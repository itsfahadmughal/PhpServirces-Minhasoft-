<?php
$serverName = "192.168.100.122"; //serverName\instanceName
$connectionInfo = array( "Database"=>"saledb", "UID"=>"sa", "PWD"=>"minhasoft");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$machId=$_POST['MachId'];
$moldId=$_POST['MoldId'];
$itemId=$_POST['ItemId'];
$stmt2;

$temp=array();

if( $conn ) {
	$query="SELECT * From ProductionConfig where ItemId=$itemId and MachineId=$machId and MoldId=$moldId";
	$stmt = sqlsrv_query($conn, $query);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
if (sizeof($row)>0) {
$query2 = "SELECT Id as Emp_Id,FirstName as Emp_Name FROM eEmployee";
$stmt2 = sqlsrv_query($conn, $query2);
while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
	$temp[]=$row;
}
echo json_encode($temp);
}else{
	echo "No Record Exists...";
}
sqlsrv_close($conn);
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>