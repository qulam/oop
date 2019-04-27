<?php

use app\core\Layouts;

Layouts::breadCrumbs();
$action = 'Create project';

return $this->render('_form', [
    'model' => $model,
    'action' => $action
]);