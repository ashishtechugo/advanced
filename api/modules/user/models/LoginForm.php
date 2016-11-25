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
    public $phone_number;
    public $password;
    public $new_password;
    //public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email 
            [['email','password'], 'required'],
            ['email', 'emailNotExist'],


            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],

            // password is validated by validatePassword()
            ['password', 'validatePassword'],

            //For reset password
            ['new_password','safe','on'=>'resetpass'],
            ['new_password','string','min' => 6,'on'=>'resetpass'],

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
            $this->_user = User::findByEmailPhone($this->email);
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
                $user = User::findByEmailPhone($this->email);
                $user->setPassword($this->new_password);
                //print_r($user);
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

    

}
