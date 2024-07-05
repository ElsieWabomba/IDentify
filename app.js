$(document).ready(function() {
    // Event listener for Attend button
    $('.attend-btn').on('click', function() {
        console.log("x");
        let requestId = $(this).data('id');
        updateStatus(requestId, 'In Progress');
    });

    // Event listener for Complete button
    $('.complete-btn').on('click', function() {
        let requestId = $(this).data('id');
        updateStatus(requestId, 'Complete');
    });

    // Event listener for Issue Card button
    $('.issue-btn').on('click', function() {
        let requestId = $(this).data('id');
        updateStatus(requestId, 'Issued');
    });

    // Function to update the status of a request
    function updateStatus(requestId, newStatus) {
        $.ajax({
            type: 'POST',
            url: 'processor.php',
            data: {status_id: requestId, status: newStatus},
            success: function(response) {
                if (response.trim() === 'Status updated successfully') {
                    // Reload the page or update the row status dynamically
                    location.reload();
                } else {
                    alert(response);
                }
            }
        });
    }
    $('.view-card').click(function() {
        var requestId = $(this).data('id');
        
        $.ajax({
            url: 'processor.php',
            method: 'POST',
            data: { request_id: requestId },
            success: function(response) {
                $('#cardDetails').html(response);
                $('#cardModal').modal('show');
            }
        });
    });
});
