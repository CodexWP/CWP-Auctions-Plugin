<?php
global $post;
$custom = get_post_custom( $post->ID );
if(isset($custom['lot_settings'])) {
    $lot_settings = $custom['lot_settings'];
    $lot = json_decode(base64_decode($lot_settings[0]));
    $start_date = $lot->start_date;
    $end_date = $lot->end_date;
    $lot_td1 = $lot->lot_td1;
    $lot_td2 = $lot->lot_td2;
    $lot_td3 = $lot->lot_td3;
    $images = $lot->images;
}
else
{
    $lot_td1 = $lot_td2 =$lot_td3 = $images =array();
    $start_date = $end_date = '';
}
?>
<div style="width:100%;padding:10px;">
    <div style="width:45%;padding:10px;">
        <label><strong>Start Date:</strong></label><br />
        <input id="start_date" style="width:100%;" type="text" name="start_date" value="<?= $start_date ?>" />
    </div>

    <div style="width:45%;padding:10px;">
        <label><strong>End Date:</strong></label><br />
        <input id="end_date" style="width:100%;" type="text" name="end_date" value="<?= $end_date ?>" />
    </div>

</div>

<div style="width:100%;padding:10px;overflow: auto;">
    <div id="auction_lot_container" style="width:98%;padding:10px;">
        <div style="margin-bottom: 1em;font-weight: bold">Lot Information <!--| <span style="cursor: pointer;color:#0085ba" id="importtab">Import</span>--></div>

        <hr>
        <div id="import" style="display:none;border: 1px solid gainsboro;margin-top:10px;margin-bottom: 10px;padding:10px;">
            <input type="file" id="import_file" accept=".xls, .xlsx"><br><br>
            <button style="width:10%" id="btninsert" type="button">Insert</button>
        </div>

        <?php
        if(count($lot_td1)==0)
        {
            ?>
            <div class="auction_single">
                <table style="width:100%;">
                    <tr><td style="width:30%;">
                            <input style="width:98%;" type="text" name="lot_td1[]" id="lot_tb1" value="" class="regular-text" placeholder="Lot number" /></td>
                        <td style="width:15%;">
                            <input style="width:98%;" type="text" name="lot_td3[]" id="lot_tb3" value="" class="regular-text" placeholder="Quantity" /></td>
                        <td style="width:45%;"><textarea style="width:98%;" name="lot_td2[]" id="lot_tb2" value="" class="regular-text" placeholder="Lot description"></textarea></td>
                        <td style="width:10%;"><i style="color: #0085ba;" class="fa fa-plus-square" aria-hidden="true"></i></td>
                    </tr>
                </table>
            </div>
            <?php
        }

        for($i=0;$i<count($lot_td1);$i++) {
                ?>
                <div class="auction_single">
                    <table style="width:100%;">
                        <tr><td style="width:30%;">
                                <input style="width:98%;" type="text" name="lot_td1[]" id="lot_tb1" value="<?php echo $lot_td1[$i]; ?>" class="regular-text" placeholder="Lot number" /></td>
                            <td style="width:15%;">
                                <input style="width:98%;" type="text" name="lot_td3[]" id="lot_tb3" value="<?php echo $lot_td3[$i]; ?>" class="regular-text" placeholder="Quantity" /></td>
                            <td style="width:45%;"><textarea style="width:98%;" name="lot_td2[]" id="lot_tb2" value="" class="regular-text" placeholder="Lot description"><?php echo $lot_td2[$i]; ?></textarea></td>
                            <td style="width:10%;"><i style="color: #0085ba;" class="fa <?php if($i==0){echo 'fa-plus-square';}else{echo 'fa-minus-square red-minus';}?>" aria-hidden="true"></i></td>
                        </tr>
                    </table>
                </div>
                <?php
        }
        ?>
    </div>
    <br>
    <div id="auction_image_container" style="width:98%;padding:10px;">
        <div style="margin-bottom: 1em;font-weight: bold">Bulk Images</div>
        <hr>
        <button type="submit" class="upload_image_button button">Add Images</button><br><br>
        <div class="upload">

            <?php
            if(count($images)==0)
            {
                ?>
                <div id ="single-image" style="width:10%;float:left;">
                    <input type="hidden" name="images[]"  value="" />
                </div>

                <?php
            }
            for($i=0;$i<count($images);$i++) {
                $img =  $images[$i];
                if($img!="")
                {
                    ?>
                    <div id ="single-image" style="width:10%;float:left;">
                        <img style="width: 95%;" data-src="" src="<?php echo $images[$i];?>" width="" height="50px;" />
                        <input type="hidden" name="images[]"  value="<?php echo $images[$i];?>" />
                        <button type="submit" class="remove_image_button button">&times;</button>
                    </div>

                <?php }} ?>
        </div>
    </div>
</div>
