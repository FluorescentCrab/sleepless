<?php
	$fullName = $_POST['fullName'];
	$rollNo = $_POST['rollNo'];
	$program = $_POST['program'];
	$year = $_POST['year'];
	$mobileNo1 = $_POST['mobileNo1'];
	$mobileNo2 = $_POST['mobileNo2'];
	$dol = $_POST['dol'];
	$cov = $_POST['cov'];
	$rtp = $_POST['rtp'];
	

	$conn = new mysqli('localhost','root','','test');
	if($conn->connect_error)
	{
		die('Connection Failed : '.$conn->connect_error);
	}
	else
	{
		$stmp=$conn->prepare("insert into registration (fullName,rollNo,program,year,mobileNo1,mobileNo2,dol,cov,rtp,status) values(?,?,?,?,?,?,?,?,?,'pending')");
		$stmp->bind_param("ssssiisss",$fullName,$rollNo,$program,$year,$mobileNo1,$mobileNo2,$dol,$cov,$rtp);
		$stmp->execute();
		$stmp->close();
		$conn->close();
		header('Location: formSubmitConfirm.html');
		exit;
	}
?>