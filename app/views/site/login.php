<?php

use app\core\Helpers;

?>
<style type="text/css">
	body {
		background: #006097;
	}
</style>
<div class="login_page">
	<h2 class="text-center">Login</h2>
	<form method="post" action="<?= Helpers::Url() . '/site/login' ?>">
		<div class="form-group">
			<input placeholder="Username" type="text" name="username" id="username" class="form-control">
		</div>
		<div class="form-group">
			<a href="#" class="forgot_pass">Forgot password?</a>
			<input placeholder="Password" type="password" name="password" id="password" class="form-control">
		</div>
		<div class="form-group">
			<input id="btnSubmit" class="form-control" type="submit" id="btnSubmit" class="btn btn-primary" value="Sign in">
		</div>
	</form>
</div>
