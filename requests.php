<?php
include "frame.php";
?>
<div class="container">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cardRequestModal">
    Request Card
    </button>
    <?php displayRequests($con)?>
</div>
<!-- Card Request Modal -->
<div class="modal fade" id="cardRequestModal" tabindex="-1" aria-labelledby="cardRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cardRequestModalLabel">Card Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="processor.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="agency_id">Agency</label>
            <select class="form-select" id="agency_id" name="agency_id" required>
            <?= displayAgentOptions($con)?>
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" id="user_id" value="<?= $_SESSION['user_id']?>" name="user_id">
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="type">Type</label>
            <select class="form-select" id="type" name="type" value="1">
              <option value="">Select Request Type</option>
              <?= displayRequestTypesOptions($requestTypes) ?>
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" class="form-control" id="status" name="status" value="new">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="saveCardRequest" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>