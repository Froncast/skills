<?php

namespace app\models;
use app\core\Model;

class Login extends Model
{
    public $error;

    /**
     *  Validate
     */

    public function validate($input, $post)
    {
        $rules = [
            'email' => [
                'pattern' => '/^([a-z0-9_.-]{3,20}+)@([a-z0-9_.-]+)\.([a-z\.]{2,10})$/',
                'message' => 'Invalid email address!',
            ],

            'login' => [
                'pattern' => '/^[a-z]{3,15}$/',
                'message' => 'The login specified is incorrect (only latin letters from 3 to 15 characters are allowed)',
            ],

            'password' => [
                'pattern' => '/^([a-z0-9!_.-]{5,30})$/',
                'message' => 'The password is incorrect (only latin letters and numbers from 5 to 30 characters are allowed)',
            ],
        ];
        
        foreach ($input as $val) {
            if(!isset($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])){
                $this->error = $rules[$val]['message'];
                return false;
            }
            return true;
        }
    }

    /**
     *  Admin auth start
     */

    public function checkData($login, $password)
    {
        $params = [
            'login' => $login,
        ];

        $hash = $this->db->column('SELECT `password` FROM users WHERE `login` = :login', $params);
        if (!$hash or !password_verify($password, $hash)) {
            $this->error = "Username or password are incorrect!";
            return false;
        }
        return true;
    }

    public function adminAuth($login)
    {
        $params = [
            'login' => $login,
        ];

        $data = $this->db->row('SELECT * FROM `users` WHERE `login` = :login', $params);
        $_SESSION['admin'] = $data[0];
        return true;
    }

    /**
     *  Admin auth end
     */

}