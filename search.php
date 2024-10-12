<?php
include ("includes/header.php");
include ("connection.php");


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

  <style>
    .maincontainer {
      min-height: 100vh;

    }
  </style>

</head>

<body>



  <div class="container my-3 maincontainer">
    <h1> Search result for <em> "<?php echo $_GET['search']; ?>"</em> </h1>

    <?php
    $noresult = true;
    $query = $_GET['search'];
    $sql = "SELECT * FROM `threads` WHERE match (thr_title , thr_des) against ('$query')";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $title = $row['thr_title'];
      $des = $row['thr_des'];
      $thr_id =$row['thr_id'];
      $url = "threads.php?thread_id=" . $thr_id ;
      echo ' <div class="result">

            <h3> <a href=" '.$url . '" class="text-dark">' . $title . '</a></h3>
            <p> ' . $des . '</p>
            </div>

        </div>';
            }

            if ($noresult) {
              echo '
              <div class = "jumbotron jumbotron-fluid" >
              <div class="ml-2">
              <p class = "display-4 ml-4"> No Result Found  </p>
              <p class = "">
              <div class="my-3 ml-3"> Suggestions: </div>
             <ul>
            <li>  Make sure that all words are spelled correctly. </li>
            <li>  Try different keywords.</li>
            <li>  Try more general keywords.</li>
              </p></ul>
            </div>
            </div>
              ';
          }
  
    ?>

</div>
  
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



    <?php
    include ("includes/footer.php");

    ?>

</body>

</html>