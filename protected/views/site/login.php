<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<?php var_dump($info); ?>


<?php echo $this->renderPartial('_login', array('modelLogin'=>$modelLogin)); ?>


<?php echo $this->renderPartial('../users/_form', array('model'=>$model,"schools"=>$schools,"cities"=>$cities)); ?>






