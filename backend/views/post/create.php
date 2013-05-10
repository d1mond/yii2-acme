<?php
/**
 * @var yii\base\View $this
 * @var common\models\Post $post
 */

$this->title = 'Create new post';
?>

<?php echo $this->render('/shared/_breadcrumbs', array(
	'items' => array(
		'Posts' => array('index'),
		'Create',
	),
)); ?>

<?php echo $this->render('_form', array(
	'post' => $post,
)); ?>
