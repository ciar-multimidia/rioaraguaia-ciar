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

});
