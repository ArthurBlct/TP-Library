<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
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

</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $psw = $_POST['password'];
    echo "<br>Username: " . $name . "<br>";
    echo "Password: " . $psw;
}

$encrypted = password_hash($psw, PASSWORD_DEFAULT);

echo "<br><br>Encrypted Password: " . $encrypted;

$decrypt = password_verify($psw, $encrypted);
echo "<br>Decrypted Password: " . $decrypt;
echo "<br>⬆ password_verify() returns 1 if the password matches, 0 if it does not.";