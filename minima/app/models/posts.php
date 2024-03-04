<?php
Class Posts
{
  function get_all()
  {
    $query = "SELECT * FROM images ORDER BY id DESC LIMIT 12";

    $DB = new Database();
    $data = $DB->read($query);
    if(is_array($data))
    {
      return $data;

    }
    return false;
  }
}