<?php

class Admin_Content_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		return View::make('home.admin_content');
	}

	public function get_list()
	{
		return Response::eloquent(Content::all());
	}

}
