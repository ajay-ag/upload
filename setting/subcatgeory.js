//== Class Definition
var ValidationControls = function() {

            $("#category_id").select2({
            allowClear:true,
            placeholder: 'Select Category',
            multiple:false
            });
           

    
 
    var formValidation = function() {
       
                      $('#subcategory_form').validate({
                        debug: false,
                        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
                        rules: {
                            name: {
                                // required: true,
                                remote: {
                                    async: false,
                                    url: $('#subcategory_form').attr('data-exit-url'),
                                    type: "post",
                                    data: {
                                       
                                        form_field: function () {
                                            return $("#name").val();
                                        },
                                        id: function ()
                                        {
                                            return $("#id").val();
                                        },
                                        db_field: function () {
                                            return 'name';
                                        },
                                        table: function () {
                                            return 'category';
                                        },
                                        condition_form_field: function () {
                                            return '';
                                        },
                                        condition_db_field: function () {
                                            return '';
                                        }
                                    }
                                }
                            }

                            },
                        messages: {

                            name:{
                                remote: "Name is already exits."
                            }

                        },
                        errorPlacement: function (error, element) {
                             error.appendTo(element.parent()).addClass('text-danger-custom');
                            if(element.parent('.input-group').length)
                                {
                                    error.insertAfter(element.parent());
                                }
                        },
                        submitHandler: function (e) {
                          $("button[name='save']").attr("disabled", "disabled").button('refresh');
                          $('#subcategory_form').find('span#sid').addClass("spinner-border spinner-border-sm");
                          return true;
                        }
                    })
           

            
        
    }
    var formSlug = function() {
                    $('#name').on('keydown keyup', function (e) {

                        var el = $(this);
                        var textdata = el.val();
                        var slug = convertToSlug($('#name').val());

                        $('#slug').val(slug);
                        });

                        function convertToSlug(Text) {
                         var data = Text
                         .toLowerCase()
                         .replace(/[^\w ]+/g, '')
                         .replace(/ +/g, '-');
                         return data
                        }   


    }


    
    //== Public Functions
    return {
        // public functions
        init: function() {
           formValidation();
           formSlug();
         
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    ValidationControls.init();
});