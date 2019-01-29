<?php

namespace app\models;

use fw\core\base\Model;


class User extends Model
{
    public $attributes = [
        'login' => '',
        'password' => '',
        'email' => '',
        'name' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['email'],
            ['name'],
        ],
        'email' => [
            ['email']
        ],
        'lengthMin' => [
            ['password', 6],
        ],
    ];

    public function checkUnique()
    {
        $user = \R::findOne('user', 'login = ? OR email = ? LIMIT 1', [$this->attributes['login'], $this->attributes['email']]);
        if($user) {
            if($user->login ==  $this->attributes['login']) {
                $this->errors['unique'][] = 'This login has already registered';
            }
            if($user->email ==  $this->attributes['email']) {
                $this->errors['unique'][] = 'This email has already registered';
            }
            return false;
        }
        return true;
    }
}
