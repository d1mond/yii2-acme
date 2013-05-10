<?php
/**
 * @var yii\base\View $this
 * @var common\models\User[] $users
 */

$this->title = 'Users';
?>

<?php echo $this->render('/shared/_breadcrumbs', array(
	'items' => array(
		'Users',
	),
)); ?>

<?php echo $this->render('/shared/_alerts'); ?>

<?php echo $this->render('/shared/_actions', array(
	'actions' => array(
		'Create new user' => array(array('create'), 'type' => 'primary', 'icon' => 'icon-plus icon-white'),
	),
)); ?>

<?php echo $this->render('/shared/_dataGrid', array(
	'models' => $users,
	'modelName' => 'user',
	'header' => array('Name', 'Posts', ''),
	'attributes' => array('username', 'posts' => 'title'),
)); ?>
