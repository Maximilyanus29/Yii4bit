<?php 
/**
 * 
 */
require '../engine/Controller.php';

// use app\engine\Controller;


class IndexController//чет не могу наследование подключить
{
	public $action;
	public $params;
	

	public function beforeAction()
	{
		# code...
	}


	public function afterAction()
	{
		# code...
	}


	public function Action($action,$params)
	{
		$this->params=$params
		$this->$action;

		

	}

	public function index($params)
	{
		return 'actionIndex';
	}


	function __construct()
	{
		var_dump($this);
	}
}

 ?>