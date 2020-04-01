//== Class Definition
var ValidationControls = function() {

    
    
 
    var formValidation = function() {
       
                     $('#mailsetupform').validate({   
                        debug: false,
                        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
                        rules: {},
                        messages: {},
                        errorPlacement: function (error, element) {            
                            // $(element).addClass('is-invalid')
                            error.appendTo(element.parent()).addClass('text-danger-custom');
                        },
                        submitHandler: function (e) {
                        $("button[name='save']").attr("disabled", "disabled").button('refresh');
                        $('#mailsetupform').find('span#sid').addClass("spinner-border spinner-border-sm");
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