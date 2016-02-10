/*!
 * 
 * Angle - Bootstrap Admin App + jQuery
 * 
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: http://support.wrapbootstrap.com/knowledge_base/topics/usage-licenses
 * 
 */

var chatUploading = false;
var timeoutCount = 0;
$(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
  if(xhr.status != 500 && thrownError === "timeout"){
    timeoutCount++;
    if(timeoutCount > 3){
      $("#timeoutOops").modal('show');
    }
  }
});
(function(window, document, $, undefined){

  if (typeof $ === 'undefined') { throw new Error('This application\'s JavaScript requires jQuery'); }

  $(function(){

    // Restore body classes
    // ----------------------------------- 
    var $body = $('body');
    new StateToggler().restoreState( $body );
    
    // enable settings toggle after restore
    $('#chk-fixed').prop('checked', $body.hasClass('layout-fixed') );
    $('#chk-collapsed').prop('checked', $body.hasClass('aside-collapsed') );
    $('#chk-boxed').prop('checked', $body.hasClass('layout-boxed') );
    $('#chk-float').prop('checked', $body.hasClass('aside-float') );
    $('#chk-hover').prop('checked', $body.hasClass('aside-hover') );


  }); // doc ready


})(window, document, window.jQuery);

// Start Bootstrap JS
// ----------------------------------- 

(function(window, document, $, undefined){

  $(function(){

    // POPOVER
    // ----------------------------------- 

    $('[data-toggle="popover"]').popover();

    // TOOLTIP
    // ----------------------------------- 

    $('[data-toggle="tooltip"]').tooltip({
      container: 'body'
    });

    // DROPDOWN INPUTS
    // ----------------------------------- 
    $('.dropdown input').on('click focus', function(event){
      event.stopPropagation();
    });

  });

})(window, document, window.jQuery);

/**=========================================================
 * Module: clear-storage.js
 * Removes a key from the browser storage via element click
 =========================================================*/

(function($, window, document){
  'use strict';

  var Selector = '[data-reset-key]';

  $(document).on('click', Selector, function (e) {
      e.preventDefault();
      var key = $(this).data('resetKey');
      
      if(key) {
        $.localStorage.remove(key);
        // reload the page
        window.location.reload();
      }
      else {
        $.error('No storage key specified for reset.');
      }
  });

}(jQuery, window, document));

// GLOBAL CONSTANTS
// ----------------------------------- 


(function(window, document, $, undefined){

  window.APP_COLORS = {
    'primary':                '#5d9cec',
    'success':                '#27c24c',
    'info':                   '#23b7e5',
    'warning':                '#ff902b',
    'danger':                 '#f05050',
    'inverse':                '#131e26',
    'green':                  '#37bc9b',
    'pink':                   '#f532e5',
    'purple':                 '#7266ba',
    'dark':                   '#C4C6C7',
    'yellow':                 '#fad732',
    'gray-darker':            '#232735',
    'gray-dark':              '#C4C6C7',
    'gray':                   '#dde6e9',
    'gray-light':             '#e4eaec',
    'gray-lighter':           '#edf1f2'
  };
  
  window.APP_MEDIAQUERY = {
    'desktopLG':             1200,
    'desktop':                992,
    'tablet':                 768,
    'mobile':                 480
  };

})(window, document, window.jQuery);


// TRANSLATION
// ----------------------------------- 

(function(window, document, $, undefined){

  var preferredLang = 'en';
  var pathPrefix    = 'i18n'; // folder of json files
  var packName      = 'site';
  var storageKey    = 'jq-appLang';

  $(function(){

    if ( ! $.fn.localize ) return;

    // detect saved language or use default
    var currLang = $.localStorage.get(storageKey) || preferredLang;
    // set initial options
    var opts = {
        language: currLang,
        pathPrefix: pathPrefix,
        callback: function(data, defaultCallback){
          $.localStorage.set(storageKey, currLang); // save the language
          defaultCallback(data);
        }
      };

    // Set initial language

    // Listen for changes
    $('[data-set-lang]').on('click', function(){

      currLang = $(this).data('setLang');

      if ( currLang ) {
        
        opts.language = currLang;


        activateDropdown($(this));
      }

    });
    

    function setLanguage(options) {
      $("[data-localize]").localize(packName, options);
    }

    // Set the current clicked text as the active dropdown text
    function activateDropdown(elem) {
      var menu = elem.parents('.dropdown-menu');
      if ( menu.length ) {
        var toggle = menu.prev('button, a');
        toggle.text ( elem.text() );
      }
    }

  });

})(window, document, window.jQuery);

// NAVBAR SEARCH
// ----------------------------------- 


(function(window, document, $, undefined){

  $(function(){
    
    var navSearch = new navbarSearchInput();
    
    // Open search input 
    var $searchOpen = $('[data-search-open]');

    $searchOpen
      .on('click', function (e) { e.stopPropagation(); })
      .on('click', navSearch.toggle);

    // Close search input
    var $searchDismiss = $('[data-search-dismiss]');
    var inputSelector = '.navbar-form input[type="text"]';

    $(inputSelector)
      .on('click', function (e) { e.stopPropagation(); })
      .on('keyup', function(e) {
        if (e.keyCode == 27) // ESC
          navSearch.dismiss();
      });
      
    // click anywhere closes the search
    $(document).on('click', navSearch.dismiss);
    // dismissable options
    $searchDismiss
      .on('click', function (e) { e.stopPropagation(); })
      .on('click', navSearch.dismiss);

  });

  var navbarSearchInput = function() {
    var navbarFormSelector = 'form.navbar-form';
    return {
      toggle: function() {
        
        var navbarForm = $(navbarFormSelector);

        navbarForm.toggleClass('open');
        
        var isOpen = navbarForm.hasClass('open');
        
        navbarForm.find('input')[isOpen ? 'focus' : 'blur']();

      },

      dismiss: function() {
        $(navbarFormSelector)
          .removeClass('open')      // Close control
          .find('input[type="text"]').blur() // remove focus
          .val('')                    // Empty input
          ;
      }
    };

  }

})(window, document, window.jQuery);
// SIDEBAR
// ----------------------------------- 


