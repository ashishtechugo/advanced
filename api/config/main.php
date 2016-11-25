<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
//die('dff');
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'driver' => [
            'basePath' => '@app/modules/driver/',
            'class' => 'api\modules\driver\Module'
        ],
        'user' => [
            'basePath' => '@app/modules/user/',
            'class' => 'api\modules\user\Module'
        ]
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
        ],
		'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
		'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => [
                        'driver/driver','user/user'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
			        'extraPatterns' => [
                        'POST verifyotp' => 'verifyotp',
                        'POST login' => 'login',
                        'POST get-otp' => 'get-otp',
                        'POST reset-password-validate' => 'reset-password-validate',
                        'POST reset-password' => 'reset-password',
                        // 'POST requestpasswordreset' => 'requestpasswordreset',
                        // 'POST acceptbooking'   =>'acceptbooking',
                        // 'POST rejectbooking'   =>'rejectbooking',
                        // 'POST getupcomingbooking'   =>'getupcomingbooking',
                        // 'POST startridebydriver'   =>'startridebydriver',
                        // 'POST endridebydriver' =>  'endridebydriver',
                        // 'POST getcurrentride' => 'getcurrentride',
                        // 'POST bookingpayment' => 'bookingpayment',
                        // 'POST getcompletedride' => 'getcompletedride',
                        // 'POST cancelacceptedbooking' => 'cancelacceptedbooking',
                        // 'POST cancelupcomingride' => 'cancelupcomingride',
                        // 'POST getdutyslip' => 'getdutyslip',
                        // 'GET getcurrentdatetime' => 'getcurrentdatetime',
                        // 'POST updateprofile' => 'updateprofile', 
                        // 'POST updatedevicetoken' => 'updatedevicetoken',
                        // 'POST updatedriveravailability' =>'updatedriveravailability',
                        // 'POST driverschedulemanagement' =>'driverschedulemanagement',
                        // 'POST getdutylog'=> 'getdutylog',
                        // 'POST getbookinglist'=> 'getbookinglist',
                        // 'POST availabledriverforbooking' => 'availabledriverforbooking' , 
                        // 'POST resendotp' => 'resendotp' , 
                        // 'POST sendtemppassword' => 'sendtemppassword' , 	
                        // 'POST getassigneddriver' => 'getassigneddriver' , 
                        // 'POST getunassigneddriver' => 'getunassigneddriver' ,
                        // 'POST approvedriver' => 'approvedriver' , 
                        // 'POST getvehiclelist' => 'getvehiclelist',
                        // 'POST adddriver' => 'adddriver',
                        // 'POST addvehicle' => 'addvehicle',                         
                    ]
                   
                ]
            ],      
        ]
		
    ],
    'params' => $params,
	
];



