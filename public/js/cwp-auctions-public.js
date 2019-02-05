(function( $ ) {
	'use strict';
    var curimgid;
    jQuery("#auction-images").on("click","img",function(){
        jQuery("div.modal-body").html("");
        var src = jQuery(this).attr("src");
        curimgid = parseInt(jQuery(this).attr("sn"));
        var html = '<img sn="'+curimgid+'" style="height:500px;width:auto;" src="'+src+'">';
        var arr = src.split("/");
        var name = arr[arr.length-1];
        jQuery("h4.modal-title").text(name);
        jQuery("div.modal-body").append(html);
    });

    jQuery("#img-popup").on("click", "#mnext", function(){nextImg();});
    jQuery("#img-popup").on("click", "#mprev", function(){prevImg();});

    jQuery(document).keydown(function(e){
        if (jQuery('#img-popup').is(':visible')) {
            if (e.keyCode == 37) {
                prevImg();
                return false;
            }
            else if (e.keyCode == 39) {
                nextImg();
                return false;
            }
        }
    });

    function prevImg(){
        var tmpid = curimgid-1;
        var previmg = jQuery("#auction-images").find('img[sn="'+tmpid+'"]');
        if(previmg.length!=0)
        {
            var src = previmg.attr("src");
            var html = '<img sn="'+tmpid+'" style="height:500px;width:auto;display:none;" src="'+src+'">';
            jQuery("div.modal-body").append(html);
            jQuery("#img-popup").find('img[sn="'+curimgid+'"]').remove();
            jQuery("#img-popup").find('img[sn="'+tmpid+'"]').toggle( "slide");
            var name = 'Images '+tmpid+'/'+totalimg;
            var arr = src.split("/");
            var name = arr[arr.length-1];
            jQuery("h4.modal-title").text(name);
            curimgid=tmpid;
        }
    }

    function nextImg(){
        var tmpid = curimgid+1;
        var nextimg = jQuery("#auction-images").find('img[sn="'+tmpid+'"]');
        if(nextimg.length!=0)
        {
            var src = nextimg.attr("src");
            var html = '<img sn="'+tmpid+'" style="height:500px;width:auto;display:none;" src="'+src+'">';
            jQuery("div.modal-body").append(html);
            jQuery("#img-popup").find('img[sn="'+curimgid+'"]').remove();
            jQuery("#img-popup").find('img[sn="'+tmpid+'"]').toggle( "slide");
            var name = 'Images '+tmpid+'/'+totalimg;
            var arr = src.split("/");
            var name = arr[arr.length-1];
            jQuery("h4.modal-title").text(name);
            jQuery("h4.modal-title").text(name);
            curimgid=tmpid;
        }
    }
})( jQuery );
