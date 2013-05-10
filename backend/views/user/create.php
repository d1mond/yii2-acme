<?php
/**
 * @var yii\base\View $this
 * @var common\models\User $user
 */

$this->title = 'Create new user';
?>

<?php echo $this->render('/shared/_breadcrumbs', array(
	'items' => array(
		'Users' => array('index'),
		'Create',
	),
)); ?>

<?php echo $this->render('_form', array(
	'user' => $user,
)); ?>
