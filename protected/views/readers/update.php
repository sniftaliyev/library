<?php
/* @var $this ReadersController */
/* @var $model Readers */

$this->breadcrumbs=array(
	'Readers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Readers', 'url'=>array('index')),
	array('label'=>'Create Readers', 'url'=>array('create')),
	array('label'=>'View Readers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Readers', 'url'=>array('admin')),
);
?>

<h1>Update Readers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>