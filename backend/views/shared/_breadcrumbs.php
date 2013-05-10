<?php
/**
 * @var yii\base\View $this
 * @var array $items
 */

use yii\helpers\Html as h;
?>

<ul class="breadcrumb">
	<?php $lastKey = end($items); ?>
	<?php foreach ($items as $key => $item): ?>
		<?php if (is_numeric($key)): ?>
			<li class="active">
				<?php echo h::encode($item); ?>
				<?php if ($lastKey != $key): ?>
					<span class="divider">/</span>
				<?php endif; ?>
			</li>
		<?php else: ?>
			<li>
				<?php echo h::a(h::encode($key), $item); ?>
				<?php if ($lastKey != $key): ?>
					<span class="divider">/</span>
				<?php endif; ?>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
