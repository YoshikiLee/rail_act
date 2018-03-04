<?php

class Home_Controller extends Base_Controller {

	public $restful = true;
	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function get_index()
	{
		$contents = Content::where('isopen', '=', true)->get();
		foreach ($contents as $content) {
				$content->url='download/'.$content->name;
		}
		return View::make('home.index')->with('contents', $contents);
	}

	public function get_download($filename)
	{
		$content = Content::where('name', '=', $filename)->first();
		if (isset($content) && file_exists($file= path('storage').'content'.DS.$filename)) {
			$download = new Download;
			$download->userid = Auth::user()->id;
			$download->username = Auth::user()->username;
			$download->filename = $content->name;
			$download->fileextension = $content->extension;
			$download->isopen = $content->isopen;
      $download->save();
      return Response::download($file, $filename);
		} else {
			return Response::error('404');
		}
	}

}