(function(window, document, $, undefined){

  var $win;
  var $html;
  var $body;
  var $sidebar;
  var mq;

  $(function(){

    $win     = $(window);
    $html    = $('html');
    $body    = $('body');
    $sidebar = $('.sidebar');
    mq       = APP_MEDIAQUERY;
    
    // AUTOCOLLAPSE ITEMS 
    // ----------------------------------- 

    var sidebarCollapse = $sidebar.find('.collapse');
    sidebarCollapse.on('show.bs.collapse', function(event){

      event.stopPropagation();
      if ( $(this).parents('.collapse').length === 0 )
        sidebarCollapse.filter('.in').collapse('hide');

    });
    
    // SIDEBAR ACTIVE STATE 
    // ----------------------------------- 
    
    // Find current active item
    var currentItem = $('.sidebar .active').parents('li');

    // hover mode don't try to expand active collapse
    if ( ! useAsideHover() )
      currentItem
        .addClass('active')     // activate the parent
        .children('.collapse')  // find the collapse
        .collapse('show');      // and show it

    // remove this if you use only collapsible sidebar items
    $sidebar.find('li > a + ul').on('show.bs.collapse', function (e) {
      if( useAsideHover() ) e.preventDefault();
    });

    // SIDEBAR COLLAPSED ITEM HANDLER
    // ----------------------------------- 


    var eventName = isTouch() ? 'click' : 'mouseenter' ;
    var subNav = $();
    $sidebar.on( eventName, '.nav > li', function() {

      if( isSidebarCollapsed() || useAsideHover() ) {

        subNav.trigger('mouseleave');
        subNav = toggleMenuItem( $(this) );

        // Used to detect click and touch events outside the sidebar          
        sidebarAddBackdrop();
      }

    });

    var sidebarAnyclickClose = $sidebar.data('sidebarAnyclickClose');

    // Allows to close
    if ( typeof sidebarAnyclickClose !== 'undefined' ) {

      $('.wrapper').on('click.sidebar', function(e){
        // don't check if sidebar not visible
        if( ! $body.hasClass('aside-toggled')) return;

        var $target = $(e.target);
        if( ! $target.parents('.aside').length && // if not child of sidebar
            ! $target.is('#user-block-toggle') && // user block toggle anchor
            ! $target.parent().is('#user-block-toggle') // user block toggle icon
          ) {
                $body.removeClass('aside-toggled');          
        }

      });
    }

  });

  function sidebarAddBackdrop() {
    var $backdrop = $('<div/>', { 'class': 'dropdown-backdrop'} );
    $backdrop.insertAfter('.aside').on("click mouseenter", function () {
      removeFloatingNav();
    });
  }

  // Open the collapse sidebar submenu items when on touch devices 
  // - desktop only opens on hover
  function toggleTouchItem($element){
    $element
      .siblings('li')
      .removeClass('open')
      .end()
      .toggleClass('open');
  }

  // Handles hover to open items under collapsed menu
  // ----------------------------------- 
  function toggleMenuItem($listItem) {

    removeFloatingNav();

    var ul = $listItem.children('ul');
    
    if( !ul.length ) return $();
    if( $listItem.hasClass('open') ) {
      toggleTouchItem($listItem);
      return $();
    }

    var $aside = $('.aside');
    var $asideInner = $('.aside-inner'); // for top offset calculation
    // float aside uses extra padding on aside
    var mar = parseInt( $asideInner.css('padding-top'), 0) + parseInt( $aside.css('padding-top'), 0);

    var subNav = ul.clone().appendTo( $aside );
    
    toggleTouchItem($listItem);

    var itemTop = ($listItem.position().top + mar) - $sidebar.scrollTop();
    var vwHeight = $win.height();

    subNav
      .addClass('nav-floating')
      .css({
        position: isFixed() ? 'fixed' : 'absolute',
        top:      itemTop,
        bottom:   (subNav.outerHeight(true) + itemTop > vwHeight) ? 0 : 'auto'
      });

    subNav.on('mouseleave', function() {
      toggleTouchItem($listItem);
      subNav.remove();
    });

    return subNav;
  }

  function removeFloatingNav() {
    $('.sidebar-subnav.nav-floating').remove();
    $('.dropdown-backdrop').remove();
    $('.sidebar li.open').removeClass('open');
  }

  function isTouch() {
    return $html.hasClass('touch');
  }
  function isSidebarCollapsed() {
    return $body.hasClass('aside-collapsed');
  }
  function isSidebarToggled() {
    return $body.hasClass('aside-toggled');
  }
  function isMobile() {
    return $win.width() < mq.tablet;
  }
  function isFixed(){
    return $body.hasClass('layout-fixed');
  }
  function useAsideHover() {
    return $body.hasClass('aside-hover');
  }

})(window, document, window.jQuery);
// TOGGLE STATE
// ----------------------------------- 

(function(window, document, $, undefined){

  $(function(){

    var $body = $('body');
        toggle = new StateToggler();

    $('[data-toggle-state]')
      .on('click', function (e) {
        // e.preventDefault();
        e.stopPropagation();
        var element = $(this),
            classname = element.data('toggleState'),
            noPersist = (element.attr('data-no-persist') !== undefined);

        if(classname) {
          if( $body.hasClass(classname) ) {
            $body.removeClass(classname);
            if( ! noPersist)
              toggle.removeState(classname);
          }
          else {
            $body.addClass(classname);
            if( ! noPersist)
              toggle.addState(classname);
          }
          
        }
        // some elements may need this when toggled class change the content size
        // e.g. sidebar collapsed mode and jqGrid
        $(window).resize();

    });

  });

  // Handle states to/from localstorage
  window.StateToggler = function() {

    var storageKeyName  = 'jq-toggleState';

    // Helper object to check for words in a phrase //
    var WordChecker = {
      hasWord: function (phrase, word) {
        return new RegExp('(^|\\s)' + word + '(\\s|$)').test(phrase);
      },
      addWord: function (phrase, word) {
        if (!this.hasWord(phrase, word)) {
          return (phrase + (phrase ? ' ' : '') + word);
        }
      },
      removeWord: function (phrase, word) {
        if (this.hasWord(phrase, word)) {
          return phrase.replace(new RegExp('(^|\\s)*' + word + '(\\s|$)*', 'g'), '');
        }
      }
    };

    // Return service public methods
    return {
      // Add a state to the browser storage to be restored later
      addState: function(classname){
        var data = $.localStorage.get(storageKeyName);
        
        if(!data)  {
          data = classname;
        }
        else {
          data = WordChecker.addWord(data, classname);
        }

        $.localStorage.set(storageKeyName, data);
      },

      // Remove a state from the browser storage
      removeState: function(classname){
        var data = $.localStorage.get(storageKeyName);
        // nothing to remove
        if(!data) return;

        data = WordChecker.removeWord(data, classname);

        $.localStorage.set(storageKeyName, data);
      },
      
      // Load the state string and restore the classlist
      restoreState: function($elem) {
        var data = $.localStorage.get(storageKeyName);
        
        // nothing to restore
        if(!data) return;
        $elem.addClass(data);
      }

    };
  };

})(window, document, window.jQuery);

/**=========================================================
 * Module: utils.js
 * jQuery Utility functions library 
 * adapted from the core of UIKit
 =========================================================*/

