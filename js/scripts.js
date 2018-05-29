jQuery(document).ready(function($) {
  ////////////////////////////////// GALERIA
  $('.fancybox').magnificPopup({
    type: 'image',
    gallery:{
      enabled:true
    }
  });

  // galeria
  var galerias = $('.galeria-imgs');

  galerias.each(function(index, el) {
    var itensGal = $(el).find('.galeria-item');
    var linhasGal = $(el).find('.linha');

    var nColunas = parseInt($(el).attr('data-colunas') );

    if (linhasGal.eq(linhasGal.length-1).contents().length == 0) {
      linhasGal.eq(linhasGal.length-1).remove();
      linhasGal = $(el).find('.linha');
    }

    if (linhasGal.length > 1) {

      if (nColunas > 2 && itensGal.length % nColunas == 1) {
        var ultimaLinha = linhasGal.eq(linhasGal.length-1);
        var penultimaLinha = linhasGal.eq(linhasGal.length-2);
        var itemMovido = penultimaLinha.find('.galeria-item').eq(penultimaLinha.find('.galeria-item').length-1);
        ultimaLinha.prepend(itemMovido);
        // linhasGal = $(el).find('.linha');
      }

      linhasGal.each(function(index2, el2) {
        if ($(el2).find('.galeria-item').length < nColunas){
          $(el2).addClass('grid-'+$(el2).find('.galeria-item').length);
        }
      });
    }
  });  

  ////////////////////////////////// mudanca de lingua

  var $arealinguas = $('.arealingua');

  if ($arealinguas.length > 0) {

    $arealinguas.each(function(index, el) {
      var $thisarea = $(this);
      $thisarea.find('.linguas').on('change', function(event) {
        $thisarea.find('.lingua-pt, .lingua-kr').addClass('hidden');
        $thisarea.find('.lingua-'+$(this).val()).removeClass('hidden');
      });  
    });
    
  }


  ////////////////////////////////// IR PRO PRODAPE

  $('[href=#rodape-site]').on('click', function(event) {
    event.preventDefault();
    $('html').stop().animate({scrollTop: $('body').height() - $(window).height()}, 500);
  });


  // =============== Bt Play Youtube

  var scriptYtApi = $('<script></script>');
  scriptYtApi.attr('src', '//www.youtube.com/player_api');
  $('main').find('script').eq(0).before(scriptYtApi);

  var $video = $('.video');
  
  window.onYouTubePlayerAPIReady = function() {
    // create the global player from the specific iframe (#video)
    console.log('api carregou');

    $video.each(function(index, el) {
      var $iframeYt = $(el).children('iframe');
      var idIframe = $iframeYt.attr('id');

      var player;

      player = new YT.Player(idIframe, {
        events: {
          // call this function when player is ready to use
          'onReady': onPlayerReady
        }
      });

      function onPlayerReady(event){
        var $btVideo = $(el).siblings('.bt-youtube-video');
        $btVideo.on('click', function(event) {
          $(this).animate({'opacity': 0}, 300, function() {
            $(this).remove();
          });
          $iframeYt.parent().addClass('visivel');
          player.playVideo();
        });
      }
    });
  }
  
});
