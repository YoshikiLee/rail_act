<?php

class Admin_Auth_Controller extends Base_Controller {

	public $restful = true;

	public $errors;

	public function __construct() {
		// $this->filter( 'before', 'guest' )->except( array( 'logout', 'validate' ) );
		// $this->filter( 'before', 'csrf' )->on( 'post' )->except( array( 'login' ) );
	}

	/**
	 * No direct access needed
	 *
	 * @return NULL
	 */
	public function get_index() {
		$input = array('username' => '');
		return View::make('auth.admin_login')->with('input', $input);
	}

	/**
	 * Verify login information and authenticate the client
	 *
	 * @param array
	 * @return Redirect
	 */
	public function post_login() {
		$input = array('username' => Input::get('username'));
		$rules = array(
    	'username'  => 'required|max:32',
    	'password' => 'required|max:32',
		);
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
				return View::make('auth.admin_login')->with('input', $input)->with_errors($validation);
		}
		$credentials = array('username' => Input::get('username'), 'password' => Input::get('password'), 'isadmin' => true);
		if (Auth::attempt($credentials))
		{
			return Redirect::to('admin/home');
		} else {
			$this->errors = new Messages;
			$this->errors->add('username', Lang::line('auth.failed')->get());
			return View::make('auth.admin_login')->with('input', $input)->with_errors($this->errors);
		}
	}

	/**
	 * Handle logout requests by cleaning up the session
	 *
	 * @return View
	 */
	public function post_logout() {
		return $this->logout();
	}

	/**
	 * Handle logout requests by cleaning up the session
	 *
	 * @return View
	 */
	public function get_logout() {
		return $this->logout();
	}

	/**
	 * Handle logout requests by cleaning up the session
	 *
	 * @return View
	 */
	public function logout() {
		Auth::logout();
		return View::make('auth.admin_logout');
	}
}
