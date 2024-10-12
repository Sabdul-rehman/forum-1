<?php
include("connection.php");
include("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Forum</title>
</head>

<body>

    <?php
    $id = intval($_GET['catid']);
    $sql = "SELECT * FROM `categories` WHERE cat_id = $id";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['cat_name'];
        $catdes = $row['cat_description'];
    }
    ?>

    <!-- input php -->

    <?php
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $thr_title = $_POST['title'];
        $thr_des = $_POST['com'];
        // Replace special characters to prevent HTML injection
        $thr_title = str_replace("<", "&lt;", $thr_title);
        $thr_title = str_replace(">", "&gt;", $thr_title);
        $thr_des = str_replace("<", "&lt;", $thr_des);
        $thr_des = str_replace(">", "&gt;", $thr_des);
        $sno = intval($_POST['sno']);
        $sql = "INSERT INTO `threads` (`thr_id`, `thr_title`, `thr_des`, `thr_cat_id`, `thr_user_id`, `timestamp`) VALUES (NULL, '$thr_title', '$thr_des', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($connection, $sql);
        $showalert = true;

        if ($showalert) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
              <path d="M7.818 12.854a.5.5 0 0 1-.637-.769l2.097-2.829a.5.5 0 0 1 .769.638l-2.097 2.829a.5.5 0 0 1-.132.131.5.5 0 0 1-.1.026zm-3.018-6.472a.5.5 0 0 1 .648-.761l1.399 1.04 3.859-5.211a.5.5 0 1 1 .767.641l-4.537 6.14a.5.5 0 0 1-.648.104L4.8 7.648l-.002-.003a.5.5 0 0 1-.002-.003zm8.64 3.608a.5.5 0 0 0-.708-.708L8 11.293 6.146 9.439a.5.5 0 1 0-.708.708L7.293 12l-2.854 2.854a.5.5 0 0 0 .708.708L8 12.707l1.854 1.854a.5.5 0 0 0 .708-.708L8.707 12l2.853-2.854z"/>
            </svg>
            Your thread has been successfully created!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <div class="row">
                <h4 class="display-6">Welcome To <b><?php echo $catname; ?></b> Forum</h4>
                <p class="lead"><?php echo $catdes; ?></p>
                <hr class="my-4">
                <p>This Is Peer To Peer Forum For Sharing Knowledge For Each Other.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="container">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter Your Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
                </div>
                <label for="com" class="form-label">Type Your Comment</label>
                <textarea class="form-control" id="com" name="com" rows="3" required></textarea>
                <br>
                <?php
                if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
                    echo '
                <button type="submit" class="btn btn-success">Comment</button>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>';
                } else {
                    echo '    
                    <br>
                    <div class="alert alert-danger" role="alert">
                    Sign In To Start A Conversation
                  </div>';
                }
                ?>
        </form>
    </div>
    </div>

    <!-- comment php -->

    <div class="container">
        <h1>Browse Questions</h1>
        <br>
        <?php
        $limit = 3;
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Ensure $page is an integer
        $offset = max(0, ($page - 1) * $limit);  // Ensure $offset is non-negative
        $id = intval($_GET['catid']);  // Ensure $id is an integer
        $sql = "SELECT * FROM `threads` WHERE thr_cat_id = $id LIMIT $offset, $limit";
        $result = mysqli_query($connection, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $thr_id = $row['thr_id'];
            $title = $row['thr_title'];
            $thr_des = $row['thr_des'];
            $thr_user_id = $row['thr_user_id'];
            $sql2 = "SELECT user_email FROM `users_tbl` WHERE sno= '$thr_user_id'";
            $result2 = mysqli_query($connection, $sql2);
            $row1 = mysqli_fetch_assoc($result2);
            echo '<div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <img src="img/dp1.jpg" alt="..." height="50px">
            </div>
            <div class="flex-grow-1 ms-3 my-2 spa">
                <h5><a class="text-dark" href="threads.php?thread_id=' . $thr_id . '">' . $title . '</a></h5>
                ' . $thr_des . '
                </div>' .
                '<p class="font-weight-bold my-0"> Asked By: ' . $row1['user_email'] . '</p>' .
                '</div>';
        }
        if ($noresult) {
            echo '
            <div class="alert alert-info" role="alert">
                No Threads Found.
            </div>';
        }

        // Pagination logic
        $sql1 = "SELECT COUNT(*) AS total_threads FROM `threads` WHERE thr_cat_id = $id";
        $result1 = mysqli_query($connection, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $total_records = $row1['total_threads'];
        $total_pages = ceil($total_records / $limit);

        echo '<br><br>
            <nav aria-label="...">    
            <ul class="pagination admin-pagination">';

        // Previous button
        if ($page > 1) {
            echo '<li class="page-item">
                <a class="page-link" href="threadlist.php?catid=' . $id . '&page=' . ($page - 1) . '" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';
        } else {
            echo '<li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';
        }

        // Page numbers
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<li class="page-item active"><a class="page-link" href="threadlist.php?catid=' . $id . '&page=' . $i . '">' . $i . '</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="threadlist.php?catid=' . $id . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }

        // Next button
        if ($page < $total_pages) {
            echo '<li class="page-item">
                <a class="page-link" href="threadlist.php?catid=' . $id . '&page=' . ($page + 1) . '" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';
        } else {
            echo '<li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';
        }

        echo '</ul>
                </nav>';
        ?>
        <br><br><br><br><br><br>
    </div>

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
