<?php
/**
 * @var yii\base\View $this
 * @var common\models\User $user
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php $form = $this->beginWidget('yii\widgets\ActiveForm', array(
	'enableClientValidation' => false,
	'options' => array('class' => 'form-horizontal'),
)); ?>
	<?php echo $this->render('/shared/_formErrors', array('model' => $user)); ?>

	<?php echo $form->field($user, 'username')->textInput(array('class' => 'span4')); ?>
	<?php echo $form->field($user, 'email')->textInput(array('class' => 'span4')); ?>

	<?php echo $form->field($user, 'password')->passwordInput(array('class' => 'span4', 'autocomplete' => 'off')); ?>
	<?php echo $form->field($user, 'passwordRepeat')->passwordInput(array('class' => 'span4', 'autocomplete' => 'off')); ?>

	<?php echo $form->field($user, 'postIds')->checkboxList($this->context->posts); ?>

	<?php echo $this->render('/shared/_formActions', array('model' => $user)); ?>
<?php $this->endWidget(); ?>
