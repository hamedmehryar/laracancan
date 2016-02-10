/**
 * Created by mustafaehsan on 8/16/15.
 */

window.ParsleyValidator
    .addValidator('filetype', function (val, req) {
        var reqs = req.split('|');
        var field_name = reqs[0];
        var valid_exts = reqs[1].split(',');
        var error_message = reqs[2];

        var path = document.getElementById(field_name).value;
        var ext = path.substring(path.lastIndexOf(".")+1, path.length);
        var is_valid = $.inArray(ext, valid_exts) > -1;
        var error_field = $('.' + field_name + '_error');


        if(!is_valid){
            error_field.show().html(error_message + valid_exts.join(', '));
            return false;
        }

        error_field.hide();
        return true;
    }, 32);