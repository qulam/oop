<?php

use app\core\Helpers;
use app\core\Widgets;
use app\core\Layouts;

Layouts::breadCrumbs();
?>
<h2><?= 'View '. $this->title() ?></h2>

<table class="table table-bordered table-striped">
	<?php foreach($blogs as $key => $val): ?>
		<tr>
			<td><span class="text-bold"><?= $key; ?></span></td>
            <?php if($key == 'image'): ?>
                <td><img width="200" height="200" src="<?= '../../.'.$val ?>" alt=""></td>
            <?php else: ?>
                <td><?= $val; ?></td>
            <?php endif; ?>
		</tr>
	<?php endforeach; ?>

</table>