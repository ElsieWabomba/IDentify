<?php
include "frame.php";
?>
<div class="container">
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#userModal">
        Add User
    </button>
    <?php
        displayUsers($con);
    ?>
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    
                </div>

            </div>
        </div>
    </div>

</div>