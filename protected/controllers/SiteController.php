<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			/*// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),*/
			
			
			
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$modelLogin=new LoginForm;
		
		$model=new Users;
		
		$schools=School::model()->findAll();
		
		$cities=City::model()->findAll();
		
		
		

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($modelLogin);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$modelLogin->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($modelLogin->validate() && $modelLogin->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		if(isset($_POST['LoginForm'])){
			$info=$modelLogin->attributes;
			
			
		}else{
			$info=null;
		}
		
		
		//esta es la parte del sign up 
		
		
		// uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='users-signUp-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

	    if(isset($_POST['Users']))
	    {
			$model->attributes=$_POST['Users'];
	
            $uploadedFile=CUploadedFile::getInstance($model,'urlPic');
            
            
			if($model->save()){
				$directory=Yii::app()->basePath.'/images/'.$model->mail."/profile/";
				if (!file_exists($directory)) {
					//mkdir($directory,0700);
					//mkdir(Yii::app()->basePath.'/../../images/'.$model->mail."/profile/", 0700);
					
				}
				   //$uploadedFile->saveAs(Yii::app()->basePath.'/../../images/'.$model->mail."/profile/".$fileName);  
			 }

	
	
	        if($model->validate())
	        {
	            // form inputs are valid, do something here
				$this->redirect(Yii::app()->user->returnUrl);

	            return;
	        }
	
			// display the user form
			if(isset($_POST['Users'])){
				$info=Yii::app()->basePath;


			}else{
				$info=Yii::app()->basePath.'/images/'.$model->mail."/profile/";
			}
	
	    }
		
	    $this->render('login',array('model'=>$model,'modelLogin'=>$modelLogin,"info"=>$info,"schools"=>$schools,"cities"=>$cities));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	
}