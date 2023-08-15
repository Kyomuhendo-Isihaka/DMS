<?php
$current_time = date("Y-m-d");
echo "Current time: " . $current_time;
?>

<br>
<?php
$current_time = time(); // Get the current timestamp
$one_week_ago = strtotime('-1 week', $current_time); // Subtract one week

$current_formatted = date("Y-m-d H:i:s", $current_time);
$one_week_ago_formatted = date("Y-m-d H:i:s", $one_week_ago);

echo "Current time: " . $current_formatted . "<br>";
echo "One week ago: " . $one_week_ago_formatted;
?>

<?php
// Replace with your database connection details
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current time
$current_time = time();
$formatted_current_time = date("Y-m-d H:i:s", $current_time);

// Construct and execute the SQL query
$sql = "UPDATE your_table SET status = '1' WHERE your_time_column = '$formatted_current_time'";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo "Status updated successfully.";
} else {
    echo "Error updating status: " . $conn->error;
}

// Close the connection
$conn->close();
?>

