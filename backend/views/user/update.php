<?php
/**
 * @var yii\base\View $this
 * @var common\models\User $user
 */

$this->title = 'Update user';
?>

<?php echo $this->render('/shared/_breadcrumbs', array(
	'items' => array(
		'Users' => array('index'),
		'Update',
	),
)); ?>

<?php echo $this->render('_form', array(
	'user' => $user,
)); ?>
