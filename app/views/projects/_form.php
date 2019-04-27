<?php

use app\core\ActiveForm;
use app\core\HTML;

?>

<div class="container-fluid">
    <div class="form">
        <div class="row">
            <h2><?= $action ?></h2>

            <?php ActiveForm::begin(); ?>

            <?= HTML::multiLanguage($model, [
                    'title' => [
                        'class' => 'title',
                        'id' => 'titleInput',
                        'placeholder' => 'Enter title',
                        'editor' => false
                    ],
                    'short' => [
                        'class' => 'short',
                        'id' => 'shortInput',
                        'placeholder' => 'Enter short',
                        'editor' => false
                    ],
                    'description' => [
                        'class' => 'description',
                        'id' => 'descriptionInput',
                        'placeholder' => 'Enter description',
                        'editor' => true
                    ],
            ]); ?>

            <?= HTML::field($model,'image')->fileInput(); ?>

            <?= HTML::field($model, 'status')->dropdownList(['1' => 'active', '0' => 'deactive']) ?>

            <?= HTML::button(['class' => 'btn btn-success', 'id' => 'btnSuccess', 'value' => 'Save']); ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>