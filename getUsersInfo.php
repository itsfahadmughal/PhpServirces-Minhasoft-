<?php
$serverName = "192.168.100.122"; //serverName\instanceName
$connectionInfo = array( "Database"=>"saledb", "UID"=>"sa", "PWD"=>"minhasoft");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$username=$_POST['username'];
$password=$_POST['password'];
$temp=array();                               
if( $conn ) {
$query = "EXEC dbo.sploadsignin3 @UserName = $username, @Password = $password, @IP_Add = null, @Sessionid = null, @MacAdd = null";
$stmt = sqlsrv_query($conn, $query);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	if (!is_null($row['UserId'])) {
		echo $row['UserId'];
	}else{
		echo 0;
			}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>