<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php $model->idRole=1 ?>
	
		<?php echo $form->labelEx($model,'idRole'); ?>
		<?php  echo $form->textField($model,'idRole'); ?>
		<?php  echo $form->error($model,'idRole'); ?>	
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lName'); ?>
		<?php echo $form->textField($model,'lName',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'lName'); ?>
	</div>


	<div id="row">
		<?php echo $form->labelEx($model,'urlPic'); ?>
		<?php echo CHtml::activeFileField($model, 'urlPic',array('enctype' => 'multipart/form-data')); ?> 
		<?php echo $form->error($model,'urlPic'); ?>
		<?php if($model->isNewRecord!='1'){ ?>
		<div class="row">
		     <?php echo CHtml::image(Yii::app()->request->baseUrl.'/banner/'.$model->image,"urlPic",array("width"=>200)); ?>  // Image shown here if page is update page
		</div>
		<?php } ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>100,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->dropDownList($model,'idCity',CHtml::listData( $cities, 'id' , 'cityName')); ?>
		<?php echo $form->error($model,'idCity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school'); ?>
		<?php echo $form->dropDownList($model,'idSchool',CHtml::listData( $schools, 'id' , 'name')); ?>
		<?php echo $form->error($model,'idSchool'); ?>
	</div>


	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->