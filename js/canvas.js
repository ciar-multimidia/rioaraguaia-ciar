jQuery(document).ready(function($) {
  ////////////////////////////////// canvas
  $( "main" ).prepend( "<div class='canvas-overlay'></div>" );

  function escondeCanvas() {
    $('.canvas, .canvas-overlay').removeClass('visivel');
    setTimeout(function(){
      $('.canvas, .canvas-overlay').removeClass('db');
    },330)
    $('main').off('mousedown', escondeCanvas);
    $('.canvas').off('swipeleft', escondeCanvas);
    $('.canvas-overlay').removeClass('visivel');
    console.log('escondeu');
    
  }

  function mostraCanvas() {
    $('.canvas, .canvas-overlay').addClass('db');
    setTimeout(function(){
      $('.canvas, .canvas-overlay').addClass('visivel');
    },20)
    $('main').on('mousedown', escondeCanvas);
    $('.canvas').on('swipeleft', escondeCanvas);
  }


  $('.menu-mobile').on('click', function(){
    mostraCanvas();
  });
});