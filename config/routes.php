<?php 

$routeArray=[
	'/'=>'index/index',

	'/index/<action:\w+>/<controller:\g+>'=>'index/<action>',
	'/index/<action:\d+>'=>'index/<action>'
]






 ?>

