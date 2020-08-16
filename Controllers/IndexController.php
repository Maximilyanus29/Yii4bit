<?php 

namespace app\Controllers;
/**
 * 
 */
use app\engine\Controller;


class indexController extends Controller
{

	public $layout='main';


	public function index($params=null)
	{

		return $this->render('index',['max'=>1241]);
	}

	
}




 ?>