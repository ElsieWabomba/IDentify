<?php
include "frame.php";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h3 class="mb-3">Register</h3>
            <form id="userForm" method="post" action="processor.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="password" name="cpassword" required>
                </div>
                <button type="submit" class="btn btn-primary" name="saveUser">Submit</button>
            </form>
        </div>
    </div>