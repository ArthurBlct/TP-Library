<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<h1>TP library API</h1>
<h2>Login</h2>
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
        <input type="submit" value="Login" />
    </div>
</form>

<br>
<a href="signup.php">Need an account?</a>
<br>

</body>
</html>

<?php

require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $psw = $_POST['password'];

    // echo "<br>Username: " . $name . "<br>";
    // echo "Password: " . $psw;

    $encrypted = password_hash($psw, PASSWORD_DEFAULT);

    $stm = $pdo->prepare("SELECT * FROM user WHERE name = :name");
    $stm->execute(['name' => $name]);
    $user = $stm->fetch();
    if ($user) {
        // echo "<br>Username already exists.";
        $decrypt = password_verify($psw, $user['password']);
        if ($decrypt) {
            echo "Login successful.";
        } else {
            echo "Login failed.";
        }
    } else {
        echo "Username does not exist.";
    }


}


// echo "<br><br>Encrypted Password: " . $encrypted;

// $decrypt = password_verify($psw, $encrypted);
// echo "<br>Decrypted Password: " . $decrypt;
// echo "<br><br>⬆ password_verify() returns 1 if the password matches, 0 if it does not.";