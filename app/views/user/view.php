<?php

use app\core\Helpers;
use app\core\Widgets;
use app\core\Layouts;

Layouts::breadCrumbs();
?>

<h2><?= 'View '. $this->title() ?></h2>


<table class="table table-bordered table-striped">
	
	<?php foreach($user as $key => $val): ?>
		<tr>
			<td><span class="text-bold"><?= $key; ?></span></td>
			<td><?= $val; ?></td>
		</tr>
	<?php endforeach; ?>

</table>