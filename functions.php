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
function saveUser($con, $userFname, $userMname, $userLname, $userPhone, $userEmail, $userDob, $userPob, $userPassword, $userClan, $userVillage, $userRole, $userAgency){
    $saveUser = mysqli_query($con, "INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `phone`, `email`, `dob`, `pob`, `password`, `clan`,  `village`, `role`, `agency`)
                                     VALUES (NULL, '$userFname', '$userMname', '$userLname', '$userPhone', '$userEmail', '$userDob', '$userPob', '$userPassword', '$userClan', '$userVillage', '$userRole', '$userAgency')");
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
function displayRequestTypesOptions($counties){
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
            echo "<option value='$id'>$agent</option>";
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
function displayAgents($con){
    $agents = fetchAgents($con);
    if(count($agents)>=1){
        echo "<ul class='agents items'>";
        foreach ($agents as $agent) {
            echo "<li>{$agent['name']}</li>";
        }
        echo "</ul>";
    }
    else{
        echo "No Agents Listed Yet.";
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
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($_SESSION['user_level']==1) {
            $result = mysqli_query($con, "SELECT * FROM `card_request` WHERE `status`='$status' AND `user_id`=".$_SESSION['user_id']);        
        }
        elseif ($_SESSION['user_level']==2) {
            $result = mysqli_query($con, "SELECT * FROM `card_request` WHERE `status`='$status' AND `agency`='1'");
        }
        else {
            $result = mysqli_query($con, "SELECT * FROM `card_request` WHERE `status`='$status'");
        }
    }
    else{

        if ($_SESSION['user_level']==1) {
            $result = mysqli_query($con, "SELECT * FROM `card_request` WHERE `user_id`=".$_SESSION['user_id']);        
        }
        elseif ($_SESSION['user_level']==2) {
            $result = mysqli_query($con, "SELECT * FROM `card_request` WHERE `agency`='1'");
        }
        else {
            $result = mysqli_query($con, "SELECT * FROM `card_request`");
        }
    }
    $requests = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $requests[] = $row;
    }
    return $requests;
}

function displayRequests($con){
    $requests = fetchRequests($con);
    if(count($requests)>=1){
        echo "<ul class='requests items'>";
        foreach ($requests as $request) {
            echo "<li>{$request['request_date']}</li>";
        }
        echo "</ul>";
    }
    else{
        echo "No Requests Made Yet.";
    }
}
function saveCardRequest($con, $agencyId, $userId, $phone, $type, $status){
    $saveRequest = mysqli_query($con, "INSERT INTO `card_request`  (`id`, `agency_id`, `user_id`, `phone`, `request_date`, `date_issued`, `type`, `status`) 
                                        VALUES (NULL, '$agencyId', '$userId', '$phone', current_timestamp(), NULL, '$type', '$status')");
    if ($saveRequest) {
        return true;
    }
}