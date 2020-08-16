<?php 

namespace app\engine;
/**
 * 
 */



abstract class Controller
{
	public $activeController;
	public $activeAction;
	public $layout='layout';


	abstract protected function index();

	protected function render($view,$params=[])
	{

		$view = new View($this->layout,$this->activeController,$params,$view);
	}


	
}




 ?>