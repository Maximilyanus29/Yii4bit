<?php 


//конастанты коды ошибок для рендера страницы
define('DONT_HAVE_CONTROLLER', 0);
define('DONT_HAVE_MODEL', 1);
/**
 * 
 */
class App
{
	public $page;
	public $user;
	public $method;
	public $url;
	public $request=[];
	public $layout;
	public $action;
	public $params=[];
	public $controller;

	public $homeUrl="/";



	private function getUrl()
	{
		if (!isset($this->url)) {
			$this->url = $_SERVER['REQUEST_URI'];
		}
		
		return $this->url;
	}




	public function handleRequest($url,$routes)
	{
		if ($url=='/') {
			$this->controller='index';
			$this->action='index';
			return;
		}
		
		foreach ($routes as $key => $value) {

			if (preg_match('%'.$key.'%', $url)) {

				$explode = explode('/', $url);

				$this->controller=$explode[1];
				$this->action=$explode[2];

				//удаляю что бы получить параметры запроса
				unset($explode[0]);
				unset($explode[1]);
				unset($explode[2]);

				foreach ($explode as  $exp) {
					//получить оставшиеся параметры от url
					array_push($this->params, $exp);

				}

				
				


			}
		}
	}






	

	// public function renderErrorAppClass($codeError)
	// {
	// 	switch ($codeError) {
	// 		case 0:
	// 			echo'не удалось найти контроллер';
	// 			break;
			
	// 		default:
	// 			echo "Какая то ошибка";
	// 			break;
	// 	}

	// 	return;
	// }



	public function getController($controllerName)
	{
var_dump($this);
		
		//путь до контроллера
		$controllerPath='../Controllers/'.$controllerName.'Controller.php';


			if (file_exists($controllerPath)) {

				try {

					require_once $controllerPath;

					$controllerName=$controllerName.'Controller';

					$controller = new $controllerName;

					$controller->beforeAction();
					$controller->action($this->action,$this->params);

					$controller->afterAction();

					
					
				} catch (Exception $e) {

					echo "Почему то контроллер не создался".$e->messege;
					
				}

			}

			else{
				echo "не получилось найти контроллер";
			}
				
	}







	public function run($config)//принимает массив маршрутов
	{
		$url = $this->getUrl();



		$request = $this->handleRequest($url,$config);


		$this->getController($this->controller);
	

	}















}













 ?>