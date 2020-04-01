"use strict";
var DatatablesDataSource = function() {
         
    var sourceDataTable = function() {

  

       
       tab_case_list();



            $("#search").click(function(){
                $('#userTable').DataTable().destroy();
                // table.destroy();
                tab_case_list();
            });

            var userSelect2 = $('.userSelect2');
                userSelect2.select2({
                        allowClear :true,
                        ajax: {
                            url: userSelect2.data('url'),
                            data: function (params) {
                                return {
                                    search: params.term,
                                    id : $(userSelect2.data('target')).val()
                                };
                            },
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: data.map(function (item) {
                                        return {
                                            id: item.id,
                                            text: item.name,
                                            otherfield: item,
                                        };
                                    }),
                                }
                            },
                            cache: true,
                        },
                        placeholder: 'Select a name',
                         minimumInputLength: 2,
                    });

                var userCitySelect2 = $('.userCitySelect2');
                userCitySelect2.select2({
                        allowClear :true,
                        ajax: {
                            url: userCitySelect2.data('city-url'),
                            data: function (params) {
                                return {
                                    search: params.term,
                                    id : $(userCitySelect2.data('target')).val()
                                };
                            },
                            dataType: 'json',
                            processResults: function (data) {
                                return {
                                    results: data.map(function (item) {
                                        return {
                                            id: item.id,
                                            text: item.name,
                                            otherfield: item,
                                        };
                                    }),
                                }
                            },
                            cache: true,
                        },
                        placeholder: 'Select a city',
                        minimumInputLength: 2,
                    });
         
         

            $("#btn_clear").click(function(){

                $('#date_from').val('');
                $('#date_to').val('');
                $('#user_name').val('').trigger('change');
                $('#citiesID').val('').trigger('change'),
                $('#userTable').DataTable().destroy();
                tab_case_list();
               
            });

            $(".dateFrom").datepicker({
                format: 'dd-mm-yyyy',
               // todayHighlight: true,
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
        // begin first table
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
                "data":  {
                          
                            date_from:$('#date_from').val(),
                            date_to:$('#date_to').val(),
                            user_id:$('#user_name').val(),
                            city_id:$('#citiesID').val(),

                      
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
                    "data": "name"
                },
                // {
                //     "data": "email"
                // },
                {
                    "data": "mobile"
                },

                {
                    "data": "personal_city"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "post_count"
                },
                // {
                //     "data": "platform"
                // },
                 {
                    "data": "status"
                },
                {
                     "data":"action"
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