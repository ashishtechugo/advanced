<?php
namespace api\modules\driver\models;

use Yii;
use yii\base\Model;
use common\models\Driver;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    //public $rememberMe = true;
    public $social_id;
    public $new_password;

    private $_driver;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email'], 'required','except'=>'sociallogin'],
            ['email', 'emailNotExist','except'=>'sociallogin'],

            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],

            // password is validated by validatePassword()
            [['password'], 'required','except'=>['sociallogin','resetpass']],
            ['password', 'validatePassword','except'=>['sociallogin','resetpass']],

            //For reset password
            ['new_password','required','on'=>'resetpass'],
            ['new_password','string','min' => 6,'on'=>'resetpass'],

            //social id validation
            ['social_id','required','on'=>'sociallogin'],
            ['social_id','validateSocial','on'=>'sociallogin'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $driver = $this->getDriver();
            //print_r($driver);die;
            if (!$driver || !$driver->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
    * Validate Email/phone For Not Exist.
    * This method serves as the inline validation for email.
    */
    public function emailNotExist($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $driver = $this->getDriver();
            //print_r($user);die;
            if (empty($driver)) {
                $this->addError($attribute, 'Email/Phone not exists.');
            }
        }
    }

    /**
    * Validate social id in driver table.
    */
    public function validateSocial($attribute,$params){
        if (!$this->hasErrors()) {
            $driver = $this->getDriverBySocial();
            if(empty($driver)){
                $this->addError($attribute,'Social-Id does not exists.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return $this->getDriver();
        } else {
            return false;
        }
    }

    /**
     * Finds driver by [[email/phone]]
     *
     * @return Driver|null
     */
    protected function getDriver()
    {
        if ($this->_driver === null) {
            $this->_driver = Driver::findByEmailPhoneSocial($this->email);
        }

        return $this->_driver;
    }

    /**
     * Finds driver by [[socialid]]
     *
     * @return Driver|null
     */
    protected function getDriverBySocial()
    {
        if ($this->_driver === null) {
            $this->_driver = Driver::findByEmailPhoneSocial($this->social_id);
        }

        return $this->_driver;
    }

    /**
    *Login by social id.
    */
    public function socialLogin(){
        if ($this->validate()) {
            return $this->getDriverBySocial();
        } else {
            return false;
        }
    }

    /**
    *Reset validatePassword
    */
    public function resetpassword(){
        if ($this->validate()) {
            $driverDetail = $this->getDriver();
            if(!empty($driverDetail)){
                
                //Update New Password If User Exists.
                $driver = Driver::findByEmailPhoneSocial($this->email);
                $driver->setPassword($this->new_password);
                $driver->password_reset_otp = "";
                //print_r($driver);
                if($driver->save(false)){
                    $msg = array('msg'=>'Password has been updated.');
                    return $msg;
                }else{
                    $msg = array('msg'=>'Password has not been updated.');
                    return $msg;
                }
            }
        }
    }


}
