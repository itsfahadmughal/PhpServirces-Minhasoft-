<?php
$serverName = "192.168.100.122"; //serverName\instanceName
$connectionInfo = array( "Database"=>"saledb", "UID"=>"sa", "PWD"=>"minhasoft");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$machid=$_POST['mach_id'];
$temp=array();
if( $conn ) {
$query = "select id as Mold_Id,mold as Mold_Name from mold where machid=$machid";
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