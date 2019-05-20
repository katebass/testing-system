<?php

namespace app\models;
use yii\base\Model;

class SignupForm extends Model{

    public $username;
    public $password;
    public $email;
    public $name;

    public function rules() {
        return [
            [['username', 'password', 'email', 'name'], 'required'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'This username is already in use'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Login',
            'password' => 'Password',
            'email' => 'Email',
            'name' => 'Full Name',
        ];
    }

}