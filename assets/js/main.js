$(function(){
    'use strict';
    //hide place holder on focus
    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
        $(this).attr('data-text','');
    });

    // Switch between login and signup

    $('.login-form h1 span').click(function() {
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.login-form form').hide();   
        $('.' + $(this).data('class')).fadeIn(100);
    });

    $('.live-name').keyup(function(){
        $('.live-preview .caption h3').text($(this).val());
    });

    $('.live-description').keyup(function(){
        $('.live-preview .caption p').text($(this).val());
    });
    $('.live-price').keyup(function(){
        $('.live-preview .price-tag').text($(this).val());
    });

    $('#hideBtn').click(function(){
        $('#edit-from').slideUp(3000);
    });

    $('#show-edit-form').click(function () {
        $('#edit-from').slideDown(3000);
    });

});
