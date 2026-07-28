<?php
session_start(); 

$host = "127.0.0.1";
$user = "admin";
$password = "admin";
$database = "gameboxd";

$conn = mysqli_connect($host, $user, $password, $database)
or die('Error connecting database: '.mysqli_error($conn) );


$action = $_POST['action'] ?? '';
$username = $_POST['username'] ?? '';
$passwordInput = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

// ==========================================
// REGISTRATION LOGIC
// ==========================================
if ($action === 'register') {
    
    // check if the two passwords are equal, and if not, send them back with a message error
    if ($passwordInput !== $confirmPassword) { 
        header("Location: ../web/register.php?error=mismatch");
        exit;
    }


    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username taken! Send them back to register page with an error in the URL
        header("Location: ../web/register.php?error=taken");
        exit;
    } else {
        // Encrypt password and save user
        $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);
        $insertStmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
        $insertStmt->bind_param("ss", $username, $hashedPassword);
        $insertStmt->execute();
        $insertStmt->close();

        // Success! Send them to main page with a success message in the URL
        header("Location: ../web/index.php?msg=registered");
        exit;
    }
    $stmt->close();
} 

// ==========================================
// LOGIN LOGIC
// ==========================================
elseif ($action === 'login') {
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($passwordInput, $row['password'])) {
            // Give them the VIP Wristband!
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            
            // Redirect to index with a success message in the URL
            header("Location: ../web/profile.php?msg=loggedin");
            exit;
        }
    }
    
    header("Location: ../web/login.php?error=invalid");
    exit;
    $stmt->close();
}

$conn->close();
