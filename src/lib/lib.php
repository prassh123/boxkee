<?php
include('dbfunctions.php');
include('functions.php');

$db = "testdb";
mysql_connect("localhost", "uroot", "")
or die ("Unable to connect to server.");
mysql_select_db($db)
or die ("Unable to select database.");


switch ($_GET['mode']) {

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
	getZipcodeStoreInfo($_GET['store_zipcode'],array('store_name'));
	break;		

case 'getStoreInfo':
	getStoreInfo($_GET['store_name'],array('store_name','store_zipcode'));
	break;		

case 'getCountStoreZipcodeInfo':
	getCountStoreZipcode($_GET['store_zipcode']);
	break;

}


?>
