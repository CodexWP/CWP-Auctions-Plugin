console.log($("#start_date"));

(function( $ ) {
	'use strict';
    $("#start_date").datepicker();
    $("#end_date").datepicker();
    $("div#auction_image_container").on('click', '#uploadimage', function() {
        tb_show('Auction Image Upload', 'media-upload.php?type=image&TB_iframe=1');
        var b = $(this).siblings("input");
        i = $(this).siblings("img");
        window.send_to_editor = function( html )
        {
            var imgurl = $(html ).attr( 'src' );
            b.val(imgurl);
            b.attr('src',imgurl);
            tb_remove();
        }
        return false;
    });

    $("div#auction_image_container").on("click",".fa-plus-square", function(){
        var html = '<div class="auction_single"><img class="user-preview-image" src=""><input type="text" name="images[]" id="image" value="" class="regular-text" />&nbsp;<input type="button" class="button-primary" value="Upload Image" id="uploadimage"/>&nbsp;<i style="color: #0085ba;" class="fa fa-minus-square red-minus" aria-hidden="true"></i></br><br></div>';
        $("div#auction_image_container").append(html);

    });

    $("div#auction_image_container").on("click",".fa-minus-square", function(){
        $(this).parent('div.auction_single').remove();
    });

    $("div#auction_lot_container").on("click",".fa-plus-square", function(){
        var html = '<div class="auction_single"><table style="width:100%;"><tr><td style="width:30%;"><input style="width:98%;" type="text" name="lot_td1[]" id="lot_tb1" value="" class="regular-text" placeholder="Lot number" /></td><td style="width:15%;"><input style="width:98%;" type="text" name="lot_td3[]" id="lot_tb3" value="" class="regular-text" placeholder="Quantity" /></td><td style="width:45%;"><textarea style="width:98%;" name="lot_td2[]" id="lot_tb2" value="" class="regular-text" placeholder="Lot description"></textarea></td><td style="width:10%;"><i style="color: #0085ba;" class="fa fa-minus-square red-minus" aria-hidden="true"></i></td></tr></table></div>';
        $("div#auction_lot_container").append(html);

    });

    $("div#auction_lot_container").on("click",".fa-minus-square", function(){
        $(this).parents('div.auction_single').remove();
    });


    // The "Upload" button
    $('.upload_image_button').click(function(e) {
        e.preventDefault();
        var custom_uploader = wp.media.frames.file_frame = wp.media({multiple: true});

        custom_uploader.on('select', function() {
            var selection = custom_uploader.state().get('selection');
            var attachments = [];
            selection.map( function( attachment ) {
                attachment = attachment.toJSON();
                attachments.push(attachment.url);
                //
            });
            var i=0;var html="";
            for(i=0;i<attachments.length;i++)
            {
                html = '<div id ="single-image" style="width:10%;float:left;"><img style="width: 95%;" data-src="" src="'+attachments[i]+'" width="" height="50px;" /><input type="hidden" name="images[]"  value="'+attachments[i]+'" /><button type="submit" class="remove_image_button button">&times;</button></div>';
                $('div.upload').append(html);
            }
        });

        custom_uploader.open();
        return false;
    });

    // The "Remove" button (remove the value from input type='hidden')
    $("div#auction_image_container").on('click','.remove_image_button', function(e) {
        e.preventDefault();
        var answer = confirm('Are you sure?');
        if (answer == true) {
            $(this).parents("div#single-image").remove();
        }
        return false;
    });

})( jQuery );
