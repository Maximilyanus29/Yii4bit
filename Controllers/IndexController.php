<?php 
/**
 * 
 */
require '../engine/Controller.php';

use app\engine\Controller;


class IndexController//чет не могу наследование подключить
{
	public $action;
	public $params;
	public $layout='layout';
	

	public function beforeAction()
	{
		# code...
	}


	public function afterAction()
	{

	}


	public function Action($action,$params)
	{

		$func = $action;

		$this->$func($params);

		
		

	}

	public function index($params)
	{


		return $this->render('main');
	}


	public function render($view)
	{
		

		if (file_exists('../view/'.$view.'.php')) {
			// require_once '../view/'.$view.'.php';
		}

		$view="../view/".$view.".php";



		require '../view/'.$this->layout.'.php';





	}


	public function injectionIntoLayout()
	{
		# code...
	}



}

 ?>