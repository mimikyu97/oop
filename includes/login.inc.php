<?php

if(isset($_POST['login'])){
    
    require 'dbh.inc.php';

    $username = $_POST['username'];
    $password = $_POST['pwd'];

    if(empty($username) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM enrolling WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwd']);
                if($pwdCheck == false) {
                    header("Location: ../login.php?error=wrongpasword");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION["username"] = $row['username'];
                    header("Location: ../login.php?login=success");
                    exit();
                }
            }
            else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
}
else {
    header("Location: ../login.php");
    exit();
}