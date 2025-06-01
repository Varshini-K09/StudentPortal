<?php
session_start();
include('db.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT institution,degree,start_year,end_year,cgpa FROM education WHERE user_id='$user_id';";
$result = mysqli_query($conn, $query);
?>
<div class="education">
    <h2 id="education">Education</h2>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="summary-items education-items flex">
                <h4><?php echo htmlspecialchars($row['institution']); ?></h4>
                <div class="item flex" style="margin-bottom: 20px;">
                    <i>Degree:</i>
                    <i><?php echo htmlspecialchars($row['degree']); ?></i>
                </div>
                <div class="item flex" style="margin-bottom: 20px;">
                    <i>Years:</i>
                    <i><?php echo htmlspecialchars($row['start_year']) . " - " . htmlspecialchars($row['end_year']); ?></i>
                </div>
                <div class="item flex" style="margin-bottom: 20px;">
                    <i>CGPA:</i>
                    <i><?php echo htmlspecialchars($row['cgpa']); ?></i>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No education records found.</p>
    <?php endif; ?>
</div>