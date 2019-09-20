jQuery(document).ready(function($){
    if($('#ys_cartPage').length) {
        /*Send*/
        var postObj = cart;
        window.parent.postMessage(postObj, "*");
        /*Receive*/
        var eventMethodCart = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventerCart = window[eventMethodCart];
        var messageEventCart = eventMethodCart == "attachEvent" ? "onmessage" : "message";
        // Listen to message from child window
        eventerCart(messageEventCart, function (e) {
            jQuery(document).ready(function ($) {
                if (e.data) {
                    console.log(e.data);
                    if(JSON.stringify(e.data).indexOf('deleteAll') !== -1){
                        $('a.ysco_remove_link').each(function(i,obj){
                            $.get($(this).attr('href'));
                        });
                        window.parent.postMessage("deleteAllFinished", "*");
                    }
                    if (JSON.stringify(e.data).indexOf('itemdel') !== -1 && e.data.substring(0, 7) === 'itemdel') {
                        var removeLink = $('table.ys_basket a[href*="' + e.data.substring(8) + '"]').parents('tr').find('a.ysco_remove_link').first();
                        if(removeLink.length) {
                            window.location = removeLink.attr('href');
                        }
                    }
                }
            });

        }, false);
    }
    $(window).bind('beforeunload', function(){
        capture();
    });
    $('#billing-email').focusout(function() {
        capture();
    });
    var isValidEmailAddress = function(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    };
    var capture = function(){
        var email = $('#billing-email').val();
        if(isValidEmailAddress(email)){
            $.ajax({
                url: 'https://account.deepbluewatches.com/api/recover',
                data:{
                    cart : window.cart,
                    name: $('#shipping-full-name').val(),
                    email : email
                }
            });
        }
    };
});