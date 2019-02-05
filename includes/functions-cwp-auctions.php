<?php
add_shortcode( 'cwp-past-auctions', 'cwp_past_auctions' );
add_shortcode( 'cwp-up-auctions', 'cwp_upcomming_auctions' );
?>

<?php

function cwp_past_auctions($atts)
{
    if(isset($atts['number']))
        $per_page = $atts['number'];
    else
        $per_page = 12;

    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css', array(), '1', 'all');
    $today_date = date("m/d/Y");
    $d = new DateTime($today_date);
    $cur_ts = $d->getTimestamp();
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $args = array(
        'post_type' => 'auctions',
        'post_status' => 'publish',
        'meta_key' => 'auction_end_ts',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => $per_page,
        'paged' => $paged,
        'meta_query' => array(
            array(
                'key' => 'auction_end_ts',
                'value' => $cur_ts,
                'compare' => '<'
            )
        )
    );
    $auctions = new WP_Query($args);
    ?>
    <div class="container">
        <div class="row mb-5">
            <?php
            if ($auctions->have_posts()) :
                while ($auctions->have_posts()) :
                    $auctions->the_post();
                    $lot_settings = base64_decode(get_post_meta(get_the_ID(), 'lot_settings', true));
                    $lot = json_decode($lot_settings);
                    $start_date = $lot->start_date;
                    $end_date = $lot->end_date;
                    $img = $lot->images;
                    $img_url = get_the_post_thumbnail_url();
                    $msg = 'Status : Closed<br>Starts on : ' . $start_date . '<br>Ends on : ' . $end_date;
                    ?>
                    <div class="col-sm-12 mb-3">
                        <div class="border">
                            <a href="<?= get_permalink(get_the_ID()); ?>"><img class="col-sm-12 p-1"
                                                                               src="<?php echo $img_url; ?>"></a>
                        </div>
                        <div class="col-sm-12 border pt-2 pb-2">
                            <h6 style="font-weight: bold;"><a
                                    href="<?= get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a></h6>
                            <span style="color: #91042b;"><?php echo $msg; ?></span>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                esc_html_e('No auctions are found!', 'text-domain');
            endif;
            ?>
        </div>

        <div class="row mb-5">
            <div class="col-sm-6 mb-2 text-left">
                <?php
                previous_posts_link('<button class="btn-lg search-submit"><i class="fa fa-caret-left" aria-hidden="true"></i> Previous</button>', $auctions->max_num_pages);
                ?>
            </div>
            <div class="col-sm-6 mb-2 text-right">
                <?php
                next_posts_link('<button class="btn-lg search-submit">Next <i class="fa fa-caret-right" aria-hidden="true"></i> </button>', $auctions->max_num_pages);
                ?>
            </div>
        </div>
    </div>
    <?php
}

function cwp_upcomming_auctions($atts)
{
    if(isset($atts['number']))
        $per_page = $atts['number'];
    else
        $per_page = 12;

    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css', array(), '1', 'all');
    $today_date = date("m/d/Y");
    $d = new DateTime($today_date);
    $cur_ts = $d->getTimestamp();
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
    $args = array(
        'post_type' => 'auctions',
        'post_status' => 'publish',
        'meta_key' => 'auction_end_ts',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page' => $per_page,
        'paged' => $paged,
        'meta_query' => array(
            array(
                'key' => 'auction_end_ts',
                'value' => $cur_ts,
                'compare' => '>='
            )
        )
    );
    $auctions = new WP_Query($args);
    ?>
    <div class="container">
        <div class="row mb-5">
            <?php
            if ($auctions->have_posts()) :
                while ($auctions->have_posts()) :
                    $auctions->the_post();
                    $lot_settings = base64_decode(get_post_meta(get_the_ID(), 'lot_settings', true));
                    $lot = json_decode($lot_settings);
                    $start_date = $lot->start_date;
                    $end_date = $lot->end_date;
                    $img = $lot->images;
                    $img_url = get_the_post_thumbnail_url();
                    $msg = 'Starts on : ' . $start_date . ',  Ends on : ' . $end_date;
                    ?>
                    <div class="col-sm-12 mb-3">
                        <div class="border">
                            <a href="<?= get_permalink(get_the_ID()); ?>"><img class="col-sm-12 p-1"
                                                                               src="<?php echo $img_url; ?>"></a>
                        </div>
                        <div class="col-sm-12 border pt-2 pb-2">
                            <h5 style="font-weight: bold;"><a
                                    href="<?= get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a></h5>
                            <span style="color: #91042b;"><?php echo $msg; ?></span>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                esc_html_e('No auctions are found!', 'text-domain');
            endif;
            ?>
        </div>

        <div class="row mb-5">
            <div class="col-sm-6 mb-2 text-left">
                <?php
                previous_posts_link('<button class="btn-lg search-submit"><i class="fa fa-caret-left" aria-hidden="true"></i> Previous</button>', $auctions->max_num_pages);
                ?>
            </div>
            <div class="col-sm-6 mb-2 text-right">
                <?php
                next_posts_link('<button class="btn-lg search-submit">Next <i class="fa fa-caret-right" aria-hidden="true"></i> </button>', $auctions->max_num_pages);
                ?>
            </div>
        </div>
    </div>
    <?php
}


?>