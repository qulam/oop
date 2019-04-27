<?php

use app\core\ActiveForm;
use app\core\HTML;

?>

<div class="container-fluid">
	<div class="form">
		<div class="row">
			<h2><?= $action ?></h2>

			<?php ActiveForm::begin(); ?>

				<?= HTML::field($model, 'title')->textInput()?>

				<?= HTML::field($model, 'short')->textInput()?>

				<?= HTML::field($model, 'description')->textArea();?>

                <?= HTML::field($model,'image')->fileInput(); ?>

				<?= HTML::button(['class' => 'btn btn-success', 'id' => 'btnSuccess', 'value' => 'Save']); ?>

			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>