<?php
$serverName = "192.168.100.122"; //serverName\instanceName
$connectionInfo = array( "Database"=>"saledb", "UID"=>"sa", "PWD"=>"minhasoft");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$WorkerId=array();

$Id=0;
$MainId=0;
$TDate=strval($_POST['TDate']);
$UserIp=$_POST['UserIp'];
$ShiftId=(int)$_POST['ShiftId'];
$InchargeId=(int)$_POST['InchargeId'];
$SubInchargeId=(int)$_POST['SubInchargeId'];
$BagsReceived=(float)$_POST['BagsReceived'];
$BagsUsed=(float)$_POST['BagsUsed'];
$QtyProduced=(float)$_POST['ProducedQty'];
$ScrapeQty=(float)$_POST['ScrapeQty'];
$Remarks=$_POST['Remarks'];
$UserId=(int)$_POST['UserId'];
$Workers=(int)$_POST['Workers'];
$Doc_Number='DOC5000';//$_POST['DocNumber'];
$Counter=1; //$_POST['Counter'];
$RemCounter=-1; //$_POST['RemCounter'];
$MachId=(int)$_POST['MachId'];
$MoldId=(int)$_POST['MoldId'];
$ItemId=(int)$_POST['ItemId'];
$WorkerId[0]=(int)$_POST['WorkerOneId'];
$WorkerId[1]=(int)$_POST['WorkerTwoId'];
$WorkerId[2]=(int)$_POST['WorkerThreeId'];
$WorkerId[3]=(int)$_POST['WorkerFourId'];
$LevelNo=1; //$_POST['LevelNo'];
$EntryTime=strval($_POST['CurrentDateTime']);

echo "\n\n$TDate+","+$ShiftId+","+$InchargeId+","+$SubInchargeId+","+$BagsReceived+","+$BagsUsed+","+$QtyProduced+","+$ScrapeQty+","+$Remarks+","+$UserId+","+$UserIp+","+$Workers+","+$MachId+","+$MoldId+","+$ItemId+","+$WorkerId[0]+","+$WorkerId[1]+","+$WorkerId[2]+","+$WorkerId[3]";

if( $conn ) {
	$query1 = "EXEC dbo.spinsertefficiencylevels @Id = $Id, @MainId = $MainId, @TDate = '$TDate', @ShiftId = $ShiftId, @InchargeId = $InchargeId, @SubInchargeId=$SubInchargeId, @BagsReceived=$BagsReceived, @BagsUsed=$BagsUsed, @QtyProduced=$QtyProduced, @ScrapeQty=$ScrapeQty, @Remarks='$Remarks', @UserId=$UserId, @EntryTime='$EntryTime', @UserIp='$UserIp', @LevelNo=$LevelNo, @Workers=$Workers";

$stmt1 = sqlsrv_query($conn, $query1);
	if( $stmt1 === false ) {
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."\n";
            echo "code: ".$error[ 'code']."\n";
            echo "message: ".$error[ 'message']."\n";
        }
    }
}//end of error checking...

$query2 = "EXEC dbo.spinsertefficiency @Id=$Id, @Doc_Number='$Doc_Number', @Counter=$Counter, @RemCounter=$RemCounter, @MachId=$MachId, @MoldId=$MoldId, @ItemId=$ItemId, @UserId=$UserId, @EntryTime='$EntryTime', @UserIp='$UserIp'";


$stmt2 = sqlsrv_query($conn, $query2);
	if (!$stmt2) {
		echo "Data Not Inserted 2\n";
	}else{
		echo "Data Inserted 2\n";
			}	

for ($i=0; $i<(int)$Workers ; $i++) { 
	# code...
	if ($WorkerId[$i]!=0) {
		# code...
	$query3 = "EXEC dbo.spinsertlevelworkers @LevelNo = $LevelNo, @MainId = $MainId, @WorkerId = $WorkerId[$i]";
    $stmt3 = sqlsrv_query($conn, $query3);
	if (!$stmt3) {
		echo "Data Not Inserted 3\n";
	}else{
		echo "Data Inserted 3\n";
			}	
	}

}//end of loop
sqlsrv_close($conn);
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>