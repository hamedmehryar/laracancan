// Forms Demo
// ----------------------------------- 


(function(window, document, $, undefined){

  $(function(){

    // BOOTSTRAP SLIDER CTRL
    // ----------------------------------- 

    $('[data-ui-slider]').slider();

    // CHOSEN
    // ----------------------------------- 

    $('.chosen-select').chosen().change(function(evt, params){
        var deselected = params.deselected;
        var option = $(".chosen-select option[value='"+ deselected +"']");

        $('<input>').attr({
            type: 'hidden',
            class: 'foo',
            value: deselected,
            name: 'deselects[]'
        }).appendTo('#interests-form');

        console.log(option);
    });


      // MASKED
    // ----------------------------------- 

    $('[data-masked]').inputmask();

    // FILESTYLE
    // ----------------------------------- 

    $('.filestyle').filestyle();

    // WYSIWYG
    // ----------------------------------- 

    $('.wysiwyg').wysiwyg();


    // DATETIMEPICKER
    // ----------------------------------- 

    $('#datetimepicker1').datetimepicker({
      icons: {
          time: 'fa fa-clock-o',
          date: 'fa fa-calendar',
          up: 'fa fa-chevron-up',
          down: 'fa fa-chevron-down',
          previous: 'fa fa-chevron-left',
          next: 'fa fa-chevron-right',
          today: 'fa fa-crosshairs',
          clear: 'fa fa-trash'
        }
    });
    // only time
    $('#datetimepicker2').datetimepicker({
        format: 'LT'
    });

  });

})(window, document, window.jQuery);