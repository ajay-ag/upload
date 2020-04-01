//== Class Definition
var ValidationControls = function() {

    
     $("#category").select2({
            allowClear: true,
            placeholder: 'Select Category',
            multiple: false
        });
        $("#subcategory").select2({
            allowClear: true,
            placeholder: 'Select Sub Category',
            multiple: false
        });
 
    var formValidation = function() {
       
                   $('#attribute_form').validate({
            debug: false,
            ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
            rules: {},
            messages: {},
            errorPlacement: function (error, element) {
                  error.appendTo(element.parent()).addClass('text-danger-custom');
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