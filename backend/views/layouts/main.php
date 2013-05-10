<?php
/**
 * @var yii\base\View $this
 * @var string $content
 */

use yii\helpers\Html as h;

$this->registerAssetBundle('bootstrap');
$this->title = Yii::$app->name . ($this->title ? ' — ' . $this->title : '');
?>
<?php $this->beginPage(); ?>
<!doctype html>
<html lang="<?php echo Yii::$app->language; ?>">

<head>
	<meta charset="UTF-8"/>

	<title><?php echo h::encode($this->title); ?></title>

	<?php $this->head(); ?>
</head>

<body>
	<?php $this->beginBody(); ?>

	<div class="navbar">
		<div class="navbar-inner">
			<?php echo h::a(Yii::$app->name, array('site/index'), array('class' => 'brand')); ?>
			<?php if (!Yii::$app->getUser()->getIsGuest()): ?>
				<ul class="nav">
					<li class="divider-vertical"></li>
					<li<?php echo h::renderTagAttributes($this->context->id == 'post' ? array('class' => 'active') : array()); ?>>
						<?php echo h::a('Posts', array('post/index')); ?>
					</li>
					<li<?php echo h::renderTagAttributes($this->context->id == 'user' ? array('class' => 'active') : array()); ?>>
						<?php echo h::a('Users', array('user/index')); ?>
					</li>
					<li class="divider-vertical"></li>
				</ul>
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li>
						<?php echo h::beginForm(array('site/logout'), 'delete', array('style' => 'display: inline;')); ?>
							<?php echo h::submitButton('Logout', null, null,
								array('class' => 'btn btn-mini btn-info')); ?>
						<?php echo h::endForm(); ?>
					</li>
				</ul>
			<?php endif; ?>
		</div>
	</div>

	<div class="container-fluid">
		<?php echo $content; ?>

		<hr/>
		<div class="row">
			<div class="span2">
				&copy <?php echo date('Y'); ?> Acme Inc.
			</div>
			<div class="span2 offset8">
				<?php echo Yii::powered(); ?>
			</div>
		</div>
	</div>

	<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
