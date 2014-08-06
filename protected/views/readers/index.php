<?php
/* @var $this ReadersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Readers',
);

$this->menu=array(
	array('label'=>'Create Readers', 'url'=>array('create')),
	array('label'=>'Manage Readers', 'url'=>array('admin')),
);
?>

<h1>Readers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
