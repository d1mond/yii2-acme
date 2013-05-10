<?php
/**
 * @var yii\base\View $this
 * @var common\models\User $user
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html as h;

$this->title = 'Create New User Account';
?>

<div class="row">
	<div class="large-8 columns">
		<h1><?php echo h::encode($this->title); ?></h1>
	</div>
	<div class="large-4 columns">
		<p style="margin-top: 25px;">
			<a href="#"><span class="round success label">— I already have existing account!</span></a>
		</p>
	</div>
</div>

<div class="row">
	<div class="large-5 columns">
		<?php $form = $this->beginWidget('\yii\widgets\ActiveForm', array(
			'enableClientValidation' => false,
			'fieldConfig' => array(
				'errorOptions' => array('style' => 'display: none;'),
			),
		)); ?>
			<?php echo $form->field($user, 'username')->textInput(); ?>

			<?php echo $form->field($user, 'password')->passwordInput(array('autocomplete' => 'off')); ?>
			<?php echo $form->field($user, 'passwordRepeat')->passwordInput(array('autocomplete' => 'off')); ?>

			<?php echo $form->field($user, 'email')->textInput(); ?>

			<?php echo h::submitButton('Create Account'); ?>
		<?php $this->endWidget(); ?>
	</div>
	<div class="large-5 columns">
		<?php echo $this->render('/shared/_formErrors', array('model' => $user)); ?>
	</div>
	<div class="large-2 columns">&nbsp;</div>
</div>
