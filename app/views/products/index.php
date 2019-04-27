<?php
use app\core\Widgets;


Widgets::listWidget($model, [
	'options' => [
		'columns' => [
				'id',
				'name',
				'short',
				'price',
				'description',
				'created_at'
			],
		'filters' => [
//				'id',
				'description',
				'short',
				'name',
				'price',
				'created_at'
		],
		'templates' => [
			'view', 'update', 'delete'
		]
	]
]);