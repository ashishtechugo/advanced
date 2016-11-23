<?php
namespace api\modules\user\controllers;

use Yii;
use common\models\User;
use api\modules\user\models\SignupForm;
use api\modules\user\models\LoginForm;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
class UserController extends ActiveController{
    public $modelClass = '\common\models\User';
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

    /**
    *Signup User
    */
    public function actionCreate(){
        //echo "here";die;
        $model = new SignupForm;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if($model->validate()){
           $user = $model->signup();
           if (!$user) {
             return ['error_code'=>400,'result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
           } else {
             $data = array('id'=>$user->id,'otp'=>'1234');
             return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$data];
           }
        }else {
           return ['error_code'=>400,'result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
        }
        return $model;
    }

    /**
    *Login User
    */
    public function actionLogin(){
        $model = new LoginForm();
        $model->load(Yii::$app->getRequest()->getBodyParams(),'');

        if($model->validate()){
            $user =  $model->login();
            if(!$user){
                return ['error_code'=>400,'result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
            }elseif($user->otp_status == "NO"){
                $data = array('id'=>$user->id,'otp'=>'1234');
                return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$data];
            }else{
                return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$user];
            }
        }else{
            return ['error_code'=>400,'result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
        }
        return $model;
    }

    /**
    * verify and update otp user
    */
    public function actionVerifyotp() {
        
        if(isset($_POST['id']) && empty($_POST['id'])){
            return ['error_code'=>400,'result' =>'failure','message'=>"ID field required."];
        }

        if(isset($_POST['otp']) && empty($_POST['otp'])){
            return ['error_code'=>400,'result' =>'failure','message'=>"OTP field required."];
        }

        $result = Yii::$app->commonfunction->checkotp($_POST['id'], $_POST['otp'],'user');
        $user = User::findIdentity($_POST['id']);
        if($result === true){
            return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$user];
        }else{
            return ['error_code'=>400,'result' =>'failure','message'=>"Wrong OTP"];
        }

    }

}