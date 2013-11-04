<?php

class SiteController extends Controller
{
    public $layout='//layouts/column1com';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
			
			'crugeconnector'=>array('class'=>'CrugeConnectorAction'),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionoldIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
    
    public function actionIndexCompras()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        //$this->layout ='//layouts/column1com';
        $this->render('index-Compras');
    }
    
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        //$this->layout ='//layouts/column1com';
        $this->render('index-Compras');
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
	{if (Yii::app()->user->checkAccess("action_site_contact"))
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
		else
        {
        throw new CrugeException("Usted no tiene los permisos para realizar esta accion");     
        } 
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
        $this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionLoginSuccess($key){
		$loginData = Yii::app()->crugeconnector->getStoredData();

		// Hacer un mapeo de campos.
		//
		// el argumento 'scope' del cliente 'facebook'
		// causara que facebook nos envie de regreso datos como estos:
		// 	{username, email, firstname, lastname}
		// pues debemos decirle a cruge que campos coinciden con
		// cuales campos internos de cruge para que los reconozca:
		//
		if($key == 'facebook')
		$fieldmap = array(
			'username'=>'username',
			'email'=>'email',
			'nombre'=>'first_name', 
			'apellido'=>'last_name'
		);
		// igual que el caso anterior, pero para el caso google:
		if($key == 'google')
		$fieldmap = array(
			'email'=>'contact/email',
			// caso google: no trae username, pues cruge lo generara
			// de ser necesario de forma automatica.
		);
		if($key == 'tester')
		$fieldmap = array('email'=>'contact/email');

		// en este punto, fieldmap dice: que campos de Cruge estan relacionados
		// con cuales campos que nos ha enviado facebook o google.
		//	por ejemplo: array('email'=>'contact/email'),
		//
		// ademas, loginData se espera que sea un array indexado, cuyo
		// indice sea un campo de facebook o google:
		//   por ejemplo:  array('contact/email'=>'juanperez@abc.com'),
		//
		// la modalidad de registro puede ser una de:
		//	'auto', 'manual' o 'none'
		//
		$debugFlag = false;
		$errorInfo = '';
		$url = Yii::app()->user->um->remoteLoginInterface(
				$fieldmap, CJSON::decode($loginData), 'auto', $errorInfo,
				$debugFlag);
		
		if($url == false)
		{
			// errorInfo tiene mas informacion del error.
			//
			Yii::log(__METHOD__, $errorInfo,'error');
			$this->renderText('<h3>Disculpe no se pudo iniciar sesion.'
					.'</h3><pre><i>'.$errorInfo.'</i></pre>');
		}
		else
		{
			// puede ser la pagina de login o la pagina de registration
			//  errorInfo dice 'registration' en caso de ser la url de registro
			//	si la modalidad indicada es 'manual'.
			//
			$this->redirect($url);
		}
	}

	
}