<?php

class Task {
	public $title = 'A Task Board';
	
	public $title_create = 'Add a new Task';

	public $title_edit = 'Edit Task';

	// create url for order in depends of current $_GET params
	public static function urlForOrder($get, $key, $param) {
		$get[$key] = $param;
		$result = http_build_query($get);
		$result = '/?'.$result;
		return $result;
	}


	// add 'active' css class to current order links
	public static function isActive($get, $key, $param) {
		$result = '';
		if (!array_key_exists($key, $get) && ($param == 'name' || $param == 'ASC')) { //for default order values
			$result = 'active';
		} 
		if (in_array($param, $get)) {
			$result = 'active';
		}
		return $result;
	}


	// Zebra_Pagination by https://github.com/stefangabos/Zebra_Pagination
	public function pagination($items, $records_per_page) {
		require 'vendor/stefangabos/zebra_pagination/Zebra_Pagination.php';
		$pagination = new Zebra_Pagination();
		$pagination->records(count($items));
		$pagination->records_per_page($records_per_page);

		$items = array_slice(
			$items,
			(($pagination->get_page() - 1) * $records_per_page),
			$records_per_page
		);

		$result = array(
			'items' => $items, 
			'instance' => $pagination
		);
		return  $result;
	}



	public static function isHasError($errors, $field) {
		$result = '';
		if (array_key_exists($field, $errors)) {
			$result = 'alert alert-danger';
		} 
		return $result;
	}


	public static function getTask($id) {
		$database = AppController::db();
		$data = $database->select('tasks', 
			array('id', 'name', 'email', 'text', 'status', 'edited'),
			array('id' => $id)
		);
		$result = $data[0];
		return $result;
	}


	public function randomWords($length = 1) {
		$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		$arr = explode(' ', $text);

		if ($length > 1) {
			$keys = array_rand($arr, $length);
			$result = '';
			foreach ($keys as $key) {
				$result .= $arr[$key].' ';
			}
		} else {
			$key = array_rand($arr);
			$result = str_replace(array(',','.'), '', $arr[$key]);
		}
		return  $result;
	}


}