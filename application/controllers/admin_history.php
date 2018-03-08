<?php

class Admin_History_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		return View::make('home.admin_history');
	}

	public function get_list()
	{
		return Response::json(DB::query('select id, username, filename, fileextension, (case when isopen = 0 then "公開" else "非公開" end) as isopen, created_at from downloads order by created_at desc'));
	}

	public function post_delete()
	{
		DB::query('delete from downloads where id in ('.Input::get('ids').')');
		return Response::json(array('success' => true));
	}

}
