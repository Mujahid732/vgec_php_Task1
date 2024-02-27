<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit();
} else {
    require 'partials/dbconnect.php';

    $username = $_SESSION["username"];
    if(isset($_GET["deletes"])){
        $sno = $_GET["deletes"];
        
        $sql = "DELETE FROM `todo` WHERE `sno` = '$sno'";
        $result = mysqli_query($conn, $sql);
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST["snoedit"])) {
            // update record
            $sno = $_POST["snoedit"];
            $pnameEdit = $_POST["pnameedit"];
            $descEdit = $_POST["descedit"];

            $sql = "UPDATE `todo` SET `project name` = '$pnameEdit', `description` = '$descEdit ' WHERE `sno` = '$sno'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // echo "update success";
            }else{
                
            }
        } else {
            // $sql = "SELECT * FROM `todo` WHERE user = '$username'";
            // $result = mysqli_query($conn, $sql);

                $pname = $_POST["pname"];
                $desc = $_POST["desc"];
                $ddate = $_POST["date"];
                $sql = "INSERT INTO `todo` (`user`, `project name`, `description`, `date`)
                    VALUES ('$username', '$pname', '$desc', '$ddate')";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                $sql = "SELECT * FROM `todo` WHERE user = '$username'";
                $result = mysqli_query($conn, $sql);
                }
        }
                
    }else{
        $sql = "SELECT * FROM `todo` WHERE user = '$username'";
        $result = mysqli_query($conn, $sql);
    }

    $sql = "SELECT * FROM `todo` WHERE user = '$username'";
    $result = mysqli_query($conn, $sql);
}
?>


<html>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
<title>todo</title>
<style>
    #uname {
        color: green;
    }

    #captcha {
        user-select: none;
        pointer-events: none;
        letter-spacing: 12px;
        text-decoration: line-through;
        font-style: italic;
        font-size: 20px;
        border: 0;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;

    }

    #span {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 18px;
        color: grey;
        margin-right: 3px;


    }

    #regref {
        font-size: 22px;
        font-weight: bold;

    }
</style>
</head>

<body>
    <?php require 'partials/nav.php' ?>


    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
 edit--modal
</button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update list</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="todo.php" method="post">
                        <input type="hidden" name="snoedit" id="snoedit">
                        <div class="mb-3">
                            <label for="pnameedit" class="form-label">Project name</label>
                            <input name="pnameedit" type="text" class="form-control" id="pnameedit"
                                aria-describedby="emailHelp" require>
                        </div>
                        <div class="mb-3">
                            <label for="descedit" class="form-label">Project description</label>
                            <textarea name="descedit" id="descedit" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="ddateedit" class="form-label">Date</label>
                            <input name="dateedit" type="date" class="form-control" id="ddate">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>










    <div class="container">

        <div class="row p-4">
            <h1>Welcome ! <b id="uname">
                    <?php echo $_SESSION["username"]; ?>
                </b></h1>
            <hr>
            <div class="col-md-3">
                <form action="todo.php" method="post">
                    <div class="mb-3">
                        <label for="pname" class="form-label">Project name</label>
                        <input name="pname" type="text" class="form-control" id="pname" aria-describedby="emailHelp"
                            Required>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Project description</label>
                        <textarea name="desc" id="desc" class="form-control" cols="30" rows="3" Required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ddate" class="form-label">Date</label>
                        <input name="date" type="date" class="form-control" id="ddate">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
            <div class="col-md-9">
                <table class="table" id="#myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Project name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sno = 0;
                        while ($row = mysqli_fetch_assoc($result)) {

                            $sno++;
                            echo '
                            <tr>
                            <th scope="row">' . $sno . '</th>
                            <td>' . $row["project name"] . '</td>
                            <td>' . $row["description"] . '</td>
                            <td><button class="edit btn btn-sm btn-primary" id=' . $row["sno"] . '>Edit</button><button class="delete ms-1 btn btn-sm btn-danger" id=d'.$row["sno"].' >Delete</button>
                            </tr>
                            ';
                        }

                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>












    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        })
    </script>

    <script>
        let edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName('td')[0].innerText;
                description = tr.getElementsByTagName('td')[1].innerText;
                pnameedit.value = title;
                descedit.value = description;
                snoedit.value = e.target.id;
                $('#editModal').modal('toggle');
            })
        });
        let deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                // title = tr.getElementsByTagName('td')[0].innerText;
                // description = tr.getElementsByTagName('td')[1].innerText;
                // pnameedit.value = title;
                // descedit.value = description;
                // snoedit.value = e.target.id;
                sno = e.target.id.substr(1, );
                if(confirm("Are your sure want to delete the record !")){
                    //console.log("yes");
                    window.location = `/MyPhp/loginsystem/todo.php?deletes=${sno}`;
                }else{
                    console.log("no");
                }
                //$('#editModal').modal('toggle');
            })
        });
    </script>
</body>

</html>