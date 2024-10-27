<?php
$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$status = $_POST['status'];

// Prepare and execute the SQL statement with parameter binding
$stmt = $conn->prepare("UPDATE registration SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
  echo "Status updated successfully!";
  header("Location: warden.php");
  exit();
} else {
  echo "Error updating status: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>