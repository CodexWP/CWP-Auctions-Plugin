<?php
/**
 * The template for displaying all single posts.
 *
 * @package Poseidon
 */

get_header();?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<section style="width:100%;" id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post();
            $lot_settings = base64_decode(get_post_meta(get_the_ID(),'lot_settings',true));
            if(isset($lot_settings) && $lot_settings!='') {
                $lot = json_decode($lot_settings);
                $start_date = $lot->start_date;
                $end_date = $lot->end_date;
                $images = $lot->images;
                $lot_td1 = $lot->lot_td1;
                $lot_td2 = $lot->lot_td2;
                $lot_td3 = $lot->lot_td3;
                $today_date = date("m/d/Y");
                $start = strtotime($start_date);
                $end = strtotime($end_date);
                $today = strtotime($today_date);
            }
            else
            {
                $lot_td1 = $images = array();
            }
            ?>

            <header class="entry-header">
                <center><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></center>
                <div class="entry-content clearfix">
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-5">
                            <table style="font-size:0.8em;" class="table table-bordered">
                                <thead>
                                <th width="25%">Lot</th>
                                <th width="20%">Qty</th>
                                <th width="55%">Description</th>
                                </thead>
                                <tbody>
                                <?php
                                for($i=0;$i<count($lot_td1);$i++)
                                {
                                    if($lot_td1[$i]!="")
                                    {
                                        echo '<tr>';
                                        echo '<td>'.$lot_td1[$i].'</td><td>'.$lot_td3[$i].'</td><td>'.$lot_td2[$i].'</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-7">
                            <div id="auction-images" class="col-sm-12 border text-center pb-3 pt-3 pl-3 pr-3 mb-3">

                                <?php
                                for($i=0;$i<count($images);$i++)
                                {
                                    if($images[$i]!="")
                                    {
                                        $j = $i+1;
                                        echo '<img sn="'.$j.'" data-toggle="modal" data-target="#img-popup" style="max-width:22%;display: inline;" class="col-sm-3 p-1 border m-1" src="'.$images[$i].'">';
                                    }
                                }
                                echo '<script>var totalimg='.count($images).';</script>';
                                ?>
                                </div>
                        </div>
                    </div>
                </div>
            </header><!-- .entry-header -->
        <?php
        endwhile; ?>

    </main><!-- #main -->
</section><!-- #primary -->
<!-- Modal -->
<div class="modal fade" id="img-popup" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">

            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <button id="mprev" type="button" class="btn btn-default ">Prev</button>
                    <button id="mnext" style="float:right;" type="button" class="btn btn-default ">Next</button>
                </div>
            </div>
        </div>

    </div>
</div>
<!--End Modal -->

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php //get_sidebar(); ?>

<?php get_footer(); ?>

