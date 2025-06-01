<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume Uploading</title>
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
        <h3>Upload Your Resume</h3>
        <form action="upload_resume.php" method="post" enctype="multipart/form-data">
            <label for="file">Resume File</label><br>
            <input type="file" name="file_path" accept=".pdf" required><br>
            <input type="submit" value="Upload" name="submit">
        </form>
    </div>
</body>
</html>