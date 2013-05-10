<?php
/**
 * @var yii\base\View $this
 * @var array $actions
 */

use yii\helpers\Html as h;
?>

<p>
	<?php foreach ($actions as $title => $options): ?>
		<?php echo h::a(
			isset($options['icon'])
				? '<i class="' . $options['icon'] . '"></i> ' . h::encode($title)
				: h::encode($title),
			$options[0],
			array('class' => 'btn btn-' . $options['type'])
		); ?>
	<?php endforeach; ?>
</p>
