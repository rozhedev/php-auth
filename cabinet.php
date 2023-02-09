<?php
session_start();
if (!isset($_SESSION["session_username"]) || !isset($_SESSION["session_password"])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Особистий кабінет</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="task cabinet">
        <h3><a href="index.php" class="task__link">Лабораторна робота № 8</a></h3>
        <div class="task__inner">
            <div class="task__form">

                <p class="task__label">Ласково просимо на борт <b><?= $_SESSION["session_username"]; ?></b></p>
                <p class="task__label">Ваш пароль: <b><?= $_SESSION["session_password"]; ?></b></p>

                <form action="logout.php">
                    <button type="submit" name="logout" id="logout" class="task__form-btn">Вийти</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>