<?php
include "frame.php";
?>
<div class="container">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agentModal">
        Add Agent
    </button>
    <?php
        displayAgents($con);
    ?>
    <div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="agentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="agentModalLabel">Add Agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="agentForm" method="POST" action="processor.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="mb-3">
                            <label for="county" class="form-label">County:</label>
                            <input type="text" class="form-control" id="county" name="county" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="saveAgent">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>