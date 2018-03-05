<?php

class Admin_History_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		return View::make('home.admin_history');
	}

	public function get_list()
	{
		return Response::eloquent(Download::order_by('created_at', 'desc')->take(5000)->get());
	}

	public function post_delete()
	{
		DB::query('delete from downloads where id in ('.Input::get('ids').')');
		return Response::json(array('success' => true));
	}

}
