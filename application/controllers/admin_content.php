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
				File::delete(path('storage').'content'.DS.$content->name);
				DB::table('contents')->where('id', '=', $id)->delete();
			}
		}
		return Response::json(array('success' => true));
	}

	public function post_upload()
	{
		$upload_handler = new UploadHandler();
	}

	public function post_regist()
	{
		var_dump(Input::get('files'));
		foreach (Input::get('files') as $file) {
			$content = new Content;
			$content->name = '11';
			$content->extension = 'pdf';
			$content->save();
		}
	}

}
