<?php

// php.ini 
// 为了是文件上传，需要修改php.ini中的post_max_size = 1G
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// set foreign_key_checks=off
// set foreign_key_checks=on

// 20140001 学号 = 入学年月 + 普高(01)/技能(02) + 校内编号(4位)



return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '孝感市综合高级中学 - ',
    'language' => 'zh_cn',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'rootadmin',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        // 设置自定义消息路径
        'coreMessages' => array(
            'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..\messages'
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => false,
            'loginUrl'=>array('site/login'),
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
        'request' => array(
            'enableCsrfValidation' => true,
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
            'connectionString' => 'mysql:host=localhost;dbname=xsglxtsql;port=3306',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'rootadmin',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'enableSlave' => false,
            'slaves' => array(
                array(
                    'connectionString' => 'mysql:host=localhost;dbname=xsglxtsql;port=3316',
                    'username' => 'root',
                    'password' => 'rootadmin',
                    'charset' => 'utf8',
                    'enableProfiling' => true,
                    'enableParamLogging' => true,
                ),
                array(
                    'connectionString' => 'mysql:host=localhost;dbname=xsglxtsql;port=3316',
                    'username' => 'root',
                    'password' => 'rootadmin',
                    'charset' => 'utf8',
                    'enableProfiling' => true,
                    'enableParamLogging' => true,
                ),
            ),
        ),
        
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, info',
                    'logFile' => 'application_' . date('Ymd') . '.log',
                ),
               array(
                    'class'=>'CWebLogRoute',
//                    'levels' => 'trace,info,error,warning,debug',
                ),
            ),
        ),
        
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'EmptySelectOption' => '--------',
        'PageSize' => 20,
        'FilePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..\..\uploadfile\\',
    ),
);
