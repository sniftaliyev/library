<?php
/* @var $this BooksController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Update Books', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Books', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<h1>View Books #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
//		'update_time',
//		'create_time',
	),
));
?>
<table class="detail-view">
	<tbody>
	<tr class="odd">
		<th>Authors</th>
		<td>
			<?php foreach($model->authors as $author) { echo $author->name . ', '; } ?>
		</td>
	</tr>
	<tr class="even">
		<th>Readers</th>
		<td>
			<?php foreach($model->readers as $reader) { echo $reader->name . ', '; } ?>
		</td>
	</tr>
	</tbody>
</table>
