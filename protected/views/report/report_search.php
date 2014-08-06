<?php
/* @var $this ReportController */
/* @var $data SearchBooks[] */

$this->breadcrumbs=array(
	'Report',
);
?>

<h1>Report search books</h1>
<?php echo CHtml::form($this->createUrl('search'), 'get'); ?>
	<?php echo CHtml::textField('searchText', (isset($_GET['searchText'])) ? $_GET['searchText'] : '',
		array('placeHolder' => 'Start typing the author name or/and book name', 'size' => 70)
		); ?>
	<?php echo CHtml::submitButton('search', array('display'=>'none')); ?>
<?php echo CHtml::endForm(); ?>

<?php
if($data)
foreach($data as $book_id => $book) : ?>
		<div class="view">

			<b>Name:</b>
<!--			--><?php //echo CHtml::link(CHtml::encode($book['book_name']), array('/books/view', 'id'=>$book_id)); ?>
			<?php echo CHtml::encode($book['book_name']); ?>
			<br />

			<b>Authors</b>
			<?php foreach($book['author_name'] as $author_name) { echo $author_name . ', '; } ?>
			<br />

		</div>
<?php endforeach; ?>
