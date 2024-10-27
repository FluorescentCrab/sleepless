<!DOCTYPE html>
<html>
<head>
<style>
        body
        {
            background-image:url(back1.jpg);
            background-repeat:no-reapeat;
        background-size:cover;
            justify-content:center;
            align-content:center;
            align-items:center;
            display:flex;
        }
        .box{
            background-color:rgba(255,255,255,.5);
            font-family: sans-serif;
            margin: 10vh 0 10vh 0;
            width:40%;
            height:60%;
            font-size:large;
            border-radius:6px;

        }
</style>
</head>

<body>
<?php
	$conn = new mysqli('localhost','root','','test');
	if($conn->connect_error)
	{
		die('Connection Failed : '.$conn->connect_error);
	}

	else{
		$id = $_GET['id'];

// Prepare and execute the SQL statement
$sql = "SELECT * FROM registration WHERE id = $id";

// Get the result
$result = $conn->query($sql);
echo"<div class='box'>";
// Display the results
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo "ID: " . $row["id"] . "<br>";
    echo "Name: " . $row["fullName"] . "<br>";
    echo "Roll.No: " . $row["rollNo"] . "<br>";
    echo "Program: " . $row["program"] . "<br>";
    echo "Year: " . $row["year"] . "<br>";
    echo "Mobile No. 1: " . $row["mobileNo1"] . "<br>";
    echo "Mobile No. 2: " . $row["mobileNo2"] . "<br>";
    echo "Date Of Leave: " . $row["dol"] . "<br>";
    echo "City Of Visit: " . $row["cov"] . "<br>";
    echo "Relation to the Place: " . $row["rtp"] . "<br>";
    echo "Status : " . $row["status"] . "<br>";
    // ... other fields as needed
    echo"</div>";
} else {
    echo "No results found for the given ID.";
}

$conn->close();
	}
?>

</body>
</html>