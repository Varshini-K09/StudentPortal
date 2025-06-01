<?php
session_start();
include('db.php');  
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to upload a resume.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_path'])) {
    $file = $_FILES['file_path'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading file. Error code: " . $file['error']);
    }

    if (!is_uploaded_file($file['tmp_name'])) {
        die("No valid file uploaded.");
    }

    $fileType = mime_content_type($file['tmp_name']);
    if ($fileType !== 'application/pdf') {
        die("Only PDF files are allowed.");
    }

    $uploadDir = "uploads/resumes/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $originalName = basename($file['name']);
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $safeName = uniqid('resume_', true) . '.' . $extension;
    $targetPath = $uploadDir . $safeName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        die("Failed to move uploaded file.");
    }
    $targetPathEscaped = mysqli_real_escape_string($conn, $targetPath);
    $userIdEscaped = mysqli_real_escape_string($conn, $user_id);

    $check = mysqli_query($conn, "SELECT * FROM resumes WHERE user_id = '$userIdEscaped'");
    if (mysqli_num_rows($check) > 0) {
        $updateQuery = "UPDATE resumes SET file_path='$targetPathEscaped' WHERE user_id='$userIdEscaped'";
        if (mysqli_query($conn, $updateQuery)) {
            header("Location: home.html");
            exit;
        } else {
            echo "Database error (update): " . mysqli_error($conn);
        }
    } else {
        $insertQuery = "INSERT INTO resumes (user_id, file_path) VALUES ('$userIdEscaped', '$targetPathEscaped')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Resume uploaded successfully.";
        } else {
            echo "Database error (insert): " . mysqli_error($conn);
        }
    }
} else {
    echo "Invalid upload request.";
}
?>