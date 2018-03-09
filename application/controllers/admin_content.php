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

	public function post_delete()
	{
		foreach (Input::get('ids') as $id) {
			$content = Content::find($id);
			if (isset($content)) {
				File::delete($GLOBALS['laravel_paths']['base'].'files'.DS.$content->id);
				DB::table('contents')->where('id', '=', $id)->delete();
			}
		}
		return Response::json(array('success' => true));
	}

	public function post_deleteUploadFile()
	{
		foreach (Input::get('names') as $name) {
			File::delete($GLOBALS['laravel_paths']['base'].'files'.DS.$name);
		}
		return Response::json(array('success' => true));
	}

	public function post_upload()
	{
		$upload_handler = new UploadHandler();
	}

	public function post_regist()
	{
		foreach (Input::get('names') as $name) {
			if (!empty($name)) {
				$count = Content::where('name', '=', $name)->count();
				if ($count == 0) {
					$content = new Content;
					$content->name = $name;
					$content->extension = File::extension($name);
					$content->save();
					File::move($GLOBALS['laravel_paths']['base'].'files'.DS.$name, $GLOBALS['laravel_paths']['base'].'files'.DS.$content->id);
				} else {
					return Response::json(array('success' => false, 'message' => Lang::line('messages.ng_upload', array('attribute' => $name))->get()));
				}
			} else {
				return Response::json(array('success' => false, 'message' => Lang::line('messages.content_upload_no_file')->get()));
			}
		}
		return Response::json(array('success' => true));
	}

}
