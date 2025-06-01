<?php
session_start();
include('db.php');
$profile_image = 'No Profile Picture Facebook Icon.jpeg';
$username = $_SESSION['username'];
$username_escaped = mysqli_real_escape_string($conn, $username);

$query = "SELECT profile_photo,full_name,email,phone,address,linkedin,github,website,bio FROM users WHERE user_name= '$username_escaped'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profile_image = !empty($row['profile_photo']) ? $row['profile_photo'] : $profile_image;
    $full_name=$row['full_name'];
    $email=!empty($row['email']) ? $row['email'] : 'not provided';
    $phone=!empty($row['phone']) ? $row['phone'] : 'not provided';
    $address=!empty($row['address']) ? $row['address'] : 'not provided';
    $linkedin=!empty($row['linkedin']) ? $row['linkedin'] : 'not provided';
    $github=!empty($row['github']) ? $row['github'] : 'not provided';
    $website=!empty($row['website']) ? $row['website'] : 'not provided';
    $bio=!empty($row['bio']) ? $row['bio'] : 'not provided';
}
?>
<div class="personal-info">
    <div class="profile">
        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="no picture">
    </div>
    <div class="personal-content">
        <h2>Personal Information</h2><br>
        <div class="summary-items flex">
            <div class="item flex">
                <i>Name:</i>
                <i><?php echo $full_name; ?></i>
            </div>
            <div class="item flex">
                <i>E-mail:</i>
                <i><?php echo $email; ?></i>
            </div>
            <div class="item flex">
                <i>Phone:</i>
                <i><?php echo $phone; ?></i>
            </div>
            <div class="item flex">
                <i>Address:</i>
                <i><?php echo $address; ?></i>
            </div>
            <div class="item flex">
                <i>Linked-in:</i>
                <i><?php echo $linkedin; ?></i>
            </div>
            <div class="item flex">
                <i>Git-Hub:</i>
                <i><?php echo $github; ?></i>
            </div>
            <div class="item flex">
                <i>Website:</i>
                <i><?php echo $website; ?></i>
            </div>
            <div class="item flex">
                <i>Bio:</i>
                <i><?php echo $bio; ?></i>
            </div>
        </div>
    </div>

</div>