
// Favicon
$.validator.addMethod('filesize', function (value, element, param) {
    if (element.files.length) {
        return this.optional(element) || (element.files[0].size <= param)
    }
    return true;
}, 'File size must be less than 5mb.');

$(document).ready(function ()   {

    $(document).on('click','.file-upload-browse', function() {
        var file = $(this).parents().find('.file-upload-default');
        file.trigger('click');
    });

    $(document).on('click','.file-upload-clear',function() {
        $('.file-upload-default').val('');
        $('.file-upload-default').trigger('change');
    });

    $(document).on('change', '.file-upload-default', function() {
        var el = $(this) ;
        var preview = $('#preview') ;      

        if(el.val() && el.valid()) {
            readURL(this);
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
                $('#preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change','#changeIcon', function(e) {
        var el = $(this);
        var target = el.data('target');
        if(e.icon != 'empty') {
            $(target).val(e.icon)
        }        
    });


});

// Logo

$(document).ready(function ()   {

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
        var preview = $('#preview1') ;      

        if(el.val() && el.valid()) {
            readURL(this);
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

    $(document).on('change','#changeIcon', function(e) {
        var el = $(this);
        var target = el.data('target');
        if(e.icon != 'empty') {
            $(target).val(e.icon)
        }        
    });


});