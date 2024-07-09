<?php
include "frame.php";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h3 class="mb-3">Sign Up</h3>
            <form id="userForm" method="post" action="processor.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
                <div class="mb-3">
                    <label for="mname" class="form-label">Middle Name:</label>
                    <input type="text" class="form-control" id="mname" name="mname" required>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="pob" class="form-label">Place of Birth:</label>
                    <input type="text" class="form-control" id="pob" name="pob" required>
                </div>
                <div class="mb-3">
                    <label for="clan" class="form-label">Clan:</label>
                    <input type="text" class="form-control" id="clan" name="clan" required>
                </div>
                <div class="mb-3">
                    <label for="village" class="form-label">Village:</label>
                    <input type="text" class="form-control" id="village" name="village" required>
                </div>
                <div class="mb-3">
                    <label for="profile_pic" class="form-label">Profile Pic:</label>
                    <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                </div>
                <div class="mb-3">
                    <label for="agency" class="form-label">Agency:</label>
                    <select class="form-select" id="agency_id" name="agency">
                        <option value="0">Not an Agent</option>
                        <?= displayAgentOptions($con)?>
                    </select>
                    <input type="hidden" value="1" class="form-control" id="role" name="role">
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
</div>