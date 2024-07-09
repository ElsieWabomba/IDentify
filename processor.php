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
if (isset($_POST['saveUser']) ) {
    $userFname = mysqli_real_escape_string($con, $_POST['fname']);
    $userMname = mysqli_real_escape_string($con, $_POST['mname']);
    $userLname = mysqli_real_escape_string($con, $_POST['lname']);
    $userPhone = mysqli_real_escape_string($con, $_POST['phone']);
    $userEmail = mysqli_real_escape_string($con, $_POST['email']);
    $userDob = mysqli_real_escape_string($con, $_POST['dob']);
    $userPob = mysqli_real_escape_string($con, $_POST['pob']);
    $userPassword = $_POST['password']; 
    $userConPassword = $_POST['cpassword'];
    if ($userConPassword === $userPassword) {
        $userPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
        $userClan = mysqli_real_escape_string($con, $_POST['clan']);
        $userVillage = mysqli_real_escape_string($con, $_POST['village']);
        $userAgency = mysqli_real_escape_string($con, $_POST['agency']);
        $userRole = $userAgency == "0"? 1 : 2 ;
        
        $profilePic = uploadFile($_FILES['profile_pic'], "profile_pic", "attachments/images/users/");

        if (count(searchUser($con, $userEmail, $userPhone)) < 1) {
            $saveUser = saveUser($con, $userFname, $userMname, $userLname, $userPhone, $userEmail, $userDob, $userPob, $userPassword, $userClan, $userVillage, $userRole, $profilePic, $userAgency);
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
    }
    else {
        $_SESSION['message'] = "Passwords Don't match.";
        $_SESSION['msg_type'] = "warning";
    }
    
    header('Location: index.php');
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
if (isset($_POST['request_id'])) {
    $requestId = mysqli_real_escape_string($con, $_POST['request_id']);
    $result = fetchCardRequest($con, $requestId);

    if ($result && mysqli_num_rows($result) > 0) {
        $card = mysqli_fetch_assoc($result);
        
        echo "
            <div class='card'>
                <div class='card-header'>
                    <h5>Card Details</h5>
                </div>
                <div class='card-body'>
                    <p><strong>First Name:</strong> {$card['fname']}</p>
                    <p><strong>Middle Name:</strong> {$card['mname']}</p>
                    <p><strong>Last Name:</strong> {$card['lname']}</p>
                    <p><strong>Date of Birth:</strong> {$card['dob']}</p>
                    <p><strong>Place of Birth:</strong> {$card['pob']}</p>
                    <p><strong>Village:</strong> {$card['village']}</p>
                    <p><strong>Agency Name:</strong> {$card['name']}</p>
                    <p><strong>Date Issued:</strong> {$card['date_issued']}</p>
                    <img src='attachments/images/users/{$card['profile_pic']}' alt='Profile Picture' class='img-fluid'>
                </div>
            </div>
        ";
    } 
    else {
        echo "<div class='alert alert-danger'>Failed to fetch card details.</div>";
    }
}
if (isset($_POST['status_id']) && isset( $_POST['status'])) {
    $id = mysqli_real_escape_string($con, $_POST['status_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    if (mysqli_query($con, "UPDATE `card_request` SET `status`='$status' WHERE `id`=$id")) {
        echo 'Status updated successfully';
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
}
if (isset($_POST['userDocs'])) {
    $id = mysqli_real_escape_string($con, $_POST['userDocs']);
    $momId = uploadFile($_FILES['mom_id'], "momId", "attachments/images/documents/");
    $dadId = uploadFile($_FILES['dad_id'], "dadId", "attachments/images/documents/");
    $birthCert = uploadFile($_FILES['birth_cert'], "birth_cert", "attachments/images/documents/");
    
    $uploadDocs = uploadUserDocs($con, $dadId, $momId, $birthCert);

    if ($uploadDocs) {
        $_SESSION['message'] = "Documents Uploaded Successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to Upload Documents.";
        $_SESSION['msg_type'] = "danger";
    }
    
    header('Location: dashboard.php');
    exit();
}