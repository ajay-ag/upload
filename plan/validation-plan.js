// Class definition
var FormControls = function () {
    // Private functions
    var pagesValidation = function () {
        $('#planForm').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {
            title: { 
                required: true,
                remote: {
                    url: $('#planForm').attr('data-url'),
                    type: "post",
                    data: {
                         _token: function () {
                            return window.Laravel.csrfToken;
                        },
                        form_field: function () {
                            return $("#title").val();
                        },
                        id: function ()
                        {
                            return $("#id").val();
                        },
                    }
                }
            },
        },
        messages: {
            title: {
               remote:"Please enter unique plan name",
            }
        },
        errorPlacement: function (error, element) {            
            // $(element).addClass('is-invalid')
            error.appendTo(element.parent()).addClass('text-danger-custom');
        },
        submitHandler: function (e) {
            $("button[name='save']").attr("disabled", "disabled").button('refresh');
                          $('#planForm').find('span#sid').addClass("spinner-border spinner-border-sm");
            return true;
        }
    })

    }

    return {
        // public functions
        init: function() {
            pagesValidation(); 
        }
    };
}();

jQuery(document).ready(function() {    
    FormControls.init();
});