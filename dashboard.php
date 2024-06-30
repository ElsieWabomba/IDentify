<?php
include "frame.php";
include "redirector.php";
?>
<div class="container mt-4">
        <h1>Welcome, <?= $_SESSION['user_name'] . ' ' . $_SESSION['user_lname']; ?>!</h1>
        <div class="row">
            <?php if ($_SESSION['user_level'] == '1'): ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Requests</h5>
                            <p class="card-text">View and manage your requests.</p>
                            <a href="requests.php" class="btn btn-primary">Go to Requests</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">My Details</h5>
                            <p class="card-text">View and edit your personal details.</p>
                            <a href="mydetails.php" class="btn btn-primary">Go to My Details</a>
                        </div>
                    </div>
                </div>
            <?php elseif ($_SESSION['user_level'] == '2' || $_SESSION['user_level'] == '3'): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Requests</h5>
                            <p class="card-text">View new requests.</p>
                            <a href="new_requests.php" class="btn btn-primary">Go to New Requests</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">In Progress</h5>
                            <p class="card-text">View requests in progress.</p>
                            <a href="in_progress.php" class="btn btn-primary">Go to In Progress</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Completed</h5>
                            <p class="card-text">View completed requests.</p>
                            <a href="completed.php" class="btn btn-primary">Go to Completed</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agency</h5>
                            <p class="card-text">View and manage your agency.</p>
                            <a href="agency.php" class="btn btn-primary">Go to Agency</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>