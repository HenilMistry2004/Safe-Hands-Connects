<div class=" workerDeleteData">
<script>
    function workerDeletedData(page = 1) {
        $.ajax({
            url: 'workerDeletedData.php',
            method: 'GET',
            data: { page: page }, // Pass the page number
            success: function (response) {
                $('.deletedWorkerTable').html(response); // Replace content with response
                $('.deletedWorkerTable').show();
            },
            error: function () {
                alert('Failed to fetch data.');
            }
        });
    }

    // Dynamically handle pagination links
    $(document).on('click', '.pagination-link', function (e) {
        e.preventDefault();
        const page = $(this).data('page'); // Get the page number from the link
        workerDeletedData(page); // Load the selected page
    });
</script>

    <div class="deletedWorkerTable"></div>


</div>