<?php
/**
 * @var \yii\base\View $this
 * @var common\models\User $user
 * @var \yii\widgets\ActiveForm $form
 */

use \yii\helpers\Html as h;

$this->title = 'Login with Existing Account';
?>

<?php $form = $this->beginWidget('\yii\widgets\ActiveForm'); ?>
	<?php echo $form->field($user, 'username')->textInput(); ?>

	<?php echo $form->field($user, 'password')->passwordInput(array('autocomplete' => 'off')); ?>

	<?php echo h::submitButton('Log In'); ?>
<?php $this->endWidget(); ?>
