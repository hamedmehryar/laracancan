/*!
 * 
 * Angle - Bootstrap Admin App + jQuery
 * 
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: http://support.wrapbootstrap.com/knowledge_base/topics/usage-licenses
 * 
 */


(function(window, document, $noConflict, undefined){

  if (typeof $noConflict === 'undefined') { throw new Error('This application\'s JavaScript requires jQuery'); }

  $noConflict(function(){

    // Restore body classes
    // ----------------------------------- 
    var $body = $noConflict('body');
    new StateToggler().restoreState( $body );
    
    // enable settings toggle after restore
    $noConflict('#chk-fixed').prop('checked', $body.hasClass('layout-fixed') );
    $noConflict('#chk-collapsed').prop('checked', $body.hasClass('aside-collapsed') );
    $noConflict('#chk-boxed').prop('checked', $body.hasClass('layout-boxed') );
    $noConflict('#chk-float').prop('checked', $body.hasClass('aside-float') );
    $noConflict('#chk-hover').prop('checked', $body.hasClass('aside-hover') );


  }); // doc ready


})(window, document, window.jQuery);

// Start Bootstrap JS
// ----------------------------------- 

(function(window, document, $noConflict, undefined){

  $noConflict(function(){

    // POPOVER
    // ----------------------------------- 

    $noConflict('[data-toggle="popover"]').popover();

    // TOOLTIP
    // ----------------------------------- 

    $noConflict('[data-toggle="tooltip"]').tooltip({
      container: 'body'
    });

    // DROPDOWN INPUTS
    // ----------------------------------- 
    $noConflict('.dropdown input').on('click focus', function(event){
      event.stopPropagation();
    });

  });

})(window, document, window.jQuery);

/**=========================================================
 * Module: clear-storage.js
 * Removes a key from the browser storage via element click
 =========================================================*/

(function($noConflict, window, document){
  'use strict';

  var Selector = '[data-reset-key]';

  $noConflict(document).on('click', Selector, function (e) {
      e.preventDefault();
      var key = $noConflict(this).data('resetKey');
      
      if(key) {
        $noConflict.localStorage.remove(key);
        // reload the page
        window.location.reload();
      }
      else {
        $noConflict.error('No storage key specified for reset.');
      }
  });

}(jQuery, window, document));

// GLOBAL CONSTANTS
// ----------------------------------- 


