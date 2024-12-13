<div id="misRreport">
    <form id="dateForm" method="post" action="">
        <label>Month: </label>
        <input type="text" name="month" id="month">
        <label>Year: </label>
        <input type="text" name="year" id="year">
        <input type="button" value="Submit" id="submitBtn" onclick="misReports()">
    </form>
    <!-- <div class="misTableReporte"></div> -->
</div>

<script>
    function misReports(page = 1) {
        var month = document.getElementById("month").value;
        var year = document.getElementById("year").value;

        if (!month || !year) {
            alert("Please enter a valid month and year.");
            return;
        }

        $.ajax({
            url: 'tps_mis.php',
            method: 'POST',
            data: {
                month: month,
                year: year,
                report: "misReport",
                page: page
            },
            success: function (response) {
                $('.misTableReporte').html(response); // Display the fetched table
            }
        });
    }

    // MIS Report pagination
    $(document).off('click', '.mis-pagination').on('click', '.mis-pagination', function (e) {
        e.preventDefault();
        var page = $(this).data('page');
        misReports(page);
    });
</script>
