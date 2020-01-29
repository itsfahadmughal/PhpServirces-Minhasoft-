<?php
$serverName = "192.168.100.122"; //serverName\instanceName
$connectionInfo = array( "Database"=>"saledb", "UID"=>"sa", "PWD"=>"minhasoft");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$WorkerId=array();

$Id=0;
$MainId=0;
$TDate=$_POST['TDate'];
$ShiftId=$_POST['ShiftId'];
$InchargeId=$_POST['InchargeId'];
$SubInchargeId=$_POST['SubInchargeId'];
$BagsReceived=$_POST['BagsReceived'];
$BagsUsed=$_POST['BagsUsed'];
$QtyProduced=$_POST['ProducedQty'];
$ScrapeQty=$_POST['ScrapeQty'];
$Remarks=$_POST['Remarks'];
$UserId=$_POST['UserId'];
$UserIp=$_POST['UserIp'];
$Workers=$_POST['Workers'];
$Doc_Number= "DOC-5000"//$_POST['DocNumber'];
$Counter=1; //$_POST['Counter'];
$RemCounter=-1; //$_POST['RemCounter'];
$MachId=$_POST['MachId'];
$MoldId=$_POST['MoldId'];
$ItemId=$_POST['ItemId'];
$WorkerId[0]=$_POST['WorkerOneId'];
$WorkerId[1]=$_POST['WorkerTwoId'];
$WorkerId[2]=$_POST['WorkerThreeId'];
$WorkerId[3]=$_POST['WorkerFourId'];
$LevelNo=5; //$_POST['LevelNo'];
$EntryTime=$TDate;


if( $conn ) {
	$query1 = "EXEC dbo.spinsertefficiencylevels @Id = $Id, @MainId = $MainId, @TDate = $TDate, @ShiftId = $ShiftId, @InchargeId = $InchargeId, @SubInchargeId=$SubInchargeId, @BagsReceived=$BagsReceived, @BagsUsed=$BagsUsed, @QtyProduced=$QtyProduced, @ScrapeQty=$ScrapeQty, @Remarks=$Remarks, @UserId=$UserId, @EntryTime=$EntryTime, @UserIp=$UserIp, @LevelNo=$LevelNo, @Workers=$Workers";

$stmt1 = sqlsrv_query($conn, $query1);
	if (!$stmt1) {
		echo "Data Not Inserted 1\n";
	}else{
		echo "Data Inserted 1\n";
			}

$query2 = "EXEC dbo.spinsertefficiency @Id=$Id, @Doc_Number=$Doc_Number, @Counter=$Counter, @RemCounter=$RemCounter, @MachId=$MachId, @MoldId=$MoldId, @ItemId=$ItemId, @UserId=$UserId, @EntryTime=$TDate, @UserIp=$UserIp";
$stmt2 = sqlsrv_query($conn, $query2);
	if (!$stmt2) {
		echo "Data Not Inserted 2\n";
	}else{
		echo "Data Inserted 2\n";
			}	

for ($i=0; $i<(int)$Workers ; $i++) { 
	# code...
	$query3 = "EXEC dbo.spinsertlevelworkers @LevelNo = $LevelNo, @MainId = $MainId, @WorkerId = $WorkerId[$i]";
    $stmt3 = sqlsrv_query($conn, $query3);
	if (!$stmt3) {
		echo "Data Not Inserted 3\n";
	}else{
		echo "Data Inserted 3\n";
			}	

}//end of loop
sqlsrv_close($conn);
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>