(function(window, document, $noConflict, undefined){

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
    'dark':                   '#6A7F8A',
    'yellow':                 '#fad732',
    'gray-darker':            '#232735',
    'gray-dark':              '#6A7F8A',
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

(function(window, document, $noConflict, undefined){

  var preferredLang = 'en';
  var pathPrefix    = 'i18n'; // folder of json files
  var packName      = 'site';
  var storageKey    = 'jq-appLang';

  $noConflict(function(){

    if ( ! $noConflict.fn.localize ) return;

    // detect saved language or use default
    var currLang = $noConflict.localStorage.get(storageKey) || preferredLang;
    // set initial options
    var opts = {
        language: currLang,
        pathPrefix: pathPrefix,
        callback: function(data, defaultCallback){
          $noConflict.localStorage.set(storageKey, currLang); // save the language
          defaultCallback(data);
        }
      };

    // Set initial language

    // Listen for changes
    $noConflict('[data-set-lang]').on('click', function(){

      currLang = $noConflict(this).data('setLang');

      if ( currLang ) {
        
        opts.language = currLang;


        activateDropdown($noConflict(this));
      }

    });
    

    function setLanguage(options) {
      $noConflict("[data-localize]").localize(packName, options);
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


(function(window, document, $noConflict, undefined){

  $noConflict(function(){
    
    var navSearch = new navbarSearchInput();
    
    // Open search input 
    var $searchOpen = $noConflict('[data-search-open]');

    $searchOpen
      .on('click', function (e) { e.stopPropagation(); })
      .on('click', navSearch.toggle);

    // Close search input
    var $searchDismiss = $noConflict('[data-search-dismiss]');
    var inputSelector = '.navbar-form input[type="text"]';

    $noConflict(inputSelector)
      .on('click', function (e) { e.stopPropagation(); })
      .on('keyup', function(e) {
        if (e.keyCode == 27) // ESC
          navSearch.dismiss();
      });
      
    // click anywhere closes the search
    $noConflict(document).on('click', navSearch.dismiss);
    // dismissable options
    $searchDismiss
      .on('click', function (e) { e.stopPropagation(); })
      .on('click', navSearch.dismiss);

  });

  var navbarSearchInput = function() {
    var navbarFormSelector = 'form.navbar-form';
    return {
      toggle: function() {
        
        var navbarForm = $noConflict(navbarFormSelector);

        navbarForm.toggleClass('open');
        
        var isOpen = navbarForm.hasClass('open');
        
        navbarForm.find('input')[isOpen ? 'focus' : 'blur']();

      },

      dismiss: function() {
        $noConflict(navbarFormSelector)
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


(function(window, document, $noConflict, undefined){

  var $win;
  var $html;
  var $body;
  var $sidebar;
  var mq;

  $noConflict(function(){

    $win     = $noConflict(window);
    $html    = $noConflict('html');
    $body    = $noConflict('body');
    $sidebar = $noConflict('.sidebar');
    mq       = APP_MEDIAQUERY;
    
    // AUTOCOLLAPSE ITEMS 
    // ----------------------------------- 

    var sidebarCollapse = $sidebar.find('.collapse');
    sidebarCollapse.on('show.bs.collapse', function(event){

      event.stopPropagation();
      if ( $noConflict(this).parents('.collapse').length === 0 )
        sidebarCollapse.filter('.in').collapse('hide');

    });
    
    // SIDEBAR ACTIVE STATE 
    // ----------------------------------- 
    
    // Find current active item
    var currentItem = $noConflict('.sidebar .active').parents('li');

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
    var subNav = $noConflict();
    $sidebar.on( eventName, '.nav > li', function() {

      if( isSidebarCollapsed() || useAsideHover() ) {

        subNav.trigger('mouseleave');
        subNav = toggleMenuItem( $noConflict(this) );

        // Used to detect click and touch events outside the sidebar          
        sidebarAddBackdrop();
      }

    });

    var sidebarAnyclickClose = $sidebar.data('sidebarAnyclickClose');

    // Allows to close
    if ( typeof sidebarAnyclickClose !== 'undefined' ) {

      $noConflict('.wrapper').on('click.sidebar', function(e){
        // don't check if sidebar not visible
        if( ! $body.hasClass('aside-toggled')) return;

        var $target = $noConflict(e.target);
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
    var $backdrop = $noConflict('<div/>', { 'class': 'dropdown-backdrop'} );
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
    
    if( !ul.length ) return $noConflict();
    if( $listItem.hasClass('open') ) {
      toggleTouchItem($listItem);
      return $noConflict();
    }

    var $aside = $noConflict('.aside');
    var $asideInner = $noConflict('.aside-inner'); // for top offset calculation
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
    $noConflict('.sidebar-subnav.nav-floating').remove();
    $noConflict('.dropdown-backdrop').remove();
    $noConflict('.sidebar li.open').removeClass('open');
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

(function(window, document, $noConflict, undefined){

  $noConflict(function(){

    var $body = $noConflict('body');
        toggle = new StateToggler();

    $noConflict('[data-toggle-state]')
      .on('click', function (e) {
        // e.preventDefault();
        e.stopPropagation();
        var element = $noConflict(this),
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
        $noConflict(window).resize();

    });

  });

  // Handle states to/from localstorage
  window.StateToggler = function() {

    var storageKeyName  = 'jq-toggleState';

    // Helper object to check for words in a phrase //
    var WordChecker = {
      hasWord: function (phrase, word) {
        return new RegExp('(^|\\s)' + word + '(\\s|$noConflict)').test(phrase);
      },
      addWord: function (phrase, word) {
        if (!this.hasWord(phrase, word)) {
          return (phrase + (phrase ? ' ' : '') + word);
        }
      },
      removeWord: function (phrase, word) {
        if (this.hasWord(phrase, word)) {
          return phrase.replace(new RegExp('(^|\\s)*' + word + '(\\s|$noConflict)*', 'g'), '');
        }
      }
    };

    // Return service public methods
    return {
      // Add a state to the browser storage to be restored later
      addState: function(classname){
        var data = $noConflict.localStorage.get(storageKeyName);
        
        if(!data)  {
          data = classname;
        }
        else {
          data = WordChecker.addWord(data, classname);
        }

        $noConflict.localStorage.set(storageKeyName, data);
      },

      // Remove a state from the browser storage
      removeState: function(classname){
        var data = $noConflict.localStorage.get(storageKeyName);
        // nothing to remove
        if(!data) return;

        data = WordChecker.removeWord(data, classname);

        $noConflict.localStorage.set(storageKeyName, data);
      },
      
      // Load the state string and restore the classlist
      restoreState: function($elem) {
        var data = $noConflict.localStorage.get(storageKeyName);
        
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

(function($noConflict, window, doc){
    'use strict';
    
    var $html = $noConflict("html"), $win = $noConflict(window);

    $noConflict.support.transition = (function() {

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

    $noConflict.support.animation = (function() {

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

    $noConflict.support.requestAnimationFrame = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.msRequestAnimationFrame || window.oRequestAnimationFrame || function(callback){ window.setTimeout(callback, 1000/60); };
    $noConflict.support.touch                 = (
        ('ontouchstart' in window && navigator.userAgent.toLowerCase().match(/mobile|tablet/)) ||
        (window.DocumentTouch && document instanceof window.DocumentTouch)  ||
        (window.navigator['msPointerEnabled'] && window.navigator['msMaxTouchPoints'] > 0) || //IE 10
        (window.navigator['pointerEnabled'] && window.navigator['maxTouchPoints'] > 0) || //IE >=11
        false
    );
    $noConflict.support.mutationobserver      = (window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver || null);

    $noConflict.Utils = {};

    $noConflict.Utils.debounce = function(func, wait, immediate) {
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

    $noConflict.Utils.removeCssRules = function(selectorRegEx) {
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

    $noConflict.Utils.isInView = function(element, options) {

        var $element = $noConflict(element);

        if (!$element.is(':visible')) {
            return false;
        }

        var window_left = $win.scrollLeft(),
            window_top  = $win.scrollTop(),
            offset      = $element.offset(),
            left        = offset.left,
            top         = offset.top;

        options = $noConflict.extend({topoffset:0, leftoffset:0}, options);

        if (top + $element.height() >= window_top && top - options.topoffset <= window_top + $win.height() &&
            left + $element.width() >= window_left && left - options.leftoffset <= window_left + $win.width()) {
          return true;
        } else {
          return false;
        }
    };

    $noConflict.Utils.options = function(string) {

        if ($noConflict.isPlainObject(string)) return string;

        var start = (string ? string.indexOf("{") : -1), options = {};

        if (start != -1) {
            try {
                options = (new Function("", "var json = " + string.substr(start) + "; return JSON.parse(JSON.stringify(json));"))();
            } catch (e) {}
        }

        return options;
    };

    $noConflict.Utils.events       = {};
    $noConflict.Utils.events.click = $noConflict.support.touch ? 'tap' : 'click';

    $noConflict.langdirection = $html.attr("dir") == "rtl" ? "right" : "left";

    $noConflict(function(){

        // Check for dom modifications
        if(!$noConflict.support.mutationobserver) return;

        // Install an observer for custom needs of dom changes
        var observer = new $noConflict.support.mutationobserver($noConflict.Utils.debounce(function(mutations) {
            $noConflict(doc).trigger("domready");
        }, 300));

        // pass in the target node, as well as the observer options
        observer.observe(document.body, { childList: true, subtree: true });

    });

    // add touch identifier class
    $html.addClass($noConflict.support.touch ? "touch" : "no-touch");

}(jQuery, window, document));
// Custom jQuery
// ----------------------------------- 


(function(window, document, $noConflict, undefined){

  $noConflict(function(){

    // document ready

  });

})(window, document, window.jQuery);