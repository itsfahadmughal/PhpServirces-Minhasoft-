<?php
$serverName = "192.168.100.122"; //serverName\instanceName
$connectionInfo = array( "Database"=>"saledb", "UID"=>"sa", "PWD"=>"minhasoft");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$temp=array();

if( $conn ) {
$query = "select id as Mach_Id,name as Mach_Name from machine";
$stmt = sqlsrv_query($conn, $query);

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	$temp[]=$row;
    //  echo $row['Id'].", ".$row['FirstName']."<br />";
}
echo json_encode($temp);
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);


}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>