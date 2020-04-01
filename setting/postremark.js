"use strict";
var validationControls = function() {

    var sourceDataTable = function() {

  

        $('#attribute_form').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {},
            messages: {},
            errorPlacement: function (error, element) {
                    error.appendTo(element.parent()).addClass('text-danger-custom');;
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                }
            },
            submitHandler: function (e) {
              $("button[name='save']").attr("disabled", "disabled").button('refresh');
                $('#attribute_form').find('span#sid').addClass("spinner-border spinner-border-sm");
                         return true;
            }
        })
          
      
        

    };

    return {

        //main function to initiate the module
        init: function() {
            sourceDataTable();
        },

    };

}();

jQuery(document).ready(function() {
    validationControls.init();
});