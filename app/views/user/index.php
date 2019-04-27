<?php
use app\core\Widgets;

Widgets::listWidget($model,[
	'options' => [
		'columns' => [
			'id',
			'name',
			'username',
			'email',
			'password_hash',
			'created_at',
			'status',
		],
		'filters' => [
			'name',
			'username',
			'email',
			'password_hash',
			'created_at',
			'status',
		],
		'templates' => [
			'view', 'update', 'delete'
		]
	]
]);


