<?php
/* @var $this ReadersController */
/* @var $model Readers */

$this->breadcrumbs=array(
	'Readers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Readers', 'url'=>array('index')),
	array('label'=>'Manage Readers', 'url'=>array('admin')),
);
?>

<h1>Create Readers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>