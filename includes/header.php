<?php
session_start();
include("connection.php");
echo '

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed">
    <div class="container-fluid ">
        <a class="navbar-brand" href="index.php">iDisscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">';
$sql = "SELECT cat_name,cat_id FROM `categories` LIMIT 3";
$result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['cat_id'];
    echo ' <li><a class="dropdown-item" href="threadlist.php?catid=' . $id . '"> ' . $row['cat_name'] . '</a></li>';

}
echo '     
                       </ul>
                       </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            
            
            <div class="mt-2">';
if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
    echo '
                <form class=" mb-2 d-flex" role="search" action="search.php" method = "get">
                <input class="form-control me-2" name="search"  type="search" placeholder="Search" aria-label="Search">
                <div style = "margin-right: 30px">
                <button class="btn btn-success" type="submit">Search</button>
                </div>
                <p class ="text-light mt-2 ml-0 mr-5 mb-0">' . $_SESSION['user_email'] . ' </p>
                <div class="mx-2">
                <a href="logout_confirm.php" type="button" class="btn btn-outline-success">
                logout
                </a>
                </div>';

} else {


    echo '
                <div class="mt-2">
                <form class=" mb-2 d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                    <div class="mx-2">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#signupmodal">
                            signup
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                        data-bs-target="#loginmodal">
                        Login
                        </button>
                        </div>
                        </form>
                        </div>
                        
                        </div>';
}
echo '
</nav>
</div>
</div>';



include 'includes/signupModal.php';
include 'includes/loginModal.php';
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
    <strong>Successfully Signup!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';
}


?>