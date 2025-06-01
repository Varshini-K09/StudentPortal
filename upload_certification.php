<?php
session_start();
include('db.php');  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to upload a resume.");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_path1'])) {
    $file = $_FILES['file_path1'];
    $certname = trim($_POST['cert_title']);
    $isseby = trim($_POST['issuser']);
    $issuedate = $_POST['issue_date'];

    $uploadDir = 'uploads/certificates/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $originalName = basename($file['name']);
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    $safeName = uniqid('certificate_', true) . '.' . $extension;
    $targetPath = $uploadDir . $safeName;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        $targetPathEscaped = mysqli_real_escape_string($conn, $targetPath);
        $certnameEscaped = mysqli_real_escape_string($conn, $certname);
        $issebyEscaped = mysqli_real_escape_string($conn, $isseby);
        $issuedateEscaped = mysqli_real_escape_string($conn, $issuedate);

        $insertQuery = "INSERT INTO certifications (user_id, cert_title, issuer, issue_date, cert_file_path)
                        VALUES ('$user_id', '$certnameEscaped', '$issebyEscaped', '$issuedateEscaped', '$targetPathEscaped')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "Certificate uploaded successfully.";
        } else {
            echo "Database error (insert): " . mysqli_error($conn);
        }
    } else {
        echo "Failed to move uploaded file.";
    }
} else {
    echo "Invalid upload request.";
}
?>