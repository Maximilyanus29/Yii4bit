<?php 

namespace app\engine;

use app\engine\Request;

/**
 * 
 */
class RouterWithGetParams extends Request
{
	
	function __construct()
	{

	}



	public function handleRequest()
	{
		//если есть параметров значит рендерим из параметра route

		if (isset($_GET['route'])) {
			$route=$_GET['route'];



			$controllerId=explode('/', trim($_GET['route'],'/'))[0];
			$action=explode('/', trim($_GET['route'],'/'))[1];


			unset($_GET['route']);


			if (file_exists('../Controllers/indexController.php')) {

				require_once '../Controllers/indexController.php';
				
//строка для создания класса из пространства имен контроллеров
				$namespaceStringCreateObject="app\\Controllers\\".$controllerId."Controller";

				$controller = new $namespaceStringCreateObject;

				$controller->activeController=$controllerId;

				if (method_exists($controller, $action)) {

					$controller->activeAction=$action;
					$controller->$action($_GET);

				}
				else{
					echo "не такого действия";
				}

				


			}


		}
		else{
			//если нет параметров значит рендерим главную страницу

			if (file_exists('../Controllers/indexController.php')) {

				require_once '../Controllers/indexController.php';

				$controller = new \app\Controllers\indexController();

				$controller->activeController='index';

				$controller->activeAction='index';

				$controller->index();
			}

		}

		




	}



}








 ?>