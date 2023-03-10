var page = 2;
$(document).ready(function(){
    $('.more').click( function(){
        var item = 'more';
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'item': item
        };
        $.post(news.ajaxurl, data, function(responce){           
            if($.trim(responce)!= ''){
                $('.portfolio__carts').append(responce);
                page++;
            } else {
                $('.more').hide();
            }
        });
    });
    $('.portfolio__btn').click( function(){
        var id = $(this).data('id');
        var myThis = $(this);
        var link = $(this).data('link');
        var item = 'filter';
        var data = {
            'action': 'filter',
            'id': id,
            'item': item
        };
        $.post(news.ajaxurl, data, function(responce){           
            if($.trim(responce)!= ''){
                $('.portfolio__carts').empty();
                $('.portfolio__carts').append(responce);
                $(myThis).addClass('active');
                $('.portfolio__btn').not(myThis).removeClass('active');
                $('.more').hide();
            }
        });
    });
    $('.btn-all').click( function(){
        var item = 'all';
        var mayThis1 = $(this);
        var data = {
            'action': 'all_posts',
            'page': 1,
            'item': item
        };
        $.post(news.ajaxurl, data, function(responce){           
            if($.trim(responce)!= ''){
                $('.portfolio__carts').append(responce);
                $(mayThis1).addClass('active');
                $('.portfolio__btn').not(mayThis).removeClass('active');
                $('.more').show();
            }
        });
    });
    
});