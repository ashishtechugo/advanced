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
             $data = array('id'=>$user->id);
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
                $data = array('id'=>$user->id);
                return ['error_code'=>201,'result' =>'success','message'=>'','data'=>$data];
            }else{
                return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$user];
            }
        }else{
            return ['error_code'=>400,'result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
        }
        return $model;
    }

    /**
    *Get OTP user
    */
    public function actionGetOtp(){
        $requestData = Yii::$app->getRequest()->getBodyParams();
        //$otp = Yii::$app->commonfunction->genrateotp($_POST['id'],'user');
        //$data = array('id'=>$_POST['id'],'otp'=>$otp);
        $data = array('id'=>$_POST['id'],'otp'=>'1234');
        return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$data];
    }

    /**
    * verify and update otp user
    */
    public function actionVerifyotp() {
        $requestData = Yii::$app->getRequest()->getBodyParams();
        if(isset($requestData['id']) && empty($requestData['id'])){
            return ['error_code'=>400,'result' =>'failure','message'=>"ID field required."];
        }

        if(isset($requestData['otp']) && empty($requestData['otp'])){
            return ['error_code'=>400,'result' =>'failure','message'=>"OTP field required."];
        }

        $result = Yii::$app->commonfunction->checkotp($requestData['id'], $requestData['otp'],'user');
        $user = User::findIdentity($requestData['id']);
        if($result === true){
            return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$user];
        }else{
            return ['error_code'=>400,'result' =>'failure','message'=>"Wrong OTP"];
        }

    }

    /**
    *Reset Password Validation By Mobile number & Email
    */
    public function actionResetPasswordValidate(){
        
        $requestData = Yii::$app->getRequest()->getBodyParams();
        //BY Mobile Number
        if(isset($requestData['phone_number']) && !empty($requestData['phone_number'])){
            
            //echo "mobile number";die;
            $resdata = Yii::$app->commonfunction->resetpasswordotp($requestData['phone_number'],'user');
            if(!empty($resdata)){
                $data = array('id'=>$resdata['id'],'otp'=>$resdata['otp']);
                return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$data];
            }else{
                return ['error_code'=>400,'result' =>'failure','message'=>'Mobile number not found.'];
            }

        }

        //BY Email-ID
        if(isset($requestData['email']) && !empty($requestData['email'])){
            echo "email";die;
        }

    }

    /**
    *Reset Password 
    *Input: old_password, new_password
    */
    public function actionResetPassword(){
        
        $model = new LoginForm();
        $model->scenario = 'resetpass';
        $model->load(Yii::$app->getRequest()->getBodyParams(),'');
        if($model->validate()){
            $user = $model->resetpassword();
            if(!$user){
                return ['error_code'=>400,'result' =>'failure','message'=>array_values($model->getFirstErrors())[0]];
            }else{
                return ['error_code'=>200,'result' =>'success','message'=>'','data'=>$user];
            }
        }else{
            return ['error_code'=>400,'result'=>'failuree','message'=>array_values($model->getFirstErrors())[0]];
        }
    }

}