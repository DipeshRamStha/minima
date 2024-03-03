<?php

Class Signup extends Controller
{
  function index()
  {
    $data['page_title'] = "Signup";
    $this->view("minima/signup", $data);
  }

  
}