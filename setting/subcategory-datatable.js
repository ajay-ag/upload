"use strict";
var DatatablesDataSource = function() {

    var sourceDataTable = function() {

  

        var table = $('#subcategoryTable');
       
        // begin first table
        var table2 = $('#subcategoryTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#subcategoryTable').attr('data-url'),
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
                    "data": "name"
                },
                {
                    "data": "category_name"
                },
                {
                    "data": "status"
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