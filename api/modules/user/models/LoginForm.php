<?php
namespace api\modules\user\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $new_password;
    public $social_id;
    //public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email 
            [['email'], 'required','except'=>'sociallogin'],
            ['email', 'emailNotExist','except'=>'sociallogin'],


            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],

            // password is validated by validatePassword()
            [['password'], 'required','except'=>['sociallogin','resetpass']],
            ['password', 'validatePassword','except'=>['sociallogin','resetpass']],

            //For reset password
            ['new_password','safe','on'=>'resetpass'],
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
            $user = $this->getUser();
            //print_r($user);die;
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect credentials.');
            }
        }
    }

    /**
    * Validate Email/ For Not Exist.
    * This method serves as the inline validation for email.
    */
    public function emailNotExist($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            //print_r($user);die;
            if (empty($user)) {
                $this->addError($attribute, 'Email/Phone not exists.');
            }
        }
    }

    /**
    * Validate social id in driver table.
    */
    public function validateSocial($attribute,$params){
        if (!$this->hasErrors()) {
            $user = $this->getUserBySocial();
            if(empty($user)){
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
            return $this->getUser();
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmailPhoneSocial($this->email);
        }

        return $this->_user;
    }

    /**
     * Finds user by [[socialid]]
     *
     * @return User|null
     */
    protected function getUserBySocial()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmailPhoneSocial($this->social_id);
        }

        return $this->_user;
    }


    /**
     * Reset user password by using provided Email and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function resetpassword()
    {
        if ($this->validate()) {
            $userDetail = $this->getUser();
            if(!empty($userDetail)){
                
                //Update New Password If User Exists.
                $user = User::findByEmailPhoneSocial($this->email);
                $user->setPassword($this->new_password);
                $user->password_reset_otp = "";
                if($user->save(false)){
                    $msg = array('msg'=>'Password has been updated.');
                    return $msg;
                }else{
                    $msg = array('msg'=>'Password has not been updated.');
                    return $msg;
                }
            }
        }
    }

    /**
    *Login by social id.
    */
    public function socialLogin(){
        if ($this->validate()) {
            return $this->getUserBySocial();
        } else {
            return false;
        }
    }

}
