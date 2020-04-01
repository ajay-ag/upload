"use strict";
var DatatablesDataSourceHtml = function() {
  
    var initPlanTable = function() {
        var table = $('#planDatatable');
        // begin first table
        table.DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            "language": {
                searchPlaceholder: "Package name"
            },
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#planDatatable').attr('data-url'),
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
                    "data": "title"
                },
                // {
                //     "data": "no_of_package"
                // },
                {
                    "data": "price"
                },
                {
                    "data": "is_active"
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
            initPlanTable();
        },

    };

}();

jQuery(document).ready(function() {
    DatatablesDataSourceHtml.init();
});
