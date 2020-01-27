<?php
require 'vendor/autoload.php';
use Medoo\Medoo;

class AppController {

	protected $status = 200;

	protected $url;

	// default controller
	protected $controller = 'taskController';

	// default method.
	protected $method = 'index';
	
	// params from the URI
	protected $params = array();

	// database lib by https://medoo.in/
	// a database connect, port, dbname, user, pass
	public static function db(){
		$database = new Medoo(
			array(
				'database_type' => 'sqlite',
				'database_file' => 'data.db'
			)
		);
		return $database;
	}

	public function setstatus($status) {
		$this->status = $status;
		return $this;
	}

	public function getstatus() {
		return $this->status;
	}

	public function respondNotFound() {
		require_once 'header.php';
		require_once 'views/404.php';
		require_once 'footer.php';
		exit();
	}

	// constructor and parce url to array
	public function __construct() {
		if (isset($_GET['url']) && !empty($_GET['url'])) {
			$this->url =  explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
		}
	}

	//run app by controller method and pass params
	public function dispatch() {
		$this->setController();
		$this->setMethod();
		$this->setParams();
		call_user_func_array(array($this->controller, $this->method), $this->params);
	}

	// set the controller by the first index from the url
	private function setController() {
		$path = 'controllers/' . $this->url[0] . 'Controller.php';

		if (file_exists($path)) {
			$this->controller = $this->url[0] . 'Controller';
			unset($this->url[0]);
		}
		else if (!file_exists($path) && !empty($this->url[0])) {
			$this->respondNotFound();
		}
		require_once 'controllers/' . $this->controller . '.php';
		$this->controller = new $this->controller();
	}

	// method by the second index of the url
	private function setMethod() {
		if (isset($this->url[1]) && method_exists($this->controller, $this->url[1])) {
			$this->method = $this->url[1];
			unset($this->url[1]);
		}
	}

	// set the params to pass to the controller method
	private function setParams() {
		$this->params = $this->url ? array(array_values($this->url), $_POST) : array($_POST);
	}

	// return a new instance of a model
	public function model($model)
	{
		if (is_readable('models/' . $model . '.php')) {
			require_once 'models/' . $model . '.php';
			return new $model();
		}
		throw new Exception("Model $model not exist");
	}

	// return view with data
	public function view($view, $data = array()){
		$data['view'] = $view;
		extract($data);

		if (is_readable('views/' . $view . '.php')) {
			require_once 'header.php';
			require_once 'views/' . $view . '.php';
			require_once 'footer.php';
		} else {
			$this->respondNotFound();
		}
	}

	public function isAdmin() {
		$result = false;
		if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') {
			$result = true;
		} 
		return $result;
	}

}