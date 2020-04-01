//== Class Definition
var ValidationControls = function() {

    
    $("#category").select2({
        allowClear:true,
        placeholder: 'Select Category',
           multiple:false
      }); 
    $("#subcategory").select2({
        allowClear:true,
        placeholder: 'Select Sub Category',
           multiple:false
      });
 
    var formValidation = function() {
       
                       $('#attribute_form').validate({   
                        debug: false,
                        ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
                        rules: {


                            subcategory: {
                                // required: true,
                                remote: {
                                    async: false,
                                    url: $('#attribute_form').attr('data-exit-url'),
                                    type: "post",
                                    data: {
                                        
                                        form_field: function () {
                                            return $("#category").val();
                                        },
                                        id: function ()
                                        {
                                            return $("#id").val();
                                        },
                                        db_field: function () {
                                            return 'category_id';
                                        },
                                        table: function () {
                                            return 'post_attributes';
                                        },
                                        condition_form_field: function () {
                                            return $("#subcategory").val();
                                        },
                                        condition_db_field: function () {
                                            return 'sub_category_id';
                                        }
                                    }
                                }
                            }

                            
                            },
                        messages: {

                             subcategory:{
                                 remote: "Post Attribute is already exits."
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
                                        $('#attribute_form').find('span#sid').addClass("spinner-border spinner-border-sm");
                                                            return true;
                        }
                    })
           

            
        
    }
    var formRepeater = function() {
        $('.repeater').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            initEmpty: true,
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            defaultValues: {
                'text-input': 'foo'
            },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            show: function () {
                $(this).slideDown();
       
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // (Optional)
            // You can use this if you need to manually re-index the list
            // for example if you are using a drag and drop library to reorder
            // list items.
            ready: function (setIndexes) {
                //$dragAndDrop.on('drop', setIndexes);
            },
            // (Optional)
            // Removes the delete button from the first list item,
            // defaults to false.
            isFirstItemUndeletable: true
        })

    }


    
    //== Public Functions
    return {
        // public functions
        init: function() {
           formValidation();
           formRepeater();
         
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    ValidationControls.init();
});