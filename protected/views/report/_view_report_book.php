<?php
/* @var $this ReportController */
/* @var $data Books */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->name), array('/books/view', 'id'=>$data->id)); ?>
	<br />

	<b>Authors</b>
	<?php foreach($data->authors as $author) { echo $author->name . ', '; } ?>
	<br />

	<b>Reader:</b>
	<?php foreach($data->readers as $reader) { echo $reader->name . ', '; } ?>
	<br />

</div>