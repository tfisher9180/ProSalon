(function( $ ) {

  var topbar = $( '#topbar' );
  var topbarToggle = topbar.find( '.toggle' );
  var topbarContent = $( '#topbar-content' );

  var navbar = $( '#navbar' );
  var navbarToggle = navbar.find( '.menu-toggle' );

  var siteNavigationContainer = $( '#site-navigation' );
  var siteNavigation = siteNavigationContainer.find( '> div > ul, > ul' );
  var siteNavigationDropdowns = siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' );
  var siteNavigationSubmenus = siteNavigation.find( '.sub-menu' );

  // Sticky Navbar
  $( window ).on( 'scroll resize load', function() {
    var scrollPos = $( window ).scrollTop();
    var navbarHeight = navbar.outerHeight(); // needed to add padding to the body
    var topbarHeight = topbar.outerHeight();
    var adminbarHeight = $( '#wpadminbar' ).is( ':visible' ) ? $( '#wpadminbar' ).outerHeight() : 0;

    var sticky;

    // below 600px admin bar is position: absolute so we include it in the scroll distance
		if ( $( window ).width() < 600 ) {
			sticky = scrollPos >= adminbarHeight + topbarHeight;
		} else {
			sticky = scrollPos >= topbarHeight;
		}

    $( 'body' ).toggleClass( 'sticky', sticky );
    $( 'body' ).css( 'padding-top', $( 'body' ).hasClass( 'sticky' ) ? navbarHeight+'px' : 0 );
  });

  // Topbar Toggle
  (function() {
    if ( ! topbar.length ) {
      return;
    }

    // init
    topbarToggle.add( topbarContent ).attr( 'aria-expanded', 'false' );

    var toggleTopbarFn = function() {
      topbar.toggleClass( 'open' );
      topbarToggle.add( topbarContent ).attr( 'aria-expanded', topbar.hasClass( 'open' ) );
      topbarToggle.find( '.fa' ).toggleClass( 'fa-chevron-down fa-chevron-up' );
      topbarContent.slideToggle( 250 );
    };

    // toggle
    topbarToggle.on( 'click', function(e) {
      e.preventDefault();
      toggleTopbarFn();
    });
  })();

  // Menu Toggle
  (function() {
    if ( ! navbarToggle.length || ! siteNavigation.length || ! siteNavigation.children().length ) {
      return;
    }

    // init
    navbarToggle.add( siteNavigation ).attr( 'aria-expanded', 'false' );

    var toggleSiteNavFn = function() {
      $( 'body' ).toggleClass( 'site-navigation-open' );
      siteNavigationContainer.toggleClass( 'open' );
      navbarToggle.add( siteNavigation ).attr( 'aria-expanded', siteNavigationContainer.hasClass( 'open' ) );
    };

    // toggle
    navbarToggle.on( 'click', function( e ) {
      e.preventDefault();
      e.stopPropagation(); // prevent document click handler from firing
      toggleSiteNavFn();
    });

    // Click outside to close
    $( document ).on( 'click', '.site-navigation-open', function( e ) {
      if ( ! $( e.target ).closest( siteNavigationContainer ).length ) {
        toggleSiteNavFn();
      }
    });
  })();

  // Site Navigation Dropdown Toggle
  (function() {
    if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
      return;
    }

    // init
    var dropdownToggleClass = 'dropdown-toggle';
    siteNavigationSubmenus.attr( 'aria-expanded', 'false' );

    // add dropdown toggle for submenus
    var dropdownToggle = $( '<a />', { 'href': '#', 'class': dropdownToggleClass, 'aria-expanded': false } )
      .append( $( '<span />', { 'class': 'fa fa-angle-down' } ) )
      .append( $( '<span />', { 'class': 'screen-reader-text', text: prosalonScreenReaderText.expand } ) );
    siteNavigationDropdowns.after( dropdownToggle );

    var toggleSubmenuFn = function( that ) {
      var _this = $( that );
      var submenu = _this.next( '.children, .sub-menu' );
      var screenReader = _this.find( '.screen-reader-text' );
      var dropdownIcon = _this.find( '.fa' );

      submenu.slideToggle( 300 );
      _this.add( submenu ).toggleClass( 'open' );
      _this.add( submenu ).attr( 'aria-expanded', _this.hasClass( 'open' ) );
      dropdownIcon.toggleClass( 'fa-angle-down fa-angle-up' );
    };

    // toggle
    siteNavigation.find( '.'+dropdownToggleClass ).on( 'click', function( e ) {
      e.preventDefault();
      toggleSubmenuFn( this );
    });
  })();

  // Toggle focus class for dropdowns on touch devices
  (function() {
    if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
      return;
    }

    siteNavigation.find( 'a' ).on( 'focus blur', function() {
      $( this ).parents( 'li' ).toggleClass( 'focus' );
    });

    if ( 'ontouchstart' in window ) {
      $( window ).on( 'resize', toggleFocusClassTouchScreen );
      toggleFocusClassTouchScreen();
    }

    function toggleFocusClassTouchScreen() {
      var dropdownItemsLinks = siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' );
      var items = siteNavigation.find( 'li' );


      if ( navbarToggle.css( 'display' ) == 'none' ) {
        $( document.body ).on( 'touchstart', function( e ) {
          if ( ! $( e.target ).closest( items ).length ) {
            items.removeClass( 'focus' );
          }
        });

        dropdownItemsLinks.on( 'touchstart', function( e ) {
          var targetParent = $( this ).parent( 'li' );

          if ( ! targetParent.hasClass( 'focus' ) ) {
            e.preventDefault();
            targetParent.toggleClass( 'focus' );
            targetParent.siblings( '.focus' ).removeClass( 'focus' );
          }
        });
      } else {
        dropdownItemsLinks.unbind( 'touchstart' );
      }
    }
  })();

})(jQuery);
