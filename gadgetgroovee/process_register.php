<?php
include 'config.php';
session_start();


function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateContactNumber($contactnumber) {
    return preg_match('/^[0-9]{10,15}$/', $contactnumber);
}

function validatePassword($password) {
    return strlen($password) >= 8; 
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = sanitizeInput($_POST['firstname']);
    $lastname = sanitizeInput($_POST['lastname']);
    $contactnumber = sanitizeInput($_POST['contactnumber']);
    $birthdate = sanitizeInput($_POST['birthdate']);
    $gender = isset($_POST["gender"]) ? sanitizeInput($_POST["gender"]) : null;
    $address = sanitizeInput($_POST['address']);
    $country = sanitizeInput($_POST['country']);
    $zone = sanitizeInput($_POST['zone']);
    $region = sanitizeInput($_POST['region']);
    $postalcode = sanitizeInput($_POST['postalcode']);
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $user_type = sanitizeInput($_POST['user_type']);

    
    if ($gender) {
        switch ($gender) {
            case "m":
                $genderText = "Male";
                break;
            case "f":
                $genderText = "Female";
                break;
            case "o":
                $genderText = "Prefer not to say";
                break;
            default:
                $genderText = "Invalid input";
        }
    } else {
        $genderText = "Gender is required.";
    }

    
    if (empty($firstname) || empty($lastname) || empty($contactnumber) || empty($birthdate) || empty($genderText) || empty($address) || empty($country) || empty($zone) || empty($region) || empty($postalcode) || empty($username) || empty($email) || empty($password) || empty($user_type)) {
        die("All fields are required.");
    }

    if (!validateEmail($email)) {
        die("Invalid email format.");
    }

    if (!validateContactNumber($contactnumber)) {
        die("Invalid contact number format. It should be numeric and between 10-15 digits.");
    }

    if (!validatePassword($password)) {
        die("Password must be at least 8 characters long.");
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($conn->connect_error) {
        die("Connection failed: " . htmlspecialchars($conn->connect_error));
    }
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, contactnumber, birthdate, gender, address, country, zone, region, postalcode, username, email, password, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ssssssssssssss", $firstname, $lastname, $contactnumber, $birthdate, $genderText, $address, $country, $zone, $region, $postalcode, $username, $email, $hashedPassword, $user_type);

    
    if ($stmt->execute()) {
        echo "Registration successful";

        
        session_regenerate_id(true);

        $_SESSION['usertype'] = $user_type;

        if ($user_type === 'admin') {
            header('Location: admin_home.php');
        } else {
            header('Location: home2.php');
        }
        exit();
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No data received.";
}
?>