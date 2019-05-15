<?php

namespace app\models;
use yii\base\Model;

class SignupForm extends Model{

    public $username;
    public $password;
    public $email;

    public function rules() {
        return [
            [['username', 'password', 'email'], 'required'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'This username is already in use'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

}