(function($, window, doc){
    'use strict';
    
    var $html = $("html"), $win = $(window);

    $.support.transition = (function() {

        var transitionEnd = (function() {

            var element = doc.body || doc.documentElement,
                transEndEventNames = {
                    WebkitTransition: 'webkitTransitionEnd',
                    MozTransition: 'transitionend',
                    OTransition: 'oTransitionEnd otransitionend',
                    transition: 'transitionend'
                }, name;

            for (name in transEndEventNames) {
                if (element.style[name] !== undefined) return transEndEventNames[name];
            }
        }());

        return transitionEnd && { end: transitionEnd };
    })();

    $.support.animation = (function() {

        var animationEnd = (function() {

            var element = doc.body || doc.documentElement,
                animEndEventNames = {
                    WebkitAnimation: 'webkitAnimationEnd',
                    MozAnimation: 'animationend',
                    OAnimation: 'oAnimationEnd oanimationend',
                    animation: 'animationend'
                }, name;

            for (name in animEndEventNames) {
                if (element.style[name] !== undefined) return animEndEventNames[name];
            }
        }());

        return animationEnd && { end: animationEnd };
    })();

    $.support.requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.msRequestAnimationFrame || window.oRequestAnimationFrame || function(callback){ window.setTimeout(callback, 1000/60); };
    $.support.touch                 = (
        ('ontouchstart' in window && navigator.userAgent.toLowerCase().match(/mobile|tablet/)) ||
        (window.DocumentTouch && document instanceof window.DocumentTouch)  ||
        (window.navigator['msPointerEnabled'] && window.navigator['msMaxTouchPoints'] > 0) || //IE 10
        (window.navigator['pointerEnabled'] && window.navigator['maxTouchPoints'] > 0) || //IE >=11
        false
    );
    $.support.mutationobserver      = (window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver || null);

    $.Utils = {};

    $.Utils.debounce = function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    $.Utils.removeCssRules = function(selectorRegEx) {
        var idx, idxs, stylesheet, _i, _j, _k, _len, _len1, _len2, _ref;

        if(!selectorRegEx) return;

        setTimeout(function(){
            try {
              _ref = document.styleSheets;
              for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                stylesheet = _ref[_i];
                idxs = [];
                stylesheet.cssRules = stylesheet.cssRules;
                for (idx = _j = 0, _len1 = stylesheet.cssRules.length; _j < _len1; idx = ++_j) {
                  if (stylesheet.cssRules[idx].type === CSSRule.STYLE_RULE && selectorRegEx.test(stylesheet.cssRules[idx].selectorText)) {
                    idxs.unshift(idx);
                  }
                }
                for (_k = 0, _len2 = idxs.length; _k < _len2; _k++) {
                  stylesheet.deleteRule(idxs[_k]);
                }
              }
            } catch (_error) {}
        }, 0);
    };

    $.Utils.isInView = function(element, options) {

        var $element = $(element);

        if (!$element.is(':visible')) {
            return false;
        }

        var window_left = $win.scrollLeft(),
            window_top  = $win.scrollTop(),
            offset      = $element.offset(),
            left        = offset.left,
            top         = offset.top;

        options = $.extend({topoffset:0, leftoffset:0}, options);

        if (top + $element.height() >= window_top && top - options.topoffset <= window_top + $win.height() &&
            left + $element.width() >= window_left && left - options.leftoffset <= window_left + $win.width()) {
          return true;
        } else {
          return false;
        }
    };

    $.Utils.options = function(string) {

        if ($.isPlainObject(string)) return string;

        var start = (string ? string.indexOf("{") : -1), options = {};

        if (start != -1) {
            try {
                options = (new Function("", "var json = " + string.substr(start) + "; return JSON.parse(JSON.stringify(json));"))();
            } catch (e) {}
        }

        return options;
    };

    $.Utils.events       = {};
    $.Utils.events.click = $.support.touch ? 'tap' : 'click';

    $.langdirection = $html.attr("dir") == "rtl" ? "right" : "left";

    $(function(){

        // Check for dom modifications
        if(!$.support.mutationobserver) return;

        // Install an observer for custom needs of dom changes
        var observer = new $.support.mutationobserver($.Utils.debounce(function(mutations) {
            $(doc).trigger("domready");
        }, 300));

        // pass in the target node, as well as the observer options
        observer.observe(document.body, { childList: true, subtree: true });

    });

    // add touch identifier class
    $html.addClass($.support.touch ? "touch" : "no-touch");

}(jQuery, window, document));
// Custom jQuery
// ----------------------------------- 


(function(window, document, $, undefined){

  $(function(){

    // document ready

  });

})(window, document, window.jQuery);




//////some General js functions/////////////////
function showModalUntilAjaxResponse(modalId){
  $('.pace').removeClass('pace-inactive');
  $('.pace').addClass('pace-active');
  $('.pace').find('.pace-progress').css('-webkit-transform','translate3d(0, 0px, 0px)');
  $('.pace').find('.pace-progress').css('transform','translate3d(0, 0px, 0px)');
  $('#page-overlay').show();
}
function getContentWithAjax(url, responseDiv, isClass){

  $.ajax({
    url: url,
    success: function(data){
      if(data != "LOGOUT"){
        $('#page-overlay').hide();
        $('#general_modal').modal('show');

        if(isClass)
          $("#general_modal").find("."+responseDiv).html(data);
        else{
          $("#"+responseDiv).html(data);
        }
        $('.pace').removeClass('pace-active');
        $('.pace').addClass('pace-inactive');
      }else{

        window.location = 'login';

      }
    },
    error: function(xhr,textStatus,errorThrown) {
      //alert('test');
      if(xhr.status == 401){
        if(xhr.responseText == "LOGOUT"){
          window.location.replace('/login');
        }else if(xhr.responseText == "LOCK"){
          alert("session LOCKED!!!");
        }
      }
    }
  });

}


function getContentWithAjaxOb(url, responseDiv, isClass){

  $.ajax({
    url: url,
    success: function(data){
      if(data != "LOGOUT"){
        $('#page-overlay').hide();
        $('#observation_modal').modal('show');
        if(isClass)
          $("#observation_modal").find("."+responseDiv).html(data);
        else{
          $("#"+responseDiv).html(data);
        }
        $('.pace').removeClass('pace-active');
        $('.pace').addClass('pace-inactive');
      }else{

        window.location = 'login';

      }
    }
  });

}

$('#success_message').delay(5000).slideUp(300);
$('#error_message').delay(5000).slideUp(300);
$('#warn_message').delay(5000).slideUp(300);




