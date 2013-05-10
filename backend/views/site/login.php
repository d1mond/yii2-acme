<?php
/**
 * @var yii\base\View $this
 * @var common\models\User $user
 * @var yii\widgets\ActiveForm $form
 */

use \yii\helpers\Html as h;

$this->title = 'Login into control panel';
?>

<?php $form = $this->beginWidget('\yii\widgets\ActiveForm', array(
	'enableClientValidation' => false,
	'options' => array('class' => 'form-horizontal'),
)); ?>
	<?php echo $form->field($user, 'username')
		->textInput(array('placeholder' => $user->getAttributeLabel('username'))); ?>

	<?php echo $form->field($user, 'password')
		->passwordInput(array('placeholder' => $user->getAttributeLabel('password'), 'autocomplete' => 'off')); ?>

    <div class="control-group">
		<div class="controls">
			<?php echo h::submitButton('<i class="icon-lock icon-white"></i> Sign In',
				null, null, array('class' => 'btn btn-primary')); ?>
		</div>
    </div>
<?php $this->endWidget(); ?>
