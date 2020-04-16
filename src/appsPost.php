<?php 

  class Post {
    // DB stuff
    private $conn;
    private $table = 'yp_Users';

    // Post Properties
    public $ID;
    public $username;
    public $userIdTag;
    public $pin;
    public $registerationDate;
    public $email;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    
    public function my2CheckOutApi(){
        
        // Token info
        $token  = $this->token;
        
        // Card info
        $card_num = $this->card_no;
        $card_cvv = $this->card_cvv;
        $card_exp_month = $this->card_exp_month;
        $card_exp_year = $this->card_exp_year;
        
        // Buyer info
        $name = "Ahsan Ahmed";
        $email = "sa02908@st.habib.edu.pk";
        $phoneNumber = '555-555-5555';
        $addrLine1 = '123 Test St';
        $city = 'Columbus';
        $state = 'OH';
        $zipCode = '43123';
        $country = 'USA';
        
        // Item info
        $itemName = 'Premium Script CodexWorld';
        $itemNumber = 'PS123456';
        $itemPrice = '25.00';
        $currency = 'USD';
        $orderID = 'SKA92712382139';
        
        
        
        require_once("Twocheckout.php");
        
        
        // Set API key
        Twocheckout::privateKey('7243EE0C-D31D-4AF4-8108-A70BBFE356E2');
        Twocheckout::sellerId('901411125');
        Twocheckout::sandbox(true);
    
    try {
        // Charge a credit card
        $charge = Twocheckout_Charge::auth(array(
            "merchantOrderId" => $orderID,
            "token"      => $token,
            "currency"   => $currency,
            "total"      => $itemPrice,
            "billingAddr" => array(
                "name" => $name,
                "addrLine1" => $addrLine1,
                "city" => $city,
                "state" => $state,
                "zipCode" => $zipCode,
                "country" => $country,
                "email" => $email,
                "phoneNumber" => $phoneNumber
            )
        ));
        // Check whether the charge is successful
        if ($charge['response']['responseCode'] == 'APPROVED') {
           
            // Order details
            $orderNumber = $charge['response']['orderNumber'];
            $total = $charge['response']['total'];
            $transactionId = $charge['response']['transactionId'];
            $currency = $charge['response']['currencyCode'];
            $status = $charge['response']['responseCode'];
            
            return true;
            /**
            // Include database config file
            include_once 'dbConfig.php';
            
            // Insert order info to database
            $sql = "INSERT INTO orders(name, email, card_num, card_cvv, card_exp_month, card_exp_year, item_name, item_number, item_price, currency, paid_amount, order_number, txn_id, payment_status, created, modified) VALUES('".$name."', '".$email."', '".$card_num."', '".$card_cvv."', '".$card_exp_month."', '".$card_exp_year."', '".$itemName."', '".$itemNumber."','".$itemPrice."', '".$currency."', '".$total."', '".$orderNumber."', '".$transactionId."', '".$status."', NOW(), NOW())";
            $insert = $db->query($sql);
            $insert_id = $db->insert_id;
            
            $statusMsg = '<h2>Thanks for your Order!</h2>';
            $statusMsg .= '<h4>The transaction was successful. Order details are given below:</h4>';
            $statusMsg .= "<p>Order ID: {$insert_id}</p>";
            $statusMsg .= "<p>Order Number: {$orderNumber}</p>";
            $statusMsg .= "<p>Transaction ID: {$transactionId}</p>";
            $statusMsg .= "<p>Order Total: {$total} {$currency}</p>";
            **/
        }
    } catch (Twocheckout_Error $e) {
        $statusMsg = '<h2>Transaction failed!</h2>';
        return false;
        $statusMsg .= '<p>'.$e->getMessage().'</p>';
    }
    
    }

    
        // Create Post
    public function create_user() {
        
          // Create query
          $query = 'INSERT INTO as_users SET name = :name, email = :email, password = :password, userIdTag =:userIdTag';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->userIdTag = htmlspecialchars(strip_tags($this->userIdTag));
          
          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':userIdTag', $this->userIdTag);

          // Execute query
          if($stmt->execute()) {
            return true;
      }
      
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
      
    }
    
    public function sendNotfToRes() {
                define( 'API_ACCESS_KEY', 'AAAAUjJH48c:APA91bEatEWDjhZvtoi_4KaPoyutmCXq4L4gW4WyAnWRstfY0-ylcNSgAe0M75j3Edy4JZAfT9auEWRAJWll2ZqckW2IRFgEX-xrm8gdorWV3n21rcmvMVQzy9zO3HOiJd3sc0kBCmlN' );

        
        $tokenArray = ['fsWS0cY4unw:APA91bHCsJvDYDks319m2DbwJCGRTUf37im99hEP0XYDmW05VPo1eZxK0m_dA7HhrPLbbS4nUrU1DAJNzUdVI5ffj0YMRXFS75FbAEmsFQ1kriNFv2v7QSLWda83HwJfE_Hdm-7TXoIe'];
        
        $data = array(//"to" => $tokenArray,
        'registration_ids'  =>$tokenArray,
                      "notification" => array( "title" => "New booking", "body" => "You have a new meal booking." ,"icon" => "./images/logo.png", "click_action" => "https://projects.anomoz.com/allSet/portal/dashboard.php")
                      );                                                                    
        $data_string = json_encode($data); 
        //echo "The Json Data : ".$data_string; 
        $headers = array
        (
             'Authorization: key=' . API_ACCESS_KEY, 
             'Content-Type: application/json'
        );                                                                                 
        $ch = curl_init();  
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
        curl_setopt( $ch,CURLOPT_POST, true );  
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
        $result = curl_exec($ch);
        //echo $result;
        curl_close ($ch);
      
      // Print error if something goes wrong
      //printf("Error: %s.\n", $stmt->error);

      //return false;
      
    }
    
    public function create_resturant() {
        
          // Create query
          $query = 'INSERT INTO as_resturants SET name = :name, image = :image, rating=4';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->image = htmlspecialchars(strip_tags($this->image));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':image', $this->image);

          // Execute query
          if($stmt->execute()) {
            return true;
      }
      
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
      
    }
    
    function read_all_resturants(){
    // Create query
      $query = "SELECT id, name, rating, image from as_resturants";
     
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    function read_all_menu_and_resturants(){
        // Create query
      $query = "select r.id as resId, r.name as resName, r.lat, r.lng, r.rating as resRating, r.image as resImage, s.id as foodId, s.name as foodName, s.resturantId as resFoodId, s.about as foodAbout, s.price as foodPrice, s.image as foodImage, s.category as foodCat, s.childOf from as_menu m right outer join as_menu s on m.id=s.childOf right outer join as_resturants r on s.resturantId = r.id where r.isActive=1";
     
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    function read_menu_of_resturant(){
    // Create query
      $query = "SELECT b.timeAdded as 'timeBooked', b.timeDue as 'timeDine', r.name as 'resName', b.nPeople FROM `as_booking` b inner join as_resturants r on r.id=b.resId  where b.userIdTag=:userIdTag group by b.cartId";
     
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      $stmt->bindParam(':userIdTag', $this->userIdTag);
      
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    

    function read_live_resturant_bookings(){
    // Create query
    if($this->resId=='all'){
        $query = "select b.cartId,  r.id, b.timeDue, b.timeAdded, b.status, u.name  as 'userName', r.name as 'resName' from   
        as_booking b  LEFT outer join as_users u on u.userIdTag=b.userIdTag inner join as_resturants r on b.resId=r.id where status != 'done' group by b.cartId order by b.id desc";
    }
    else{
        $query = "select b.cartId, r.id, b.timeDue, b.timeAdded, b.status, u.name  as 'userName', r.name as 'resName' from   
        as_booking b  LEFT outer join as_users u on u.userIdTag=b.userIdTag inner join as_resturants r on b.resId=r.id where status != 'done' and r.id=:resId group by b.cartId order by b.id desc";
     
    }
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      $stmt->bindParam(':resId', $this->resId);
      
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    function read_bookings_of_user(){
        $query = "SELECT b.status, r.id as resId, b.cartId, b.timeAdded as 'timeBooked', b.timeDue as 'timeDine', r.name as 'resName', r.image as 'resImage', b.nPeople, sum(b.quantity*m.price) as cost, t.rating as 'rating' FROM `as_booking` b inner join as_resturants r on r.id=b.resId inner join as_menu m on m.id=b.itemId left outer join as_ratings t on t.cartId=b.cartId where b.userIdTag = :userIdTag group by b.cartId order by b.id desc";
     
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      $stmt->bindParam(':userIdTag', $this->userIdTag);
      
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    function get_user(){
        $query = "SELECT * from as_users where email=:email and password=:password";
     
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->password);
      
      // Execute query
      $stmt->execute();

      return $stmt;
    }
    
    
        public function create_menu_in_resturant() {
        
          // Create query
          $query = 'INSERT INTO as_menu SET name = :name, resturantId= :resturantId, about = :about, price = :price, category =:category, image=:image'; 

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->resturantId = htmlspecialchars(strip_tags($this->resturantId));
          $this->about = htmlspecialchars(strip_tags($this->about));
          $this->price = htmlspecialchars(strip_tags($this->price));
          $this->category = htmlspecialchars(strip_tags($this->category));
          $this->image = htmlspecialchars(strip_tags($this->image));
          
          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':resturantId', $this->resturantId);
          $stmt->bindParam(':about', $this->about);
          $stmt->bindParam(':price', $this->price);
          $stmt->bindParam(':category', $this->category);
          $stmt->bindParam(':image', $this->image);
        
          // Execute query
          if($stmt->execute()) {
            return true;
      }
      
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
      
    }


    public function insert_booking($data) {
    
      // Prepare statement
        $timeAdded = time();
        foreach($data as $item) {
            //echo "\nitem:".$item['id']."\n";
            $itemId = $item['itemId'];
            $cartId = $item['cartId'];
            $quantity = $item['quantity'];
            
            $timeDue = $item['timeDue'];
            $nPeople = $item['nPeople'];
            $resId = $item['resId'];
            $userIdTag = $item['userIdTag'];
            
             $query = "INSERT INTO as_booking SET itemId = '$itemId', cartId = '$cartId', quantity = '$quantity', timeAdded = '$timeAdded', nPeople = '$nPeople', timeDue = '$timeDue', resId = '$resId', userIdTag = '$userIdTag'"; 
             $stmt = $this->conn->prepare($query);
             $stmt->execute();

     }
     
        //$a = sendPushNotfToResturant();
      
      return true;
      
    }
    
    public function insert_rating() {
        
          // Create query
          $timeAdded = time();
          $query = "INSERT INTO as_ratings SET cartId = :cartId, rating = :rating, resId=:resId, timeAdded='$timeAdded';
          
          update as_resturants res set res.rating = (SELECT AVG(r.rating) as avgRating FROM as_ratings r where r.resId=:resId) where res.id=:resId;
          ";
            
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->cartId = htmlspecialchars(strip_tags($this->cartId));
          $this->rating = htmlspecialchars(strip_tags($this->rating));
          $this->resId = htmlspecialchars(strip_tags($this->resId));

          // Bind data
          $stmt->bindParam(':cartId', $this->cartId);
          $stmt->bindParam(':rating', $this->rating);
          $stmt->bindParam(':resId', $this->resId);

          // Execute query
          if($stmt->execute()) {
            return true;
      }
      
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
      
    }
    
    public function sendPushNotfToResturant(){
        echo "1";
        //echo 1;
        return true;
        /**
        define( 'API_ACCESS_KEY', 'AAAAUjJH48c:APA91bEatEWDjhZvtoi_4KaPoyutmCXq4L4gW4WyAnWRstfY0-ylcNSgAe0M75j3Edy4JZAfT9auEWRAJWll2ZqckW2IRFgEX-xrm8gdorWV3n21rcmvMVQzy9zO3HOiJd3sc0kBCmlN' );

        $data = array("to" => 'deCnWWFEdF0:APA91bHoSnvjHI-FQgjkO1DrkJyMQqqvgEL6fbpFcncz4eph8q1gH_CLYUcfGlrfNc9MES0xGU-hjMK80M59JqRho5bPKKKl5OU_zkOZmeVx_ffyjaA-h90JfO3sCRm_POcP-yF-c1Rk',
                      "notification" => array( "title" => "New Order", "body" => "You have a new order" ,"icon" => "./p1.jpg", "click_action" => "https://projects.anomoz.com/allSet/portal/dashboard.php"));                                                                    
        $data_string = json_encode($data); 
        
        //echo "The Json Data : ".$data_string; 
        $headers = array
        (
             'Authorization: key=' . API_ACCESS_KEY, 
             'Content-Type: application/json'
        );                                                                                 
        $ch = curl_init();  
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
        curl_setopt( $ch,CURLOPT_POST, true );  
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
        $result = curl_exec($ch);
        curl_close ($ch);
        **/
        
    }
    
    

  }