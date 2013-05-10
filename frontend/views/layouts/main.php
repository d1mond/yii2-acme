<?php
/**
 * @var yii\base\View $this
 * @var string $content
 */

use yii\helpers\Html as h;

$this->registerAssetBundle('foundation');
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

	<nav class="top-bar">
		<ul class="title-area">
			<li class="name">
				<h1><?php echo h::a(Yii::$app->name, array('site/index')); ?></h1>
			</li>
		</ul>
		<section class="top-bar-section">
			<ul class="left">
				<li class="divider"></li>
				<li class="has-dropdown">
					<a href="#">Posts</a>
					<ul class="dropdown">
						<li><label>Posts</label></li>
						<li><?php echo h::a('Latest Posts', array('post/index')); ?></li>
						<li><?php echo h::a('Popular and Best Rated', array('post/best')); ?></li>
						<li class="divider"></li>
						<li><label>Tags</label></li>
						<li><a href="#">Popular Tags</a></li>
						<li><a href="#">All Tags</a></li>
						<li class="divider"></li>
						<li><label>Comments</label></li>
						<li><a href="#">Latest Comments</a></li>
						<li><a href="#">Best Comments</a></li>
						<li><a href="#">All Comments</a></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li class="has-dropdown">
					<a href="#">Community</a>
					<ul class="dropdown">
						<li><label>Users</label></li>
						<li><?php echo h::a('Newbies', array('users/index')); ?></li>
						<li><?php echo h::a('Popular and Top Rated', array('users/best')); ?></li>
						<li class="divider"></li>
						<li><label>Groups</label></li>
						<li><a href="#">Recently Created</a></li>
						<li><a href="#">Most Interesting Group</a></li>
						<li class="divider"></li>
					</ul>
				</li>
				<li class="divider"></li>
				<li>
					<a href="#">About Us</a>
				</li>
				<li class="divider"></li>
			</ul>

			<ul class="right">
				<li class="divider"></li>
				<?php if (Yii::$app->getUser()->getIsGuest()): ?>
					<li>
						<?php echo h::a('Create New Account', array('user/create')); ?>
					</li>
					<li class="divider"></li>
					<li>
						<?php echo h::a('Sign In', array('user/login')); ?>
					</li>
				<?php else: ?>
					<li>
						<a href="#">Hello, <?php echo h::encode(Yii::$app->getSession()->get('User.username')); ?>!</a>
					</li>
					<li class="divider"></li>
					<li class="has-form">
						<?php echo h::beginForm(array('user/logout'), 'delete'); ?>
							<?php echo h::submitButton('Logout', null, null, array('class' => 'button')); ?>
						<?php echo h::beginForm(); ?>
					</li>
				<?php endif; ?>
			</ul>
		</section>
	</nav>

	<?php echo $content; ?>

	<div class="row">
		<div class="large-12 columns"><hr/></div>
		<div class="large-3 columns">&copy <?php echo date('Y'); ?> Acme Inc.</div>
		<div class="large-3 offset-6 columns" style="text-align: right;"><?php echo Yii::powered(); ?></div>
	</div>

	<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
