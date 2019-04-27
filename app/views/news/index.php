<?php

use app\core\Widgets;

Widgets::listWidget($model,[
	'options' => [
		'columns' => [
			'id',
			'name',
			'category_id',
			'short',
			'description',
			'created_at',
			'updated_at',
			'admin_id'
		],
		'filters' => [
			'name',
			'category_name',
			'short',
			'created_at',
			'admin_id'
		],
		'templates' => ['view', 'update', 'delete'],
	]
]);

