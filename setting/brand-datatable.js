"use strict";
var DatatablesDataSource = function() {

    var sourceDataTable = function() {

  

        var table = $('#brandDataTable');
       
        // begin first table
          table = $('#brandDataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#brandDataTable').attr('data-url'),
                "dataType": "json",
                "type": "POST",
                "data": function (d) {
                    return $.extend({}, d, {});
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "category_id"
                },
                {
                    "data": "sub_category_id"
                },

                 {
                    "data": "name"
                },

                {
                    "data": "action"
                }
            ]
        });
      
        

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