<?php

class Admin_Member_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$users = User::all();
		$minid = min($users)->id;
		return View::make('home.admin_member')
							->with('users', $users)
							->with('minid', $minid);
	}

	public function post_changepassword()
	{
		$rules = array(
			'password' => 'required|max:32'
		);
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
			return Response::json(array('success' => false, 'message' => $validation->errors->first('password')));
		}
		$user = User::where('id', '=', Input::get('userid'))->first();
		$user->password = Hash::make(Input::get('password'));
		$user->save();
		return Response::json(array('success' => true, 'lastupdated' => $user->updated_at));
	}

}
