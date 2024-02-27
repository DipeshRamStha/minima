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
    /**
     * In the context of your provided code, $this->controller = new $this->controller; is indeed a dynamic way of instantiating a controller class based on the URL route. Let's break down what's happening:

Dynamic Controller Instantiation: The line $this->controller = new $this->controller; dynamically creates an instance of a controller class based on the value stored in $this->controller. In PHP, you can use variables to dynamically specify the name of a class to instantiate.

Default Controller: If the file corresponding to the controller specified in the URL is not found, the default controller page is set to home.php. This behavior is implemented earlier in the constructor:


private $controller = "home";
This line sets the default controller to "home" if no other controller is specified in the URL. So, if the requested URL does not specify a controller, the home controller will be instantiated by default.

Class Name Resolution: The value stored in $this->controller is expected to be the name of the controller class. For example, if the URL specifies product, then $this->controller would be set to "product". In PHP, when you use $this->controller as the class name in new $this->controller, PHP will look for a class with that name and instantiate it.

Usage Example: Let's say your URL is http://example.com/product/milk/5. The controller specified in the URL is product. In your project's directory structure, you have a ProductController.php file containing a ProductController class.

When the application routes the request to the controller, it dynamically instantiates the ProductController class using:


$this->controller = new ProductController();
Since $this->controller holds the string "ProductController", PHP interprets it as the name of the class to instantiate.

Overall, this approach allows for dynamic routing and instantiation of controller classes based on the URL route. It provides flexibility in handling different requests without needing to explicitly specify each controller class instantiation.
     */
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
    /**
     * Then what does $_GET['url'] contains? Explain

When the .htaccess file rewrites the URL to index.php?url=$1, it takes the original URL path (after the domain name) and appends it as a query string parameter named url to index.php.

For example, let's say you have a URL like this:


http://example.com/product/milk/5
After the rewrite rule in the .htaccess file is applied, the URL becomes:

http://example.com/index.php?url=product/milk/5
Now, $_GET['url'] in your index.php file will contain the value 'product/milk/5'. This value represents the path portion of the original URL that comes after the domain name, without the leading slash.

In your PHP application, you can then parse this value and use it to determine which controller, method, and any additional parameters should be invoked to handle the request.

For example, you might have logic in your App class to parse this URL and determine that it corresponds to the product controller, the milk method, and 5 as an additional parameter. This allows your application to route the request appropriately and execute the corresponding code to handle the request.
     */
    return explode("/", filter_var(trim($_GET['url'], "/"), FILTER_SANITIZE_URL));


  }

}

