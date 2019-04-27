<?php

use app\core\ActiveForm;
use app\core\Html;
use app\core\Layouts;

?>

<?= Layouts::breadCrumbs() ?>

<div class="container-fluid">
	<div class="form">
		<h2><?= $action ?></h2>

		<?php ActiveForm::begin(); ?>

			<?= HTML::field($model, 'name')->textInput(); ?>

			<?= HTML::field($model, 'username')->textInput(); ?>

			<?= HTML::field($model, 'email')->textInput(); ?>

			<?= HTML::field($model, 'password_hash')->textInput(); ?>

			<?= HTML::field($model, 'status')->dropdownList(['1' => 'active', '0' => 'deactive']); ?>

			<?= HTML::button(['class' => 'btn btn-primary', 'id' => 'btnSuccess', 'value' => 'Save']); ?>

		<?php ActiveForm::end(); ?>

	</div>
</div>