var educationStatus = $("input[name='graduation']:radio").val();
$(function(){

        $("input[name='graduation']:radio").change(function () {
            educationStatus = $(this).val();
            //alert(status);
            if(educationStatus == "progress"){
                $("#form-group-diploma_expected").show();
                $("#form-group-diploma_awarded").hide();
                $("#form-group-diploma_not_available").hide();

                if($('#calendar_type').val() == "en"){
                    $("#diploma_expected").attr('required', 'required');
                    $("#diploma_awarded").removeAttr('required').val('');
                    $("#diploma_not_available").removeAttr('required').val('');
                }else{
                    $("#diploma_expectedP").attr('required', 'required');
                    $("#diploma_awardedP").removeAttr('required').val('');
                    $("#diploma_not_available").removeAttr('required').val('');
                }
            } else if (educationStatus == "graduated") {
                $("#form-group-diploma_expected").hide();
                $("#form-group-diploma_awarded").show();
                $("#form-group-diploma_not_available").hide();
                if($('#calendar_type').val() == "en"){
                    $("#diploma_expected").removeAttr('required').val('');
                    $("#diploma_awarded").attr('required', 'required');
                    $("#diploma_not_available").removeAttr('required').val('');
                }else{
                    $("#diploma_expectedP").removeAttr('required').val('');
                    $("#diploma_awardedP").attr('required', 'required');
                    $("#diploma_not_available").removeAttr('required').val('');
                }
            } else {
                $("#form-group-diploma_expected").hide();
                $("#form-group-diploma_awarded").hide();
                $("#form-group-diploma_not_available").show();
                if($('#calendar_type').val() == "en"){
                    $("#diploma_expected").removeAttr('required').val('');
                    $("#diploma_awarded").removeAttr('required').val('');
                    $("#diploma_not_available").attr('required', 'required');
                }else{
                    $("#diploma_expectedP").removeAttr('required').val('');
                    $("#diploma_awardedP").removeAttr('required').val('');
                    $("#diploma_not_available").attr('required', 'required');
                }
            }
        });

    $("body").on('change', '#education_type', function(){
        if($(this).val() == "other"){
            $("#education_other").show();
            $("#education_other").attr('required', 'required');
        } else {
            $("#education_other").removeAttr('required');
            $("#education_other").hide();

        }
    });


    /* Backup

     var d = new Date();
     var year = d.getFullYear();
     d.setFullYear(year);

    $("#diploma_awarded1").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "c-30:c",
        maxDate: new Date(),
        defaultDate: d,

        onClose: function(dateText, inst) {
            var month = inst['drawMonth'];
            var year = inst['drawYear'];
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
            $( "#to" ).datepicker( "option", "maxDate", new Date(year, month, 1) );
            $( "#fromNew" ).datepicker( "option", "maxDate", new Date(year, month, 1) );
        }
    }).attr('readonly', 'readonly');

    $("#diploma_awarded1").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });

    var d = new Date();
    var year = d.getFullYear();
    d.setFullYear(year);

    $("#diploma_expected1").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "c:c+20",
        minDate: new Date(),
        defaultDate: d,

        onClose: function(dateText, inst) {
            var month = inst['drawMonth'];
            var year = inst['drawYear'];
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
            $( "#to" ).datepicker( "option", "maxDate", new Date(year, month, 1) );
            $( "#fromNew" ).datepicker( "option", "maxDate", new Date(year, month, 1) );
        }
    }).attr('readonly', 'readonly');

    $("#diploma_expected1").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });
    */

    var d = new Date();
    var year = d.getFullYear();
    d.setFullYear(year);

    $("#diploma_awarded").datepicker({
        dateFormat: 'dd MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "c-30:c",
        maxDate: new Date(),
        defaultDate: d,

        onClose: function(dateText, inst) {
            console.log(inst);
            var month = inst['drawMonth'];
            var year = inst['drawYear'];
            var day = inst['selectedDay'];
            $( "#to" ).datepicker( "option", "maxDate", new Date(year, month, day) );
            $( "#fromNew" ).datepicker( "option", "maxDate", new Date(year, month, day) );
        }
    }).attr('readonly', 'readonly');


    var d = new Date();
    var year = d.getFullYear();
    d.setFullYear(year);

    $("#diploma_expected").datepicker({
        dateFormat: 'dd MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "c:c+20",
        minDate: new Date(),
        defaultDate: d,

        onClose: function(dateText, inst) {
            console.log(inst);
            var month = inst['drawMonth'];
            var year = inst['drawYear'];
            var day = inst['selectedDay'];
            $( "#to" ).datepicker( "option", "maxDate", new Date(year, month, day) );
            $( "#fromNew" ).datepicker( "option", "maxDate", new Date(year, month, day) );
        }
    }).attr('readonly', 'readonly');


    $( "#fromNew" ).datepicker({
        dateFormat: 'dd MM yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "c-40:c+10",
        onClose: function( selectedDate ) {
            $( "#to" ).datepicker( "option", "minDate", selectedDate );
        }
    }).attr('readonly', 'readonly');

    $( "#to" ).datepicker({
        dateFormat: 'dd MM yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "c-30:c+20",
        onClose: function( selectedDate ) {
            $( "#fromNew" ).datepicker( "option", "maxDate", selectedDate );
        }
    }).attr('readonly', 'readonly');

    // prepare the form when the DOM is ready
    $(document).ready(function() {
        var options = {
            //target:        '',   // target element(s) to be updated with server response
            beforeSubmit:  showRequest,  // pre-submit callback
            success:       showResponse  // post-submit callback

            // other available options:
            //url:       '/applicant/applications/education'         // override for form's 'action' attribute
            //type:      type        // 'get' or 'post', override for form's 'method' attribute
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
            //clearForm: true        // clear all form fields after successful submit
            //resetForm: true        // reset the form after successful submit

            // $.ajax options can be used here too, for example:
            //timeout:   3000
        };

        // bind form using 'ajaxForm'
        $('#add_new_education').ajaxForm(options);
    });

// pre-submit callback
    function showRequest(formData, jqForm, options) {
        // formData is an array; here we use $.param to convert it to a string to display it
        // but the form plugin does this for you automatically when it submits the data
        var queryString = $.param(formData);
        $('#save_changes_button').hide();
        $('#save_changes_loading').show();
        return true;
    }

// post-submit callback
    function showResponse(responseText, statusText, xhr, $form)  {
        if(responseText[0] == "error"){
            $(".error-field").show();
            $("#errors-ul").html('');
            $('#save_changes_button').show();
            $('#save_changes_loading').hide();
            $.each(responseText[1], function( index, value ) {
                $("#errors-ul").append('<li>' + value[0] + '</li>');
                console.log(value[0]);
            });
        } else if(responseText[0] == "success") {
            console.log('success');

            $('#save_changes_button').hide();
            $('#save_changes_loading').hide();
            $("#save_changes_success").show();
            $(".error-field").hide();
            $("#success-message").show().html(responseText[1]);
            setTimeout(
                function()
                {

                    window.location.reload(true);
                }, 1000
            );


        } else {}
    }
});