<?php
namespace api\modules\driver\models;
use Yii;
use yii\base\Model;
use common\models\Driver;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $fname;
    public $lname;
    public $email;
    public $password;
	public $phone_number;
	public $otp;
	public $zipcode;
    public $social_id;
    public $social_type;
    public $id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required','except'=>'verifyotp'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Driver', 'message' => 'This email address has already been taken.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['fname', 'required','except'=>'verifyotp'],
            ['lname', 'safe'],
            ['password', 'string', 'min' => 6],
			['zipcode', 'required','except'=>'verifyotp'],

            ['phone_number', 'trim'],
            ['phone_number', 'required','except'=>'verifyotp'],
            ['phone_number', 'string', 'min' => 10, 'max' => 20],
            ['phone_number', 'unique', 'targetClass' => '\common\models\Driver', 'message' => 'This mobile number has already been taken.'],
            ['phone_number', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This mobile number has already been taken.'],
            
            
            ['social_id', 'trim'],
            ['social_id', 'string','min' => 5],
            ['social_id', 'unique', 'targetClass' => '\common\models\Driver', 'message' => 'This social_id has already been taken.'],
            ['social_id', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This social_id has already been taken.'],
            
			['otp', 'safe'],

            ['id', 'required','on'=>'verifyotp'],
            ['otp', 'required','on'=>'verifyotp'],
        ];
    }

    /**
     * Signs Driver up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        //echo $this->lname;die;
        $driver = new Driver();
		$driver->fname = $this->fname;
        $driver->lname = $this->lname;
        $driver->phone_number = $this->phone_number;
        $driver->zipcode = $this->zipcode;
        $driver->email = $this->email;
        $driver->social_id = $this->social_id;
        $driver->social_type = 'FACEBOOK';
        $driver->setPassword($this->password);
		$driver->otp='1234';
        $driver->generateAuthKey();
        $driver->registration_datetime = date('Y-m-d H:i:s');

		//return $driver->save() ? $driver : null;
        if($driver->save()){

            $resetLink = $_SERVER['HTTP_HOST'].'/site/verify-email?type=driver&token='.$driver->auth_key;
            $varKeywordContent = array('{to_email}','{email_verification_link}');
            $varKeywordValueContent = array(ucfirst($this->email),$resetLink);

            Yii::$app->commonfunction->sendMail(3,$this->email,$varKeywordContent,$varKeywordValueContent);
            return $driver;

        } else {
                return null;
        }
    }

    /**
     * Driver's details update.
     */
     public function updatedriver(){
         echo "die";die;
     } 
}