// validate curriculum
function validateCurriculum()
{
  var valid = true;
  var input =  $('#name').val();
  //$('#error').hide();
  // if (input == '') {
  //   $('#nameLabel').after('<span id="err_msg" style="color:red;"> Please enter a Name !</span>');
  //   isValid = false;
  // }
  // if (input.length <= 3) {
  //   $('#nameLabel').after('<span id="err_msg" style="color:red;"> Name field should not be less then 3 character!</span>');
  //   isValid = false;
  // }
  if(input == ''){
          $('#name_err').show();
          valid = false;
      }else{
        $('#name_err').hide();
        if(input.length < 3){
          $('#name_err2').show();
          valid = false;
        }
      }
  return valid;

}
//validate wld materials
function validateMaterial()
{ 
    var validFiles = ['png','gif','jpeg','doc','pdf','docx','ppt','pptx','mp4','mp3','xls','m4v','avi','flv','mp4','mov','vnd.ms-excel','msexcel','x-msexcel','x-ms-excel','x-excel','x-dos_ms_excel','xls','x-xls','vnd.openxmlformats-officedocument.spreadsheetml.sheet','vnd.ms-office'];

      var name  = $('#name').val();
      var file = document.getElementById("attachments").files[0];

      var valid = true;
      console.log(file);
      if(name == ''){
          $('#name_err').show();
          valid = false;
      }else{
        $('#name_err').hide();
        if(name.length < 3){
          $('#name_err2').show();
          valid = false;
        }
      }
    if (!file) 
    {
        $('#attachment_err').show();
        valid = false;
    }
    else
    { 
          var ext = file.name.split(".");
          ext = ext[ext.length-1];
          if(file.size > 10000000){
            alert('in size');
              $('#attachment_err').hide();
              $('#attachment_err3').show();
              valid = false;
          } 
          console.log(validFiles.indexOf(ext.toLowerCase() == -1));
          if (!validFiles.indexOf(ext.toLowerCase())) {
            alert('in type');
              $('#attachment_err').hide();
              $('#attachment_err2').show();
              valid = false;
          }
    }
      return valid;
}

//validate wld feedback question forms
function validatFbQuestion(){

  $('#curriculum_err').hide();
  $('#section_type_err').hide();
  $('#question_type_err').hide();
  $('#title_err').hide();
  $('#title_err2').hide();
  $('#Qtext_err').hide();
  $('#Qtext_err2').hide();
  $('#title_err_m').hide();
  $('#title_err2_m').hide();
  $('#Qtext_err_m').hide();
  $('#Qtext_err2_m').hide();
  $('#Answers_err_m').hide();
  $('#Answers_err2_m').hide();
  $('#Answers_err3_m').hide();
  $('#title_err_md').hide();
  $('#title_err2_md').hide();
  $('#Qtext_err_md').hide();
  $('#Qtext_err2_md').hide();
  $('#Answers_err_md').hide();
  $('#Answers_err2_md').hide();
  $('#Answers_err3_md').hide();

  var valid = true;
  var curriculums = $('#curriculums').val();
  var section_type = $('#section_type').val();
  var question_type = $('#questiontype').val();

  if (curriculums == '') {
    $('#curriculum_err').show();
    valid = false;
  }

  if (section_type == '') {
    $('#section_type_err').show();
    valid = false;   
  }
  if (question_type == '') {
    $('#question_type_err').show();
    valid = false;
  }else{

  var descriptive = $('.descriptive').css('display');
  var multi_selective = $('.multi-selective').css('display');
  var multi_desc_selective = $('.multi_desc_selective').css('display');

  if (descriptive != "none") {

   var Qtitle = $('#question_title_descriptive').val();
   var Qtext = $('#qtext_o_1').val();

    if (Qtitle == '') 
    {
      $('#title_err').show();
      valid = false;
    }
    else{
      if (Qtitle.length < 2) 
      {
       $('#title_err').hide();
       $('#title_err2').show();
       valid = false;
      }
    } 
    if (Qtext == '') 
    {
      $('#Qtext_err').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err').hide();
       $('#Qtext_err2').show();
       valid = false;
      }
    }
  }
  else if( multi_selective != "none"){

    var Qtitle = $('#question_title_multi_selective').val();
    var Qtext = $('#qtext_o_2').val(); 
    var Qanswers = document.getElementsByName('answers_multi_selective[]'); //console.log(Qanswers); 
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    }
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      { 
        $('#Answers_err_m').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_m').hide();
         $('#Answers_err2_m').show();
         valid = false;
        }
      }
    }
    if (Qtitle == '') 
    {
      $('#title_err_m').show();
      valid = false;
    }
    else
    {
      if (Qtitle.length < 2) 
      {
       $('#title_err_m').hide();
       $('#title_err2_m').show();
       valid = false;
      }
    }
    if (Qtext == '') 
    {
      $('#Qtext_err_m').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_m').hide();
       $('#Qtext_err2_m').show();
       valid = false;
      }
    }
    
    if (QanswersVals.length < 0) {
      $('#Answers_err3_m').show();
      valid = false;
    }

  }
  else if( multi_desc_selective != "none"){

    var Qtitle = $('#question_title_multi_desc_selective').val();
    var Qtext = $('#qtext_o_3').val();
    var Qanswers = document.getElementsByName('answers_multi_desc_selective[]');
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    }
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      {
        $('#Answers_err_md').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_md').hide();
         $('#Answers_err2_md').show();
         valid = false;
        }
      }
    }

    if (Qtitle == '') 
    {
      $('#title_err_md').show();
      valid = false;
    }
    else
    {
      if (Qtitle.length < 2) 
      {
       $('#title_err_md').hide();
       $('#title_err2_md').show();
       valid = false;
      }
    }
    if (Qtext == '') 
    {
      $('#Qtext_err_md').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
      $('#Qtext_err_md').hide();
      $('#Qtext_err2_md').show();
      valid = false;
      }
    }
    
    if (QanswersVals.length < 0) {
      $('#Answers_err3_md').show();
      valid = false;
    }


    
  }else{

  }
 }
