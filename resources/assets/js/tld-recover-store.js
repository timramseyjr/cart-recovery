jQuery(document).ready(function($){
    var getUrlVars = function(){
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    };
    var cid = getUrlVars()['cid'];
    var url = window.location.pathname;
    if(url === '/cart.html'){
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
        // Listen to message from child window
        var cartItems = '';
        eventer(messageEvent,function(e){
            try {
                if (e.data) {
                    var data = e.data;
                    if (typeof(data.numOfItems) != "undefined") {
                        cartItems = e.data.items;
                        if(!cartItems.length){
                            $('#tld-cart').submit();
                        }
                    }
                }
            } catch (e) {}
        },false);
        $('iframe[name="tlCartTarget"]').on("load", function() {
            $.ajax({
                url: 'https://account.deepbluewatches.com/api/recover/cart',
                data:{
                    id:cid
                },
                success:function(obj){
                    var iframe = $('iframe[name="tlCartTarget"]')[0];
                    var iframewindow = iframe.contentWindow ? iframe.contentWindow : iframe.contentDocument.defaultView;
                    iframewindow.postMessage('deleteAll', "*");
                    var cart = JSON.parse(obj.cart);
                    var items = cart.items;
                    $.each(items,function(i,obj){
                        if(i === 0){
                            $('#tld-cart').attr('action',$('#tld-cart').attr('action').replace("+nil","+"+obj.id));
                        }
                        $.each(obj.options,function(i2,obj) {
                            $('#tld-cart').append('<input type="hidden" name="vwattr' + i + '_'+obj.name+'" value="' + obj.value + '" />');
                        });
                        $('#tld-cart').append('<input type="hidden" name="vwitem'+i+'" value="'+obj.id+'" />');
                        $('#tld-cart').append('<input type="hidden" name="vwquantity'+i+'" value="'+obj.qty+'" />');
                    });
                    setTimeout(function(){
                        $('#tld-cart').removeAttr('target');
                        $('#tld-cart').submit();
                    },2000);
                    //$('#tld-cart').submit();
                }
            });
        });
    }
});