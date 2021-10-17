<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
        header("location: login.php");
        exit;
    }
    $insert = false;
    $delete = false;
    $update =false;
    // $servername="localhost";
    // $username = "root";
    // $password = "";
    // $database = "dbRupesh";

    // $conn = mysqli_connect($servername, $username, $password, $database);

    // if(!$conn){
    //     die("Sorry the connection can't be created : ". mysqli_connect_error());
    // }
    // else{
        
    // }
    require 'connfile.php';

    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        
        $sql = "DELETE FROM `notess` WHERE `notess`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $delete = true;
        } 
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['snoEdit'])) {
            
            //UPDATING THE RECORD
            $sno = $_POST['snoEdit'];
            $titleEdit = $_POST['titleEdit'];
            $descrptionEdit = $_POST['descEdit'];
            $sql = "UPDATE `notess` SET `title` = '$titleEdit' , `descrption` = '$descrptionEdit'  WHERE `notess`.`sno` = $sno";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                # code..
                die("Sorry can't update: ". mysqli_connect_error());
            } 
            else{
                $update =true;
            }
        }
        else{
            // INSERTING THE RECORD
            $title = $_POST['title'];
            $descrption = $_POST['desc'];
            $sql = "INSERT INTO `notess` (`sno`, `title`, `descrption`) VALUES (NULL, '$title', '$descrption') ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $insert = true;
            }      
        }      
    }

?>

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
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <title>iNotes Time</title>

</head>

<body>
    <!-- ================================> Editing Modal <================================ -->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/crud/index.php" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Note Descrption</label>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Enter details here" id="descEdit"
                                    name="descEdit" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Comments</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Note</button>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- ======================> Enidng of Edit Modal <================================ -->

    <!--  -->
    <?php require 'resources/_nav.php';
    ?>
    <?php
        if ($insert) {
            # code...
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> your notes inserted sucessfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } 
        if ($delete) {
            # code...
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> your notes Deleted sucessfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } 
        if ($update) {
            # code...
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> your notes Updated sucessfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } 

    ?>

    <div class="container my-4">
        <h2>Add A Note</h2>
        <form action="/crud/index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Note Descrption</label>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Enter details here" id="desc" name="desc"
                        style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Comments</label>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <!-- ======================> DISPLAYING THE RECORD PRESENT <================================= -->
    <?php
        require 'show.php';
    ?>
    <hr>
    <!-- ========================>   <============================================ -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>


    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                descrption = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, descrption);
                descEdit.value = descrption;
                titleEdit.value = title;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');

            })
        })

        dels = document.getElementsByClassName('del');
        Array.from(dels).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                descrption = tr.getElementsByTagName("td")[1].innerText;
                snodel = e.target.id.substr(1,);
                if (confirm("Are You Sure! ")) {
                    window.location = `/crud/index.php?delete=${snodel}`;
                    // Create a form Use post request to submit the form.

                } else {
                    console.log("no");
                }
            })
        })

    </script>

</body>

</html>