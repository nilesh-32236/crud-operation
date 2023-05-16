<?php
session_start();
require_once("connection.php");
$stmt = $conn->prepare("SELECT id, fname, lname, city FROM demo1 LIMIT 100");
$stmt->execute();
$result = $stmt->get_result();
if (isset($_POST["process"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $city = $_POST["city"];
    $stmt = $conn->prepare("INSERT INTO demo1 (fname, lname, city) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fname, $lname, $city);
    if ($stmt->execute()) {
        $_SESSION["msg"] = "Data Inserted successfully";
    } else {
        $_SESSION["msg"] = "Error inserting records";
    }
    $conn->close();
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5" class="border p-5">
                <form action="#" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="fname" id="fname"
                            placeholder="Enter First Name : ">
                        <label for="fname" class="form-label">Enter First Name : </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="lname" id="lname"
                            placeholder="Enter Last Name : ">
                        <label for="lname" class="form-label"> Enter Last Name : </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="city" id="city" placeholder="Enter City Name :">
                        <label for="city" class="form-label"> Enter city Name : </label>
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" value="Submit" class="btn btn-primary" name="process">

                    </div>
                </form>
                <?php
                if (isset($_SESSION["msg"])) {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Success : </strong>
                        <?php echo $_SESSION['msg']; ?>
                    </div>

                    <script>
                        $(".alert").alert();
                    </script>
                    <?php
                    unset($_SESSION["msg"]);
                }
                ?>
            </div>
            <div class="col-md-7">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Fname</th>
                            <th>Lname</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Fname</th>
                            <th>Lname</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                        <td>$row[id]</td>
                        <td>$row[fname]</td>
                        <td>$row[lname]</td>
                        <td>$row[city]</td>
                        <td>
                            <a href='edit.php?id=$row[id]' class='btn btn-primary'>Edit</a>
                            <a href='delete.php?id=$row[id]' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>