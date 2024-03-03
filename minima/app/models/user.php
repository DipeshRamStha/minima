<?php

Class User
{
  function login($POST)
  {

    $DB = new Database();

    $_SESSION['error'] = "";
    if(isset($POST['username']) && isset($POST['username']))
    {
      $arr['username'] = $POST['username'];
      $arr['password'] = $POST['password'];

      $query = "SELECT * FROM users WHERE username = :username && password = :password LIMIT 1";
      $data = $DB->read($query, $arr);
      if(is_array($data))
      {
        // logged in
        $_SESSION['user_id'] = $data[0]->userid;
        $_SESSION['user_name'] = $data[0]->username;
      }else {
        $_SESSION['error'] = "wrong username or password";
      }

    }else {
      $_SESSION['error'] = "please enter a valid username and password";
    }
    

  }

  function signup()
  {

  }

  function check_login()
  {

  }
}