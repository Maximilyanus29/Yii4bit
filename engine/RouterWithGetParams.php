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



			$controller=explode('/', trim($_GET['route'],'/'))[0];
			$action=explode('/', trim($_GET['route'],'/'))[1];


			unset($_GET['route']);


			if (file_exists('../Controllers/indexController.php')) {

				require_once '../Controllers/indexController.php';

				$controller = new \app\Controllers\indexController();

				if (method_exists($controller, $action)) {
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

				$controller->index();
			}

		}

		




	}



}








 ?>