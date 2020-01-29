<?php
$serverName = "192.168.100.122"; //serverName\instanceName
$connectionInfo = array( "Database"=>"saledb", "UID"=>"sa", "PWD"=>"minhasoft");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$machid=23;
$moldid=32;
$itemid=2;
$temp=array();

if( $conn ) {
$query = "EXEC dbo.sploadpackingworkers @MachId = $machid,@MoldId=$moldid,@ItemId=$itemid";
$stmt = sqlsrv_query($conn, $query);
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	$temp[]=$row;
}
echo json_encode($temp);
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>