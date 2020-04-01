"use strict";
var DatatablesDataSource = function() {

    var sourceDataTable = function() {

  

        var table = $('#staticpagesTable');
       
        // begin first table
          var table2 = $('#staticpagesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [10, 25, 50],
            "responsive": true,
            // "iDisplayLength": 2,
            "ajax": {
                "url": $('#staticpagesTable').attr('data-url'),
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
                    "data": "banner_image"
                },
                {
                    "data": "name"
                },
                // {
                //     "data": "status"
                // },
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