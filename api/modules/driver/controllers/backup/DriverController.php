<?php
namespace api\modules\driver\controllers;

use Yii;
//use common\models\User;
use api\modules\driver\models\SignupForm;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
class DriverController extends ActiveController
{
    public $modelClass = '\common\models\Driver';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
	
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // $behaviors['authenticator'] = [
        //     'class' => CompositeAuth::className(),
        //     'authMethods' => [
        //         QueryParamAuth::className(),
        //     ],
        // ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view'], $actions['otpverification'], $actions['validateemail']);
        return $actions;
    }
    
    public function actionIndex()
    {
        echo "here";die;
        // $modelClass = $this->modelClass;
	
        // $query = $modelClass::find();
        // return new ActiveDataProvider([
        //     'query' => $query,
        // ]);
    }
    
    public function actionCreate()
    {
        //echo "HERE";die;
        $model = new SignupForm;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if($model->validate()){
           if (!$model->signup()) {
             return ['result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
             return array_values($model->getFirstErrors())[0];
           } else {
             return ['result' =>'success','message'=>''];
           }
        }else {
           return ['result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
        }
        return $model;
    }

    /*public function actionValidateemail() {
        echo "here";die;
        $model = new ValidateEmail;
        $model->load(Yii::$app->getRequest()->getBodyParams(),'');

        if(!$model->validate()){
           if(!$model->verifyEmail()){
               return ['result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
               return array_values($model->getFirstErrors())[0];
           } else {
               return ['result' =>'success','message'=>''];
           }
        }else{
            return ['result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
        }
        return $model;

    }*/

}