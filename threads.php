<?php
include("connection.php");
include("includes/header.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Forum</title>
</head>

<body>




    <?php
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE thr_id = $id ";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thr_title'];
        $des = $row['thr_des'];
        $thr_user_id = $row['thr_user_id'];
        $sql2 = "SELECT user_email FROM `users_tbl` where sno = '$thr_user_id'";
        $result2 = mysqli_query($connection , $sql2);
        $row1 =mysqli_fetch_assoc($result2);
        $posted_by = $row1['user_email'];

    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h4 class="display-6"><b>
                    <?php echo $title; ?>
                </b> </h4>
            <p class="lead">
                <?php echo $des; ?>
            </p>
            <hr class="my-4">
            <p>This Is Peer To Peer Forum For Sharing Knowledge For Each Other.</p>
            <p> Posted By  <?php echo $posted_by; ?> </
            b></p>
        </div>
    </div>

                                <!-- Inset Into Discussion Part From Form -->

    <?PHP
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $com = $_POST['com'];
        $com = str_replace("<" , "&lt" ,  $com);
        $com = str_replace(">" , "&gt" ,  $com);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`com_content`, `thr_id`, `com_by`,`com_time`) VALUES ('$com', '$id', $sno , current_timestamp()) ;";
        $result = mysqli_query($connection, $sql);
        $showalert = true;

        if ($showalert) {

            echo ' 
            <div class = container>
            <div class="alert alert-success  alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-circle me-3" viewBox="0 0 16 16">
                <path d="M7.818 12.854a.5.5 0 0 1-.637-.769l2.097-2.829a.5.5 0 0 1 .769.638l-2.097 2.829a.5.5 0 0 1-.132.131.5.5 0 0 1-.1.026zm-3.018-6.472a.5.5 0 0 1 .648-.761l1.399 1.04 3.859-5.211a.5.5 0 1 1 .767.641l-4.537 6.14a.5.5 0 0 1-.648.104L4.8 7.648l-.002-.003a.5.5 0 0 1-.002-.003zm8.64 3.608a.5.5 0 0 0-.708-.708L8 11.293 6.146 9.439a.5.5 0 1 0-.708.708L7.293 12l-2.854 2.854a.5.5 0 0 0 .708.708L8 12.707l1.854 1.854a.5.5 0 0 0 .708-.708L8.707 12l2.853-2.854z"/>
            </svg>
            <div>Your thread has been successfully created!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        </div>';
        }

    }
    ?>



    <div class="container">
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="container">

                <label for="com" class="form-label">Type Your Comment</label>
                <textarea class="form-control" id="com" name="com" rows="3" required></textarea>
                <br>
                <?php
                if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
                    echo '
                    <button type="submit" class="btn btn-success">Post Comment</button>
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'" >
            </div> ';
                } else {
                    echo '    
                    <br>
                    <div class="alert alert-danger" role="alert">
                    Sign In To Start A Conversation
                  </div>
                    ';

                }
                ?>
            </div>
        </form>
    </div>

    <div class="container ">`
        <h1>Discussions</h1>
        <br>
        <?php
        $id = $_GET['thread_id'];
        $sql = "SELECT * FROM `comments` WHERE thr_id = $id ";
        $result = mysqli_query($connection, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $id = $row['com_id'];
            $com_content = $row['com_content'];
            $com_by = $row['com_by'];
            $sql2 = "SELECT user_email FROM `users_tbl` where sno = '$com_by'";
            $result2 = mysqli_query($connection , $sql2);
            $row1 =mysqli_fetch_assoc($result2);


        echo '     <div class="d-flex align-items-center">
        <div class="flex-shrink-0">
            <img src="img/dp1.jpg" alt="..." height="50px">
        </div>
        <div class="flex-grow-1 ms-3 my-2  spa">
       
            <h5 class= "text-dark "> '.$row1['user_email'].' </h5>
         ' . $com_content . '<br>    
        </div>
    </div>';

        }
        if ($noresult) {
            echo '
            <div class="alert alert-info" role="alert">
            No questions available at the moment.
          </div>
            ';
        }

        ?>

    </div>

    <br><br><br><br><br><br><br><br><br><br>
    <?php
    include("includes/footer.php");

    ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>