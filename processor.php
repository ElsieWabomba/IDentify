<?php
session_start();
include "functions.php";

if (isset($_POST['saveAgent'])) {
    $agentName = mysqli_real_escape_string($con, $_POST['name']);
    $agentEmail = mysqli_real_escape_string($con, $_POST['email']);
    $agentTel = mysqli_real_escape_string($con, $_POST['phone']);
    $agentLocation = mysqli_real_escape_string($con, $_POST['location']);
    $agentCounty = mysqli_real_escape_string($con, $_POST['county']);

    if (count(searchAgent($con, $agentEmail, $agentTel)) < 1) {
        $saveAgent = saveAgent($con, $agentCounty, $agentLocation, $agentTel, $agentEmail, $agentName);
        if ($saveAgent) {
            $_SESSION['message'] = "Agent added successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to add agent.";
            $_SESSION['msg_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Agent with this email or phone already exists.";
        $_SESSION['msg_type'] = "warning";
    }
    
    header('Location: agents.php');
    exit();
}
if (isset($_POST['saveUser'])) {
    $userFname = mysqli_real_escape_string($con, $_POST['fname']);
    $userMname = mysqli_real_escape_string($con, $_POST['mname']);
    $userLname = mysqli_real_escape_string($con, $_POST['lname']);
    $userPhone = mysqli_real_escape_string($con, $_POST['phone']);
    $userEmail = mysqli_real_escape_string($con, $_POST['email']);
    $userDob = mysqli_real_escape_string($con, $_POST['dob']);
    $userPob = mysqli_real_escape_string($con, $_POST['pob']);
    $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $userClan = mysqli_real_escape_string($con, $_POST['clan']);
    $userVillage = mysqli_real_escape_string($con, $_POST['village']);
    $userAgency = mysqli_real_escape_string($con, $_POST['agency']);
    $userRole = mysqli_real_escape_string($con, $_POST['role']);
    
    $profilePic = uploadFile($_FILES['profile_pic'], "profile_pic", "attachments/images/users/");
    $momId = uploadFile($_FILES['mom_id'], "momId", "attachments/images/documents/");
    $dadId = uploadFile($_FILES['dad_id'], "dadId", "attachments/images/documents/");
    $birthCert = uploadFile($_FILES['birth_cert'], "birth_cert", "attachments/images/documents/");


    if (count(searchUser($con, $userEmail, $userPhone)) < 1) {
        $saveUser = saveUser($con, $userFname, $userMname, $userLname, $userPhone, $userEmail, $userDob, $userPob, $userPassword, $userClan, $userVillage, $userRole, $profilePic, $dadId, $momId, $birthCert, $userAgency);
        if ($saveUser) {
            $_SESSION['message'] = "User added successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to add user.";
            $_SESSION['msg_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "User with this email or phone already exists.";
        $_SESSION['msg_type'] = "warning";
    }
    
    header('Location: users.php');
    exit();
}
if (isset($_POST['loginUser'])) {
    $userEmail = mysqli_real_escape_string($con, $_POST['email']);
    $userPassword = $_POST['password'];

    $user = verifyUser($con, $userEmail, $userPassword);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_level'] = $user['role'];
        $_SESSION['user_lname'] = $user['lname'];
        $_SESSION['user_name'] = $user['fname'];
        $_SESSION['user_agency'] = $user['agency'];
        $_SESSION['message'] = "Login successful!";
        $_SESSION['msg_type'] = "success";
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = "Invalid email or password.";
        $_SESSION['msg_type'] = "danger";
        header('Location: index.php');
        exit();
    }
}
if (isset($_POST['saveCardRequest'])) {
    $agencyId = mysqli_real_escape_string($con, $_POST['agency_id']);
    $userId = mysqli_real_escape_string($con, $_POST['user_id']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

   $saveRequest = saveCardRequest($con, $agencyId, $userId, $phone, $type, $status);

    if ($saveRequest) {
        $_SESSION['message'] = "Card request submitted successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to submit card request.";
        $_SESSION['msg_type'] = "danger";
    }
    
    header('Location: dashboard.php');
    exit();
}
if (isset($_POST['id']) && isset( $_POST['status'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    if (mysqli_query($con, "UPDATE card_request SET status='$status' WHERE id=$id")) {
        echo 'Status updated successfully';
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
}
