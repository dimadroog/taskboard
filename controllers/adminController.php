<?php
use Rakit\Validation\Validator;

class AdminController extends AppController {

	public function index() {		
		if (!$this->isAdmin()) {
			header('Location: ' . '/admin/login', true, 301); die();
		}

		$admin = $this->model('Admin');
		$task = $this->model('Task');
		$database = $this->db();

		$tasks = $database->select('tasks', 
			array('id', 'name', 'email', 'text', 'status', 'edited'),
			array('ORDER' => array('status' => 'ASC'))
		);

		$this->view('admin', array(
			'title' => $admin->admin_title,
			'tasks' => $tasks
			)
		);
	}


	public function login() {
		$admin = $this->model('Admin');
		$data = array('login' => '', 'pass' => '');
		$validator = new Validator;
		$errors = array();
		$success = false;

		if ($_POST) {
			$data = $_POST;

			$validation = $validator->make($data, 
			array(
				'login' => 'required',
				'pass' => 'required',
				)
			);
			// then validate
			$validation->validate();

			if ($validation->fails()) {
				// handling errors
				$errors = $validation->errors();
				$errors = $errors->firstOfAll();
			} 

			// check login/pass match
			$login = 'admin';
			$pass = '123';
			if ($data['login'] != $login || $data['pass'] != $pass) {
				$errors['match'] = 'Login or password is incorrect';
			}

			if (empty($errors)) {
				// it's valid. Do login
				$_SESSION['login'] = 'admin';
				header('Location: ' . '/admin', true, 301); die();
			}
		}

		$this->view('login', array(
			'title' => $admin->login_title,
			'data' => $data,
			'errors' => $errors,
			'success' => $success
			)
		);
	}

	public function logout() {
		unset($_SESSION['login']);
		header('Location: ' . '/', true, 301); die();
	}


}
