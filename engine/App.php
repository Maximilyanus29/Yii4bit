<?php 


//конастанты коды ошибок для рендера страницы
define('DONT_HAVE_CONTROLLER', 0);
define('DONT_HAVE_MODEL', 1);
/**
 * 
 */



class App
{
	private $page;
	private $user;
	private $method;
	private $url;
	private $request=[];
	private $layout;
	private $action;
	private $params=[];
	private $controller;

	private $homeUrl="/";



	private function getUrl()
	{
		if (!isset($this->url)) {
			$this->url = $_SERVER['REQUEST_URI'];
		}
		
		return $this->url;
	}




	private function handleRequest($url,$routes)
	{
		if ($url=='/') {
			$this->controller='index';
			$this->action='index';
			return;
		}

		$isset_in_routes=true;
		
		foreach ($routes as $key => $value) {

			if (preg_match('%'.$key.'%', $url)) {

				$explode = explode('/', $url);



				$this->controller=$explode[1];

				if (isset($explode[2])) {

					if ($explode[2]==NULL) {
						$this->action="index";
					}
					else{
						$this->action=$explode[2];
					}

				}
				else{
					$this->action='index';
				}


				
				

				//удаляю что бы получить параметры запроса
				unset($explode[0]);
				unset($explode[1]);
				unset($explode[2]);

				foreach ($explode as  $exp) {
					//получить оставшиеся параметры от url
					array_push($this->params, $exp);

				}

				break;



			}


		}
	}





	private function getController($controllerName)
	{
		// var_dump($this);
		
		//путь до контроллера
		$controllerPath='../Controllers/'.$controllerName.'Controller.php';


			if (file_exists($controllerPath)) {

				try {

					require_once $controllerPath;

					$controllerName=$controllerName.'Controller';

					$controller = new $controllerName;

					$controller->beforeAction();

					if ($this->action==NULL) {
						$controller->action('index',$this->params);
					}
					else{
						$controller->action($this->action,$this->params);
					}

					

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