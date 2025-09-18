<?php
include("connect.php");

$name      = $_POST['name'];
$mobile    = $_POST['mobile'];
$password  = $_POST['password'];
$cpassword = $_POST['cpassword'];
$address   = $_POST['address'];
$role      = $_POST['role'];

$image     = $_FILES['photo']['name'];
$tmp_name  = $_FILES['photo']['tmp_name'];

if ($password == $cpassword) {
    // Move uploaded file
    if (move_uploaded_file($tmp_name, "../uploads/$image")) {

        // Insert query
        $insert = mysqli_query($conn, 
            "INSERT INTO users(name, mobile, address, password, photo, role, status, votes) 
             VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', '0', '0')"
        );

        if ($insert) {
            echo "<script>
                alert('Registration Successful!');
                window.location='../';
            </script>";
        } else {
            echo "<script>
                alert('Some error occurred: " . mysqli_error($connect) . "');
                window.location='../routes/register.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('File upload failed!');
            window.location='../routes/register.html';
        </script>";
    }
} else {
    echo "<script>
        alert('Password and Confirm Password do not match');
        window.location='../routes/register.html';
    </script>";
}
?>
