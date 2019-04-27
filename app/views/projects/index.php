<?php

use app\core\Layouts;
use app\core\Widgets;
Widgets::listWidget($model, [
    'options' => [
        'columns' => [
            'id',
            'admin_id',
            'image',
            'created_at',
            'status'
        ],
        'filters' => [
            'admin_id',
            'created_at',
            'status'
        ],
        'template' => ['view', 'update', 'delete']
    ]
]);

?>