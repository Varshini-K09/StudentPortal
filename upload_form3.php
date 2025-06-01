<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Uploading</title>
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
            width: 500px;
        }
        input[type="file"],
        input[type="submit"],
        input[type="text"] {
            width: 95%;
            margin: 10px 0;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Upload Your Project</h3>
        <form action="upload_project.php" method="post" enctype="multipart/form-data">
            <label for="title">Project Title</label>
            <input type="text" name="project_title" required>

            <label for="des">Description</label>
            <input type="text" name="description" required>

            <label for="tech">Technologies</label>
            <input type="text" name="technology" required>

            <label for="git_link">GIT-HUB link</label>
            <input type="text" name="git_link">

            <label for="demo_link">LIVE DEMO link</label>
            <input type="text" name="demo_link">

            <label for="file">Project Image</label>
            <input type="file" name="file_path2" accept="image/*" required>

            <input type="submit" value="Upload" name="submit">
        </form>
    </div>
</body>
</html>