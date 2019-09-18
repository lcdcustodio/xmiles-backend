<?php
 
class DB_Connect {
 
    // constructor
    function __construct() {
         
    }
 
    // destructor
    function __destruct() {
        // $this->close();
    }
 
    // Connecting to database
    public function connect() {
        require_once 'config.php';
        // connecting to pgsql
        /*
	$string_connection ="host=DB_HOST port=5432 dbname=DB_DATABASE user=DB_USER password=DB_PASSWORD";
        $con =  pg_connect($string_connection);

	if (!$con) {
	 echo "Connection Lost";
	}
        /*/
	//*
        $string_connection ="host=localhost port=5432 dbname=xmiles user=power_user password=power_user";

        $con =  pg_connect($string_connection);

   
        if (!$con)
          {
           die('Could not connect: ' .pg_last_error());
              
          }
	else 
	  {
	   //echo "Connected!";
	  }
	//*/
 
        // return database handler
        return $con;
    }
 
    // Closing database connection
    public function close() {
        pg_close($con);
    }
 
}
 
?>
