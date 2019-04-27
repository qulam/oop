<?php

use app\core\Layouts;

echo Layouts::breadCrumbs();

$action = 'Update';

return $this->render('_form', [
	'model' => $model,
]);
