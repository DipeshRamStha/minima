<?php

Class Upload extends Controller
{
  function index()
  {
    $data['page_title'] = "Upload";
    $this->view("minima/upload", $data);
  }

  
}