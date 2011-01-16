<?php

//******************************************//
//			users table
//user_id user_email user_password user_zipcode
//******************************************//

//addUser - to add a user profile
function addUser($user_id,$user_email,$user_password,$user_zipcode){
$sql="INSERT INTO users (user_id, user_email, user_password, user_zipcode) VALUES ('$user_id', '$user_email', '$user_password', '$user_zipcode')";
if(!runQuery($sql,0)){
	echo "Failed to add User.<br/>";
	}
}

//getUserId - get id of record to be added
function getUserId(){
return findMaxId('users','user_id','','')+1;
}

//isLoginAccepted - to check the username and password
function isLoginAccepted($useremail,$userpassword){
$sql = "SELECT user_id FROM users WHERE user_email='$useremail' and user_password='$userpassword'";
//echo $sql;
if(!isResultPresent($sql,0)){
	echo "Login Failed";
	} else {
	echo "Login Accepted";
	}
}

//isUserIdPresent - validate user id
function isUserIDPresent($user_id){
$sql="SELECT * FROM users WHERE user_id = ".$user_id;
if(!isResultPresent($sql,0)){
	echo "User ID does not exist";
	} else {
	echo "User ID exists";
	}
}

//isUserEmailPresent - validate user email
function isUserEmailPresent($user_email){
$sql="SELECT * FROM users WHERE user_email = '".$user_email."'";
//echo $sql;
if(!isResultPresent($sql,0)){
	echo "User Email does not exist";
	} else {
	echo "User Email exists";
	}
}

//modifyUserProfile - to modify basic user profile
function modifyUserProfile(){
}

//getPassword - to get password for an userid
function getPassword($user_id,$info){
$sql="SELECT user_password FROM users WHERE user_id = '".$user_id."'";
//echo $sql;
$result=getQueryResult($sql,$info,0);
}

//getUserInfo - to get info of an user
//$info is the array that specifies the list of fields needed
function getUserInfo($user_id,$info){
$sql="SELECT * FROM users WHERE user_id = '".$user_id."'";
//echo $sql;
$result=getQueryResult($sql,$info,0);
}

//getZipcodeInfo - to get info for a particular zipcode
function getZipcodeInfo($zipcode,$info){
$sql="SELECT * FROM users WHERE user_zipcode = '".$zipcode."'";
//echo $sql;
$result=getQueryResult($sql,$info,0);
}


//******************************************//
//			stores table
//
//******************************************//

//addStore - to add a store profile
function addStore($store_id,$store_name,$store_zipcode){
$sql="INSERT INTO stores (store_id, store_name, store_zipcode) VALUES ('$store_id', '$store_name', '$store_zipcode')";
if(!runQuery($sql,0)){
	echo "Failed to add Store.<br/>";
	} else {
	echo "Store Added Successfully";
	}
}

//getStoreId - get id of record to be added
function getStoreId(){
return findMaxId('stores','store_id','','')+1;
}

//getStoreInfo - to get info of a store
//$info is the array that specifies the list of fields needed
function getStoreInfo($store_name,$info){
$sql="SELECT * FROM stores WHERE store_name = '".$store_name."'";
//echo $sql;
$result=getQueryResult($sql,$info,0);
}

//getZipcodeInfo - to get info for a particular zipcode
function getZipcodeStoreInfo($zipcode,$info){
$sql="SELECT store_name FROM stores WHERE store_zipcode = '".$zipcode."'";
//echo $sql;
$temp=getQueryResult($sql,$info,0);
for ( $i = 0; $i < sizeof($temp); $i ++) {
	$j = $i+1;
	$item = "item".$j;
	echo "<div class='dojoDndItem' id='".$item."'><span class='dojoDndHandle'>$i</span> <strong>".$temp[$i]['store_name']."</strong></div>";
}
}

//getCountStoreZipcode - get count of stores in a zipcode
function getCountStoreZipcode($zipcode){
$sql="SELECT COUNT(store_id) FROM stores WHERE store_zipcode = '".$zipcode."'";
//echo $sql;
$result=getQueryResult($sql,array('COUNT(store_id)'),0);
}


//******************************************//
//			usersmoreinfo table
//
//******************************************//

?>
