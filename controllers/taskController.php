<?php
use Rakit\Validation\Validator;

class TaskController extends AppController {

	public function index() {
		$task = $this->model('Task');
		$database = $this->db();

		$order = 'ASC'; //default order
		$order_by = 'name'; //default order_by

		if (!empty($_GET)) {
			if (isset($_GET['order_by'])) {
				$order_by = $_GET['order_by'];
			}
			if (isset($_GET['order'])) {
				$order = $_GET['order'];
			}
		}

		$tasks = $database->select('tasks', 
			array('id', 'name', 'email', 'text', 'status', 'edited'),
			array('ORDER' => array($order_by => $order))
		);

		$items_per_page = 3;
		$pagination = $task->pagination($tasks, $items_per_page);

		$this->view('home', array(
			'title' => $task->title,
			'tasks' => $pagination['items'],
			'pagination' => $pagination['instance'],
			'items_per_page' => $items_per_page,
			)
		);
	}

	public function create() {
		$task = $this->model('Task');
		$database = $this->db();
		$validator = new Validator;
		$data = array( 'name' => '', 'email' => '', 'text' => '');
		$errors = array();
		$success = false;

		if ($_POST) {
			$data = $_POST;

			$validation = $validator->make($data, 
			array(
				'name' => 'required',
				'email' => 'required|email',
				'text' => 'required'
				)
			);
			// then validate
			$validation->validate();

			if ($validation->fails()) {
				// handling errors
				$errors = $validation->errors();
				$errors = $errors->firstOfAll();
			} else {
				// it's valid. Save to db
				$database->insert('tasks', array(
					'name' => htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'),
					'email' => $data['email'],
					'text' => htmlspecialchars($data['text'], ENT_QUOTES, 'UTF-8'),
					'status' => 0
					)
				);

				$success = true;
				$data = array( 'name' => '', 'email' => '', 'text' => '');
			}
		}

		$this->view('taskcreate', array(
			'title' => $task->title_create,
			'data' => $data,
			'errors' => $errors,
			'success' => $success,
			)
		);
	}


	public function edit() {
		// when no admin
		if (!$this->isAdmin()) {
			header('Location: ' . '/admin/login', true, 301); die();
		}
		// when we unknown edited task id
		if ((!isset($_GET['id']) || empty($_GET['id'])) && !isset($_POST['id'])) {
			header('Location: ' . '/admin', true, 301); die();
		}
		// when form reloaded and we miss $_GET params
		$id = (isset($_POST['id'])) ? $_POST['id'] : $_GET['id'];

		$task = $this->model('Task');
		$database = $this->db();
		$validator = new Validator;
		$errors = array();
		$success = false;

		$data = $task->getTask($id);

		if ($_POST) {
			$old_data = $task->getTask($id);
			$data = $_POST;

			$validation = $validator->make($data, 
			array(
				'name' => 'required',
				'email' => 'required|email',
				'text' => 'required'
				)
			);
			// then validate
			$validation->validate();

			if ($validation->fails()) {
				// handling errors
				$errors = $validation->errors();
				$errors = $errors->firstOfAll();
			} else {
				// it's valid. Update into db

				// check edited by admin label
				$edited = 0;
				if ($old_data['text'] != $data['text'] || $old_data['edited'] == 1) {
					$edited = 1;
				}

				$database->update('tasks', 
					array(
						'name' => htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'),
						'email' => $data['email'],
						'text' => htmlspecialchars($data['text'], ENT_QUOTES, 'UTF-8'),
						'status' => $data['status'],
						'edited' => $edited
						), 
					array('id' => $id)
				);

				$data = $task->getTask($id);
				$success = true;

			}
		}

		$this->view('taskedit', array(
			'title' => $task->title_edit,
			'data' => $data,
			'errors' => $errors,
			'success' => $success,
			)
		);
	}


	// This for quick generate tasks by /task/generator page refresh. enjoy! 
	public function generator() {
		$task = $this->model('Task');
		$database = $this->db();

		$database->insert('tasks', array(
				'name' => $task->randomWords(),
				'email' => strtolower($task->randomWords().'@'.$task->randomWords().'.com'),
				'text' => $task->randomWords(rand(20, 45)),
				'status' => rand(0, 1),
				'edited' => rand(0, 1),
				)
			);

		$tasks = $database->select('tasks', 
			array('id', 'name', 'email', 'text', 'status', 'edited'),
			array('ORDER' => array('id' => 'DESC'))
		);

		$this->view('taskgenerator', array(
			'tasks' => $tasks
			)
		);
	}


}
