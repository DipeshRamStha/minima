<?php
Class Posts
{
  function get_all()
  {
    $page_number = isset($_GET['page']) ? $_GET['page'] : 1;

    $limit = 2;
    $offset = ($page_number - 1) * $limit;
    $query = "SELECT * FROM images ORDER BY id DESC LIMIT $limit OFFSET $offset";

    $DB = new Database();
    $data = $DB->read($query);
    if(is_array($data))
    {
      return $data;

    }
    return false;
  }

  function get_one($link)
  {
    $query = "SELECT * FROM images WHERE url_address = :link LIMIT 1";
    $arr['link'] = $link;

    $DB = new Database();
    $data = $DB->read($query, $arr);
    if(is_array($data))
    {
      return $data[0];
    }
    return false;
  }
}