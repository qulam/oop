<?php
use app\core\Layouts;


Layouts::breadCrumbs();

return $this->render('_form',[
	'model' => $model,
]);

