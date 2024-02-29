<?php

Class Home extends Controller
{
  function index()
  {
    $DB = new Database();
    $data = $DB->read("SELECT * FROM images");
    show($data[0]->image);
    $this->view("home");
  }

  
}