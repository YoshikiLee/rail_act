<?php

class Admin_History_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		return View::make('home.admin_history');
	}

}
