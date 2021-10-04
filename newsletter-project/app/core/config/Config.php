 <?php 


  define("APPLICATON_NAME", "Newsletter project");


 /**
  * Database credentials.
  */

  define("DB_TYPE", "mysql");
  define("DB_NAME", "newsletter_project");
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_HOST', 'localhost');


  define("PROTOCOL", "http");
  $path = str_replace("\\", "/",PROTOCOL . "://" . $_SERVER['SERVER_NAME'] . __DIR__ . "/");
  $path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);

  define("ROOT", str_replace("app/core/config", "public", $path));
  define("ASSETS", str_replace("app/core/config", "public/assets", $path));
  define("URLROOT", "http://localhost/newsletter-project");

  define('APPROOT', dirname(dirname(dirname(__FILE__))));
  

  
  

