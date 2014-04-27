<?php

class AccountController extends \BaseController {

	public function login() {
		$application = Config::get('facebook.fb');
		$appURL = Config::get('facebook.url');
		$permissions = 'publish_stream, email, user_birthday, read_friendlists';

		// getInstance
		$facebook = FacebookConnect::getFacebook($application);
		$getUser = FacebookConnect::getUser($permissions, $appURL); // Return facebook User data

		if( !isset($getUser['user_profile']) ) {
			Session::put('error', 'Sorry! There was an error!');
			return Redirect::to('/');
		}
		Log::info('login id:'.$getUser['user_profile']['id']);

		if( !($user = self::User($getUser['user_profile'], $getUser['access_token'])) ) return Redirect::to('/');

		// Cookie::forever('token', $user['token']);
		Session::put('user', $user);
		Session::put('wfb', $getUser);

	    return Redirect::to('/items');
	}


	private static function User($userData=array(), $access_token) {
        if(isset($userData['id'])) {
            $user = User::where('provider_uid', $userData['id'])->first();
            $token = self::generateRandomString(30);

            if(isset($user->id)) {
            	Log::info('login');
                // kullanici var! update et!
                $u = User::find($user->id);
                $u->access_token = $access_token;
                $u->last_entry = date('Y-m-d H:i:s');
                // $u->token = $token;
                try {
                    $u->save();    
                } catch (Exception $e) {
                    Log::error($e);
                    return 0;
                }
                
            } else {
            	Log::info('register');
                // kullanici yok kayit et!
                $u = new User();
                $u->provider = 'facebook';
                $u->provider_uid = $userData['id'];
                $u->name = $userData['first_name'];
                $u->surname = $userData['last_name'];
                $u->username = $userData['username'];
                $u->email = isset($userData['email']) ? $userData['email'] : $userData['id'].'wasteful.com';
                $u->approved = 1;
                $u->gender = $userData['gender'];
                $u->location = $userData['locale'];
                $u->birthday = $userData['birthday'];
                $u->provider_picture = Config::get('facebook.graph_base_url').$userData['id'].Config::get('facebook.get_image_qs');
                $u->picture = Config::get('facebook.graph_base_url').$userData['id'].Config::get('facebook.get_image_qs');
                $u->token = $token;
                $u->access_token = $access_token;
                $u->date = date('Y-m-d H:i:s');
                $u->last_entry = date('Y-m-d H:i:s');
                $u->description = '';
                try {
                    $u->save();    
                } catch (Exception $e) {
                    Log::error($e);
                    return 0;
                }
                EmailController::send($u->email);
            }

        } else {
            Log::error('KULLANICI YOK!');
            return 0; 
        }
        
        Log::info('userID:'.$u->id);
        return $u;
    }

    /**
	 * @param  [type]  $Length        [description]
	 * @param  string  $CharSet       [description]
	 * @param  boolean $CaseSensitive [description]
	 * @return [type]                 [description]
	 */
	private static function generateRandomString($Length, $CharSet='hex', $CaseSensitive=true) {
		$alpha='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; //alphanumeric set
		$numeric='0123456789';
		
		if($CharSet=='alphanumeric') $cset=$alpha.$numeric;
		elseif($CharSet=='alpha') $cset=$alpha;
		elseif($CharSet=='hex') $cset=$numeric.'ABCDEF';
		else $cset=$numeric; 
		
		$len=strlen($cset);
		srand((double)microtime()*1000003);
		$out = NULL;
		for ($i=0;$i<$Length;$i++)
			$out .= $cset[rand(0,$len-1)];
		
		return ($CaseSensitive)?$out:strtolower($out);
	}

}
