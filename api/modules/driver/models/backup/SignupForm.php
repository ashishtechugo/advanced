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
    public $authkey;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Driver', 'message' => 'This email address has already been taken.'],

            ['fname', 'required'],
            ['lname', 'safe'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			['zipcode', 'required'],

            ['phone_number', 'trim'],
            ['phone_number', 'required'],
            ['phone_number', 'number', 'min' => 10],
            ['phone_number', 'unique', 'targetClass' => '\common\models\Driver', 'message' => 'This mobile number has already been taken.'],

			['otp', 'safe'],
        ];
    }

    /**
     * Signs user up.
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
        $driver->setPassword($this->password);
		$driver->otp='12345';
		$driver->otp = md5($this->otp);
        $this->authkey = $driver->generateAuthKey();
        $driver->registration_datetime = date('Y-m-d H:i:s');

		//return $driver->save() ? $driver : null;
        if($driver->save()){

            $resetLink = $_SERVER['HTTP_HOST'].'/site/verify-email?token='.$this->authkey;
            $varKeywordContent = array('{to_email}','{email_verification_link}');
            $varKeywordValueContent = array(ucfirst($this->email),$resetLink);

            Yii::$app->commonfunction->sendMail(3,$this->email,$varKeywordContent,$varKeywordValueContent);
            return $driver;

        } else {
                return null;
        }
    }
    
}
