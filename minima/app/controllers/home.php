<?php

Class Home extends Controller
{
  function index()
  {
    $DB = new Database();
    $data = $DB->read("SELECT * FROM images");
    $this->view("home", $data);
  }

  
}