return valid;
}
//validate edit feedback questions form
function validatFbQuestion_e(){

  $('#curriculum_err').hide();
  $('#section_type_err').hide();
  $('#question_type_err').hide();
  $('#title_err').hide();
  $('#title_err2').hide();
  $('#Qtext_err').hide();
  $('#Qtext_err2').hide();
  $('#title_err_m').hide();
  $('#title_err2_m').hide();
  $('#Qtext_err_m').hide();
  $('#Qtext_err2_m').hide();
  $('#Answers_err_m').hide();
  $('#Answers_err2_m').hide();
  $('#Answers_err3_m').hide();
  $('#title_err_md').hide();
  $('#title_err2_md').hide();
  $('#Qtext_err_md').hide();
  $('#Qtext_err2_md').hide();
  $('#Answers_err_md').hide();
  $('#Answers_err2_md').hide();
  $('#Answers_err3_md').hide();

  var valid = true;
  var curriculums = $('#curriculums').val();

  if (curriculums == '') {
    $('#curriculum_err').show();
    valid = false;
  }

  var question_type = $('.question_form').attr('question-type'); //alert(question_type); 

  if (question_type == 1) {

   var Qtitle = $('#question_title_descriptive').val();
   var Qtext = $('#qtext_ed_o_1').val();

    if (Qtitle == '') 
    {
      $('#title_err').show();
      valid = false;
    }
    else{
      if (Qtitle.length < 2) 
      {
       $('#title_err').hide();
       $('#title_err2').show();
       valid = false;
      }
    } 
    if (Qtext == '') 
    {
      $('#Qtext_err').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err').hide();
       $('#Qtext_err2').show();
       valid = false;
      }
    }
  }
  else if( question_type == 2){
    var Qtitle = $('#question_title_multi_desc_selective').val(); //alert(Qtitle);
    var Qtext = $('#qtext_ed_o_3').val();
    var Qanswers = document.getElementsByName('answers_multi_desc_selective[]'); //console.log(Qanswers); 
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    }
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      { 
        $('#Answers_err_md').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_md').hide();
         $('#Answers_err2_md').show();
         valid = false;
        }
      }
    }

    if (Qtitle == '') 
    {
      $('#title_err_md').show();
      valid = false;
    }
    else
    {
      if (Qtitle.length < 2) 
      {
       $('#title_err_md').hide();
       $('#title_err2_md').show();
       valid = false;
      }
    }
    if (Qtext == '') 
    {
      $('#Qtext_err_md').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_md').hide();
       $('#Qtext_err2_md').show();
       valid = false;
      }
    }
    
    if (QanswersVals.length < 0) {
      $('#Answers_err3_md').show();
      valid = false;
    }

  }
  else{ //alert('hi3');
    var Qtitle = $('#question_title_multi_selective').val(); //console.log(Qtitle);
    var Qtext = $('#qtext_ed_o_2').val(); 
    var Qanswers = document.getElementsByName('answers_multi_selective[]');
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    }
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      {
        $('#Answers_err_m').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_m').hide();
         $('#Answers_err2_m').show();
         valid = false;
        }
      }
    }

    if (Qtitle == '') 
    {
      $('#title_err_m').show();
      valid = false;
    }
    else
    {
      if (Qtitle.length < 2) 
      {
       $('#title_err_m').hide();
       $('#title_err2_m').show();
       valid = false;
      }
    }
    if (Qtext == '') 
    {
      $('#Qtext_err_m').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_m').hide();
       $('#Qtext_err2_m').show();
      valid = false;
      }
    }
    
    if (Qanswers.length < 0) {
      $('#Answers_err3_m').show();
      valid = false;
    }

  }
return valid;
}

// validate evaluation and onservation questions forms
function validatQuestion(){

  $('#curriculum_err').hide();
  $('#section_type_err').hide();
  $('#question_type_err').hide();
  $('#Qtext_err').hide();
  $('#Qtext_err2').hide();
  $('#Qtext_err_m').hide();
  $('#Qtext_err2_m').hide();
  $('#Answers_err_m').hide();
  $('#Answers_err2_m').hide();
  $('#Answers_err3_m').hide();
  $('#Qtext_err_md').hide();
  $('#Qtext_err2_md').hide();
  $('#Answers_err_md').hide();
  $('#Answers_err2_md').hide();
  $('#Answers_err3_md').hide();

  var valid = true;
  var curriculums = $('#curriculums').val();
  var section_type = $('#section_type').val();
  var question_type = $('#questiontype').val();

  if (curriculums == '') {
    $('#curriculum_err').show();
    valid = false;
  }

  if (section_type == '') {
    $('#section_type_err').show();
    valid = false;   
  }
  if (question_type == '') {
    $('#question_type_err').show();
    valid = false;
  }else{

  var descriptive = $('.descriptive').css('display');
  var multi_selective = $('.multi-selective').css('display');
  var multi_desc_selective = $('.multi_desc_selective').css('display');

  if (descriptive != "none") {

   var Qtext = $('#qtext_o_1').val();

    if (Qtext == '') 
    {
      $('#Qtext_err').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err').hide();
       $('#Qtext_err2').show();
       valid = false;
      }
    }
  }
  else if( multi_selective != "none"){

    var Qtext = $('#qtext_o_2').val(); 
    var Qanswers = document.getElementsByName('answers_multi_selective[]');  
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    }
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      { 
        $('#Answers_err_m').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_m').hide();
         $('#Answers_err2_m').show();
         valid = false;
        }
      }
    }
    
    if (Qtext == '') 
    {
      $('#Qtext_err_m').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_m').hide();
       $('#Qtext_err2_m').show();
       valid = false;
      }
    }
    
    if (QanswersVals.length < 0) {
      $('#Answers_err3_m').show();
      valid = false;
    }

  }
  else if( multi_desc_selective != "none"){

    var Qtext = $('#qtext_o_3').val();
    var Qanswers = document.getElementsByName('answers_multi_desc_selective[]');
    for (var i = 0; i < Qanswers.length; i++) {
      Qanswer = Qanswers[i]; //alert(Qanswer);
      if (Qanswer == '') 
      {
        $('#Answers_err_md').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_md').hide();
         $('#Answers_err2_md').show();
         valid = false;
        }
      }
    }

    if (Qtext == '') 
    {
      $('#Qtext_err_md').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
      $('#Qtext_err_md').hide();
      $('#Qtext_err2_md').show();
      valid = false;
      }
    }
    if (Qanswers.length < 0) {
      $('#Answers_err3_md').show();
      valid = false;
    }


    
  }else{

  }
 }
return valid;
}
// validate edit obsevation and evaluation question
function validatQuestion_e(){

  $('#curriculum_err').hide();
  $('#section_type_err').hide();
  $('#question_type_err').hide();
  $('#Qtext_err').hide();
  $('#Qtext_err2').hide();
  $('#Qtext_err_m').hide();
  $('#Qtext_err2_m').hide();
  $('#Answers_err_m').hide();
  $('#Answers_err2_m').hide();
  $('#Answers_err3_m').hide();
  $('#Qtext_err_md').hide();
  $('#Qtext_err2_md').hide();
  $('#Answers_err_md').hide();
  $('#Answers_err2_md').hide();
  $('#Answers_err3_md').hide();

  var valid = true;
  var curriculums = $('#curriculums').val();

  if (curriculums == '') {
    $('#curriculum_err').show();
    valid = false;
  }

  var question_type = $('.question_form').attr('question-type'); //alert(question_type); 

  if (question_type == 1) {

   var Qtext = $('#qtext_ed_o_1').val();

    if (Qtext == '') 
    {
      $('#Qtext_err').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err').hide();
       $('#Qtext_err2').show();
       valid = false;
      }
    }
  }
  else if( question_type == 2){
 //alert('hi 2');
    var Qtext = $('#qtext_ed_o_3').val();
    var Qanswers = document.getElementsByName('answers_multi_desc_selective[]'); //console.log(Qanswers); 
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    }
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      { 
        $('#Answers_err_md').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_md').hide();
         $('#Answers_err2_md').show();
         valid = false;
        }
      }
    }

    if (Qtext == '') 
    {
      $('#Qtext_err_md').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_md').hide();
       $('#Qtext_err2_md').show();
       valid = false;
      }
    }
    
    if (QanswersVals.length < 0) {
      $('#Answers_err3_md').show();
      valid = false;
    }

  }
  else{ //alert('hi3');
    var Qtext = $('#qtext_ed_o_2').val(); 
    var Qanswers = document.getElementsByName('answers_multi_selective[]');
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    }
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      {
        $('#Answers_err_m').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_m').hide();
         $('#Answers_err2_m').show();
         valid = false;
        }
      }
    }

    if (Qtext == '') 
    {
      $('#Qtext_err_m').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_m').hide();
       $('#Qtext_err2_m').show();
      valid = false;
      }
    }
    
    if (Qanswers.length < 0) {
      $('#Answers_err3_m').show();
      valid = false;
    }

  }
