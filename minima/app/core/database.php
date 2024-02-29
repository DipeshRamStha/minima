<?php

Class Database
{
  public function db_connect()
  {

    try{

      $string = DB_TYPE .":host=".DB_HOST.";dbname=".DB_NAME.";";

      return $db = new PDO($string, DB_USER, DB_PASS);
      show($db);

    }catch(PDOException $e){
      die($e->getMessage());

    }

  }

  /* 
  What does the second argument in the read function '$data = []' represent and what does '$data =[]' contain in the database.php file? Why does the read function call from home.php perfectly works even if we don't pass the second argument? Explain in great detail with great detailed sample easy example.
Let's break down the code and understand the purpose of the second argument $data = [] in the read() function and why the function call from home.php works perfectly even if we don't pass the second argument:

Purpose of the Second Argument $data in the read() Function:

In the read() function definition:

php
public function read($query, $data = [])
The second argument $data is an optional parameter with a default value of an empty array [].

The purpose of $data is to pass any bound parameters needed for the SQL query specified in the $query parameter. This allows for prepared statements to prevent SQL injection attacks and enhance security.

Prepared statements allow you to execute the same SQL statements repeatedly with high efficiency and security by separating SQL logic from the data being supplied.

Understanding the $data Parameter:

When $data is provided:
php
$data = [':username' => 'john', ':age' => 25];
In this example, $data is an associative array where keys represent parameter placeholders in the SQL query and values represent the actual values to bind to those placeholders.
For instance, :username and :age are placeholders in the SQL query, and their corresponding values 'john' and 25 will be bound to them respectively during query execution.
Why Does the Function Call from home.php Work Perfectly Even Without Passing the Second Argument?:

The function call from home.php:

php
$data = $DB->read("SELECT * FROM images");
In this call, only the SQL query is provided to the read() function, and the second argument ($data) is not explicitly passed.
Since $data is an optional parameter with a default value of an empty array [], if not provided explicitly, it will default to an empty array inside the function.
Inside the read() function:

php
public function read($query, $data = [])
{
  // If $data is not provided explicitly, it defaults to an empty array
  $DB = $this->db_connect();
  $stm = $DB->prepare($query);

  // If $data is an empty array, count($data) will be 0
  if (count($data) == 0) {
    // Execute the query without bound parameters
    $stm = $DB->query($query);
    // Check if the query execution was successful
    if ($stm) {
      $check = 1;
    }
  } else {
    // Execute the query with bound parameters
    $check = $stm->execute($data);
  }

  // Rest of the function...
}
Inside the read() function, it checks if $data is empty by using count($data) == 0. If $data is empty, it executes the query without bound parameters. Otherwise, it executes the query with bound parameters as per the values in $data.
Sample Example:

Suppose we have a simple SQL query to retrieve user information:

sql
SELECT * FROM users WHERE username = :username AND age = :age
We can use the read() function with bound parameters as follows:

php

$data = [':username' => 'john', ':age' => 25];
$users = $DB->read("SELECT * FROM users WHERE username = :username AND age = :age", $data);
In this example, the $data array contains the values to be bound to the placeholders :username and :age in the SQL query.

In summary, the second argument $data in the read() function is used to pass bound parameters for prepared statements. The function call works perfectly even without explicitly passing the second argument because it defaults to an empty array if not provided, allowing the function to execute SQL queries with or without bound parameters effectively.
  */
  public function read($query, $data = [])
  {

    $DB = $this->db_connect();
    $stm = $DB->prepare($query);
    if(count($data)==0)
    {
      $stm = $DB->query($query);
      $check = 0;
      if($stm){
        $check = 1;
      }
    } else {
      $check = $stm->execute($data);
    }
    if($check)
    {
      return $stm->fetchAll(PDO::FETCH_OBJ);

    }else
    {
      return false;
    }

  }
  
  public function write($query, $data = [])
  {
    $DB = $this->db_connect();
    $stm = $DB->prepare($query);

    if(count($data) == 0)
    {
      $stm = $DB->query($query);
      $check = 0;
      if($stm){
        $check = 1;
      }
    }else{
      $check = $stm->execute($data);
    }

    if($check)
    {
      return true;
    } else
    {
      return false;
    }

  }
}