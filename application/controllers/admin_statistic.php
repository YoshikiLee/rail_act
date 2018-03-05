<?php

class Admin_Statistic_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		return View::make('home.admin_statistic');
	}

	public function get_list()
	{
		return Response::json(DB::query('select fileid, filename, fileextension, count(*) as total from downloads group by fileid, filename, fileextension'));
	}

}
