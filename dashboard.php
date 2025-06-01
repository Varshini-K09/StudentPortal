<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('db.php');

$full_name = '';
$profile_image = 'No Profile Picture Facebook Icon.jpeg';
$certCount = 0;
$projectCount = 0;
$resume_status = 'not uploaded';

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    echo "User not logged in. Please <a href='login.php'>login</a>.";
    exit();
}

$username = $_SESSION['username'];
$username_escaped = mysqli_real_escape_string($conn, $username);

$query = "SELECT user_id, full_name, profile_photo FROM users WHERE user_name = '$username_escaped' LIMIT 1";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['user_id'];
    $full_name = $row['full_name'];
    $profile_image = !empty($row['profile_photo']) ? $row['profile_photo'] : $profile_image;

    $user_id = $_SESSION['user_id'];

    $query1 = "SELECT COUNT(cert_id) AS cert_count FROM certifications WHERE user_id = '$user_id'";
    $query2 = "SELECT COUNT(project_id) AS pro_count FROM projects WHERE user_id = '$user_id'";
    $query3 = "SELECT COUNT(resume_id) AS resume_count FROM resumes WHERE user_id = '$user_id'";

    $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($conn, $query2);
    $result3 = mysqli_query($conn, $query3);

    if ($result1) {
        $row1 = mysqli_fetch_assoc($result1);
        $certCount = $row1['cert_count'] ?? 0;
    }

    if ($result2) {
        $row2 = mysqli_fetch_assoc($result2);
        $projectCount = $row2['pro_count'] ?? 0;
    }

    if ($result3) {
        $row3 = mysqli_fetch_assoc($result3);
        $resume_status = ($row3['resume_count'] ?? 0) > 0 ? "uploaded" : "not uploaded";
    }
} else {
    echo "Error fetching user details: " . mysqli_error($conn);
    exit();
}


?>

<div class="dash-content flex">
    <div class="profile" onclick="upload();">
        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="no picture">
        <h2 id="student-name"><?php echo htmlspecialchars($full_name); ?> </h2>

    </div>

    <div class="summary">
        <h4>Profile Summary</h4><br>
        <div class="summary-items flex">
            <div class="item flex">
                <i>Total Projects</i>
                <h5><?php echo $projectCount; ?></h5>
            </div>
            <div class="item flex">
                <i>Certifications</i>
                <h5><?php echo $certCount; ?> </h5>
            </div>
            <div class="item flex">
                <i>Resume status</i>
                <h5><?php echo $resume_status; ?></h5>
            </div>
        </div>
    </div>

    <div class="quick-action">
        <h4>Quick actions</h4>
        <div class="quick-items flex">
            <div class="items flex">
                <h5 id="add_resume" onclick="window.location.href='upload_form.php';">Add Resume</h5>
            </div>
            <div class="items flex">
                <h5 id="add_certificate" onclick="window.location.href='upload_form2.php';">Add Certificate</h5>
            </div>
            <div class="items flex">
                <h5 id="add_project" onclick="window.location.href='upload_form3.php';">Add Project</h5>
            </div>
            <div class="items flex">
                <h5 id="view_portfolio" onclick="window.location.href='preview.php';">View Portfolio</h5>
            </div>
        </div>
    </div>

</div>