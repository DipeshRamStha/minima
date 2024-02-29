<?php

// set website title
define("WEBSITE_NAME", "My Website");

// set database variables

define('DB_TYPE', 'mysql');
define('DB_NAME', 'minima_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');

/* protocol type http or https */
define('PROTOCAL', 'http');

/* root and asset paths*/

$path = str_replace("\\", "/", PROTOCAL ."://" . $_SERVER['SERVER_NAME'] . __DIR__ . "/");
$path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

/* Here, $_SERVER['DOCUMENT_ROOT'] is used to replace the server's document root directory from the full path, leaving only the relative path. This can be useful for constructing URLs or file paths dynamically in your application.


In the given code, the str_replace() function is used to modify the $path variable to construct two other constants: ROOT and ASSETS. Let's break down the usage of app/core and public in the str_replace() functions:

Explanation:
app/core:

This is a part of the directory path that needs to be replaced in $path.
It likely represents a specific directory within the project structure, possibly where core application files or configurations are stored.
This portion is being replaced to modify the path for specific purposes, such as determining the root directory accessible to the public or locating asset files.
public:

This string represents the target replacement for app/core.
It may refer to the public directory in the project structure, which typically contains files accessible to the public via the web server.
The public directory often hosts files such as HTML, CSS, JavaScript, and other assets that are directly served to website visitors.

In this scenario:

app/core represents the core directory within the app directory.
public represents the public directory where the web server serves files from.

In the str_replace() function calls:
"app/core" is replaced with "public" to construct the ROOT constant.
"app/core" is replaced with "public/assets" to construct the ASSETS constant.
Summary:
app/core represents a specific directory within the project structure.
public represents the target directory where files will be publicly accessible.
The str_replace() function replaces occurrences of app/core in the $path variable with public and public/assets, allowing the construction of the ROOT and ASSETS constants for determining paths to publicly accessible resources and assets in the web application.
*/
define('ROOT', str_replace("app/core", "public", $path));
define('ASSETS', str_replace("app/core", "public/assets", $path));

/*
set to true to allow error reporting
set to false when we upload online to stop error reporting
*/

define('DEBUG', true);

if(DEBUG)
{
  ini_set("display_errors", 1);
}else {
  ini_set("display_errors", 0);
}