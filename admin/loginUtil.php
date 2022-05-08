<?php
/**
 * @param mysqli $con
 * @param $sql
 * @param $password
 * @param $username
 * @return void
 */

function runLogin(mysqli $con, $sql, $password, $username, $location, $permission)
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $is_verified = $row['is_verified'];
        $id = $row['id'];

        if ($is_verified == 1) {
            $passwordInTable = $row['password'];
            $hashedPassword = hash("sha256", $password);

            // check whether passwords match or not
            if ($passwordInTable == $hashedPassword) {
                $_SESSION['user'] = $id;
                $_SESSION['permission'] = $permission;
                header("Location: $location");
            } else {
                header("Location: login.php?username={$username}&code=2");
            }

        } else {
            $email = $row['email'];
            header("Location: login.php?username=$username&email=$email&code=4");
        }
    } else {
        header("Location: login.php?username={$username}&code=3");
    }
}

?>