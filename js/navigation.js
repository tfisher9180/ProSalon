(function( $ ) {

  var topbar = $( '#topbar' );
  var topbarToggle = topbar.find( '.toggle' );
  var topbarContent = $( '#topbar-content' );

  // Topbar Toggle
  (function() {
    if ( ! topbar.length ) {
      return;
    }

    // init
    topbarContent.attr( 'aria-expanded', 'false' );

    // toggle
    topbarToggle.on( 'click', function(e) {
      e.preventDefault();

      topbar.toggleClass( 'open' );
      topbarContent.attr( 'aria-expanded', topbar.hasClass( 'open' ) );
      topbarContent.slideToggle( 250 );
      topbarToggle.find( '.fa' ).toggleClass( 'fa-chevron-down fa-chevron-up' );
    });
  })();

})(jQuery);
