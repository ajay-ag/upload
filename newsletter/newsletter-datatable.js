"use strict";
var DatatablesDataSource = function() {

    var sourceDataTable = function() {

            tab_case_list();

            $("#search").click(function(){
                $('#newsletterTable').DataTable().destroy();
                // table.destroy();
                tab_case_list();
            });
            $("#btn_clear").click(function(){

                $('#date_from').val('');
                $('#date_to').val('');
               
                $('#newsletterTable').DataTable().destroy();
                tab_case_list();
               
            });

            $(".dateFrom").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
            }).on('changeDate', function (selected) {
                var startDate = new Date(selected.date.valueOf());
                $('.dateTo').datepicker('setStartDate', startDate);
            }).on('clearDate', function (selected) {
                $('.dateTo').datepicker('setStartDate', null);
            });

            $(".dateTo").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
            }).on('changeDate', function (selected) {
                var endDate = new Date(selected.date.valueOf());
                $('.dateFrom').datepicker('setEndDate', endDate);
            }).on('clearDate', function (selected) {
                $('.dateFrom').datepicker('setEndDate', null);
            });
            function tab_case_list() {

            var table = $('#newsletterTable');
            table.DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#newsletterTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": {
                    from_date:$('#date_from').val(),
                    to_date:$('#date_to').val(),
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "email"
                },
                
                // {
                //     "data":"action"
                // }
            ]
        });
        }
 
      
        

    };

    return {

        //main function to initiate the module
        init: function() {
            sourceDataTable();
        },

    };

}();

jQuery(document).ready(function() {
    DatatablesDataSource.init();
});