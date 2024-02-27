<?php

Class App
{
  private $controller = "home";
  private $method = "index";
  // After the url product/milk/5 or any other parameter after milk stored in params array
  private $params = [];

  public function __construct()
  {
    $url = $this->splitURL();

    if(file_exists("../app/controllers/" . strtolower($url[0]) .".php")){
      $this->controller = strtolower($url[0]);
      unset($url[0]);
    };
    require "../app/controllers/" . $this->controller .".php";
    $this->controller = new $this->controller;

    if(isset($url[1])){
      if(method_exists($this->controller, $url[1])){
        $this->method = $url[1];
        unset($url[1]);
      }

    }

    // run the class and method
    $this->params = array_values($url);
    call_user_func_array([$this->controller, $this->method], $this->params);

  }

  private function splitURL()
  {
    return explode("/", filter_var(trim($_GET['url'], "/"), FILTER_SANITIZE_URL));


  }

}
