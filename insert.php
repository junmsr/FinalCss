<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "mentalfatiguedb";
        
                $conn = new mysqli($servername, $username, $password, $dbname);
        
                if ($conn->connect_error) {
                    die("Error" . $conn->connect_error);
                }
        
                $name = $conn->real_escape_string($_POST['name']);
                $email = $conn->real_escape_string($_POST['email']);
                $rate = $conn->real_escape_string($_POST['rate']);
                $message = $conn->real_escape_string($_POST['message']);
        
                $stmt = $conn->prepare("INSERT INTO users (name, email, rate, message) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $rate, $message);
        
                if ($stmt->execute()) {
                    echo "Thank you for your feedback!";
                } else {
                    echo "Sorry, feedback can't be recorded." . $stmt->error;
                }
        
                $stmt->close();
                $conn->close();
            }
            ?>