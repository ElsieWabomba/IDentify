<?php
include "frame.php";
$user = fetchUserDetails($con);
?>

<div class="container">
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#docsModal">
        Upload Documents
    </button>
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
    <div class="modal fade" id="docsModal" tabindex="-1" aria-labelledby="docsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">User Documents</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="loginForm" method="POST" action="processor.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="birth_cert" class="form-label">Birth Cert:</label>
                        <input type="file" class="form-control" id="birth_cert" name="birth_cert">
                    </div>
                    <div class="mb-3">
                        <label for="dad_id" class="form-label">Father's Id:</label>
                        <input type="file" class="form-control" id="dad_id" name="dad_id">
                    </div>
                    <div class="mb-3">
                        <label for="mom_id" class="form-label">Mother's Id:</label>
                        <input type="file" class="form-control" id="mom_id" name="mom_id">
                    </div>
                        <button type="submit" class="btn btn-primary" name="userDocs">Upload</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>