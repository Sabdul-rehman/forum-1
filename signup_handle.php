<?php
include 'connection.php';
$showerror = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_email = $_POST['signup_email'];
    $user_pass = $_POST['signup_pass'];
    $user_cpass = $_POST['signup_cpass'];


    

    // check For Existing Email
    $exist_email = "SELECT * From `users_tbl` WHERE user_email = '$user_email'";
    $result = mysqli_query($connection, $exist_email);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {

        echo "<script>alert('Email Is Already In Use')</script>";
        echo "<script>window.location.href='/forum/index.php'</script>";
        exit();

    } else {
        if ($user_pass == $user_cpass) {
            $hash = password_hash($user_pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users_tbl` (`user_email`, `user_pass`, `user_time`) VALUES ('$user_email', '$hash', current_timestamp());";

            $result = mysqli_query($connection, $sql);
            if ($result) {
                $showalert = true;
                header("location:/forum/index.php?signupsuccess=true");
                exit();
            }

        } else {
            echo "<script>alert('Password Does Not Match')</script>";
            echo "<script>window.location.href='/forum/index.php'</script>";
            exit();

        }

    }

    header("location:/forum/index.php?signupsuccess=false&error= $showerror");
}
header("location:/forum/index.php?signupsuccess=false&error= $showerror");









?>