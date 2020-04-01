//== Class Definition
var ValidationControls = function() {

    
    
 
    var formValidation = function() {
       
                      $('#staticpages_form').validate({   
        debug: false,
        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
        rules: {
          
            },
        messages: {
          
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
            $('#staticpages_form').find('span#sid').addClass("spinner-border spinner-border-sm");
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
    var imageUpload1 = function() {

                   

                    $(document).on('click','.file-upload-browse2', function() {
                    var file1 = $(this).parents().find('.file-upload-default2');
                    file1.trigger('click');
                    });
                    $(document).on('click','.file-upload-clear2',function() {
                    $('.file-upload-default2').val('');
                    $('.file-upload-default2').trigger('change');
                    });

                    $(document).on('change', '.file-upload-default2', function() {
                    var el = $(this) ;
                    var preview = $('#preview2') ;
                    if(el.val() && el.valid()) {
                    readURL2(this);
                    el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
                    return true ;
                    }

                    preview.attr('src', preview.data('default'));
                    el.val('');
                    el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
                    });


                    

                        var readURL2 = function (input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    $('#preview2').attr('src', e.target.result)
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }


    }





    
    //== Public Functions
    return {
        // public functions
        init: function() {
           formValidation();
           formSlug();
           imageUpload1();
     
         
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    ValidationControls.init();
});