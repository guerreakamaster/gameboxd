<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GameBoxd — Track your games</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    
<?php include 'header.php'; ?>


    <p>Your Letterboxd for games</p>

    <?php if (isset($_SESSION['username'])) {
        echo '<h2>Hello there, <strong>' . htmlspecialchars($_SESSION['username']) . '</strong>! This is what <strong>Gameboxd</strong> offers you today.</h2>';
    } else {
        echo '<h2>Want to see more? <strong><a href="login.php">Log In</a></strong> to access all features!</h2>';
    }

    ?>

    <h3>Search new Game</h3>
    <input type="text" id="searchInput" placeholder="Elden Ring, Balatro, ...">
    <button id="searchBtn">Search</button>
    <div id="results">
        <!-- here are the results of the game search-->
    </div>

    <!---
    <h3>Popular in GameBoxd</h3>
                TBD--->


    <script>
        //check and passing JS if the session is active 
        const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        // pass user role to JS
        const userRole = `<?php echo isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';?>`;
    </script>

    <!--Sweet alert 2 widget-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../api/index.js"></script>
</body>