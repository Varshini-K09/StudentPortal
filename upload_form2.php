<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate Uploading</title>
    <style>
        body {
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 50px auto;
            background-color: rgb(23, 44, 46);
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Upload Your Certificate</h3>
        <form action="upload_certification.php" method="post" enctype="multipart/form-data">
            <label for="title">Certification Title</label><br><br>
            <input type="text" name="cert_title"><br><br>
            <label for="issed">Issued By</label><br><br>
            <input type="text" name="issuser"><br><br>
            <label for="date">Issued Date</label><br><br>
            <input type="date" name="issue_date"><br><br>
            <label for="file">Certification File</label><br><br>
            <input type="file" name="file_path1" accept=".pdf" required><br><br>
            <input type="submit" value="Upload" name="submit"><br>
        </form>
    </div>
</body>
</html>