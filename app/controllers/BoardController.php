<?php

class BoardController extends \BaseController {

	public function get() {
        $wfb = Session::get('wfb');
        $user = Session::get('user');
        
        if(!isset($wfb['user_profile']['id']) || !isset($user['token'])) return Redirect::to('/');
        if(!isset($user['access_token'])) return Redirect::to('/');
		// Session::put('wfb', $getUser);

        // https://graph.facebook.com/me/friends?access_token=CAAMWBEE1YwsBAJZAZAJ6cPUFO8VPW3zSixc30SVhxGW6ywPmXApO2OlDtJc7VX5EZCRKTSw7d60mEM6ZAwe89BzRDh3CVuEJ3WsG8FzzwO4Jc1GlhG2l3aRAzr1egMw5Gh4b31FeIZCBgPfW5EaGKC026O4vH4cMaUhK0r9U2F1xgW38HSglC&fields=id,name&limit=5000
        
        $headers = array('Accept' => 'application/json');
        $request = Requests::get(Config::get('facebook.graph_base_url').Config::get('facebook.get_friends_qs').$user['access_token'].'&fields=id&limit=5000', $headers);
        $userData = @json_decode($request->body);
        
        $users = array();
        foreach ($userData->data as $key => $us) {
            // echo "<pre>";
            // var_dump($us);
            // return;

            $friend = User::where('provider_uid', $us->id)->first();
            if( !isset($friend->id) ) continue;
            
            $wasted = Waste::with('item')->where('user_id', $friend->id)->get();

            $carbon = 0;
            foreach ($wasted as $key => $value) {
                // $wastedCalori += $value->cost * $value->item->calori;
                $carbon += $value->cost * $value->item->carbon;
            }
            // bu kisi bizim kullanicimiz
            $friend->carbon = number_format((float)($carbon/1000), 1, '.', '');
            $users[] = $friend;
        }

        $sessionUser = User::find($user['id']);
        $wasted2 = Waste::with('item')->where('user_id', $user['id'])->get();
        $carbon = 0;
        foreach ($wasted2 as $key => $value) {
            // $wastedCalori += $value->cost * $value->item->calori;
            $carbon += $value->cost * $value->item->carbon;
        }
        $sessionUser->carbon = number_format((float)($carbon/1000), 1, '.', '');
        $users[count($users)] = $sessionUser;
        // $users = (object)self::array_sort((object)$users, 'carbon', $order=SORT_ASC);

        // echo "<pre>";
        // var_dump($users);
        return View::make('leaderboard', array('users'=>$users));
	}

    public static function profile() {
        $wfb = Session::get('wfb');
        $user = Session::get('user');
        
        if(!isset($wfb['user_profile']['id']) || !isset($user['token'])) return Redirect::to('/');
        if(!isset($user['access_token'])) return Redirect::to('/');

        $wasted = Waste::where('user_id', $user['id'])->groupBy('date')->get();
        $datas = array();

        foreach ($wasted as $key => $value) {
            // $dateTime = explode(' ', $value->date);
            // echo $dateTime[0]."\n";

            $wasted2 = Waste::with('item')->where('user_id', $user['id'])->where('date', 'LIKE', $value->date)->get();

            $carbon = 0;
            foreach ($wasted2 as $key => $value2) {

                $carbon += $value2->cost * $value2->item->carbon;
                // echo $carbon;
            }
            $datas[] = (object)array(
                        'date'=>$value->date,
                        'carbon'=>number_format((float)($carbon/1000), 1, '.', '')
                        );
        }
        // echo "<pre>";
        // print_r($datas);
        // return;
        return View::make('profile', array('data'=>$datas ));
    }

    private static function array_sort($array, $on, $order=SORT_ASC){

        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}
