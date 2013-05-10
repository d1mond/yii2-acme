<?php
/**
 * @var yii\base\View $this
 * @var yii\base\Model $model
 */

use yii\helpers\Html as h;
?>

<?php if ($model->getErrors()): ?>
	<div class="panel radius">
		<h5><strong>Please fix the following errors:</strong></h5>
		<ul>
			<?php foreach ($model->getErrors() as $attributeName => $errors): ?>
				<?php foreach ($errors as $error): ?>
					<li><?php echo h::encode($error); ?></li>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
