<?php
include "frame.php";
$user = fetchUserDetails($con);
?>

<div class="container">
    <div class="col-md-6">
        <h2>My Details</h2>
        <div class="user-details">
            <div class="row">
                <img src="/images/users/<?= $user[0]['profile_pic'] ?>" alt="" class="img-fluid">
                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9"><?= $user[0]['fname']." ".$user[0]['lname'] ?>.</dd>
                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9"><?= $user[0]['phone'] ?></dd>
                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><?= $user[0]['email'] ?></dd>
                <dt class="col-sm-3">D.O.B</dt>
                <dd class="col-sm-9"><?= $user[0]['dob'] ?></dd>
                <dt class="col-sm-3">P.O.B</dt>
                <dd class="col-sm-9"><?= $user[0]['pob'] ?></dd>
            </div>
        </div>
    </div>
</div>