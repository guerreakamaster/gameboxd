<?php
session_start();

// If they aren't logged in, send them to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?msg=login_required");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($_SESSION['username']); ?>'s Profile</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <?php include 'header.php'; ?>

    <div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
        <h1 style="border-bottom: 1px solid var(--border); padding-bottom: 10px;">
            <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>'s Profile
        </h1>

        <!-- JS will inject the cards right here -->
        <div id="results" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 20px; margin-bottom: 40px;">
            <p>Loading your profile data...</p>
        </div>
    </div>

    <!-- The PHP to JS Bridge -->
    <script>
        const userRole = `<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';?>`;
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Our brand new custom JS file -->
    <script src="../api/profile.js"></script>
</body>
</html>