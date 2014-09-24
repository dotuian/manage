<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'信息管理系统',
    'language' => 'zh-CN',
    
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'rootadmin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
        
        'request'=>array(
            'enableCsrfValidation'=>true,
        ),

        
        
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
        
        'db' => array(
            'class' => 'DbConnectionMan',
            'connectionString' => 'mysql:host=localhost;dbname=score_db;port=3316',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'rootadmin',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging'=>true,
            'enableSlave' => false,
            'slaves' => array(//slave connection config is same as CDbConnection
                array(
                    'connectionString' => 'mysql:host=localhost;dbname=score_db;port=3316',
                    'username' => 'root',
                    'password' => 'rootadmin',
                    'charset' => 'utf8',
                    'enableProfiling' => true,
                    'enableParamLogging'=>true,
                ),
                array(
                    'connectionString' => 'mysql:host=localhost;dbname=score_db;port=3316',
                    'username' => 'root',
                    'password' => 'rootadmin',
                    'charset' => 'utf8',
                    'enableProfiling' => true,
                    'enableParamLogging'=>true,
                ),
            ),
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
	),
);