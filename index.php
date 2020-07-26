<?php
// CONNECT TO DB
// INSERT INTO `notes` (`sr.no`, `title`, `description`, `Timestamp`) VALUES (NULL, 'test', 'test', current_timestamp());
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes";
 
$insert = false;
$update = false;
$delete = false;

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
    die ("sorry". mysqli_connect_error());
}

if(isset($_GET['delete'])){
    $srno = $_GET['delete'];
    $delete =true;
    $sql= "DELETE FROM `notes` WHERE `srno`=$srno";
    $result=mysqli_query($conn,$sql);
}
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['snoedit'])){
    $srno=$_POST['snoedit'];
        
    $title=$_POST['titleedit'];
    $description=$_POST['descriptionedit'];
    $sql="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`srno` = $srno";

    $result=mysqli_query($conn,$sql);
    if($result){
        $update = true;
    }
     
 
}
else{



    $title=$_POST['title'];
    $description=$_POST['description'];
    $sql="INSERT INTO `notes` ( `title`, `description`) VALUES ( '$title', '$description')";

    $result=mysqli_query($conn,$sql);

    if($result){
        $insert=true;
    }
    else{
        echo"unsuccess";
    }



}
}
?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">



    <title>Hello, world!</title>

</head>

<body>
    <!-- edit trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editeModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="http://localhost/Php/dir/crud/index.php" method="POST">
                        <input type="hidden" name="snoedit" id="snoedit">
                        <div class="form-group">
                            <label for="title"> Title</label>
                            <input type="text" name="titleedit" class="form-control" id="titleedit"
                                aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Title Should Be Amazing
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="textarea">Textarea</label>
                            <textarea class="form-control" id="descriptionedit" class="description"
                                name="descriptionedit" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Php crud</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>



            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
    if($insert){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your notes has been successfully submitted.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($update){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your notes has been successfully updated.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    if($delete){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your notes has been successfully Deleted.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
    ?>
    <div class="container my-5">
        <h3>Add A note</h3>
        <br>
        <form action="http://localhost/Php/dir/crud/index.php" method="POST">
            <div class="form-group">
                <label for="title"> Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Title Should Be Amazing
                </small>
            </div>
            <div class="form-group">
                <label for="textarea">Textarea</label>
                <textarea class="form-control" id="description" class="description" name="description"
                    rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>

    </div>
    <div class="container my-4">

        <table class="table" id=myTable>
            <thead>
                <tr>
                    <th scope="col">Serial.no</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $sql="SELECT * FROM `notes`";
        $result=mysqli_query($conn,$sql);
        $srno = 0;
        while($row= mysqli_fetch_assoc($result)){
            $srno = $srno+1;
            echo " <tr>
            
            <th scope='row'>". $srno. "</th>
            <td>".$row["title"]."</td>
            <td>".$row["description"]."</td>
            <td> <button class='edit btn btn-sm btn-primary' id= ".$row['srno']." >Edit</button>     <button class='delete btn btn-sm btn-primary' id= d".$row['srno']." >Delete</button></td>
          </tr>";
         
        
           
        }

        ?>


            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>$(document).ready(function () {
            $('#myTable').DataTable();
        });</script>

    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit", e.target.parentNode.parentNode);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                desc = tr.getElementsByTagName('td')[1].innerText;
                console.log(title, desc);
                titleedit = document.getElementById("titleedit");
                titleedit.value = title;
                descedit = document.getElementById("descriptionedit");
                descedit.value = desc;


                snoedit.value = e.target.id;
                console.log(e.target.id)

                $('#editModal').modal('toggle');
            })

        })


        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete", e.target.parentNode.parentNode);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                desc = tr.getElementsByTagName('td')[1].innerText;
                srno=e.target.id.substr(1,);

                if(confirm("are u sure u want to delete")){
                    window.location=`http://localhost/Php/dir/crud/index.php?delete=${srno}`


                }



                // titleedit = document.getElementById("titleedit");
                // titleedit.value = title;
                // descedit = document.getElementById("descriptionedit");
                // descedit.value = desc;


                // snoedit.value = e.target.id;
                // console.log(e.target.id)

               
            })

        })
    </script>

</body>

</html>