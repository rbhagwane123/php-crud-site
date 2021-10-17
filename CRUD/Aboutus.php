<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title>iNotes About Us</title>

</head>

<body>
    <!-- ================================== NAVBAR STARTING  ============================================ -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="/crud/php.png" height="38px" width="67px" alt="php"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" i d="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- ================================== NAVBAR ENDING  ============================================ -->

    <!-- ================================== PANEL STARTING  ============================================ -->

    <!-- <div class="container my-4">

        <div class="row featurette d-flex justify-content-center align-items-center ">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your
                        mind.</span></h2>
                <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting
                    prose
                    here.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="img-fluid" src="https://source.unsplash.com/400x400/?code,tech,laptop,gadgets" alt="">
            </div>
        </div>
        <br>
        <div class="row featurette d-flex justify-content-center align-items-center ">
            <div class="col-md-7 ">
                <h2 class="featurette-heading">Second featurette heading. <span class="text-muted">It’ll blow your
                        mind.</span></h2>
                <p class="lead">Some great Note Writting things . Imagine some exciting prose here.</p>
            </div>
            <div class="col-md-5 ">
                <img class="img-fluid" src="https://source.unsplash.com/400x400/?code,tech,program" alt="">
            </div>
        </div>
        <br>
        <div class="row featurette d-flex justify-content-center align-items-center ">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Third featurette heading. <span class="text-muted">It’ll blow your
                        mind.</span></h2>
                <p class="lead">Write Notes and get rid for forgetting things. Write Down exciting Notes here.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="img-fluid" src="https://source.unsplash.com/400x400/?code,tech,laptop" alt="">
            </div>
        </div>

    </div>
    </div> -->
    <h3 class="container my-3">File Wiriting content</h3>
    <div class="container my-4">
        <form action="/crud/Aboutus.php" method="POST">
            <div class="form-floating mt-4">
                <textarea class="form-control" placeholder="Leave a comment here" name="content" id="content"
                    style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comments</label>
                <br>
                <button class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </div>
    <div class="container mt-4">
        <?php
            // =========== FILES CONTENT READING ========
            // $a = readfile("files.txt");
            // echo "<br>";
            // echo $a;

            // echo "<br><br>";
            // $a = readfile("files.txt");

            //================ FILES CONTENTS READING TILL '.' ENCOOUNTER========
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fptr = fopen("files2.txt","a+");
                fwrite($fptr,$_POST['content']);
                
                 while($a=fgetc($fptr)){    //character by character reading
                     
                     echo "$a";
                 }          
               
            }
             
        ?>
    </div>

    <div class="contain">
            <?php 
                // $cat = $_COOKIE['category'];
                // echo "the default is $cat";

                // Session extracting
                
            ?>
    </div>



    <footer class="container mt-3">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>© 2017–2021 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
    </footer>

</body>

</html>