return valid;
}
// validate bank question
function validatBankQuestion(){

  $('#curriculum_err').hide();
  $('#question_type_err').hide();
  $('#Qtext_err').hide();
  $('#Qtext_err2').hide();
  $('#Qtext_err_s').hide();
  $('#Qtext_err2_s').hide();
  $('#Answers_err_s').hide();
  $('#Answers_err2_s').hide();
  $('#Answers_err3_s').hide();
  $('#c_answers_err_s').show();
  $('#Qtext_err_ms').hide();
  $('#Qtext_err2_ms').hide();
  $('#Answers_err_ms').hide();
  $('#Answers_err2_ms').hide();
  $('#Answers_err3_ms').hide();
  $('#c_answers_err_ms').hide();

  var valid = true;
  var curriculums = $('#curriculums').val();

  if (curriculums == '') {
    $('#curriculum_err').show();
    valid = false;
  }

  var question_type = $('#question_type').val();
  if (question_type == '') {
    $('#question_type_err').show();
    valid = false;
  }else{

  var descriptive = $('.descriptive').css('display'); //alert(descriptive); return false;
  var single_selective = $('.single-selective').css('display');
  var multi_selective = $('.multi-selective').css('display');

  if (descriptive != "none") {//alert('descriptive');

   var Qtext = $('#question_text_descriptive').val(); //alert(Qtext); return false;

    if (Qtext == '') 
    {
      $('#Qtext_err').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err').hide();
       $('#Qtext_err2').show();
       valid = false;
      }
    }
  }
  else if( single_selective != "none"){ 

    var Qtext = $('#question_text_selective').val(); 
    var Qanswers = document.getElementsByClassName('answer_b_2');   
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    } 
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      { 
        $('#Answers_err_s').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_s').hide();
         $('#Answers_err2_s').show();
         valid = false;
        }
      }
    }

    var CorrectAns = [];
    $('#radio-btns_b input:checked').each(function() {
        CorrectAns.push($(this).attr('name'));
    }); 

    if (Qtext == '') 
    {
      $('#Qtext_err_s').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_s').hide();
       $('#Qtext_err2_s').show();
       valid = false;
      }
    }
    
    if (QanswersVals.length < 2) {
      $('#Answers_err3_s').show();
      valid = false;
    }
    if (CorrectAns.length < 1) { 
      $('#c_answers_err_s').show();
      console.log(CorrectAns.length);
      valid = false;
    }

  }
  else if( multi_selective != "none"){ 

    var Qtext = $('#question_text_multi_selective').val();
    var Qanswers = document.getElementsByClassName('answer_b_3'); 
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    } 
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      {
        $('#Answers_err_ms').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_ms').hide();
         $('#Answers_err2_ms').show();
         valid = false;
        }
      }
    }

    var CorrectAns = [];
    $('#radio-btns2_b input:checked').each(function() {
        CorrectAns.push($(this).attr('name'));
    }); 

    if (Qtext == '') 
    {
      $('#Qtext_err_ms').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
      $('#Qtext_err_ms').hide();
      $('#Qtext_err2_ms').show();
      valid = false;
      }
    }
    
    if (QanswersVals.length < 2) {
      $('#Answers_err3_ms').show();
      valid = false;
    }
    if (CorrectAns.length < 2) {
      $('#c_answers_err_ms').show();
      console.log(CorrectAns.length);
      valid = false;
    }
    
  }else{

  }
 }
return valid;
}
// validate edit bank question
function validatBankQuestion_e(){ //alert('heloo '); return false;

  $('#curriculum_err').hide();
  $('#question_type_err').hide();
  $('#Qtext_err').hide();
  $('#Qtext_err2').hide();
  $('#Qtext_err_s').hide();
  $('#Qtext_err2_s').hide();
  $('#Answers_err_s').hide();
  $('#Answers_err2_s').hide();
  $('#Answers_err3_s').hide();
  $('#c_answers_err_s').hide();
  $('#Qtext_err_ms').hide();
  $('#Qtext_err2_ms').hide();
  $('#Answers_err_ms').hide();
  $('#Answers_err2_ms').hide();
  $('#Answers_err3_ms').hide();
  $('#c_answers_err_ms').hide();

  var valid = true;
  var curriculums = $('#curriculums').val();

  if (curriculums == '') {
    $('#curriculum_err').show();
    valid = false;
  }

   var question_type = $('.question_form').attr('question-type'); 

  if (question_type == 1) {

   var Qtext = $('#question_text_descriptive').val(); 

    if (Qtext == '') 
    {
      $('#Qtext_err').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err').hide();
       $('#Qtext_err2').show();
       valid = false;
      }
    }
  }
  else if( question_type == 2){ 

    var Qtext = $('#question_text_selective').val(); 
    var Qanswers = document.getElementsByClassName('answer_b_2');   //alert(Qanswers); return false;
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    } 
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
      { 
        $('#Answers_err_s').show();
        valid = false;
      }
      else
      {
        if (Qanswer.length < 2) 
        {
         $('#Answers_err_s').hide();
         $('#Answers_err2_s').show();
         valid = false;
        }
      }
    }
    var CorrectAns = []; 
    CorrectAns = $('.answers_selective_correct_s:checked', '#myform'); //console.log(CorrectAns.length); 

    if (Qtext == '') 
    {
      $('#Qtext_err_s').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
       $('#Qtext_err_s').hide();
       $('#Qtext_err2_s').show();
       valid = false;
      }
    }
    if (QanswersVals.length < 2) {
      $('#Answers_err3_s').show();
      valid = false;
    } //alert(CorrectAns.length); return false;
    if (CorrectAns.length < 1) { 
      $('#c_answers_err_s').show();
      valid = false;
    }

  }
  else if( question_type == 3){  

    var Qtext = $('#question_text_multi_selective').val();
    var Qanswers = document.getElementsByClassName('answer_b_3'); 
    var QanswersVals = new Array();
    for (var i = 0; i < Qanswers.length; i++) {
      QanswersVals.push(Qanswers[i].value);
    } 
    for (var i = 0; i < QanswersVals.length; i++) {
      Qanswer = QanswersVals[i];
      if (Qanswer == '') 
    {
      $('#Answers_err_ms').show();
      valid = false;
    }
    else
    {
      if (Qanswer.length < 2) 
      {
       $('#Answers_err_ms').hide();
       $('#Answers_err2_ms').show();
       valid = false;
      }
    }
    }

    var CorrectAns = []; 
    CorrectAns = $('.answers_selective_correct_ms:checked', '#myform');

    if (Qtext == '') 
    {
      $('#Qtext_err_ms').show();
      valid = false;
    }
    else
    {
      if (Qtext.length < 2) 
      {
      $('#Qtext_err_ms').hide();
      $('#Qtext_err2_ms').show();
      valid = false;
      }
    }
    
    if (QanswersVals.length < 2) {
      $('#Answers_err3_ms').show();
      valid = false;
    }
    if (CorrectAns.length < 2) {
      $('#c_answers_err_ms').show();
      console.log(CorrectAns.length);
      valid = false;
    }
    
  }else{

  }
