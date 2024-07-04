<?php
include "connect.php";

$counties =  [
    '1' => 'Mombasa',
    '2' => 'Kwale',
    '3' => 'Kilifi',
    '4' => 'Tana River',
    '5' => 'Lamu',
    '6' => 'Taita-Taveta',
    '7' => 'Garissa',
    '8' => 'Wajir',
    '9' => 'Mandera',
    '10' => 'Marsabit',
    '11' => 'Isiolo',
    '12' => 'Meru',
    '13' => 'Tharaka-Nithi',
    '14' => 'Embu',
    '15' => 'Kitui',
    '16' => 'Machakos',
    '17' => 'Makueni',
    '18' => 'Nyandarua',
    '19' => 'Nyeri',
    '20' => 'Kirinyaga',
    '21' => 'Murang\'a',
    '22' => 'Kiambu',
    '23' => 'Turkana',
    '24' => 'West Pokot',
    '25' => 'Samburu',
    '26' => 'Trans Nzoia',
    '27' => 'Uasin Gishu',
    '28' => 'Elgeyo-Marakwet',
    '29' => 'Nandi',
    '30' => 'Baringo',
    '31' => 'Laikipia',
    '32' => 'Nakuru',
    '33' => 'Narok',
    '34' => 'Kajiado',
    '35' => 'Kericho',
    '36' => 'Bomet',
    '37' => 'Kakamega',
    '38' => 'Vihiga',
    '39' => 'Bungoma',
    '40' => 'Busia',
    '41' => 'Siaya',
    '42' => 'Kisumu',
    '43' => 'Homa Bay',
    '44' => 'Migori',
    '45' => 'Kisii',
    '46' => 'Nyamira',
    '47' => 'Nairobi',
];
$requestTypes = [
    '01'=>'New',
    '02'=>'Replacement'
];
function searchUser($con, $userEmail, $userPhone) {
    $searchUser = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$userEmail' OR `phone`='$userPhone'");
    $users = [];

    while ($row = mysqli_fetch_assoc($searchUser)) {
        $users[] = $row;
    }
    return $users;
}
function uploadBirthCert($birthCert){
    $birthCertName = "";
    if (!empty($birthCert)) {            
        $docname = $_FILES['birth_cert']['name'];
        $doclocation = $_FILES['birth_cert']['tmp_name'];
        $doctitle = explode(".", $docname);
        $docext = end($doctitle);
        $birthCertName =  date('Y-m-d-H-i-s')."-birth-cert.".$docext;
        $docdestination = "attachments/images/documents/$birthCertName";
        
        if (move_uploaded_file($doclocation, $docdestination)){
           return $birthCertName;
        }
    }
    else
    {
        return $birthCertName;
    }  
}
function uploadProfilePic($profilePic){
    $profilePicName = "";
    if (!empty($profilePic)) {            
        $docname = $_FILES['profile_pic']['name'];
        $doclocation = $_FILES['profile_pic']['tmp_name'];
        $doctitle = explode(".", $docname);
        $docext = end($doctitle);
        $profilePicName =  date('Y-m-d-H-i-s')."profile-pic.".$docext;
        $docdestination = "attachments/images/users/$profilePicName";
        
        if (move_uploaded_file($doclocation, $docdestination)){
           return $profilePicName;
        }
    }
    else
    {
        return $profilePicName;
    }
}
function uploadFathersId($dadId){
    $dadIdName = "";
    if (!empty($dadId)) {            
        $docname = $_FILES['dad_id']['name'];
        $doclocation = $_FILES['dad_id']['tmp_name'];
        $doctitle = explode(".", $docname);
        $docext = end($doctitle);
        $dadIdName =  date('Y-m-d-H-i-s')."-dadId.".$docext;
        $docdestination = "attachments/images/documents/$dadIdName";
        
        if (move_uploaded_file($doclocation, $docdestination)){
           return $dadIdName;
        }
    }
    else
    {
        return $dadIdName;
    }  
}
function uploadMothersId($dadId){
    $momIdName = "";
    if (!empty($dadId)) {            
        $docname = $_FILES['mom_id']['name'];
        $doclocation = $_FILES['mom_id']['tmp_name'];
        $doctitle = explode(".", $docname);
        $docext = end($doctitle);
        $momIdName =  date('Y-m-d-H-i-s')."-momId.".$docext;
        $docdestination = "attachments/images/documents/$momIdName";
        
        if (move_uploaded_file($doclocation, $docdestination)){
           return $momIdName;
        }
    }
    else
    {
        return $momIdName;
    }  
}
function uploadFile($file, $prefix, $destination) {
    $fileName = "";
    if (!empty($file) && $file['error'] == UPLOAD_ERR_OK) {            
        $docname = $file['name'];
        $doclocation = $file['tmp_name'];
        $doctitle = explode(".", $docname);
        $docext = end($doctitle);
        $fileName = date('Y-m-d-H-i-s')."-".$prefix.".".$docext;
        $docdestination = $destination . $fileName;
        
        if (move_uploaded_file($doclocation, $docdestination)){
           return $fileName;
        }
    }
    return $fileName;
}
function saveUser($con, $userFname, $userMname, $userLname, $userPhone, $userEmail, $userDob, $userPob, $userPassword, $userClan, $userVillage, $userRole, $profilePic, $dadId, $momId, $birthCert, $userAgency){
    $saveUser = mysqli_query($con, "INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `phone`, `email`, `dob`, `pob`, `password`, `clan`,  `village`, `role`,`profile_pic`, `fathers_id`, `mothers_id`, `birth_cert`, `agency`)
                                     VALUES (NULL, '$userFname', '$userMname', '$userLname', '$userPhone', '$userEmail', '$userDob', '$userPob', '$userPassword', '$userClan', '$userVillage', '$userRole', '$profilePic', '$dadId', '$momId', '$birthCert', '$userAgency')");
    if ($saveUser) {
        return true;
    }
}
function searchAgent($con, $agentEmail, $agentTel){
    $searchAgent = mysqli_query($con, "SELECT * FROM `agent` WHERE `email`='$agentEmail' OR `phone`='$agentTel'");
    $agents = [];

    while ($row = mysqli_fetch_assoc($searchAgent)) {
        $agents[] = $row;
    }
    return $agents;
}
function saveAgent($con, $agentCounty, $agentLocation, $agentTel, $agentEmail, $agentName){
    $saveAgent = mysqli_query($con, "INSERT INTO `agent` (`id`, `name`, `email`, `phone`, `location`, `county`) 
                                        VALUES (NULL, '$agentName', '$agentEmail', '$agentTel', '$agentLocation', '$agentCounty')");
    return $saveAgent;
}
function displayCountyOptions($counties){
    asort($counties);
    if(count($counties)>=1){
        foreach($counties as $id => $county){
            echo "<option value='$id'>$county</option>";
        }
    }
    else{
        echo "<option value=''>No County Listed Yet</option>";
    }
}
function displayRequestTypesOptions($requestTypes){
    asort($requestTypes);
    if(count($requestTypes)>=1){
        foreach($requestTypes as $id => $requestType){
            echo "<option value='$id'>$requestType</option>";
        }
    }
    else{
        echo "<option value=''>No Request Type Listed Yet</option>";
    }
}
function fetchAgents($con){
    $result = mysqli_query($con, "SELECT * FROM `agent`");
    $agents = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $agents[] = $row;
    }
    return $agents;
}
function displayAgentOptions($con){
    $agents = fetchAgents($con);
    asort($agents);
    if(count($agents)>=1){
        foreach($agents as $agent){
            echo "<option value='{$agent['id']}'>{$agent['name']}</option>";
        }
    }
    else{
        echo "<option value=''>No Agent Listed Yet</option>";
    }
}
function fetchUsers($con){
    if (isset($_GET['cat'])) {
        $level = $_GET['cat'];
        $result = mysqli_query($con, "SELECT * FROM `users` WHERE `role`='$level'");
    }
    else{
        $result = mysqli_query($con, "SELECT * FROM `users`");
    }
    $users = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}
function fetchUserDetails($con){

    $result = mysqli_query($con, "SELECT * FROM `users` WHERE `id`='{$_SESSION['user_id']}'");
    $users = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}
function displayAgents($con){
    $agents = fetchAgents($con);
    if(count($agents) >= 1){
        echo "<h3 class='mb-3'>Agents</h3>
            <table class='table table-striped table-bordered'>
             <thead class='table-dark'><tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>County</th>
              </tr></thead>";
        echo "<tbody>";
        foreach ($agents as $agent) {
            echo "<tr>
                    <td>{$agent['id']}</td>
                    <td>{$agent['name']}</td>
                    <td>{$agent['email']}</td>
                    <td>{$agent['phone']}</td>
                    <td>{$agent['location']}</td>
                    <td>{$agent['county']}</td>
                  </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div class='alert alert-info' role='alert'>No Agents Listed Yet.</div>";
    }
}

function displayUsers($con){
    $users = fetchUsers($con);
    if(count($users)>=1){
        echo "<ul class='users items'>";
        foreach ($users as $user) {
            echo "<li>{$user['fname']}</li>";
        }
        echo "</ul>";
    }
    else{
        echo "No Users Listed Yet.";
    }
}

function verifyUser($con, $userEmail, $userPassword) {
    $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$userEmail'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($userPassword, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}
//Requests
function fetchRequests($con){
    $userId = $_SESSION['user_id'];
    $userLevel = $_SESSION['user_level'];
    $agencyId = $_SESSION['user_agency'];

    $query = "SELECT 
                cr.id,
                cr.agency_id,
                a.name AS agency_name,
                cr.user_id,
                CONCAT(u.fname, ' ', u.mname, ' ', u.lname) AS user_name,
                cr.phone,
                cr.request_date,
                cr.date_issued,
                cr.type,
                cr.status
            FROM 
                card_request cr
            LEFT JOIN 
                agent a ON cr.agency_id = a.id
            LEFT JOIN 
                users u ON cr.user_id = u.id
            WHERE 1=1"; // Starting condition to facilitate dynamic query building

    // Append conditions based on user level and status
    if (isset($_GET['status'])) {
        $status = mysqli_real_escape_string($con, $_GET['status']);
        $query .= " AND cr.status='$status'";
    }

    if ($userLevel == 1) {
        $query .= " AND cr.user_id=$userId";
    } elseif ($userLevel == 2) {
        $query .= " AND cr.agency_id=$agencyId";
    }

    // Execute the query
    $result = mysqli_query($con, $query);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $requests = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $requests[] = $row;
    }
    return $requests;
}

function displayRequests($con){
    $requests = fetchRequests($con);
    if(count($requests) >= 1){
        echo "<table class='table table-striped'>
                <thead><tr>
                <th>ID</th>
                <th>Agency Name</th>
                <th>User Name</th>
                <th>Phone</th>
                <th>Request Date</th>
                <th>Date Issued</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr></thead>";
        echo "<tbody>";
        foreach ($requests as $request) {
            echo "<tr>
                    <td>{$request['id']}</td>
                    <td>{$request['agency_name']}</td>
                    <td>{$request['user_name']}</td>
                    <td>{$request['phone']}</td>
                    <td>{$request['request_date']}</td>
                    <td>{$request['date_issued']}</td>
                    <td>{$request['type']}</td>
                    <td>{$request['status']}</td>;
                    <td>"; // Start the action cell

                    // Determine which button to display based on the status
                    if ($request['status'] == "new" && $_SESSION['user_level'] == '2') {
                        echo "<button class='btn btn-primary attend-btn' data-id='{$request['id']}'>Attend</button>";
                    } elseif ($request['status'] == "In Progress" && $_SESSION['user_level'] == '2') {
                        echo "<button class='btn btn-warning complete-btn' data-id='{$request['id']}'>Complete</button>";
                    } elseif ($request['status'] == "Complete" && $_SESSION['user_level'] == '3') {
                        echo "<button class='btn btn-success issue-btn' data-id='{$request['id']}'>Issue Card</button>";
                    }
                    else if ($request['status'] == "Issued") {
                        echo "<button class='btn btn-primary view-card' data-id='{$request['id']}'>View Card</button>";
                    }

                    echo "</td>
                </tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<div class='alert alert-info' role='alert'>No Requests Made Yet.</div>";
    }
}
function saveCardRequest($con, $agencyId, $userId, $phone, $type, $status){
    $saveRequest = mysqli_query($con, "INSERT INTO `card_request`  (`id`, `agency_id`, `user_id`, `phone`, `request_date`, `date_issued`, `type`, `status`) 
                                        VALUES (NULL, '$agencyId', '$userId', '$phone', current_timestamp(), NULL, '$type', '$status')");
    if ($saveRequest) {
        return true;
    }
}