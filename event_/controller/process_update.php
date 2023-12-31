<!-- process_update.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id_to_update = $_POST["event_id"];
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $event_location = $_POST["event_location"];
    // Retrieve latitude and longitude from the form data


// Insert or update the event in the database with latitude and longitude
// Example SQL: INSERT INTO event (event_name, latitude, longitude, ...) VALUES ('$event_name', $latitude, $longitude, ...);

    // Retrieve other updated details...

    // Update the event in the database using prepared statements
    $stmt = $conn->prepare("UPDATE event SET
                            event_name = ?,
                            event_date = ?,
                            event_time = ?,
                            event_location = ?
                            -- Update other fields similarly...
                            WHERE event_id = ?");

    $stmt->bind_param("ssssi", $event_name, $event_date, $event_time, $event_location, $event_id_to_update);

    if ($stmt->execute()) {
        echo "Event updated successfully!";
    } else {
        echo "Error updating event: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
