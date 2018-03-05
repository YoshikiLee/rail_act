<?php

class Admin_Content_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{
		$contents = Content::all();
		return View::make('home.admin_content')->with('contents', $contents);
	}

	public function post_isopen()
	{
		$content = Content::find(Input::get('id'));
		$content->isopen = Input::get('isopen');
		$content->save();
		return Response::json(array('success' => true));
	}

}
