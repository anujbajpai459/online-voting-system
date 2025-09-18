<?php
session_start();
include('connect.php');

if(!isset($_SESSION['userdata'])){
    header("location:../");
    exit();
}

if(isset($_POST['gvotes']) && isset($_POST['gid'])){
    $votes = $_POST['gvotes'];
    $total_votes = $votes + 1;

    $gid = $_POST['gid']; 
    $uid = $_SESSION['userdata']['id']; 

    // Update group votes
    $update_votes = mysqli_query($conn, "UPDATE users SET votes='$total_votes' WHERE id='$gid'");

    // Update user status (voter status)
    $update_user_status = mysqli_query($conn, "UPDATE users SET status=1 WHERE id='$uid'");

    if($update_votes && $update_user_status){
        $groups = mysqli_query($conn, "SELECT * FROM users WHERE role=2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        // Update session
        $_SESSION['userdata']['status'] = 1;
        $_SESSION['groupsdata'] = $groupsdata;

        // Redirect after success
        echo "<script>
            alert('Voting successful!');
            window.location='../routes/dashboard.php';
        </script>";
        exit();
    }
    else{
        echo "<script>
            alert('Some error occurred!');
            window.location='../routes/dashboard.php';
        </script>";
        exit();
    }
}
else{
    echo "<script>
        alert('Invalid request!');
        window.location='../routes/dashboard.php';
    </script>";
    exit();
}
?>
