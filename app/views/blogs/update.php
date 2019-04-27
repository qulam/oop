<?php

use app\core\Layouts;

Layouts::breadCrumbs();

$action = 'Update Blog';
return $this->render('_form', [
	'model' => $model,
	'action' => $action,
]);
