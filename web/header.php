<nav class="navbar">
    <div class="nav-brand">
        <a href="index.php">GameBoxd</a>
    </div>
    <ul class="nav-links">
        
        <?php if(isset($_SESSION['username'])): ?>
            <!-- if logged in: show my profile and logout -->
            <li><a href="profile.php">My Profile (<?php echo $_SESSION['username']; ?>)</a></li>
            <?php 
    // THE SECRET ADMIN DOOR
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): 
        ?>
        <a href="add_game.php" style="color: var(--accent); font-weight: bold;">
            Add Game
        </a>
        <?php endif; ?>
            <li><a href="../api/logout.php" class="nav-btn" style="background: rgba(255, 60, 60, 0.15); border-color: rgba(255, 60, 60, 0.4);">Logout</a></li>
        <?php else: ?>
            <!-- if NOT logged show login button-->
            <li><a href="login.php" class="nav-btn">Login</a></li>
        <?php endif; ?>
        
    </ul>
</nav>