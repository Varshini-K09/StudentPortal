<?php
session_start();
include('db.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT title,description,technologies,github_link,live_demo_link,image_path FROM projects WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);
?>

<div class="projects">
    <h2>Projects</h2>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="projects-items flex">
        
        <i class="project-title"><?php echo htmlspecialchars($row['title']); ?></i>
                <i>Description:</i><br>
                <span><?php echo htmlspecialchars($row['description']); ?></span>
                <br>
                <i>Technologies:</i><br>
                <span><?php echo htmlspecialchars($row['technologies']); ?></span>
                <br>
                <a href="<?php echo htmlspecialchars($row['github_link']); ?>">> GitHub-link</a><br>
                <i>Live-Demo link:</i>
                <a href="<?php echo htmlspecialchars($row['live_demo_link']); ?>">> project demo</a><br>
                <i>Project-Image:</i><br>
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="cannot display">
    </div>
<?php endwhile; ?>
<?php else: ?>
    <p>No projects records found.</p>
<?php endif; ?>

</div>