<?php

class Admin_Kanri_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		return View::make('home.admin_kanri');
	}

}
