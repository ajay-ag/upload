//== Class Definition
var ValidationControls = function() {

    
     
    var formValidation = function() {
       
                $('.status').on('change', function () {

                    if (this.value == "canceled") {
                        $(".comment").removeClass("d-none");
                    } else {
                        $(".comment").addClass("d-none");
                    }
                });
                $("#status").select2({
                    allowClear: true,
                    placeholder: 'Select Status',
                    multiple: false
                });

                $('#ourclientform').validate({
                    debug: false,
                    // ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
                    rules: {},
                    messages: {},
                    errorPlacement: function (error, element) {
                        error.appendTo(element.parent()).addClass('text-danger');
                    },
                    submitHandler: function (e) {
                        // var formData = $("#categoryform");
                        $("button[name='save']").attr("disabled", "disabled").button('refresh');
                        $('#ourclientform').find('span#sid').addClass("spinner-border spinner-border-sm");
                                                    return true;
                        
                    }
                })

            
        
    }


    
    //== Public Functions
    return {
        // public functions
        init: function() {
           formValidation();
         
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    ValidationControls.init();
});