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

    private $_driver;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email', 'emailNotExist'],

            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],

            // password is validated by validatePassword()
            ['password', 'validatePassword'],
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
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getDriver()
    {
        if ($this->_driver === null) {
            $this->_driver = Driver::findByEmailPhone($this->email);
        }

        return $this->_driver;
    }
}
