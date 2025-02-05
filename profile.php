

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>
    <link rel="stylesheet" href="styles/dashboardstyle.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <main>
        <h2>Manage Profile</h2>
        <form method="POST" action="update_profile.php" enctype="multipart/form-data">
            <div>
                <label for="profile_image">Profile Image:</label><br>
                <img src="uploads/<?php echo $profile_image; ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;"><br>
                <input type="file" id="profile_image" name="profile_image" accept="image/*"><br>
            </div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>
            <button type="submit">Update Profile</button>
        </form>
    </main>
</body>
</html>
