<?php
require_once ('dbfunctions.php');
require_once ('functions.php');

class UserActions {
    
   private $db = "testdb";

   public function __construct() {
        
        //mysql_connect("localhost", "uroot", "")
        //or die ("Unable to connect to server.");
        //mysql_select_db($this->db)
        //or die ("Unable to select database.");
    }

    public function actions ($action) {
	    
	    switch ($action) {

        case 'login':
	        isLoginAccepted($_GET['user_email'],$_GET['user_password']);
	        break;

        case 'signup':
            $user_id=getUserId();
	        echo $user_id;
	        addUser($user_id,$_GET['user_email'],$_GET['user_password'],$_GET['user_zipcode']);
	        break;
	
        case 'checklogin':
            isUserEmailPresent($_GET['user_email']);
	        break;

        case 'getpassword':
	        getPassword($_GET['user_id'],array('user_password'));
	        break;
	
        case 'userinfo':
	        getUserInfo($_GET['user_id'],array('user_email','user_zipcode'));
	        break;	

        case 'getzipcodeinfo':
	        getZipcodeInfo($_GET['user_zipcode'],array('user_id'));
	        break;		


//*************************************************************//
//				Store related				
//*************************************************************//	
        case 'addStore':
	        $store_id=getStoreId();
        	addStore($store_id,$_GET['store_name'],$_GET['store_zipcode']);
        	break;
	
        case 'getZipcodeStoreInfo':
	        getZipcodeStoreInfo($_REQUEST['store_zipcode'],array('store_name'));
        	break;		

        case 'getStoreInfo':
        	getStoreInfo($_GET['store_name'],array('store_name','store_zipcode'));
        	break;		

        case 'getCountStoreZipcodeInfo':
        	getCountStoreZipcode($_GET['store_zipcode']);
        	break;
      }
}
}

?>
