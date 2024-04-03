<?php session_start(); ?>
<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php if (isset($_SESSION['users']) && $_SESSION['users']['logged']) : ?>
            <li><a href="profil.php">Profil</a></li>
            
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
            
        <?php endif ?>
    </ul>
</nav>

<?php
    if (isset($_SESSION['users']) && $_SESSION['users']['logged']) : 
?>
        <li><a href="logout.php">Déconnexion</a></li>
<?php 
    endif; 
?>
