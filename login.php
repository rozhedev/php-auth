<?php

function LoginUser($submit_btn, $username_val, $password_val, $row_username, $row_pass)
{
    include "includes/connection.php";
    include "includes/constant.php";
    session_start();

    if (isset($_SESSION["session_username"])) {
        header("Location: cabinet.php");
    }
    if (isset($_POST[$submit_btn])) {
        $username = $_POST[$username_val];
        $password = $_POST[$password_val];
        
        if ($username != "" && $password != "") {
            $username = htmlspecialchars($username);
            $pass = htmlspecialchars($password);
            
            $check_query = mysqli_query($con, "SELECT * FROM labrob8 WHERE username='" . $username . "' AND user_pass='" . $pass . "'");
            $numrows = mysqli_num_rows($check_query);

            if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($check_query)) {
                    $db_username = $row[$row_username];
                    $db_pass = $row[$row_pass];
                }
                if ($username == $db_username && $pass == $db_pass) {
                    $_SESSION['session_username'] = $username;
                    $_SESSION['session_password'] = $pass;
                    header("Location: cabinet.php");
                    return $_SESSION;
                }
            } else {
                return $LOGIN_MESSAGES_TEXT['incorrect_data'];
            }
        } else {
            return $LOGIN_MESSAGES_TEXT['inp_required'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторна робота № 8</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1><a href="index.php" class="task__link">Лабораторна робота № 8</a></h1>

    <div class="task">
        <h3>Увійти в кабінет</h3>
        <div class="task__inner">

            <form action="login.php" name="login-form" method="POST" id="login-form" class="task__form">
                <div><?= LoginUser("login-submit", "username", "password", "username", "user_pass") ?></div>

                <label for="username" class="task__label">Ваш логін</label>
                <input type="text" name="username" id="username" class="task__form-inp" placeholder="ivan1234">

                <label for="password" class="task__label">Введіть пароль</label>
                <input type="password" name="password" id="password" class="task__form-inp" placeholder="Пароль">

                <button type="submit" name="login-submit" id="login-submit" class="task__form-btn">Увійти</button>
            </form>

            <p class="task__descr">Ще не зареєстровані? <a href="register.php" class="task__link">Реєстрація</a></p>
        </div>
    </div>

</body>

</html>