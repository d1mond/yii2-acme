<?php
/**
 * @var yii\base\View $this
 * @var common\models\Post[] $posts
 */

$this->title = 'Posts';
?>

<?php echo $this->render('/shared/_breadcrumbs', array(
	'items' => array(
		'Posts',
	),
)); ?>

<?php echo $this->render('/shared/_alerts'); ?>

<?php echo $this->render('/shared/_actions', array(
	'actions' => array(
		'Create new post' => array(array('create'), 'type' => 'primary', 'icon' => 'icon-plus icon-white'),
	),
)); ?>

<?php echo $this->render('/shared/_dataGrid', array(
	'models' => $posts,
	'modelName' => 'post',
	'header' => array('Title', 'Author', ''),
	'attributes' => array('title', 'author' => 'username'),
)); ?>

