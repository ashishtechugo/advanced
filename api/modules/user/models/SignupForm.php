<?php
namespace api\modules\user\models;
use Yii;
use yii\base\Model;
use common\models\User;

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
    public $social_id;

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
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['fname', 'required'],
            ['lname', 'safe'],
            ['password', 'string', 'min' => 6],
			['zipcode', 'required'],

            ['phone_number', 'trim'],
            ['phone_number', 'required'],
            ['phone_number', 'string', 'min' => 10, 'max' => 20],
            ['phone_number', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This mobile number has already been taken.'],
            
            ['social_id', 'trim'],
            ['social_id', 'string','min' => 5],
            ['social_id', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This social_id has already been taken.'],
            
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
        $user = new User();
		$user->fname = $this->fname;
        $user->lname = $this->lname;
        $user->phone_number = $this->phone_number;
        $user->zipcode = $this->zipcode;
        $user->email = $this->email;
        $user->social_id = $this->social_id;
        $user->setPassword($this->password);
		$user->otp='1234';
        $this->authkey = $user->generateAuthKey();
        
        if($user->save()){

            $resetLink = $_SERVER['HTTP_HOST'].'/site/verify-email?token='.$this->authkey;
            $varKeywordContent = array('{to_email}','{email_verification_link}');
            $varKeywordValueContent = array(ucfirst($this->email),$resetLink);

            Yii::$app->commonfunction->sendMail(3,$this->email,$varKeywordContent,$varKeywordValueContent);
            return $user;

        } else {
                return null;
        }
    }

}