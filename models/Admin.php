<?php

class Admin {
	public $admin_title = 'Admin Panel';

	public $login_title = 'Login to Admin Panel';

	public static function isHasError($errors, $field) {
		$result = '';
		if (array_key_exists($field, $errors)) {
			$result = 'alert alert-danger';
		} 
		return $result;
	}
}