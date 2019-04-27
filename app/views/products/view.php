<?php
use app\core\Layouts;
?>
<div class="container">
    <?= Layouts::breadCrumbs() ?>
    <table class="table table-bordered table-striped">
        <?php foreach ($model as $key => $val): ?>
            <tr>
                <td class="text-bold"><?= $key ?></td>
                <td><?= $val ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>