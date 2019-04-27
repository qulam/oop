<?php

use app\core\HTML;
use app\core\ActiveForm;

?>

<?php ActiveForm::begin(); ?>

    <?= HTML::field($model, 'name')->textInput(); ?>

    <?= HTML::field($model, 'short')->textInput();  ?>

    <?= HTML::field($model, 'description')->textArea(); ?>

    <?=  HTML::field($model,'status')->dropdownList(['0' => 'Weather', '1' => 'Sosial', '2' => 'Economical'])?>

    <?=  HTML::field($model,'status')->dropdownList(['1' => 'active', '0' => 'deactive'])?>

    <?= HTML::button(['class' => 'btn ']); ?>

<?php ActiveForm::end(); ?>



