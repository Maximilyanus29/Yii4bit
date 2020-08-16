<?php 
namespace App;
/**
 * 
 */
use app\engine\Controller;
use app\engine\RouterWithGetParams;

class App
{

	public $controller;
	public $model;
	public $view;

	
	function __construct()
	{
		
	}


	public function run($config=NULL)
	{
		// $app = new Controller();

		$request = new RouterWithGetParams();

		$controller = $request->handleRequest();



	}


	
}






 ?>