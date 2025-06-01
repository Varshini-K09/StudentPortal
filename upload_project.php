<?php
session_start();
include('db.php'); // your DB connection

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['project_title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $technology = mysqli_real_escape_string($conn, $_POST['technology']);
    $git_link = mysqli_real_escape_string($conn, $_POST['git_link']);
    $demo_link = mysqli_real_escape_string($conn, $_POST['demo_link']);

    // File info
    $file_name = $_FILES['file_path2']['name'];
    $file_tmp = $_FILES['file_path2']['tmp_name'];
    $file_size = $_FILES['file_path2']['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($file_ext, $allowed_ext)) {
        if ($file_size <= 2 * 1024 * 1024) { 
            $new_file_name = uniqid("img_", true) . '.' . $file_ext;
            $upload_dir = "uploads/projects";
    
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
    
            $upload_path = $upload_dir . '/' . $new_file_name;
    
            if (move_uploaded_file($file_tmp, $upload_path)) {
    
                $upload_path_escaped = mysqli_real_escape_string($conn, $upload_path);
    
                $query = "INSERT INTO projects (user_id, title, description, technologies, github_link, live_demo_link, image_path)
                          VALUES ('$user_id', '$title', '$description', '$technology', '$git_link', '$demo_link', '$upload_path_escaped')";
    
                if (mysqli_query($conn, $query)) {
                    header('Location: home.html');
                    exit;
                } else {
                    echo "<p style='color:red;'>Database error: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p style='color:red;'>Failed to move uploaded file.</p>";
            }
        } else {
            echo "<p style='color:red;'>File is too large. Maximum 2MB allowed.</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid file type. Only JPG, JPEG, PNG, GIF allowed.</p>";
    }
    
}

$conn->close();