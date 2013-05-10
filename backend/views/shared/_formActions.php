<?php
/**
 * @var yii\base\View $this
 * @var yii\db\ActiveRecord $model
 */
?>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">
		<i class="icon-ok icon-white"></i>
		<?php echo $model->getIsNewRecord() ? 'Create' : 'Update'; ?>
	</button>
    <button type="reset" class="btn btn-warning">
		<i class="icon-remove icon-white"></i>
		Reset
	</button>
</div>
