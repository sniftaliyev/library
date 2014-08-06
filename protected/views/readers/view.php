<?php
/* @var $this ReadersController */
/* @var $model Readers */

$this->breadcrumbs=array(
	'Readers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Readers', 'url'=>array('index')),
	array('label'=>'Create Readers', 'url'=>array('create')),
	array('label'=>'Update Readers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Readers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Readers', 'url'=>array('admin')),
);
?>

<h1>View Readers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'update_time',
		'create_time',
	),
)); ?>
