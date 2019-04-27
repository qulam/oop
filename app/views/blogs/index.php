<?php
use app\core\Widgets;

Widgets::listWidget($model, [
	'options' => [
		'columns' => [
			'id',
			'title',
			'short',
			'description',
		],
		'filters' => [
			'short',
			'title',
			'description',
			'id'
		],
		'templates' => ['view', 'update', 'delete'],

	]
]);
?>
