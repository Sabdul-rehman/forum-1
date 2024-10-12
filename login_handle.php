<?php
session_start();
include 'connection.php';
$showerror = false;
$showalert = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login_email = $_POST['login_email'];
    $login_pass = $_POST['login_pass'];

    $check = "SELECT * From `users_tbl` WHERE user_email = '$login_email'";
    $result = mysqli_query($connection, $check);

    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($login_pass, $row['user_pass'])) {

            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['user_email'] = $login_email;
            // echo 'loggedin' . $login_email;
            header("location: /forum/index.php");
        } else {
            echo ' 
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-circle me-3" viewBox="0 0 16 16">
                <path d="M7.818 12.854a.5.5 0 0 1-.637-.769l2.097-2.829a.5.5 0 0 1 .769.638l-2.097 2.829a.5.5 0 0 1-.132.131.5.5 0 0 1-.1.026zm-3.018-6.472a.5.5 0 0 1 .648-.761l1.399 1.04 3.859-5.211a.5.5 0 1 1 .767.641l-4.537 6.14a.5.5 0 0 1-.648.104L4.8 7.648l-.002-.003a.5.5 0 0 1-.002-.003zm8.64 3.608a.5.5 0 0 0-.708-.708L8 11.293 6.146 9.439a.5.5 0 1 0-.708.708L7.293 12l-2.854 2.854a.5.5 0 0 0 .708.708L8 12.707l1.854 1.854a.5.5 0 0 0 .708-.708L8.707 12l2.853-2.854z"/>
            </svg>
            <div>Password incorrect</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

        }

    } else {
        echo ' 
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-circle me-3" viewBox="0 0 16 16">
            <path d="M7.818 12.854a.5.5 0 0 1-.637-.769l2.097-2.829a.5.5 0 0 1 .769.638l-2.097 2.829a.5.5 0 0 1-.132.131.5.5 0 0 1-.1.026zm-3.018-6.472a.5.5 0 0 1 .648-.761l1.399 1.04 3.859-5.211a.5.5 0 1 1 .767.641l-4.537 6.14a.5.5 0 0 1-.648.104L4.8 7.648l-.002-.003a.5.5 0 0 1-.002-.003zm8.64 3.608a.5.5 0 0 0-.708-.708L8 11.293 6.146 9.439a.5.5 0 1 0-.708.708L7.293 12l-2.854 2.854a.5.5 0 0 0 .708.708L8 12.707l1.854 1.854a.5.5 0 0 0 .708-.708L8.707 12l2.853-2.854z"/>
        </svg>
        <div>Invalid Email</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    }
}















?>