<?php

class Auth_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('auth.login');
	}

}
