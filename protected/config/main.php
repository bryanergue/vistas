<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'theme'=>'blueribbon',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Compras',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.cruge.components.*',
		'application.modules.cruge.extensions.crugemailer.*',
		'application.extensions.crugeconnector.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'root',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
		'cruge'=>array(
				'tableprefix'=>'cruge_',

				// para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
				//
				// en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
				// para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
				//
				'availableAuthMethods'=>array('default'),

				'availableAuthModes'=>array('username','email'),

                                // url base para los links de activacion de cuenta de usuario
				'baseUrl'=>'http://coco.com/',

				 // NO OLVIDES PONER EN FALSE TRAS INSTALAR
				 'debug'=>true,
				 'rbacSetupEnabled'=>true,
				 'allowUserAlways'=>true,

				// MIENTRAS INSTALAS..PONLO EN: false
				// lee mas abajo respecto a 'Encriptando las claves'
				//
				'useEncryptedPassword' => false,

				// Algoritmo de la función hash que deseas usar
				// Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.php
				'hash' => 'md5',

				// a donde enviar al usuario tras iniciar sesion, cerrar sesion o al expirar la sesion.
				//
				// esto va a forzar a Yii::app()->user->returnUrl cambiando el comportamiento estandar de Yii
				// en los casos en que se usa CAccessControl como controlador
				//
				// ejemplo:
				//		'afterLoginUrl'=>array('/site/welcome'),  ( !!! no olvidar el slash inicial / )
				//		'afterLogoutUrl'=>array('/site/page','view'=>'about'),
				//
				'afterLoginUrl'=>null,
				'afterLogoutUrl'=>null,
				'afterSessionExpiredUrl'=>null,

				// manejo del layout con cruge.
				//
				'loginLayout'=>'//layouts/column1com',
				'registrationLayout'=>'//layouts/column1com',
				'activateAccountLayout'=>'//layouts/column1com',
				'editProfileLayout'=>'//layouts/column1com',
				// en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
				// de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
				// requerirá de un portlet para desplegar un menu con las opciones de administrador.
				//
				'generalUserManagementLayout'=>'ui',

				// permite indicar un array con los nombres de campos personalizados, 
				// incluyendo username y/o email para personalizar la respuesta de una consulta a: 
				// $usuario->getUserDescription(); 
				'userDescriptionFieldsArray'=>array('email'), 

		),
		
	),

	// application components
	'components'=>array(
		
		// uncomment the following to enable URLs in path-format
		//  IMPORTANTE:  asegurate de que la entrada 'user' (y format) que por defecto trae Yii
			//               sea sustituida por estas a continuación:
			//
			'user'=>array(
				'allowAutoLogin'=>true,
				'class' => 'application.modules.cruge.components.CrugeWebUser',
				'loginUrl' => array('/cruge/ui/login'),
			),
			'authManager' => array(
				'class' => 'application.modules.cruge.components.CrugeAuthManager',
			),
			'crugemailer'=>array(
				'class' => 'application.modules.cruge.components.CrugeMailer',
				'mailfrom' => 'email-desde-donde-quieres-enviar-los-mensajes@xxxx.com',
				'subjectprefix' => 'Tu Encabezado del asunto - ',
				'debug' => true,
			),
			'format' => array(
				'datetimeFormat'=>"d M, Y h:m:s a",
			),
		/*'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        //'urlSuffix'=>'.html',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
                
		'crugeconnector'=>array(
			'class'=>'ext.crugeconnector.CrugeConnector',
			'hostcontrollername'=>'site',
			'onSuccess'=>array('site/loginsuccess'),
			'onError'=>array('site/loginerror'),
			'clients'=>array(
				'facebook'=>array(
					// required by crugeconnector:
					'enabled'=>true,
					'class'=>'ext.crugeconnector.clients.Facebook',
					'callback'=>'http://ascinformatix.com/app1/facebookcallback.php',
					// required by remote interface:
					'client_id'=>"892839899189819",
					'client_secret'=>"019238203890182983920989018203",
					'scope'=>'email, read_stream',
				),	
				'google'=>array(
					// required by crugeconnector:
					'enabled'=>true,
					'class'=>'ext.crugeconnector.clients.Google',
					'callback'=>'http://ascinformatix.com/app1/googlecallback.php',
					// required by remote interface:
					'hostname'=>'ascinformatix.com',
					'identity'=>'https://www.google.com/accounts/o8/id',
					'scope'=>array('contact/email'),
				),
				'tester'=>array(
					// required by crugeconnector:
					'enabled'=>true,
					'class'=>'ext.crugeconnector.clients.Tester',
					// required by remote interface:
				),
			),
		),
		
        'urlManager'=>array(
            'urlFormat'=>'path',
            //'showScriptName'=>false,
        ),
        
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=comprasdb',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'titulocom'=>'Modulo de compras',
        'tituloex'=>'Control de Existencias',
        'titulocost'=>'Costeo',
        'titulomer'=>'Mercadeo',
        'titulocon'=>'Contabilidad',
        'tituloplan'=>'Planificacion',
        'footer'=>'IA Soft',
	),
);