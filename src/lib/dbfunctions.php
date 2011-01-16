<?php

//runs a query and returns failed or succeeded
function runQuery($sql,$debug){
$result = mysql_query ("$sql");
if(!$result){
	if($debug){echo "Operation failed.";}
	return 0;
	} else {return 1;}
}

//runs the query +
//returns 1 if there is a matching record
//returns 0 if no record found
function isResultPresent($sql,$debug){
$result = mysql_query ("$sql");
if(!$result){
	if($debug){echo "Operation failed.";}
	return 0;
	} 
	$row = mysql_fetch_array($result);
	if ($row[0] == "") {
		return 0;
	} else {
		return 1;
	}	
}

//runs a query and returns the result in form of array
//array[0][id] array[0][email] array[1][id] etc
//sizeof array will give the number of records
function getQueryResult($sql,$fields,$debug){
$result = mysql_query ("$sql");
$temp = "";
$rowcount=0;
if(!$result){
	if($debug){echo "Operation failed.";}
	return 0;
	} else {
		while($row = mysql_fetch_array($result)){
			for ( $n = 0; $n < sizeof($fields); $n ++) {
				$temp[$rowcount][$fields[$n]]=$row[$fields[$n]];
				//echo $row[$fields[$n]];echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			$rowcount=$rowcount+1;
		}
		return $temp;
	}
}



//just checks for a particular id in a table
//1 if present, 0 if not
function isIdPresent($dbname,$connect,$table,$id){
	$sql = "SELECT id FROM `".$table."` WHERE id =" .$id. " LIMIT 1;";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0] == "") {
		return 0;
	} else {
		return 1;
	}
}


//gets the max record id from a table
//todo add $connect support
function findMaxId($table,$column,$dbname,$connect){
	$maxid=0;
	$sql = "SELECT max(".$column.") FROM `".$table."` WHERE 1";
	$tempresult = mysql_query($sql);
	while($temprow = mysql_fetch_array($tempresult)) {
		$maxid = $temprow[0];
	}
	return $maxid;
}


//get fields from an sql query
function getfields($tempresult){
	$fields = "";
	$numfields = mysql_num_fields($tempresult);
	$i = 0;
	while ($i < $numfields){
		$meta = mysql_fetch_field($tempresult);
		$fields[$i] = $meta->name;
		$i=$i+1;
	}
	$fields[$i] = "eof";
	return $fields;
}

function extractfields($values){
	if ($values == 0){return 0;}
	$fields = "";$i=0;
	foreach($values as $key=>$val){
		$fields[$i]=$key;
		$i=$i+1;
	}
	return $fields;
}

function getvalues($tempresult){
	$values = "";
	$fields = getfields($tempresult);
	$numfields = mysql_num_fields($tempresult);
	$rowcount = 0;
	while($temprow = mysql_fetch_array($tempresult)){
		for ( $n = 0; $n < $numfields; $n ++) {
			$values[$fields[$n]][$rowcount]=$temprow[$fields[$n]];
		}
		$rowcount = $rowcount + 1;
	}
	if ($rowcount == 0){
		return 0;
	}
	return $values;
}

// creates an array out of mysql result returned from getqueryresult
function makearray($tempresult){
    $values = "";$tempvalue = "";$rowcount = 0;
    $fields = getfields($tempresult);
    $numfields = mysql_num_fields($tempresult);

    while($temprow = mysql_fetch_array($tempresult)){
        $tempvalue = "";
        for ( $n = 0; $n < $numfields; $n ++) {
            if ($n != 0) {
                $tempvalue=$tempvalue.'='.utf8_decode($temprow[$fields[$n]]);
            } else {
                $tempvalue=$tempvalue.utf8_decode($temprow[$fields[$n]]);
            }
        }
        $values[$rowcount]=$tempvalue;
        $rowcount = $rowcount + 1;
    }
    if ($rowcount == 0){
        return 0;
    }
    return $values;
}



//to delete a record from database
function deletedata($dbname,$connect,$table,$id){
	if ($dbname != "") {
	$db = mysql_connect("localhost", "root");
	mysql_select_db($dbname, $db);
	}
	$sql = "DELETE FROM `".$table."` WHERE id =" .$id. " LIMIT 1;";
	$result = mysql_query($sql);
	$out1 = finddata($dbname,"",$table,$id);
	if ($out1 == "0"){
		return 1;
	} else {
		return 0;
	}
}

function modifydata($dbname,$connect,$table,$str,$id){
	if ($connect == "1") {
		$db = mysql_connect("localhost", "root");
		mysql_select_db($dbname, $db);
	}
	$sql = "UPDATE `".$dbname."`.`".$table."` SET ".$str." WHERE `".$table."`.`id` = ".$id." LIMIT 1;";
	$result = mysql_query($sql);
	return 1;
}

function postdata($dbname,$connect,$table,$fieldstr,$valuestr){
	if ($connect == "1") {
		$db = mysql_connect("localhost", "root");
		mysql_select_db($dbname, $db);
	}
	$max1 = findmaxid($dbname,"",$table);
	$sql = "INSERT INTO `".$dbname."`.`".$table."` ".$fieldstr." VALUES ".$valuestr.";";
	$result = mysql_query($sql);
	$max2 = findmaxid($dbname,"",$table);
	if ($max2 > $max1) {
		return $max2;
	} else {
		return 0;
	}
}

function finddata($dbname,$connect,$table,$id){
	$sql = "SELECT id FROM `".$table."` WHERE id =" .$id. " LIMIT 1;";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0] == "") {
		return 0;
	} else {
		return 1;
	}
}




?>
