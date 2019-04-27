<?php

use app\config\Params;
use app\core\Helpers;

?>

<div id="mySidenav" class="sidenav">
	<?php 
		$menuItems = Params::Modules();
	?>
	<ul>
		<li><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></li>

		<?php foreach($menuItems as $menu => $item){ ?>

			<?php if($item['children']):?>

				<li>
		  			<a href="<?= Helpers::Url() . '/' . $item['url'] ?>"><?= $item['label'] ?>
		  			<span class="menu_arrow_icon">
		  				<i class="fa fa-smile"></i>
		  			</span>
		  			</a>
		  			<ul>
		  				<?php foreach($item['children'] as $child): ?>

		  					<li><a href="<?= Helpers::Url() . '/' . $child['url'] ?>"><?= $child['label'] ?></a></li>

		  				<?php endforeach; ?>
		  			</ul>
				</li>

			<?php else: ?>

				<li><a href="<?= Helpers::Url() . '/' . $item['url'] ?>"><?= $item['label'] ?></a></li>

			<?php endif; ?>

		<?php } ?>
	</ul>
</div>

<!-- Use any element to open the sidenav -->
<span style="font-size: 30px;" class="fa fa-angle-right" onclick="openNav()"></span>

<div class="container-fluid">
	<h2 class="text-center">Header area</h2>
	<span id="sign_log">
        <?php $a = 'asdasdasd'; ?>
		<a href="" id=user_profile><i class="fa fa-user"></i></a>
		<a href="<?= Helpers::Url() . '/site/logout' ?>" id=user_logout><i class="fa fa-sign-out-alt"></i></a>
	</span>
</div>