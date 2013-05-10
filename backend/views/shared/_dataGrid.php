<?php
/**
 * @var yii\base\View $this
 * @var yii\db\ActiveRecord $models
 * @var string $modelName
 * @var array $header
 * @var array $attributes
 */

use yii\helpers\Html as h;
use yii\helpers\StringHelper as s;
use yii\helpers\ArrayHelper as a;
?>

<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<?php foreach ($header as $item): ?>
				<th><?php echo h::encode($item); ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php if ($models): ?>
			<?php foreach ($models as $model): ?>
				<tr>
					<?php foreach ($attributes as $key => $value): ?>
						<?php if (is_numeric($key)): ?>
							<td>
								<?php if ($model->hasProperty('url')): ?>
									<?php echo h::a(h::encode($model->getAttribute($value)), $model->url); ?>
								<?php else: ?>
									<?php echo h::encode($model->getAttribute($value)); ?>
								<?php endif; ?>
							</td>
						<?php else: ?>
							<?php if (is_array($model->$key)): ?>
								<td><?php echo h::encode(implode(', ', a::getColumn($model->$key, $value))); ?></td>
							<?php else: ?>
								<td><?php echo h::encode($model->$key->getAttribute($value)); ?></td>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>

					<td style="width: 250px;">
						<?php echo h::beginForm(array('update', 'id' => $model->id), 'get',
							array('style' => 'display: inline;')); ?>
							<?php echo h::submitButton('<i class="icon-pencil"></i> Edit ' . $modelName, null, null,
								array('class' => 'btn')); ?>
						<?php echo h::endForm(); ?>

						<?php echo h::beginForm(array('delete', 'id' => $model->id), 'delete',
							array('style' => 'display: inline;')); ?>
							<?php echo h::submitButton('<i class="icon-trash icon-white"></i> Delete ' . $modelName,
								null, null, array('class' => 'btn btn-danger')); ?>
						<?php echo h::endForm(); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="<?php echo count($header); ?>">
					<strong>Unfortunately there are no existing <?php echo s::pluralize($modelName); ?>! Please add new one.</strong>
				</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
