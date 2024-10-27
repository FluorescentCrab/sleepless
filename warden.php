<?php
// Connect to the database (replace with your credentials)


	$conn = new mysqli('localhost','root','','test');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT id, fullName, rollNo, program,year,mobileNo1,mobileNo2,dol,cov,rtp,status FROM registration";
$result = $conn->query($sql);


?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <style>
        body {
            background-image:url(back3.jpg);
            background-repeat:no-repeat;
            background-size:cover;
            justify-align:center;
            text-align:center;
            align-items:center;
            align-content:center;
        }

        .boxi{
            background-color:rgba(255,255,255,0.5);
            justify-align:center;
            text-align:center;
            align-items:center;
            align-content:center;
        }

        .table {
            text-align:center;
            border-collapse: collapse;
            margin:10px;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            animation: transition 1s;
        }

        .head {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .table th, .table td {
            padding: 12px 15px;
        }

        .body {
            border-bottom: 1px solid #dddddd;
        }

            .body : nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .body : last-of-type {
                border-bottom: 2px solid #009879;
            }

        @keyframes transition {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }
        .buttons:hover {
            margin: 10px;
            padding: 20px;
            display: inline-block;
            border-radius: 20px;
            width: 500px;
            border-radius = 50px;
            border-style: solid;
            border-color: white;
            background-color: rgb(100, 149, 237,0);
        }
        
        .buttons {
            margin: 10px;
            padding: 20px;
            display: inline-block;
            border-radius: 20px;
            width: 500px;
            border-radius = 50px;
            border-style: solid;
            box-shadow: none;
            transition-duration: 0.4s;
            border-color: black;
            color: black;
            background-color: rgb(255, 255, 255,.5);
        }

    </style>
    <title></title>
</head>
<body>
<div class="boxi">
    <table class="table">
        <tr class="head">
            <th>Sr.No</th>
            <th>Full Name</th>
            <th>Roll.No</th>
            <th>Program</th>
            <th>Year</th>
            <th>Mobile No. 1</th>
            <th>Mobile No. 2</th>
            <th>Date Of Leave</th>
            <th>City Of Visit</th>
            <th>Relation To Place</th>
            <th>Status</th>
            <th>decision</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc())
        {
        echo "
        <tr>
            ";
            echo "
            <td>" . $row["id"] . "</td>";
            echo "
            <td>" . $row["fullName"] . "</td>";
            echo "
            <td>" . $row["rollNo"] . "</td>";
            echo "
            <td>" . $row["program"] . "</td>";
            echo "
            <td>" . $row["year"] . "</td>";
            echo "
            <td>" . $row["mobileNo1"] . "</td>";
            echo "
            <td>" . $row["mobileNo2"] . "</td>";
            echo "
            <td>" . $row["dol"] . "</td>";
            echo "
            <td>" . $row["cov"] . "</td>";
            echo "
            <td>" . $row["rtp"] . "</td>";
            echo "
            <td>" . $row["status"] . "</td>";
            echo "
            <td>
                ";

                ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option disabled selected>Pending</option>
                        <option value="accept" <?php if ($row['status'] == 'accept') echo 'selected'; ?>>accept</option>
                        <option value="reject" <?php if ($row['status']  == 'reject') echo 'selected'; ?>>reject</option>
                    </select>

                    <input type="submit" name="update" value="update">
                </form>

                <?php
                if(isset($_POST['update']))
                {
                $id = $_POST['id'];


                $query = "UPDATE registration SET status = '$_POST[status]' where id = '$_POST[id]'";
                $query_run = mysqli_query($conn,$query);

                if($query_run)
                {
                echo'
                <script type="text/javascript">alert("ACCEPTED")</script>';
                }

                else
                {
                echo'
                <script type="text/javascript">alert("REJECTED")</script>';

                }
               
                }
                ?>
                <?php
                echo "
            </td>";
            echo "
        </tr>";
        }
        } else {
        echo "0 results";
        }
        $conn->close();
        ?>

    </table>
    
     <br/>
        
    <a href="temp.php">
        <button class="buttons">
        
            Send Mail
       
        </button>
     </a>
</div>
</body>
</html>