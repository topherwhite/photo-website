
$(document).ready(function($) {

  $('div.content').css('display', 'block');

  var onMouseOutOpacity = 0.67;
  $('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
    mouseOutOpacity:   onMouseOutOpacity,
    mouseOverOpacity:  1.0,
    fadeSpeed:         'fast',
    exemptionSelector: '.selected'
  });

  var gallery = $('#thumbs').galleriffic({
    delay:                     2500,
    numThumbs:                 10,
    preloadAhead:              0,
    enableTopPager:            false,
    enableBottomPager:         false,
    imageContainerSel:         '#slideshow',
    controlsContainerSel:      '#controls',
    captionContainerSel:       '#caption',
    loadingContainerSel:       '#loading',
    renderSSControls:          true,
    renderNavControls:         true,
    playLinkText:              'Play Slideshow',
    pauseLinkText:             'Pause Slideshow',
    prevLinkText:              '&lsaquo; Previous Photo',
    nextLinkText:              'Next Photo &rsaquo;',
    nextPageLinkText:          'Next &rsaquo;',
    prevPageLinkText:          '&lsaquo; Prev',
    enableHistory:             true,
    autoStart:                 false,
    syncTransitions:           true,
    defaultTransitionDuration: 900,
    onSlideChange: function(prevIndex, nextIndex) {
      this.find('ul.thumbs').children()
        .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
        .eq(nextIndex).fadeTo('fast', 1.0);
      this.$captionContainer.find('div.photo-index')
        .html('Photo '+ (nextIndex+1) +' of '+ this.data.length);
    },
    onPageTransitionOut: function(callback) {
      this.fadeTo('fast', 0.0, callback);
    },
    onPageTransitionIn: function() {
      var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
      var nextPageLink = this.find('a.next').css('visibility', 'hidden');
      if (this.displayedPage > 0)
        prevPageLink.css('visibility', 'visible');
      var lastPage = this.getNumPages() - 1;
      if (this.displayedPage < lastPage)
        nextPageLink.css('visibility', 'visible');
      this.fadeTo('fast', 1.0);
    }

  });

  gallery.find('a.prev').click(function(e) {
    gallery.previousPage();
    e.preventDefault();
  });

  gallery.find('a.next').click(function(e) {
    gallery.nextPage();
    e.preventDefault();
  });

  function pageload(hash) {
    if(hash) { $.galleriffic.gotoImage(hash); } else { gallery.gotoIndex(0); }
  }

  $.historyInit(pageload, "advanced.html");
  $("a[rel='history']").live('click', function(e) {
    if (e.button != 0) return true;
    var hash = this.href;
    hash = hash.replace(/^.*#/, '');
    $.historyLoad(hash);
    return false;
  });



});