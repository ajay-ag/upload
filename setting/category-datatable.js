"use strict";
var DatatablesDataSource = function() {

    var sourceDataTable = function() {

  

        var table = $('#categoryTable');
       
        // begin first table
         var table = $('#categoryTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#categoryTable').attr('data-url'),
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
                    "data": "image"
                },
                {
                    "data": "name"
                },
                {
                    "data": "post_count"
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