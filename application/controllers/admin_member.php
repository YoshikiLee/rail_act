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

}
