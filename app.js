$(document).ready(function() {
    // Event listener for Attend button
    $('.attend-btn').on('click', function() {
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
            url: 'update_status.php',
            data: {id: requestId, status: newStatus},
            success: function(response) {
                if (response.trim() === 'Status updated successfully') {
                    // Reload the page or update the row status dynamically
                    location.reload();
                } else {
                    alert('Failed to update status.');
                }
            }
        });
    }
});
