// Custom jQuery
// ----------------------------------- 


(function(window, document, $, undefined){

  $(function(){

      //
      // Filtering by Columns table 1
      //

      var training_centers = $('#training_centers').dataTable({
          responsive: true,
          'paging':   false,  // Table pagination
          'ordering': true,  // Column ordering
          'info':     false,  // Bottom left status text
          // Text translation options
          // Note the required keywords between underscores (e.g _MENU_)
          oLanguage: {
              sSearch:      'Search all columns: ',
              sLengthMenu:  '_MENU_ records per page',
              info:         'Showing page _PAGE_ of _PAGES_',
              zeroRecords:  'Nothing found - sorry',
              infoEmpty:    'No records available',
              infoFiltered: '(filtered from _MAX_ total records)'
          }
      });
      var inputSearchClass = 'datatable_input_col_search';
      var columnInputs = $('thead .'+inputSearchClass);

      // On input keyup trigger filtering
      columnInputs
          .keyup(function () {
              training_centers.fnFilter(this.value, columnInputs.index(this));
          });

    //
    // Filtering by Columns table 1
    //

    var dtInstance1 = $('#datatable1').dataTable({
        responsive: true,
        'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering
        'info':     true,  // Bottom left status text
        // Text translation options
        // Note the required keywords between underscores (e.g _MENU_)
        oLanguage: {
            sSearch:      'Search all columns: ',
            sLengthMenu:  '_MENU_ records per page',
            info:         'Showing page _PAGE_ of _PAGES_',
            zeroRecords:  'Nothing found - sorry',
            infoEmpty:    'No records available',
            infoFiltered: '(filtered from _MAX_ total records)'
        }
    });
    var inputSearchClass = 'datatable_input_col_search';
    var columnInputs = $('thead .'+inputSearchClass);

    // On input keyup trigger filtering
    columnInputs
      .keyup(function () {
          dtInstance1.fnFilter(this.value, columnInputs.index(this));
      });

       var dtInstance2 = $('#datatable2').dataTable({
         responsive: true,
        'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering
        'info':     true,  // Bottom left status text
        // Text translation options
        // Note the required keywords between underscores (e.g _MENU_)
        oLanguage: {
            sSearch:      'Search all columns: ',
            sLengthMenu:  '_MENU_  records per page',
            info:         'Showing page _PAGE_ of _PAGES_',
            zeroRecords:  'Nothing found - sorry',
            infoEmpty:    'No records available',
            infoFiltered: '(filtered from _MAX_ total records)'
        }
    });
    var inputSearchClass = 'datatable_input_col_search';
    var columnInputs = $('thead .'+inputSearchClass);

    // On input keyup trigger filtering
    columnInputs
      .keyup(function () {
          dtInstance2.fnFilter(this.value, columnInputs.index(this));
      });
       var dtInstance3 = $('#datatable3').dataTable({
           responsive: true,
        'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering
        'info':     true,  // Bottom left status text
        // Text translation options
        // Note the required keywords between underscores (e.g _MENU_)
        oLanguage: {
            sSearch:      'Search all columns: ',
            sLengthMenu:  '_MENU_  records per page',
            info:         'Showing page _PAGE_ of _PAGES_',
            zeroRecords:  'Nothing found - sorry',
            infoEmpty:    'No records available',
            infoFiltered: '(filtered from _MAX_ total records)'
        }
    });
    var inputSearchClass = 'datatable_input_col_search';
    var columnInputs = $('thead .'+inputSearchClass);

    // On input keyup trigger filtering
    columnInputs
      .keyup(function () {
          dtInstance3.fnFilter(this.value, columnInputs.index(this));
      });

  });

})(window, document, window.jQuery);
