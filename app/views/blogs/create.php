<?php

use app\core\Layouts;

Layouts::breadCrumbs();

$action = 'Create Blog';
return $this->render('_form',[
	'model' => $model,
	'action' => $action,
]);
