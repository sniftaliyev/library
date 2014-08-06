<?php
/* @var $this BooksController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'books-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'authorsName'); ?>
		<?php
		if($model->authors){
			foreach($model->authors as $author)
				$model->authorsName .= $author->name . '||';
		}
		$this->widget('CAutoComplete',
			array(
				'model'=>$model,
				'attribute'=>'authorsName',
				'url'=>array('autocomplete'),
//				'textArea' => true,
				'multiple'=>true,
				'multipleSeparator'=>'||',
				'minChars'=>2,
				'htmlOptions'=>array(
					'size'=>'60',
					'placeholder' => 'Start typing the author name'
				)
			)
		);
		?>
		<?php echo $form->error($model,'authorsName'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->