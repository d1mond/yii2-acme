<?php
/**
 * @var yii\base\View $this
 * @var yii\base\Model $model
 */

use yii\helpers\Html as h;
?>

<?php if ($model->getErrors()): ?>
	<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Please fix the following errors:</strong>
		<ul>
			<?php foreach ($model->getErrors() as $attribute => $errors): ?>
				<?php foreach ($errors as $error): ?>
					<li><?php echo h::encode($error); ?></li>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
