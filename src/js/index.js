/* BEARBEITER:  Patrick Grahm & Pascal Steffens
   INFO:        Zugehörig zu Login und Register Form
                Es soll zwischen den Login- und Register-Tabs gewechselt werden können
                Sofern man auf dem Aktiven Tab ist und auf die andere Seite wechseln möchte sollen alle aktiven Klassen "versteckt" werden
                und alle inaktiven Klassen geladen werden (vice versa) 
                Fadein bewirkt ein langsames Einblenden von 500 ms */

$('.tab a').on('click', function (e) {

  e.preventDefault();

  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');

  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();

  $(target).fadeIn(500);

});

$(document).on('click', function(e){
    if($(e.target).is('#createnotebtn')){
        $('.createnoteform').fadeIn(500);
    }else{
        $('.createnoteform').fadeOut(500);
    }
});

$('.createnoteform').on('click', function(e) {
    e.stopPropagation();
});
