<?php

class ItemsController extends \BaseController {


	public function get() {
		$wfb = Session::get('wfb');
		$user = Session::get('user');
		$token = Cookie::get('token');
		Log::info( '***user Token:'.$user['token'].' : cookie:'.$token );
		// var_dump($user);
		
		if(!isset($wfb['user_profile']['id']) || !isset($user['token'])) return Redirect::to('/');
		// var_dump($wfb);
		// var_dump($user['user']['provider']);
		
		$items = Item::get();
		// echo "<pre>";
		// foreach ($items as $key => $it) {
		// 	var_dump($it->name);
		// }
		// $datas = Session::get('data');
		// var_dump($datas);
		return View::make('choseitems', array('items' => $items));
	}

	public function send() {
		$wfb = Session::get('wfb');
		$user = Session::get('user');
		$token = Cookie::get('token');
		Log::info( '***user Token:'.$user['token'].' : cookie:'.$token );

		$data = array();
		foreach (Input::all() as $key => $value) {
			if($value==0 || $value=='') continue;
			$itemData = explode('-', $key);
			$data[$itemData[1]] = $value;

			$waste = new Waste();
			$waste->user_id = $user['id'];
			$waste->item_id = $itemData[1];
			$waste->cost = preg_replace("/[^0-9.]/", "", $value);
			$waste->date = date('Y-m-d');
			$waste->date_time = date('Y-m-d H:i:s');
			try {
				$waste->save();
			} catch (Exception $e) {
				Log::error($e);
				return;
			}
		}
		if(count($data)==0) return Redirect::to('/items');
		Log::info('post', $data);

		return Redirect::to('/items/calculate');
	}

	public function cal() {
		$wfb = Session::get('wfb');
		$user = Session::get('user');
		$token = Cookie::get('token');
		Log::info( '***user Token:'.$user['token'].' : cookie:'.$token );

		$wasted = Waste::with('item')->where('user_id', $user['id'])->get();
		$wastedCalori = 0;
		$carbon = 0;
		foreach ($wasted as $key => $value) {
			$wastedCalori += $value->cost * $value->item->calori;
			$carbon += $value->cost * $value->item->carbon;
			// echo $carbon;
			// var_dump($value->item->name);
			// return $value->id;
		}
		// echo $wastedCalori.' - '.$carbon;
		// echo "<pre>";
		return View::make('results', array('person'=>number_format((float)($wastedCalori/600), 1, '.', ''), 'carbon'=>number_format((float)($carbon/1000), 1, '.', '') ));
	}

}