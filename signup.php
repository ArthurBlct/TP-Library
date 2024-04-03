<link rel="stylesheet" href="styles.css">
<?php include 'header.php'; ?>
<h1>Signup</h1>

<form action="" method="post">
    <div class="form-example">
        <label for="name">Username: </label>
        <input type="text" autocomplete=off name="name" id="name" required/>
    </div>
        <br>
    <div>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required/>
    </div>
        <br>
    <div>
        <label for="password">Confirm: </label>
        <input type="password" name="confirm" id="confirm" required/>
    </div>
        <br>
    <div>
        <input type="submit" value="Signup"/>
    </div>
</form>

<p>Déjà enregistré ? <br> <a href="login.php">Login ici</a></p>



<?php

require_once('db_config.php');

if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirm'])) {
    $name = $_POST['name'];
    $psw = $_POST['password'];
    $confirm = $_POST['confirm'];
    if ($psw != $confirm) {
        echo "<br>Mots de passe ne correspondent pas.";
    } else {
        $stm = $pdo->prepare("SELECT * FROM users WHERE name = :name");
        $stm->execute(['name' => $name]);
        $users = $stm->fetch();
        if ($users) {
            echo "<br>L'utilisateur existe déjà.";
        } 
        else {
            $encrypted = password_hash($psw, PASSWORD_DEFAULT);
            $stm = $pdo->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
            $stm->execute(['name' => $name, 'password' => $encrypted]);
<<<<<<< HEAD
            echo "<br>compte créé avec succès.";
=======
            echo "<br>User created.";
        // Sould redirect to login page from #here
            header('Location: login.php');
>>>>>>> d4634e3f4843a85d7103a2e1d28b1fce049b7c33
        }
    }
}


