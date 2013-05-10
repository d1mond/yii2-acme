<?php
/**
 * @var yii\base\View $this
 * @var common\models\Post $post
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php $form = $this->beginWidget('yii\widgets\ActiveForm', array(
	'enableClientValidation' => false,
	'options' => array('class' => 'form-horizontal'),
)); ?>
	<?php echo $this->render('/shared/_formErrors', array('model' => $post)); ?>

	<?php echo $form->field($post, 'title')->textInput(array('class' => 'span6')); ?>
	<?php echo $form->field($post, 'text')->textarea(array('class' => 'span6', 'rows' => 10)); ?>
	<?php echo $form->field($post, 'author_id')->radioList($this->context->users); ?>

	<?php echo $this->render('/shared/_formActions', array('model' => $post)); ?>
<?php $this->endWidget(); ?>
