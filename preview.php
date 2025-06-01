<?php
session_start();
include('db.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT full_name,email,phone,address,linkedin,github,website,bio,profile_photo FROM users WHERE user_id='$user_id'";
$profile_image = 'No Profile Picture Facebook Icon.jpeg';
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $full_name = $row['full_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $linkedin = $row['linkedin'];
    $github = $row['github'];
    $website = $row['website'];
    $bio = $row['bio'];
    $profile_image = !empty($row['profile_photo']) ? $row['profile_photo'] : $profile_image;
}
$query1 = "SELECT edu_id,institution,degree,start_year,end_year,cgpa FROM education WHERE user_id='$user_id'";
$result1 = mysqli_query($conn, $query1);
$query2 = "SELECT title,description,technologies,github_link FROM projects WHERE user_id='$user_id'";
$result2 = mysqli_query($conn, $query2);
$query3 = "SELECT * FROM certifications WHERE user_id='$user_id'";
$result3 = mysqli_query($conn, $query3);
$query4 = "SELECT file_path FROM resumes WHERE user_id='$user_id'";
$result4 = mysqli_query($conn, $query4);
if ($result4 && mysqli_num_rows($result4) > 0) {
    if ($row4 = mysqli_fetch_assoc($result4)) {
        $file_path = $row4['file_path'];
    }
}
?>
<div class="preview flex">
    <div class="profile">
        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="no picture">
    </div>
    <h3 class="section-heading">Personal Information</h3>
    <div class="info flex">
        <i>Full Name:</i>
        <i><?php echo htmlspecialchars($full_name); ?></i>
    </div>
    <div class="info flex">
        <i>E-mail:</i>
        <i><?php echo htmlspecialchars($email); ?></i>
    </div>
    <div class="info flex">
        <i>Phone Number:</i>
        <i><?php echo htmlspecialchars($phone); ?></i>
    </div>
    <div class="info flex">
        <i>Address:</i>
        <i><?php echo htmlspecialchars($address); ?></i>
    </div>
    <div class="info flex">
        <i>Linked-in:</i>
        <a href="<?php echo htmlspecialchars($linkedin); ?>"><?php echo htmlspecialchars($linkedin); ?></a>
    </div>
    <div class="info flex">
        <i>GitHub:</i>
        <a href="<?php echo htmlspecialchars($github); ?>"><?php echo htmlspecialchars($github); ?></a>
    </div>
    <div class="info flex">
        <i>Website:</i>
        <a href="<?php echo htmlspecialchars($website); ?>"><?php echo htmlspecialchars($website); ?></a>
    </div>
    <div class="info flex">
        <i>Bio:</i>
        <i><?php echo htmlspecialchars($bio); ?></i>
    </div>
    <h3 class="section-heading">Education</h3>

    <?php if ($result1 && mysqli_num_rows($result1) > 0): ?>
        <table class="education-table">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Institution</th>
                    <th>Degree</th>
                    <th>Start Year</th>
                    <th>End Year</th>
                    <th>CGPA</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno = 1; ?>
                <?php while ($row1 = mysqli_fetch_assoc($result1)): ?>
                    <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo htmlspecialchars($row1['institution']); ?></td>
                        <td><?php echo htmlspecialchars($row1['degree']); ?></td>
                        <td><?php echo htmlspecialchars($row1['start_year']); ?></td>
                        <td><?php echo htmlspecialchars($row1['end_year']); ?></td>
                        <td><?php echo htmlspecialchars($row1['cgpa']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No education records found.</p>
    <?php endif; ?>
    <div class="section-heading">Projects</div>
    <?php if ($result2 && mysqli_num_rows($result2) > 0): ?>
        <div class="projects flex">
            <?php $sno1 = 1; ?>
            <?php while ($row2 = mysqli_fetch_assoc($result2)): ?>
                <h3>Project<?php echo $sno1++; ?>:&nbsp;<?php echo htmlspecialchars($row2['title']); ?></h3>
                <i>Description:<?php echo htmlspecialchars($row2['description']); ?></i>
                <i>Technologies:<?php echo htmlspecialchars($row2['technologies']); ?></i>
                <i>GitHub:<a href="<?php echo htmlspecialchars($row2['github_link']); ?>"><?php echo htmlspecialchars($row2['github_link']); ?></a></i>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No education records found.</p>
    <?php endif; ?>
    <div class="section-heading">Certifications & Acheivements</div>
    <?php if ($result3 && mysqli_num_rows($result3) > 0): ?>
        <div class="projects flex">
            <?php $sno2 = 1; ?>
            <?php while ($row3 = mysqli_fetch_assoc($result3)): ?>
                <?php
                echo $sno2++ . '. ' . htmlspecialchars($row3['cert_title']) . '-' .
                    htmlspecialchars($row3['issuser']) . '-' .
                    htmlspecialchars($row3['issue_date']);
                ?>
                <iframe
                    src="<?php echo htmlspecialchars($row3['cert_file_path']); ?>"
                    width="75%"
                    height="400px"></iframe>

            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No education records found.</p>
    <?php endif; ?>
    <div class="section-heading">Resume</div>
    <div class="projects flex">
        <iframe
            src="<?php echo $file_path; ?>"
            width="100%"
            height="600px"></iframe>

    </div>
</div>