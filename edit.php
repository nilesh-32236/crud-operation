<?php
require_once("connection.php");
session_start();

$id = $_GET["id"];
$sqlQuery = "SELECT * FROM demo1 WHERE id = '$id'";
$result = $conn->query($sqlQuery);
while ($row = $result->fetch_assoc()) {
    $fname = $row["fname"];
    $lname = $row["lname"];
    $city = $row["city"];
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

<body class="text-center">
    <h1>Edit Student detail</h1>
    <div class="container d-flex justify-content-center align-items-center">
        <form action="#" method="post" class="border p-5 rounded pb-3">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name : "
                    value="<?php echo $fname; ?>">
                <label for="fname" class="form-label">Enter First Name : </label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Last Name : "
                    value="<?php echo $lname; ?>">
                <label for="lname" class="form-label"> Enter Last Name : </label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City Name :"
                    value="<?php echo $city; ?>">
                <label for="city" class="form-label"> Enter city Name : </label>
            </div>
            <div class="form-group mb-3">
                <input type="submit" value="Submit" class="btn btn-primary" name="editProcess">
            </div>
        </form>
    </div>
</body>

</html>

<?php
if (isset($_POST["editProcess"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $city = $_POST["city"];

    $sqlQuery = "UPDATE demo1 SET fname = '$fname', lname = '$lname', city = '$city' WHERE id = '$id'";

    $conn->query($sqlQuery);
    $_SESSION["msg"] = "Data updated successfully at id = $id";

    header("location:index.php");
}
?>