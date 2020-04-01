"use strict";
var DatatablesDataSource = function() {
          var table;
    var sourceDataTable = function() {

  


       
        // begin first table
        tab_case_list();



            $("#search").click(function(){
                $('#userTable').DataTable().destroy();
                // table.destroy();
                tab_case_list();
            });

            $("#btn_clear").click(function(){

                $('#date_from').val('');
                $('#date_to').val('');
                $('#status').val('').trigger('change');
                // table.destroy();
                $('#userTable').DataTable().destroy();
                tab_case_list();
                // $("#search").attr("disabled", "disabled");
            });



            $("#status").select2({
                allowClear: true,
                placeholder: 'Select Status',
                multiple: false
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
                
                var table = $('#userTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "stateSave": true,
                    "lengthMenu": [10, 25, 50],
                    "responsive": true,
                    // "iDisplayLength": 2,
                    "ajax": {
                        "url": $('#userTable').attr('data-url'),
                        "dataType": "json",
                        "type": "POST",
                        "data":{
                      
                            status:$('#status').val(),
                            date_from:$('#date_from').val(),
                            date_to:$('#date_to').val(),

                        }
                    },
                    "order": [
                        [0, "desc"]
                    ],
                    "columns": [
                        {
                            "data": "id"
                        },
                        {
                            "data": "image"
                        },
                        {
                            "data": "title"
                        },

                        {
                            "data": "publish_date"
                        },
                        {
                            "data": "category"
                        },

                        {
                            "data": "sabcategory"
                        },
                        {
                            "data": "user_name"
                        },
                        {
                            "data": "status"
                        },
                     
                        {
                            "data": "action"
                        }
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