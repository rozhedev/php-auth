<?php

function RegisterUser($submit_btn, $fullname_val, $email_val, $username_val, $pass_val)
{
    include "includes/connection.php";
    include "includes/constant.php";

    if (isset($_POST[$submit_btn])) {
        $fullname = $_POST[$fullname_val];
        $email = $_POST[$email_val];
        $username = $_POST[$username_val];
        $pass = $_POST[$pass_val];

        if ($fullname != "" && $email != "" && $username != "" && $pass != "") {
            $fullname = htmlspecialchars($fullname);
            $email = htmlspecialchars($email);
            $username = htmlspecialchars($username);
            $pass = htmlspecialchars($pass);

            $check_query = mysqli_query($con, "SELECT * FROM labrob8 WHERE username='" . $username . "'");
            $num_rows = mysqli_num_rows($check_query);

            if ($num_rows == 0) {
                $sql_add_query = "INSERT INTO labrob8 (fullname, email, username, user_pass) VALUES('$fullname','$email', '$username', '$pass')";
                $result = mysqli_query($con, $sql_add_query);

                if ($result) {
                    return $REGISTER_MESSAGES_TEXT['account_created'];
                } else {
                    return $REGISTER_MESSAGES_TEXT['send_data_err'];
                }
            } else {
                return $REGISTER_MESSAGES_TEXT['login_taken'];
            }
        } else {
            return $REGISTER_MESSAGES_TEXT['inp_required'];
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
        <h3>Реєстрація</h3>
        <div class="task__inner">
            <form action="register.php" name="register-form" method="POST" id="register-form" class="task__form">
                <div><?= RegisterUser("register-submit", "fullname", "email", "username", "password") ?></div>

                <label for="fullname" class="task__label">Ваше повне ім'я</label>
                <input type="text" name="fullname" id="fullname" class="task__form-inp" placeholder="Іван Іванов">

                <label for="email" class="task__label">Ваше пошта</label>
                <input type="email" name="email" id="email" class="task__form-inp" placeholder="ivan@gmail.com">

                <label for="username" class="task__label">Ваш логін</label>
                <input type="text" name="username" id="username" class="task__form-inp" placeholder="ivan1234">

                <label for="password" class="task__label">Придумайте пароль</label>
                <input type="password" name="password" id="password" class="task__form-inp" placeholder="Пароль">

                <button type="submit" name="register-submit" id="register-submit" class="task__form-btn">Зареєструватись</button>
            </form>

            <p class="task__descr">Вже зареєстровані? <a href="login.php" class="task__link">Увійти</a></p>
        </div>
    </div>

</body>

</html>