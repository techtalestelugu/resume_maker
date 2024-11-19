<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "resume_maker";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    if ($action === 'email_login' && isset($_POST['email'])) {
        $email = $_POST['email'];

        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("INSERT INTO data (email) VALUES (?)");
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                echo "Email stored successfully!";
                $_SESSION['email'] = $email;
                $_SESSION['logged_in'] = "yes";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Invalid email format.";
        }
    }

    if ($action === 'save_data' && isset($_POST['email'])) {
    	// print_r($_POST['data']);
    	$query = "UPDATE data SET data = '" . mysqli_real_escape_string($conn, $_POST['data']) . "' WHERE email = '" . mysqli_real_escape_string($conn, $_POST['email']) . "'";
    	mysqli_query($conn, $query);
    	if( mysqli_error($conn) ){
			echo "there was an error in query";
			echo mysqli_error($conn);
			exit;
		}
		echo json_encode(['success' => true, 'message' => 'Data saved successfully']);
    }

    $conn->close();
}
?>
