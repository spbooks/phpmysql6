<?php
namespace Ninja;

class Authentication {
    private $users;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct(DatabaseTable $users, $usernameColumn, $passwordColumn) {
        session_start();
        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }

    public function login($username, $password) {
        $user = $this->users->find($this->usernameColumn, strtolower($username));

        if (!empty($user) && password_verify($_SESSION['password'], $user[$this->passwordColumn])) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user['password'];
            return true;
        }
        else {
            return false;
        }
    }  

    public function isLoggedIn() {
         $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

         if (!empty($author) && $author[$this->passwordColumn] === $_SESSION['password']) {
            return true;
         }
         else {
            return false;
         }
    }
}