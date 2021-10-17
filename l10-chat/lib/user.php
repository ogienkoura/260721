<?php

require_once __DIR__ . '/db.php';

function login(string $login, string $password, &$error)
{
    $db = getDBConnection();
    $sql = 'SELECT * FROM `users` WHERE `login` = ? LIMIT 1';
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $login);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (empty($user)) {
        $error = 'Login or password is incorrect';
        return false;
    }

    $isValidPassword = password_verify($password, $user['password']);
    if (!$isValidPassword) {
        $error = 'Login or password is incorrect';
        return false;
    }

    session_start();
    $_SESSION['user'] = $user;

    return true;
}