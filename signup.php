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

<p>Already have an account? <br><a href="login.php">Login here</a></p>

<!------------ here's the separation from html ^-above and PHP below-v ------------>

<?php

require_once('db_config.php');

if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirm'])) {
    $name = $_POST['name'];
    $psw = $_POST['password'];
    $confirm = $_POST['confirm'];
    if ($psw != $confirm) {
        echo "<br>Passwords do not match.";
    } else {
        $stm = $pdo->prepare("SELECT * FROM user WHERE name = :name");
        $stm->execute(['name' => $name]);
        $user = $stm->fetch();
        if ($user) {
            echo "<br>Username already exists.";
        } 
        else {
            $encrypted = password_hash($psw, PASSWORD_DEFAULT);
            $stm = $pdo->prepare("INSERT INTO user (name, password) VALUES (:name, :password)");
            $stm->execute(['name' => $name, 'password' => $encrypted]);
            echo "<br>User created.";
        }
    }
}