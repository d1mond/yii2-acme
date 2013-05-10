<?php
/**
 * @var yii\base\View $this
 */

use yii\helpers\Html as h;
?>

<?php if (Yii::$app->getSession()->hasFlash('successAlert')): ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Congratulations!</strong>
		<?php echo h::encode(Yii::$app->getSession()->getFlash('successAlert')); ?>
	</div>
<?php endif; ?>
