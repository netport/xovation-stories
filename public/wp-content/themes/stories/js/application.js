
jQuery(window).bind('scroll',function(e){
  parallax();
});

function parallax(){
  var scrolled = jQuery(window).scrollTop();
  var vimplar = jQuery('#vimplar');
  var boll = jQuery('#boll');
  var boll2 = jQuery('#boll2');
  var agg = jQuery('#agg');

  vimplar.css('top',(0-(scrolled*.02))+'px');
  boll.css('top',(0-(scrolled*.11))+'px');
  boll2.css('top',(0-(scrolled*.16))+'px');
  agg.css('top',(0-(scrolled*.13))+'px');
}

jQuery(window).load(function() {
  jQuery('#main', 'body.home').isotope({
    itemSelector : '.hentry',
    masonry: { columnWidth : 245 }
  });
});
