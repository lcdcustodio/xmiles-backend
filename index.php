<?php

/**
 * File to handle all API requests
 * Accepts GET and POST
 *
 * Each request will be identified by TAG
 * Response will be JSON data

  /**
 * check for POST request
 */
//------------------------
#$local_time = "date_trunc('sec',current_timestamp at time zone 'BRT') + interval '52 minutes'";
$local_time = "date_trunc('sec',current_timestamp at time zone 'BRT') - interval '630 seconds'";
//------------------------
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];

    // include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();

    // response Array
    $response = array("tag" => $tag, "success" => 0, "error" => 0);

    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        //$email = $_POST['email'];
        $fb_id  = $_POST['fb_id'];
	$name   = $_POST['name'];
	$picURL = $_POST['picURL'];
	$device = $_POST['device']; 
	$app_ver_name = $_POST['app_ver_name'];
        $app_ver_code = $_POST['app_ver_code'];
	$access_type = $_POST['access_type'];
	$android_api = $_POST['android_api'];

	$uber_package = $_POST['uber_package'];

	if ($uber_package === NULL){
		$uber_package = "NA";
	}


        // check for user
        //$user = $db->getUserByEmailAndPassword($fb_id);
        $user = $db->getUserProfileAndScore($fb_id);

        if ($user != false) {
            // user found
            // echo json with success = 1
            $response["success"] = 1;
	    $response["user"]["rnk"] = $user["id"];	
            $response["user"]["name"] = $user["name"];
	    $response["user"]["picurl"] = $user["picurl"];
            $response["user"]["score"] = $user["score"];
            $response["user"]["created_at"] = $user["last_update_at"];
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
	    $access_type = "register";
            $response["error"] = 1;
            $response["error_msg"] = "Incorrect email!";
            echo json_encode($response);
        }

	//$ctrl_login = $db->storeCtrlLogin($fb_id, $name, $picURL, $device);
	$ctrl_login = $db->storeCtrlLogin($fb_id, $name, $picURL, $device, $android_api, $app_ver_name, $app_ver_code, $access_type, $local_time, $uber_package);

    } else if ($tag == 'gps_notfound') {


        $user_id    = $_POST['user_id'];
        $name       = $_POST['name'];
	$buscode    = $_POST['buscode'];
	$url	    = $_POST['url'];
	$created_at = $_POST['created_at'];

        $user = $db->storeGspnotfound($user_id, $name, $buscode, $url, $created_at);
        if ($user != false) {

            $response["success"] = 1;
            $response["gps_notfound"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }


    } else if ($tag == 'lances') {
	
	$sigla_host    = $_POST['sigla_host'];
        $sigla_guest   = $_POST['sigla_guest'];


        // check for user
        $user = $db->getLances($sigla_host, $sigla_guest);
        if ($user != false) {

            $response["success"] = 1;
            $response["lances"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }




	
    } else if ($tag == 'jogos') {

        // check for user
        $user = $db->getJogos();
        if ($user != false) {

            $response["success"] = 1;
            $response["jogos"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }

    } else if ($tag == 'ranking') {

        // check for user
        $user = $db->getRanking();
        if ($user != false) {

            $response["success"] = 1;
            $response["ranking"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }

    } else if ($tag == 'newsfeed_actions') {

        $feed_id = $_POST['feed_id'];

        $post = $db->getPost($feed_id);

	$likes = $db->getLikes($feed_id);

        $comments = $db->getComments($feed_id);

        if ($post != false) {

            $response["success"] = 1;
            $response["feed"] = $post;

	    if ($likes != false) {
		//echo "likes<p/>";
                //$response["feed"]["likes"] = $likes;
	        $response["likes"] = $likes;
            } else {
                $out = array();
                $out = json_encode(array(array("no data" => "no data")));
		$response["likes"] = $out;
                //$response["likes"] = "no data";
            }

            if ($comments != false) {
                //echo "likes<p/>";
                //$response["feed"]["likes"] = $likes;
                $response["comments"] = $comments;
            } else {
           	$out = array();
           	$out = json_encode(array(array("no data" => "no data")));
		//$out = json_encode(array("comments", "no data"));
		//$out = json_encode(array("comments" => "no data"));
		//$out = json_encode("no data");
                $response["comments"] = $out;
                //$response["comments"] = "no data";
	    }


	
	
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }

    } else if ($tag == 'newsfeed_by_hashtag') {

        $fb_id   = $_POST['fb_id'];
	$hashtag = $_POST['hashtag']; 
        // check for user
        
        $user = $db->getNewsfeed_by_hashtag($fb_id, $hashtag);

        if ($user != false) {

            $response["success"] = 1;
            $response["feed"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }



    } else if ($tag == 'newsfeed') {

        $fb_id = $_POST['fb_id'];
	// check for user
	//$user = $db->getNewsfeed();
        $user = $db->getNewsfeed($fb_id);

        if ($user != false) {

            $response["success"] = 1;
            $response["feed"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }

    } else if ($tag == 'timfleet') {

        $fb_id = $_POST['fb_id'];
        // check for user
        //$user = $db->getNewsfeed();
        $user = $db->getTimfleet();

        if ($user != false) {

            $response["success"] = 1;
            $response["feed"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error!";
            echo json_encode($response);
        }

    } else if ($tag == 'uber_token') {

        
        $user_id     = $_POST['user_id'];
	$uber_code   = $_POST['uber_code']; 
       
        $user = $db->storeUberToken($user_id,$uber_code,$local_time);

        if ($user != false) {

            $response["success"] = 1;
            //$response["feed"] = $user;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error Uber Token!";
            echo json_encode($response);
        }


    } else if ($tag == 'buscode') {

        $buscode = $_POST['buscode'];
        
        $busline = $db->getBuscode($buscode);

        if ($busline != false) {
            $response["success"]  = 1;
            $response["buscode"] = $busline;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error";
            echo json_encode($response);
        }

    } else if ($tag == 'api_buscode') {

        $buscode = $_POST['buscode'];
	$buscode_digits = $_POST['buscode_digits'];

        $busline = $db->getApiBuscode($buscode,$buscode_digits);

        if ($busline != false) {
            $response["success"]  = 1;
            $response["api_buscode"] = $busline;
            echo json_encode($response);
        } else {
            $response["error"] = 1;
            $response["error_msg"] = "Error Api Buscode";
            echo json_encode($response);
        }


    } else if ($tag == 'invite_friends'){
	$user_id     = $_POST['user_id'];
        $friends_id  = explode(';',$_POST['friends_id']);
        $request_id  = $_POST['request_id'];
	$flag_action = $_POST['flag_action']; 
	/*
        echo $user_id.";";
        echo $friends_id.";";
        echo $request_id.";";
        echo $flag_action; 
	*/
        $length      = count($friends_id);	
	//echo $length;

	$query ="insert into ctrl.invite_friends (user_id,request_id,friends_id,flag_action,time_stamp) VALUES";

        for ($i = 0; $i < $length; $i++) {

	  //$query .="('$user_id','$request_id','$friends_id[$i]','$flag_action',date_trunc('sec',current_timestamp at time zone 'BRT'))";

	  $query .="('$user_id','$request_id','$friends_id[$i]','$flag_action',$local_time)";


	  if ($i < $length -1){
	      $query .=",";
	  }

        }
	
	//echo $query;

	$new_invites = $db->storeInvites($query);

        if ($new_invites){
            $response["success"] = 1;
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = 1;
            $response["error_msg"] = "Error occured in StoreInvites";
            echo json_encode($response);
        }

    } else if ($tag == 'upload_friends'){
        $user_id     = $_POST['user_id'];
        $friends_id  = explode(';',$_POST['friends_id']);

        $length      = count($friends_id);

        $query ="insert into nfu.friends (user_id,friends_id,time_stamp) VALUES";

        for ($i = 0; $i < $length; $i++) {

          $query .="('$user_id','$friends_id[$i]',$local_time)";


          if ($i < $length -1){
              $query .=",";
          }

        }


        $friends = $db->storeFriends($query);

        if ($friends){
            $response["success"] = 1;
            echo json_encode($response);
       } else {
            // user failed to store
            $response["error"] = 1;
            $response["error_msg"] = "Error occured in StoreFriends";
            echo json_encode($response);
        }

    } else if ($tag == 'busgps_txt'){

	
	//$info .= $_POST['info']. PHP_EOL;
	//$info .= $_POST['info'];
		
	//echo "blabla.csv";

	$gps_bus_id            = explode(';',$_POST['gps_bus_id']);
        $user_id               = explode(';',$_POST['user_id']);
        $latitude              = explode(';',$_POST['latitude']);
        $longitude             = explode(';',$_POST['longitude']);
        $bustype               = explode(';',$_POST['bustype']);
        $buscode               = explode(';',$_POST['buscode']);
        $busline               = explode(';',$_POST['busline']);
        $bus_hashcode          = explode(';',$_POST['bus_hashcode']);
        $created_at            = explode(';',$_POST['created_at']);
        //-------------------------------
        $u_locat_id            =explode(';',$_POST['u_locat_id']);
        $u_latitude            =explode(';',$_POST['u_latitude']);
        $u_longitude           =explode(';',$_POST['u_longitude']);
        $u_hashcode            =explode(';',$_POST['u_hashcode']);
        $u_locat_provider      =explode(';',$_POST['u_locat_provider']);
        $u_created_at          =explode(';',$_POST['u_created_at']);
        $u_diff_dist           =explode(';',$_POST['u_diff_dist']);
        $u_diff_time           =explode(';',$_POST['u_diff_time']);
        $u_status              =explode(';',$_POST['u_status']);
        $u_accuracy            =explode(';',$_POST['u_accuracy']);        
        //-------------
        $length = count($gps_bus_id);
	//*
        for ($i = 0; $i < $length; $i++) {

          $info .= $i.','.
		   $gps_bus_id[$i].','.
                   $user_id[$i].','.
                   $latitude[$i].','.
                   $longitude[$i].','.                   
                   $buscode[$i].','.
                   $busline[$i].','.                   
                   $created_at[$i].','.
                   $u_locat_id[$i].','.
                   $u_latitude[$i].','.
                   $u_longitude[$i].','.                   
                   $u_locat_provider[$i].','.
                   $u_created_at[$i].','.
                   $u_diff_dist[$i].','.
                   $u_diff_time[$i].','.                   
                   $u_accuracy[$i].','.
		   $bustype[$i].','.
		   $bus_hashcode[$i].','.
		   $u_hashcode[$i].','.
		   $u_status[$i].','.
                   'ADD';
		//*/

          if ($i < $length -1){
              $info .= PHP_EOL;
          }

        }
	

	$filename = '/var/www/html/xmiles/busgps_files/'.$user_id[0].'_'.$u_hashcode[0].'.txt';
		

	$ret = file_put_contents($filename, $info, FILE_APPEND | LOCK_EX);
	//var_dump($ret);

	$response["success"] = 1;
        echo json_encode($response);


    } else if ($tag == 'busgps_register'){
        $gps_bus_id	       = explode(';',$_POST['gps_bus_id']);
        $user_id               = explode(';',$_POST['user_id']);
        $latitude              = explode(';',$_POST['latitude']);
        $longitude             = explode(';',$_POST['longitude']);
        //$speed                 = explode(';',$_POST['speed']);
	$bustype	       = explode(';',$_POST['bustype']);
        $buscode	       = explode(';',$_POST['buscode']);
        $busline	       = explode(';',$_POST['busline']);
        //$direction	       = explode(';',$_POST['direction']);
	$bus_hashcode	       = explode(';',$_POST['bus_hashcode']);
        $created_at            = explode(';',$_POST['created_at']);
	//-------------------------------
	$u_locat_id            =explode(';',$_POST['u_locat_id']);
	$u_latitude            =explode(';',$_POST['u_latitude']);
	$u_longitude           =explode(';',$_POST['u_longitude']);
	//$u_speed               =explode(';',$_POST['u_speed']);
	$u_hashcode	       =explode(';',$_POST['u_hashcode']);
	$u_locat_provider      =explode(';',$_POST['u_locat_provider']);
	$u_created_at          =explode(';',$_POST['u_created_at']);
	$u_diff_dist           =explode(';',$_POST['u_diff_dist']);
	$u_diff_time           =explode(';',$_POST['u_diff_time']);
	//$u_locat_status        =explode(';',$_POST['u_locat_status']);
	$u_status 	       =explode(';',$_POST['u_status']);
	$u_accuracy            =explode(';',$_POST['u_accuracy']);	 		//--------------	
	//$score		       =explode(';',$_POST['score']);
	//-------------
        $length = count($gps_bus_id);
	/*
        for ($i = 0; $i < $length; $i++) {
          //echo $user_location_id[$i]." , ";
          //echo $user_id[$i]." , ";
          $new_busgps = $db->storeBusGps($gps_bus_id[$i],
                                         $user_id[$i],
                                         $latitude[$i],
                                         $longitude[$i],
                                         //$speed[$i],
					 $bustype[$i],
                                         $buscode[$i],
                                         $busline[$i],
                                         //$direction[$i],
					 $bus_hashcode[$i],
                                         $created_at[$i],
					 //------------
					$u_locat_id[$i],
					$u_latitude[$i],
					$u_longitude[$i],
					//$u_speed[$i],
					$u_hashcode[$i],
					$u_locat_provider[$i],
					$u_created_at[$i],
					$u_diff_dist[$i],     
					$u_diff_time[$i],     
					//$u_locat_status[$i],
					$u_status[$i],  
					$u_accuracy[$i]//,
					//-----------------
					//$score[$i]
					 );
        }
	*/

	$query ="insert into routes.gps_bus (
                        gps_bus_id,
                        user_id,
                        latitude,
                        longitude,
                        bustype,
                        buscode,
                        busline,
                        bus_hashcode,
                        created_at,
                        u_locat_id,
                        u_latitude,
                        u_longitude,
                        u_hashcode,
                        u_locat_provider,
                        u_created_at,
                        u_diff_dist,
                        u_diff_time,
                        u_status,
                        u_accuracy,
			flag_action
                 ) VALUES";

        for ($i = 0; $i < $length; $i++) {

          $query .="('$gps_bus_id[$i]',
                          '$user_id[$i]',
                          '$latitude[$i]',
                          '$longitude[$i]',
                          '$bustype[$i]',
                          '$buscode[$i]',
                          '$busline[$i]',
                          '$bus_hashcode[$i]',
                          '$created_at[$i]',
                          '$u_locat_id[$i]',
                          '$u_latitude[$i]',
                          '$u_longitude[$i]',
                          '$u_hashcode[$i]',
                          '$u_locat_provider[$i]',
                          '$u_created_at[$i]',
                          '$u_diff_dist[$i]',
                          '$u_diff_time[$i]',
                          '$u_status[$i]',
                          '$u_accuracy[$i]',
			  'ADD')";

          if ($i < $length -1){
              $query .=",";
          }

        }

        //echo $query;

        $new_busgps = $db->storeBusGps($query);




        if ($new_busgps){
            $response["success"] = 1;
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = 1;
            $response["error_msg"] = "Error occured in StoreBusGps";
            echo json_encode($response);
        }



    } else if ($tag == 'comments_inbox'){

        $feed_id           = $_POST['feed_id'];
        $sender            = $_POST['sender'];
        $user_id           = $_POST['user_id'];
        $flag_action       = $_POST['flag_action'];
        $time_stamp        = $_POST['time_stamp'];
        $status            = $_POST['status'];
        $feed_type         = $_POST['feed_type'];
	$comment	   = $_POST['comment'];

        $comments_inbox = $db->storeComments_inbox($feed_id,
                                                $sender,
                                                $user_id,
                                                $flag_action,
                                                $time_stamp,
                                                $status,
                                                $feed_type,
						$comment);
        //echo "likes_inbox";
        if ($comments_inbox){
            $response["success"] = 1;
            echo json_encode($response);        
        } else {
            // user failed to store
            $response["error"] = 1;
            $response["error_msg"] = "Error occured in store comments_inbox";
            echo json_encode($response);

        }                

    } else if ($tag == 'likes_inbox'){

        $feed_id           = $_POST['feed_id'];
	$sender		   = $_POST['sender'];
        $user_id           = $_POST['user_id'];
        $flag_action       = $_POST['flag_action'];
        $time_stamp        = $_POST['time_stamp'];
	$status		   = $_POST['status'];	
 	$feed_type	   = $_POST['feed_type'];

        $likes_inbox = $db->storeLikes_inbox($feed_id,
					     $sender,	
                                             $user_id,
                                             $flag_action,
                                             $time_stamp,
					     $status,
					     $feed_type);
        //echo "likes_inbox";
        if ($likes_inbox){
            $response["success"] = 1;
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = 1;
            $response["error_msg"] = "Error occured in store likes_inbox";
            echo json_encode($response);

        }


    } else if ($tag == 'newsfeed_inbox'){

	$feed_id	   = $_POST['feed_id'];
        $name              = $_POST['name'];
	$image		   = $_POST['image'];	
	$status		   = $_POST['status'];
	$profilepic	   = $_POST['profilepic'];
	$url		   = $_POST['url'];
	$sender		   = $_POST['sender'];
	$destination	   = $_POST['destination'];
	$feed_type	   = $_POST['feed_type'];
	$like_stats	   = $_POST['like_stats'];
	$comment_stats	   = $_POST['comment_stats'];
	$flag_action	   = $_POST['flag_action'];
	$time_stamp	   = $_POST['time_stamp'];
	$hashtag	   = $_POST['hashtag'];

        $newsfeed_inbox = $db->storeNewsfeed_inbox($feed_id,
        					   $name,
						   $image,
						   $status,	
						   $profilepic,
						   $url,
						   $sender,
						   $destination,
						   $feed_type,
						   $like_stats,
						   $comment_stats,
						   $flag_action,
						   $hashtag,
						   $time_stamp);
	//echo "newsfeed_inbox";
        if ($newsfeed_inbox){
            $response["success"] = 1;
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = 1;
            $response["error_msg"] = "Error occured in store newsfeed_inbox";
            echo json_encode($response);

        }
                                         

 
    } else if ($tag == 'register') {
        // Request type is Register new user
        $name = $_POST['name'];
        //$email = $_POST['email'];
        $fb_id = $_POST['fb_id'];
        $gender = $_POST['gender'];
        $picURL = $_POST['picURL'];

        // check if user is already existed
        if ($db->isUserExisted($email)) {
            // user is already existed - error response
            $response["error"] = 2;
            $response["error_msg"] = "User already existed";
            echo json_encode($response);
        } else {
            // store user
	    //echo "before storeUser function";
            $user = $db->storeUser($name, $fb_id, $gender, $picURL, $local_time);
 	    //echo $user;	
            if ($user) {
                // user stored successfully
                $response["success"] = 1;
                $response["user"]["name"] = $user["name"];
                //$response["user"]["email"] = $user["email"];
                $response["user"]["fb_id"] = $user["fb_id"];
                $response["user"]["gender"] = $user["gender"];
                $response["user"]["picURL"] = $user["picURL"];
                $response["user"]["created_at"] = $user["created_at"];
                //$response["user"]["updated_at"] = $user["updated_at"];
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = 1;
                $response["error_msg"] = "Error occured in Registartion";
                echo json_encode($response);
            }
        }
    } else {
        echo "Invalid Request";
    }
} else {
    echo "Access Denied";
}
?>
