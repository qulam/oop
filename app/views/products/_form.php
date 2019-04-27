<?php

use app\Core\ActiveForm;
use app\core\HTMl;
use app\core\Layouts;

?>

<div class="container-fluid">
	<div class="form">
		<div class="row">
            <h2>Create <?= $this->title() ?></h2>

				<?php ActiveForm::begin();?>

					<?= HTML::field($model, 'name')->textInput(); ?>

					<?= HTML::field($model, 'short')->textInput(); ?>

					<?= HTML::field($model, 'description')->textArea(); ?>

					<?= HTML::field($model, 'price')->textInput(); ?>

                    <?= HTML::field($model, 'image')->fileInput(); ?>

					<?= HTML::field($model, 'status')->dropdownList(['1' => 'active', '0' => 'deactive']); ?>

					<?= HTML::button(['class' => 'btn btn-success', 'id' => 'btnSuccess', 'value' => 'Save']); ?>

				<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>