<div id="tpsReport">
    <form id="dateForm" method="post" action="">
        <input type="date" name="date" id="date">
        <input type="button" value="Submit" id="submitBtn" onclick="tpsReports()">
    </form>
    <!-- <div class="tpsTableReporte"></div> -->
</div>

<script>
    function tpsReports(page = 1) {
        var date = document.getElementById("date").value;
        if (!date) {
            alert("Please select a valid date.");
            return; // Stop if no valid date is selected
        }
        $.ajax({
            url: 'tps_mis.php',
            method: 'POST',
            data: {
                date: date,
                report: "tpsReport",
                page: page
            },
            success: function (response) {
                $('.tpsTableReporte').html(response); // Display the fetched table
            }
        });
    }

    // TPS Report pagination
    $(document).off('click', '.tps-pagination').on('click', '.tps-pagination', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        tpsReports(page);
    });
</script>
