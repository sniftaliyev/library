<?php
/* @var $this ReportController */
/* @var $data array */

$this->breadcrumbs=array(
	'Report',
);

?>

<h1>Report random books</h1>

<?php foreach($data as $book) : ?>
	<div class="view">

			<b>Id:</b>
			<?php echo CHtml::encode($book['id']); ?>
			<br />

			<b>Name:</b>
			<?php echo CHtml::link(CHtml::encode($book['name']), array('/books/view', 'id'=>$book['id'])); ?>
			<br />

	</div>
<?php endforeach; ?>