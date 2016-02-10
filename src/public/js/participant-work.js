$(function(){

    $("body").on('change', '.province', function(){

        $('#district').prop('disabled', true);
        var province_code = $(this).val();
        var my_districts = [];
        $.ajax({
            type: "GET",
            url: "/province/districts/" + province_code, //
            success: function(districts){
                console.log(districts[0]);

                my_districts = districts[0];
                $('#district').prop('disabled', false);

                $( "#district" ).autocomplete({
                    source: my_districts
                });
            },
            error: function(){
                alert("failure");
            }
        });
    });
    // listing districts according to thier provices - STOP

    // Sign up villages autocomplete - START
    $("body").on('change', '.districts-select', function(){
        var district_code = $(this).val();
        if(district_code == "other"){
            $("#district_other").show();
        } else {
            $("#district_other").hide();
        }

        $('#villages').prop('disabled', true);
        var my_villages = [];
        $.ajax({
            type: "GET",
            url: "/province/districts/villages/" + district_code, //
            success: function(villages){
                console.log("THIS IS: " + villages);
                my_villages = villages;
                $('#villages').prop('disabled', false);

                $( "#villages" ).autocomplete({
                    source: my_villages
                });
            },
            error: function(){
                alert("failure");
            }
        });
    });

    $( "#fromNew" ).datepicker({
        dateFormat: 'dd M yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "c-40:c+10",
        maxDate: 'today',
        onClose: function( selectedDate ) {
            $( "#to" ).datepicker( "option", "minDate", selectedDate );
        }
    }).attr('readonly', 'readonly');

    $( "#to" ).datepicker({
        dateFormat: 'dd M yy',
        changeMonth: true,
        changeYear: true,
        yearRange: "c-30:c+20",
        maxDate: 'today',
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
        $('#add_new_work').ajaxForm(options);
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