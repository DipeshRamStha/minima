<?php

Class Upload_file
{
  function upload()
  {
    $DB = new Database();

    if(isset($POST['username']) && isset($POST['password']))
    {
      $arr['username'] = $POST['username'];
      $arr['password'] = $POST['password'];
      $arr['email'] = $POST['email'];
      $arr['url_address'] = get_random_string_max(60);
      $arr['date'] = date("Y-m-d H:i:s");

      $query = "INSERT INTO users (username, password, email, url_address, date) VALUES (:username, :password, :email, :url_address, :date)";
      $data = $DB->write($query, $arr);
      if($data)
      {
        header("Location:". ROOT . "login");
        die;
      }
    }
  }
}