return valid;
}

function validatCourseInstantiation(){

 var isvalidToSubmit = true;

  var trainingProvider = $('#training_provider').val();
  var province = $('#province').val();
  var district = $('#district').val();
  if($('#calendar_type').val() == "en"){
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
  }else{
    var startDate = $('#start_dateP').val();
    var endDate = $('#end_dateP').val();
  }
  var trainingCenter = $('#training_center').val();
  var classroom = $('#classroom').val();
  var courseLeader = $('#course_leader').val();
  var shift = $('#shift').val();
  var conductDays = $('#conduct-days').val();
  var startTime = $('#start_time').val();
  var endTime = $('#end_time').val();

  var conductDays = $('input:checkbox:checked.conduct-days').map(function () {
    return this.value;
    }).get();
  console.log(conductDays);

 if(trainingProvider.length == 0){
    isvalidToSubmit = false;
    $('#training-provider-error').show();
 }

 if(province.length == 0){
    isvalidToSubmit = false;
    $('#province-error').show();
 }

 if(district === null || district.length == 0){
    isvalidToSubmit = false;
    $('#district-error').show();
 }

 if(startDate.length == 0){
    isvalidToSubmit = false;
    $('#startdate-error').show();
 }

 if(endDate.length == 0){
    isvalidToSubmit = false;
    $('#enddate-error').show();
 }
  if(startDate.length > 0 && endDate.length > 0){
    if(new Date(startDate) > new Date(endDate) ){
      isvalidToSubmit = false;
      $('#enddateSmaller-error').show();
    }
  }

 if(trainingCenter === null || trainingCenter.length == 0){
    isvalidToSubmit = false;
    $('#trainingcenter-error').show();
 }

 if(classroom === null || classroom.length == 0){
    isvalidToSubmit = false;
    $('#classroom-error').show();
 }

 if(courseLeader === null || courseLeader.length == 0){
    isvalidToSubmit = false;
    $('#courseleader-error').show();
 }

 if(shift === null || shift.length == 0){
    isvalidToSubmit = false;
    $('#shift-error').show();
 }

 if(conductDays.length == 0){
    isvalidToSubmit = false;
    $('#conductdays-error').show();
 }

 if(startTime.length == 0){
    isvalidToSubmit = false;
    $('#starttime-error').show();
 }

 if(endTime.length == 0){
    isvalidToSubmit = false;
    $('#endtime-error').show();
 }
  return isvalidToSubmit;
}


$(function() {
  if($("body:has(.nav-tabs)").length > 0){
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      // save the latest tab; use cookies if you like 'em better:
      localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
      if($('.tab-pane[id="'+lastTab.substr(1,lastTab.length-1)+'"]').length > 0){
        $('[href="' + lastTab + '"]').tab('show');
      }else{
        $('.tab-pane').first().addClass('active');
      }
    }else{
      $('.tab-pane').first().addClass('active');
    }
  }

  if($("body:has(#drop-nav)").length > 0){
    $('#drop-nav').change(
        function(){
          $('.tab-pane').removeClass('active');
          $('#'+$(this).val()).addClass('active');

        }
    );
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('#drop-nav').change( function (e) {
      // save the latest tab; use cookies if you like 'em better:
      localStorage.setItem('lastTab', '#'+$(this).val());
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
      var tab = lastTab.substr(1, lastTab.length-1);
      $('.tab-pane').removeClass('active');
      $(lastTab).addClass('active');
      $('#drop-nav').find('option[value="'+tab+'"]').attr('selected','selected');
      $('.selectpicker').selectpicker('refresh');
    }else{
      $('.tab-pane').first().addClass('active');
    }
  }
});


$('.nav-wrapper').click(function(){
  $('#notificationContainer').hide();
});



function showHideDateDiv(dateIntervalId){
  var dateIntervalId = dateIntervalId.split('.');
  //alert(dateIntervalId);
  //alert($('#'+dateIntervalId[0]+'\\.'+dateIntervalId[1]).val());
  if($('#'+dateIntervalId[0]+'\\.'+dateIntervalId[1]).val() != '' && $('#'+dateIntervalId[0]+'\\.'+dateIntervalId[1]).val() != '0'){
    $('#date_interval_div').css('display', 'block');
    $('#start_date_div').css('display', 'none');
    $('#end_date_div').css('display', 'none');
  }
  else{
    $('#date_interval_div').css('display', 'none');
    $('#start_date_div').css('display', 'block');
    $('#end_date_div').css('display', 'block');
  }
}




