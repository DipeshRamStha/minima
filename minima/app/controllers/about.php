<?php
/**
 * Yes, regardless of the physical file location of the Controller class, any PHP file that includes or requires the file containing the Controller class definition can access it, as long as the class definition is loaded into memory.

This behavior is possible due to PHP's file inclusion mechanism, which allows you to include files from anywhere within your project directory structure.

Let's illustrate this with a detailed example:

Suppose you have the following directory structure:

project/
├── app/
│   ├── controllers/
│   │   └── about.php
│   └── core/
│       └── controller.php
└── public/
    └── index.php
File Locations:

The Controller class is located in project/app/core/controller.php.
The about.php file is located in project/app/controllers/about.php.
The entry point index.php is located in project/public/index.php.
Including controller.php:

In your index.php file (the entry point of your application), you include or require the controller.php file.
php

// index.php
<?php
require "../app/core/controller.php";
Accessing Controller Class in about.php:

In your about.php file, you don't need to explicitly include controller.php. As long as controller.php has been included or required in a file that's executed before about.php, the Controller class will be available.
php

// about.php
<?php
class About extends Controller {
    function index() {
        $this->view("about");
    }
}
Execution:

When a request is made to index.php, it includes controller.php and instantiates the App object, which might lead to the execution of other files and classes as part of the application initialization process.
During this initialization process, controller.php is loaded into memory, making the Controller class available for use throughout the execution of subsequent PHP files, including about.php.
Class Access:

Since about.php is executed after index.php, it can directly extend the Controller class without needing to include or require controller.php again. PHP keeps track of which classes have been loaded into memory, allowing for inheritance and access to previously defined classes.
In summary, as long as the file containing the Controller class definition is included or required somewhere in your application before about.php is executed, about.php can access the Controller class without needing to include or require it explicitly again. This is because PHP retains class definitions in memory once they've been loaded, making them available for the duration of the script execution.
 */
Class About extends Controller
{
  function index()
  {
    $data['page_title'] = "About";
    $this->view("minima/about-us", $data);
  }

  
}