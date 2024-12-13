<div class="customerDeletedData">
    <script>
        function customerDeletedData(page = 1) {
            const limit = 10; // Define the number of items per page
            $.ajax({
                url: 'customerDeletedData.php',
                method: 'GET',
                data: { page: page, limit: limit },
                success: function(response) {
                    $('.deletedCustomerTable').html(response);
                    $('.deletedCustomerTable').show();

                    // Handle pagination button clicks
                    $('.page-link').on('click', function() {
                        const newPage = $(this).data('page');
                        customerDeletedData(newPage);
                    });
                }
            });
        }
    </script>
    <div class="deletedCustomerTable"></div>
</div>