$(document).ajaxComplete(function() {

  $('.row').delay(5).fadeIn(700);

  if($(document).has('#start_date').length > 0 ){
    var dtPicker_st =  $('#start_date').datetimepicker({
      viewMode: 'years',
      format: 'YYYY/MM/DD'
    });
    $("#start_date").on("dp.change", function(e) {
      //alert(document.getElementById('start_date').value);
      $('#end_date').data("DateTimePicker").minDate(e.date);
      if(document.getElementById('start_date').value != '') {
        $('#date_interval_div').css('display', 'none');
      }
      else{
        $('#date_interval_div').css('display', 'block');
      }
    });
  }
  if($(document).has('#end_date').length > 0 ){
    var dtPicker_end = $('#end_date').datetimepicker({
      viewMode: 'years',
      format: 'YYYY/MM/DD',
      useCurrent: false //Important! See issue #1075
    });
    $("#end_date").on("dp.change", function(e) {
      $('#start_date').data("DateTimePicker").maxDate(e.date);
      if(document.getElementById('end_date').value != '') {
        $('#date_interval_div').css('display', 'none');
      }
      else{
        $('#date_interval_div').css('display', 'block');
      }
    });
  }

  if($(document).has('#datetimepicker6').length > 0 ){
    $('#datetimepicker6').datetimepicker({
      viewMode: 'years',
      format: 'YYYY/MM/DD'
    });

    $("#datetimepicker6").on("dp.change", function (e) {
      $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
  }

  if($(document).has('#datetimepicker7').length > 0 ){
    $('#datetimepicker7').datetimepicker({
      viewMode: 'years',
      format: 'YYYY/MM/DD',
      useCurrent: false //Important! See issue #1075
    });

    $("#datetimepicker7").on("dp.change", function (e) {
      $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
  }

  if($(document).has('#datetimepicker3').length > 0 ){
    $('#datetimepicker3').datetimepicker({
      format: 'LT',
      useCurrent: false //Important! See issue #1075
    });
  }

  if($(document).has('#datetimepicker2').length > 0 ){
    $('#datetimepicker2').datetimepicker({
      format: 'LT',
      useCurrent: false //Important! See issue #1075
    });
  }

  $('.toggle-calendar').unbind().click(function(){
    if($(this).hasClass('english')){
      $(this).closest('form').find('[data-calendar="persian"]').show();
      $(this).closest('form').find('[data-calendar="english"]').hide();
      $(this).removeClass('english');
      $(this).addClass('persian');
      $(this).closest('form').find('.calendar_type').val('pr');
    }else if($(this).hasClass('persian')){
      $(this).closest('form').find('[data-calendar="persian"]').hide();
      $(this).closest('form').find('[data-calendar="english"]').show();
      $(this).removeClass('persian');
      $(this).addClass('english');
      $(this).closest('form').find('.calendar_type').val('en');
    }
  });

  if($('.p-date').length > 0){
    $(".p-date").persianDatepicker({
      cellWidth: 39,
      cellHeight: 30,
      fontSize: 9
    });

    $(".p-date").focusout(function(){
      var value = $(this).val().replace(/\-| |\.|\\|,/g,"/");
      if(!isNaN(new Date(value).valueOf()))
        $(this).val(value);
      else
        $(this).val("");
    });
  }


  $('.smileydropdown').click(function(event){
    event.stopPropagation();
  });

  $('body').tooltip({
    selector: '[data-toggle=tooltip]'
  });

});

$('.toggle-calendar').unbind().click(function(){
  if($(this).hasClass('english')){
    $(this).closest('form').find('[data-calendar="persian"]').show();
    $(this).closest('form').find('[data-calendar="english"]').hide();
    $(this).removeClass('english');
    $(this).addClass('persian');
    $(this).closest('form').find('.calendar_type').val('pr');
  }else if($(this).hasClass('persian')){
    $(this).closest('form').find('[data-calendar="persian"]').hide();
    $(this).closest('form').find('[data-calendar="english"]').show();
    $(this).removeClass('persian');
    $(this).addClass('english');
    $(this).closest('form').find('.calendar_type').val('en');
  }
});

if($('.p-date').length > 0){
  $(".p-date").persianDatepicker({
    cellWidth: 39,
    cellHeight: 30,
    fontSize: 9
  });

  $(".p-date").focusout(function(){
    var value = $(this).val().replace(/\-| |\.|\\|,/g,"/");
    if(!isNaN(new Date(value).valueOf()))
      $(this).val(value);
    else
      $(this).val("");
  });
}

$('.btn.notext.small').on('mouseenter',function(){
  $(this).animate({height: '27px',width: '27px'}, 5);
  //This method keeps increasing the height by 36px
});
$('.btn.notext.small').on('mouseleave',function(){
  $(this).animate({height: '25px',width: '25px'}, 5);
  //This method keeps increasing the height by 36px
});
$('.btn.notext.large').on('mouseenter',function(){
  $(this).animate({height: '52px',width: '52px'}, 5);
  //This method keeps increasing the height by 36px
});
$('.btn.notext.large').on('mouseleave',function(){
  $(this).animate({height: '50px',width: '50px'}, 5);
  //This method keeps increasing the height by 36px
});

window.onbeforeunload = function(){
  $('.pace').removeClass('pace-inactive');
  $('.pace').addClass('pace-active');
  $('.pace').find('.pace-progress').css('-webkit-transform','translate3d(0, 0px, 0px)');
  $('.pace').find('.pace-progress').css('transform','translate3d(0, 0px, 0px)');
  $(this).removeClass('animated');
  $(this).removeClass('bounceIn');
  $(this).removeClass('tada');
  $('.btn').addClass('animated bounceOut');
  $(".row").delay(300).fadeOut(500);
  $('#general_modal').modal('hide');
  $('#observation_modal').modal('hide');
  if(chatUploading){
    return "Some file are being uploaded.";
  }
};

$(function(){

  $('.row').delay(5).fadeIn(700);
  $('.btn').addClass('animated bounceIn');
});

$('.btn').click(function(){
  $(this).removeClass('animated');
  $(this).removeClass('bounceIn');
  $(this).removeClass('tada');
  $(this).addClass('animated tada');
});


function HasArabicCharacters(text)
{
  var arregex = /[\u0600-\u06FF]/;
  return arregex.test(text);
}

function urlify(text) {
  var urlRegex = /(https?:\/\/[^\s]+)/g;
  return text.replace(urlRegex, function(url) {
    return '<a href="' + url + '">' + url + '</a>';
  })
  // or alternatively
  // return text.replace(urlRegex, '<a href="$1">$1</a>')
}

/* jQuery MaterialRipple Plugin */

$.fn.materialripple = function(options) {
  var defaults = {
    rippleClass: 'ripple-wrapper'
  }
  $.extend(defaults, options);

  $('body').on('animationend webkitAnimationEnd oAnimationEnd', '.' + defaults.rippleClass, function () {
    removeRippleElement(this);
  });

  var addRippleElement = function(element, e) {
    $(element).append('<span class="added '+defaults.rippleClass+'"></span>');
    newRippleElement = $(element).find('.added');
    newRippleElement.removeClass('added');


    var mouseX = e.pageX;
    var mouseY = e.pageY;

    elementWidth = $(element).outerWidth();
    elementHeight = $(element).outerHeight();
    d = Math.max(elementWidth, elementHeight);
    newRippleElement.css({'width': d, 'height': d});

    var rippleX = e.clientX - $(element).offset().left - d/2 + $(window).scrollLeft();
    var rippleY = e.clientY - $(element).offset().top - d/2 + $(window).scrollTop();


    newRippleElement.css('top', rippleY+'px').css('left', rippleX+'px').addClass('animated');
  }

  var removeRippleElement = function($element) {
    $element.remove();
  }

  $(this).addClass('has-ripple');

  $(this).bind('click', function(e){
    addRippleElement(this, e);
  });
}

$(document).ready(function(){

    $('nav.sidebar ul.nav > li').materialripple();
    $('button').materialripple();

});