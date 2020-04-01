//== Class Definition
var ValidationControls = function() {

    
    
 
    var formValidation = function() {
       
                      $('#category_form').validate({
                        debug: false,
                        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
                        rules: {

                            name: {
                                // required: true,
                                remote: {
                                    async: false,
                                    url: $('#category_form').attr('data-exit-url'),
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
                          $('#category_form').find('span#sid').addClass("spinner-border spinner-border-sm");
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

                    $(document).on('click','.file-upload-browse1', function() {
                    var file = $(this).parents().find('.file-upload-default1');
                    file.trigger('click');
                    });
                    $(document).on('click','.file-upload-clear1',function() {
                    $('.file-upload-default1').val('');
                    $('.file-upload-default1').trigger('change');
                    });

                    $(document).on('change', '.file-upload-default1', function() {
                    var el = $(this) ;
                    var preview1 = $('#preview1') ;
                    if(el.val() && el.valid()) {
                        readURL(this);
                        el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
                        return true ;
                    }

                    preview1.attr('src', preview1.data('default'));
                    el.val('');
                    el.parent().find('.form-control').val(el.val().replace(/C:\\fakepath\\/i, '') );
                    });

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


                    var readURL = function (input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#preview1').attr('src', e.target.result)
                        }
                        reader.readAsDataURL(input.files[0]);
                    }

                    }

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