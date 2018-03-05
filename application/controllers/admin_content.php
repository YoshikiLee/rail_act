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

	public function post_order()
	{
		$rules = array(
			'order' => 'required|integer'
		);
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
			return Response::json(array('success' => false, 'message' => $validation->errors->first('order')));
		}
		$content = Content::find(Input::get('id'));
		$content->order = Input::get('order');
		$content->save();
		return Response::json(array('success' => true));
	}

	public function post_description()
	{
		$content = Content::find(Input::get('id'));
		$content->description = Input::get('description');
		$content->save();
		return Response::json(array('success' => true));
	}

}
