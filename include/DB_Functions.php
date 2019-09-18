<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Storing new user
     * returns user details
     */
    //public function storeInvites($user_id, $request_id, $friends_id, $flag_action){
    public function storeInvites($query){
	/*
	echo $user_id.",,";
        echo $friends_id.",,";
        echo $request_id.",,";
        echo $flag_action."\n";
	*/
        $result = pg_query($query);
     	/*   
		insert into ctrl.invite_friends (
				  user_id,
				  request_id,
				  friends_id,
				  flag_action,
				  time_stamp
			) VALUES ('$user_id',
				  '$request_id',
				  '$friends_id',
				  '$flag_action',			  
				  date_trunc('sec',current_timestamp at time zone 'BRT')		
                                  )");*/
				  				

        if ($result) {
	    //echo "true";	
            return true;
        } else {
	    //echo "false";	
            return false;
        }
 	

    }

    public function storeFriends($query){

        $result = pg_query($query);

        if ($result) {

            return true;
        } else {

            return false;
        }

    }
	
    //public function storeBusGps($gps_bus_id, $user_id, $latitude, $longitude, $speed, $buscode, $busline, $direction, $created_at, $u_locat_id, $u_latitude, $u_longitude, $u_speed, $u_locat_provider, $u_created_at, $u_diff_dist, $u_diff_time, $u_locat_status, $u_accuracy, $score){
    //public function storeBusGps($gps_bus_id, $user_id, $latitude, $longitude, $bustype, $buscode, $busline, $bus_hashcode, $created_at, $u_locat_id, $u_latitude, $u_longitude, $u_hashcode, $u_locat_provider, $u_created_at, $u_diff_dist, $u_diff_time, $u_status, $u_accuracy){

    public function storeBusGps($query){

	$result = pg_query($query);
	/*
        $result = pg_query("
                insert into routes.gps_bus (
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
                        u_accuracy                        
                ) VALUES ('$gps_bus_id',
                          '$user_id',
                          '$latitude',
                          '$longitude',
                          '$bustype',
                          '$buscode',
                          '$busline',
                          '$bus_hashcode',
                          '$created_at',
                          '$u_locat_id',
                          '$u_latitude',
                          '$u_longitude',
                          '$u_hashcode',
                          '$u_locat_provider',
                          '$u_created_at',
                          '$u_diff_dist',
                          '$u_diff_time',
                          '$u_status',
                          '$u_accuracy'                          
                                )");

	*/
	/*
        $result = pg_query("
                insert into routes.gps_bus (
                        gps_bus_id,
                        user_id,
                        latitude,
                        longitude,
                        speed,
                        buscode,
                        busline,
                        direction,
                        created_at,
			u_locat_id,
			u_latitude,
			u_longitude,
			u_speed,
			u_locat_provider,
			u_created_at,
			u_diff_dist,
			u_diff_time,
			u_locat_status,
			u_accuracy,
			score
                ) VALUES ('$gps_bus_id',
                          '$user_id',
                          '$latitude',
                          '$longitude',
                          '$speed',
                          '$buscode',
                          '$busline',
                          '$direction',
                          '$created_at',
			  '$u_locat_id',
			  '$u_latitude',
			  '$u_longitude',
			  '$u_speed',
			  '$u_locat_provider',
			  '$u_created_at',
			  '$u_diff_dist',
			  '$u_diff_time',
			  '$u_locat_status',
		   	  '$u_accuracy',
			  '$score'	
				)");
        */
	if ($result) {
            return true;
        } else {
            return false;
        }

    
    }

    public function storeNewsfeed_inbox($feed_id, $name, $image, $status, $profilepic, $url, $sender, $destination, $feed_type, $like_stats, $comment_stats, $flag_action, $hashtag, $time_stamp){
	/*
	$empity_string = "";
	if ($image ==  $empity_string) {
	  //echo "image is not null <p/>";
	  //$image = null;	
        } else {
          echo "<b/>image is null <p/>";           
        }
 	*/	
	//*
        $result = pg_query("
        	       insert into app_ul.newsfeed_inbox (feed_id, 
        						  name, 
        						  image,  
        						  status,
  							  profilepic, 	
  							  url,
  							  sender,
  							  destination,
  							  feed_type,
							  like_stats,
							  comment_stats,
							  flag_action,
							  hashtag,
							  time_stamp)
						values
							('$feed_id',  
							 '$name',
    		    					 '$image',
							 '$status', 
    							 '$profilepic', 
						   	 '$url', 
							 '$sender', 
							 '$destination', 
							 '$feed_type', 
							 '$like_stats', 
							 '$comment_stats',
							 '$flag_action',
							 '$hashtag', 
							 '$time_stamp')");
							 
	//*/						 
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    public function storeComments_inbox($feed_id, $sender, $user_id, $flag_action, $time_stamp, $status, $feed_type, $comment){

        $result = pg_query("
                       insert into app_ul.comments_inbox (feed_id,
                                                       sender,
                                                       user_id,
                                                       flag_action,
                                                       time_stamp,
                                                       status,
                                                       feed_type,
                                                       comment)
                                                values
                                                        ('$feed_id',
                                                         '$sender',
                                                         '$user_id',
                                                         '$flag_action',
                                                         '$time_stamp',
                                                         '$status',
                                                         '$feed_type',
                                                         '$comment')");


        if ($result) {
            return true;
        } else {
            return false;
        }
   }


    public function storeLikes_inbox($feed_id, $sender, $user_id, $flag_action, $time_stamp, $status, $feed_type){

        $result = pg_query("
                       insert into app_ul.likes_inbox (feed_id,
						       sender,	
                                                       user_id,
                                                       flag_action,
                                                       time_stamp,
						       status,	
						       feed_type)
                                                values
                                                        ('$feed_id',
                                                         '$sender',
							 '$user_id',
                                                         '$flag_action',
                                                         '$time_stamp',
							 '$status',
							 '$feed_type')");

 
        if ($result) {
            return true;
        } else {
            return false;
        }
   }



   public function storeGspnotfound($user_id, $name, $buscode, $url, $created_at){
    	//echo $user_id;
        $result = pg_query("
                insert into ctrl.buscode_not_found (
                        user_id,
                        name,
                        url_search,
                        buscode,
                        created_at
                ) VALUES ('$user_id',
                          '$name',
                          '$url',
                          '$buscode',
                          '$created_at')");
        if ($result) {
            return true;
        } else {
            return false;
        }


    }
	
    public function storeUserRoutes($user_id, $busline, $city, $_to_bus_stop_id, $_from_bus_stop_id, $favorite_id, $uf){
	//echo "BEGIN storeUserRoutes ";

	$_from_num = (int)$_from_bus_stop_id; 
	$_to_num   = (int)$_to_bus_stop_id;
	
	if ($_from_num < $_to_num){
	   //echo "from lower than to ";
	   $id_1 = $_from_bus_stop_id;
	   $id_2 = $_to_bus_stop_id;	
	} else {
	   //echo "to lower than from ";
           $id_1 = $_to_bus_stop_id;
           $id_2 = $_from_bus_stop_id; 
	}
	//echo $_from_num . ", " . $_to_num . " ";

	//echo $user_id . ", " . $busline. ", " . $city. ", ". $_to_bus_stop_id. ", " . $_from_bus_stop_id. ", " . $favorite_id. ", ". $uf . " ";
	//*
	$result = pg_query("
		insert into routes.user_routes (
			user_id,
			favorite_id,
                	
			busline,
                        bus_stop,
                        bus_stop_id,

                        latitude,
                        longitude,
                        from_flag,
                        to_flag,
                        from_or_to_flag,
			max_distance_km,
                        created_at
		)
		select a.user_id, 
	     	       a.favorite_id,
                
		       a.busline,
                       b.bus_stop,
                       b.bus_stop_id,

                       b.latitude,
                       b.longitude,
       CASE When b.bus_stop_id = '$_from_bus_stop_id' THEN 'YES' ELSE 'NO'  END,
       CASE When b.bus_stop_id = '$_to_bus_stop_id' THEN 'YES' ELSE 'NO'  END,
       CASE When b.bus_stop_id = '$_from_bus_stop_id' or b.bus_stop_id = '$_to_bus_stop_id'  THEN 'YES' ELSE 'NO'  END,
		       b.max_distance_km,	
                       NOW()

                from   routes.favorites a join routes.bus_stop b on (a.busline = b.busline and a.city = b.city and a.uf = b.uf)
		where  a.user_id =     '$user_id'       and
                       a.favorite_id = '$favorite_id'   and
                       a.busline =     '$busline'       and
                       a.city =        '$city'		and         

		       a.uf =          '$uf'		and
	    	       b.bus_stop_id between '$id_1'  and '$id_2'                                                                 
 		");
	//*/
	//$result = pg_query("SELECT NOW()");
        if ($result) {
            // get user details
            //echo "  blabla ";
            //--------------------
            $result = pg_query("SELECT * FROM routes.user_routes WHERE user_id = '$user_id' and favorite_id = '$favorite_id'");
            //$result = pg_query("SELECT NOW()");
	    // return user details
            return pg_fetch_array($result,0);
        } else {
            return false;
        }

    }

 	
    //*/	

    public function storeUser($name, $fb_id, $gender, $picURL, $local_time) {

	$score = 0;	
	//---------------
        $result = pg_query("INSERT INTO users.fb_sso_login(fb_id, name, gender, picURL, created_at) VALUES('$fb_id', '$name', '$gender', '$picURL', $local_time)");
        //---------------
	$result_2 = pg_query("INSERT INTO app_dl.score(user_id, name, picURL, score, last_update_at) VALUES('$fb_id','$name','$picURL', '$score', $local_time)"); 
	//----------------

        $result_3 = pg_query("INSERT INTO nfu.users(user_id,
                                                         name,
                                                         feed_id,
                                                         ranking,
                                                         custom_time_stamp,
							 time_stamp)
						select '$fb_id', 
						       '$name', 
							1, 
							1, 
							$local_time,
							$local_time
						union
						(
						select '$fb_id', 
						       '$name', 
							a.id, 
							a.id - b.max_rank, 
							null,
							$local_time
						from newsfeed.main a, (select max(id) as \"max_rank\" from newsfeed.main) as b
						where destination = 'ALL'
						and a.id not in (1) 
						order by a.id desc
						limit 9	
						)");


	//---------------
	$result_4 = pg_query("insert into users.profile (
						   user_id,
						   name,  
						   gender,
						   picurl,
						   flag_picurl_update,
						   profile_type,
						   created_at,
						   picurl_update_at
						 )
						 values (
						   '$fb_id',
						   '$name',
						   '$gender',
						   '$picURL',
						   'YES',
						   'USER',
						   $local_time,
						   $local_time
						  )");

	//---------------
        if ($result) {
            // get user details           
	    //--------------------
	    $result = pg_query("SELECT * FROM users.fb_sso_login WHERE fb_id = '$fb_id'");
            // return user details
            return pg_fetch_array($result,0);
        } else {
            return false;
        }
    }

    public function getBuscode($buscode){
        //echo $city;
        $result = pg_query("SELECT * FROM routes.buscode WHERE buscode = '$buscode'");

        $no_of_rows = pg_num_rows($result);
        //echo $no_of_rows;

        if ($no_of_rows > 0) {
           $resultArray = pg_fetch_all($result);
           $out = array();
           $out = json_encode($resultArray);
           return $out;
        } else {
           return false;
        }
    }

    public function getApiBuscode($buscode,$buscode_digits){
        
        //$result = pg_query("SELECT * FROM api.bus_rio WHERE buscode like '%$buscode%' order by time_stamp desc limit 1");
	
	$result = pg_query("SELECT * FROM api.bus_rio WHERE buscode in ('$buscode','$buscode_digits') order by time_stamp desc limit 1");

        $no_of_rows = pg_num_rows($result);
        //echo $no_of_rows;

        if ($no_of_rows > 0) {
           $resultArray = pg_fetch_all($result);
           $out = array();
           $out = json_encode($resultArray);
           return $out;
        } else {
           return false;
        }
    }



    public function getLikes($feed_id) {
	/*
        $result = pg_query("select a.feed_id,
			           a.user_id,
				   b.name,
       				   b.picurl,
       				   b.score,
       		                   b.id,
    				   a.time_stamp
			    from newsfeed.likes a
			    join app_dl.score b on (a.user_id = b.user_id)
			    where a.feed_id = '$feed_id'	
			    order by a.time_stamp asc");
			    //order by b.id asc"); 
	*/
	/*
        $result = pg_query("select a.feed_id,
                                   a.user_id,
                                   b.name,
                                   c.picurl,
                                   b.score,
                                   b.id,
                                   a.time_stamp
                            from newsfeed.likes a
                            join app_dl.score b on (a.user_id = b.user_id)
			    join users.profile c on (a.user_id = c.user_id)
                            where a.feed_id = '$feed_id'
                            order by a.time_stamp asc");
                            //order by b.id asc");
	*/


        $result = pg_query("select a.feed_id,
                                   a.user_id,
                                   c.name,
                                   c.picurl,
                                   
                                   
                                   a.time_stamp
                            from newsfeed.likes a
                            
                            join users.profile c on (a.user_id = c.user_id)
                            where a.feed_id = '$feed_id'
                            order by a.time_stamp asc");
                            



        $no_of_rows = pg_num_rows($result);
        //-----
        if ($no_of_rows > 0) {
	   
           $resultArray = pg_fetch_all($result);
           $out = array();
           $out = json_encode($resultArray);           
           return $out;
        } else {
            return false;
        }
    }	

    public function getComments($feed_id) {
	/*
        $result = pg_query("select a.feed_id,
                                   a.user_id,
                                   b.name,
				   a.comment,	
                                   b.picurl,
                                   b.score,
                                   b.id,
                                   a.time_stamp
                            from newsfeed.comments a
                            join app_dl.score b on (a.user_id = b.user_id)
                            where a.feed_id = '$feed_id'
                            order by a.time_stamp");
	*/
        $result = pg_query("select a.feed_id,
                                   a.user_id,
                                   c.name,
                                   a.comment,
                                   c.picurl,
                                   
                                   
                                   a.time_stamp
                            from newsfeed.comments a
                            join users.profile c on (a.user_id = c.user_id)
                            where a.feed_id = '$feed_id'
                            order by a.time_stamp");



        $no_of_rows = pg_num_rows($result);
        //-----
        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           $out = array();
           $out = json_encode($resultArray);
           return $out;
        } else {
            return false;
        }
    }

    public function getPost($feed_id) {
	
	//echo "getPost <p/>"; 
        $result = pg_query("select *
                            from newsfeed.main
                            where id = '$feed_id'");


        $no_of_rows = pg_num_rows($result);
        //-----
        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           
           $out = array();
           $out = json_encode($resultArray);
           //echo $out;
           return $out;
        } else {

            return false;
        }
                                     

    }	


    public function getNewsfeed_by_hashtag($fb_id, $hashtag) {
    
	/*    
        $result = pg_query("select a.id,
                                   a.name,
                                   a.sender,
                                   a.image,
                                   a.status,
                                   a.feed_type,
                                   a.profilepic,
                                   a.url,
                                   a.like_stats,
                                   a.comment_stats,
                                   a.hashtag,
                                   a.time_stamp,
                                   b.custom_time_stamp,
                                   CASE When c.user_id = '$fb_id' THEN 'YES' ELSE 'NO'  END as you_like_this
                            from newsfeed.main a
                            join nfu.users_$fb_id b on (a.id = b.feed_id)
                            left join newsfeed.likes c on (b.user_id = c.user_id and a.id = c.feed_id)
                            where a.hashtag like '%$hashtag%'
                            order by ranking desc
			    limit 50");
	*/


        $result = pg_query("select a.id,
                                   a.name,
                                   a.sender,
                                   a.image,
                                   a.status,
                                   a.feed_type,
                                   a.profilepic,
                                   a.url,
                                   a.like_stats,
                                   a.comment_stats,
                                   a.hashtag,
                                   a.time_stamp,
                                   b.custom_time_stamp,
                                   'NO' as you_like_this
                            from newsfeed.main a
                            join nfu.users_$fb_id b on (a.id = b.feed_id)                            
                            where a.hashtag like '%$hashtag%'
                            order by ranking desc
			    limit 50");


        $no_of_rows = pg_num_rows($result);
        //-----
        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           //return json_encode($resultArray);
           $out = array();
           $out = json_encode($resultArray);
           //echo $out;
           return $out;
        } else {

            return false;
        }
    }

    public function getNewsfeed($fb_id) {
        
                
	//*
        $result = pg_query("select a.id,
                                   a.name,
                                   a.sender,
                                   a.image,
                                   a.status,
                                   a.feed_type,
                                   a.profilepic,
                                   a.url,
                                   a.like_stats,
                                   a.comment_stats,
                                   a.hashtag,
                                   a.time_stamp,
                                   b.custom_time_stamp,
                                   CASE When c.user_id = '$fb_id' THEN 'YES' ELSE 'NO'  END as you_like_this
                            from newsfeed.main a
                            join nfu.users_$fb_id b on (a.id = b.feed_id)
                            left join newsfeed.likes c on (b.user_id = c.user_id and a.id = c.feed_id)
                            where b.flag_action not in ('DONE')
			    order by rank_factor asc, ranking asc");		
                            //order by ranking asc");
	//*/
	
	/*
        $result = pg_query("select a.id,
                                   a.name,
                                   a.sender,
                                   a.image,
                                   a.status,
                                   a.feed_type,
                                   a.profilepic,
                                   a.url,
                                   a.like_stats,
                                   a.comment_stats,
                                   a.hashtag,
                                   a.time_stamp,
                                   b.custom_time_stamp,
                                   'NO' as you_like_this
                            from newsfeed.main a
                            join nfu.users_$fb_id b on (a.id = b.feed_id)                            
                            where b.flag_action not in ('DONE')
			    order by rank_factor asc, ranking asc");		
	
	*/
                          

        $no_of_rows = pg_num_rows($result);

  
        //-----
        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           //return json_encode($resultArray);
           $out = array();
           $out = json_encode($resultArray);
           //echo $out;
           return $out;
        } else {

            return false;
        }
    }


    public function getTimfleet() {


        //*
        $result = pg_query("select a.id,
                                   a.name,
                                   a.sender,
                                   a.image,
                                   a.status,
                                   a.feed_type,
                                   a.profilepic,
                                   a.url,
                                   a.like_stats,
                                   a.comment_stats,
                                   a.hashtag,
                                   a.time_stamp                                                                      
                            from timfleet.main a
                            order by time_stamp");


        $no_of_rows = pg_num_rows($result);


        //-----
        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           //return json_encode($resultArray);
           $out = array();
           $out = json_encode($resultArray);
           //echo $out;
           return $out;
        } else {

            return false;
        }
    }

   public function getLances($sigla_host, $sigla_guest) {

	$result = pg_query("select a.lance_id,
				 a.sigla_host,
				 b.profile_picurl as \"picurl_host\",
				 a.sigla_guest,
				 c.picurl_guest,
				 d.placar_host,
				 d.placar_guest,
				 b.estadio,
				 d.dia,
				 d.hora,
				 d.status,
				 a.pic_text1,
				 a.pic_text2,
				 a.picurl1,
				 a.picurl2,
				 a.minutes,
				 a.extra_info,
				 a.text1,
				 a.text2,
				 a.time_stamp
			from brasileirao.lances a
			join brasileirao.times b on (a.sigla_host = b.sigla )
			join (select sigla, profile_picurl as \"picurl_guest\" from brasileirao.times) c on (a.sigla_guest = c.sigla )
			join brasileirao.jogos d on (a.sigla_host = d.sigla_host)
			where a.sigla_host = '$sigla_host' and a.sigla_guest = '$sigla_guest'
			order by a.time_stamp desc");

        $no_of_rows = pg_num_rows($result);
        //-----
        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           //return json_encode($resultArray);
           $out = array();
           $out = json_encode($resultArray);
           //echo $out;
           return $out;
        } else {

            return false;
        }
    }



    public function getJogos() {



	$result = pg_query("select a.jogo_id,
				 a.sigla_host,
				 b.profile_picurl as \"picurl_host\",
				 a.placar_host,
				 a.sigla_guest,
				 c.picurl_guest,
				 a.placar_guest,
				 b.estadio,
				 a.dia,
				 a.hora,
				 a.status,
				 a.time_stamp
			from brasileirao.jogos a
			join brasileirao.times b on (a.sigla_host = b.sigla )
			join (select sigla, profile_picurl as \"picurl_guest\" from brasileirao.times) c on (a.sigla_guest = c.sigla )
			order by a.time_stamp desc");



	$no_of_rows = pg_num_rows($result);

        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           $out = array();
           $out = json_encode($resultArray);
           return $out;
        } else {

            return false;
        }
    }





    public function getRanking() {

        //$result = pg_query("SELECT * FROM app_dl.score order by score desc limit 10");
	$result = pg_query("select a.id,
				   a.user_id,
       				   c.name,
       				   c.picurl,
       				   a.score,
			           a.last_update_at
			    from app_dl.score a 
			    join users.profile c on (a.user_id = c.user_id)
			    order by score desc limit 50");
			    //order by score desc limit 10");

	$no_of_rows = pg_num_rows($result);
        //-----
        if ($no_of_rows > 0) {

           $resultArray = pg_fetch_all($result);
           //return json_encode($resultArray);
           $out = array();
           $out = json_encode($resultArray);
           //echo $out;
           return $out;
        } else {

            return false;
        }
    }




    /**
     * Get user by email and password
     */
    
    //public function storeCtrlLogin($fb_id,$name,$picURL,$device){

        //$result = pg_query("INSERT INTO users.ctrl_login(user_id, name, picurl, device, created_at) VALUES('$fb_id', '$name', '$picURL', '$device',  NOW())");
	
	//return false;

    //}
    public function storeUberToken($user_id,$uber_code,$local_time){

        $result = pg_query("INSERT INTO uber.access_token(user_id, uber_code, created_at) VALUES('$user_id', '$uber_code', $local_time)");
	
	if ($result) {
            //echo "true";
            return true;
        } else {
            //echo "false";
            return false;
        }
	
    }

    public function storeCtrlLogin($fb_id,$name,$picURL,$device,$android_api,$app_ver_name,$app_ver_code,$access_type,$local_time,$uber_package){

        //$result = pg_query("INSERT INTO users.ctrl_login(user_id, name, device, android_api, app_ver_name, app_ver_code, access_type, created_at) VALUES('$fb_id', '$name', '$device', '$android_api', '$app_ver_name', '$app_ver_code', '$access_type', $local_time)");

	$result = pg_query("INSERT INTO users.ctrl_login(user_id, name, device, android_api, app_ver_name, app_ver_code, access_type, created_at, uber_package) VALUES('$fb_id', '$name', '$device', '$android_api', '$app_ver_name', '$app_ver_code', '$access_type', $local_time, '$uber_package')");

        return false;

    }

			

    //public function getUserByEmailAndPassword($fb_id) {
    public function getUserProfileAndScore($fb_id) {

       //$result = pg_query("SELECT * FROM users.fb_sso_login WHERE fb_id = '$fb_id'");
        $result = pg_query("SELECT * FROM app_dl.score WHERE user_id = '$fb_id'");


        $no_of_rows = pg_num_rows($result);
        if ($no_of_rows > 0) {

            $result = pg_fetch_array($result);
            return $result;

        } else {
            // user not found
            return false;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($fb_id) {

        $result = pg_query("SELECT email from users.fb_sso_login WHERE fb_id = '$fb_id'");
        $no_of_rows = pg_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }


}

?>
