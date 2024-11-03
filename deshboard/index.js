$(document).ready(function(){
    $("#customer").click(function(){
      $("#customerDetails").show();
      $("#costomerHeader").show();
      $("#display").show();
    });

    $("#customer").click(function(){
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide();
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails ").hide();
        $(".charts").hide();

    });

    // Worker

    $("#worker").click(function(){
        $("#workerHeader").show();
        $("#workersDetails").show();
        $("#display").show();
    });

    $("#worker").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide();
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $(".charts").hide();

    });
  
    // servecce

    $("#services").click(function(){
        $("#serviceHeader").show();
        $("#serivceDetail").show();
        $("#display").show();
    });

    $("#services").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide();
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $(".charts").hide();

    });

    // request 

    
    $("#pendingRequests").click(function(){
        $("#bookingRequestHeader").show();
        $("#requestDetails").show();
        $("#display").show();
    });

    $("#pendingRequests").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $(".charts").hide();

    });

    // insert

    $("#addButton").click(function(){
        $(".insertForm").toggle();
    });

    // customer Deleted Data

    $("#deleteCustomer").click(function(){
        $("#deletedCostomerHeader").show();
        $("#display").show();
        $(".customerDeletedData").show();
    });

    $("#deleteCustomer").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide()
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $(".charts").hide();

    });

    $("#deleteWorker").click(function(){
        $("#deletedWorkerHeader").show();
        $("#display").show();
        $(".workerDeleteData").show();
    });

    $("#deleteWorker").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide()
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $(".charts").hide();

    });

    // TPS

    $("#tps").click(function(){
        $("#tpsReport").show();
        $("#tpsTableReporte").show();
        $("#TPSHrader").show();
        $("#display").show();
    });

    $("#tps").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide()
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $(".charts").hide();

    });

    // MIS

    $("#mis").click(function(){
        $("#misRreport").show();
        $("#misTableReporte").show();
        $("#MISHeader").show();
        $("#display").show();
    });

    $("#mis").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide()
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $(".charts").hide();

    });

    // Worker Request

    $("#requestedWorkers").click(function(){
        $("#requestWorkersHeader").show();
        $("#requestedWorkersDetails").show();
        $("#display").show();
    });

    $("#requestedWorkers").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide()
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $(".charts").hide();
    });

    //charts

    $("#chartMenu").click(function(){
        $(".charts").show();
        $("#display").show();
    });

    $("#chartMenu").click(function(){
        $("#customerDetails").hide();
        $("#costomerHeader").hide();
        $("#workerHeader").hide();
        $("#workersDetails").hide();
        $("#serviceHeader").hide();
        $("#serivceDetail").hide();
        $("#bookingRequestHeader").hide();
        $("#requestDetails").hide()
        $("#deletedCostomerHeader").hide();
        $(".customerDeletedData").hide();
        $("#deletedWorkerHeader").hide();
        $(".workerDeleteData").hide();
        $("#tpsReport").hide();
        $("#tpsTableReporte").hide();
        $("#TPSHrader").hide();
        $("#misRreport").hide();
        $("#misTableReporte").hide();
        $("#MISHeader").hide();
        $("#requestWorkersHeader").hide();
        $("#requestedWorkersDetails").hide();
        $("#allTablesDetails").hide();
        $("#display").hide();        
    });
});