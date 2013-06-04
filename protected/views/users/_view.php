<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mail')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mail), array('view', 'id'=>$data->mail)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lName')); ?>:</b>
	<?php echo CHtml::encode($data->lName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('urlPic')); ?>:</b>
	<?php echo CHtml::encode($data->urlPic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idRole')); ?>:</b>
	<?php echo CHtml::encode($data->idRole); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCity')); ?>:</b>
	<?php echo CHtml::encode($data->idCity); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idSchool')); ?>:</b>
	<?php echo CHtml::encode($data->idSchool); ?>
	<br />

	*/ ?>

</div>