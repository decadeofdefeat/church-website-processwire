<?php

                    $totalPosts = !empty($posts);
                    $i = 0;
                    foreach ($posts as $post) {
                       echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">';

                       echo "<div style='background-color:#ffffff;padding-bottom:10px;' class='serif serif-md'>";

                       //$thumb = $pages->get('/ministries/global-missions/')->images->first()->size(640,360)->url;


                       if( !empty($post->thumbnail) > 0)
                       {
                             if( ($post->thumbnail->width() == '1280' &&  $post->thumbnail->height() == '720')
                                  || ($post->thumbnail->width() == '640' &&  $post->thumbnail->height() == '360'))
                              {
                                   $thumb = $post->thumbnail->url;
                              }
                              else
                              {
                                   $thumb = $post->thumbnail->size(640,360)->url;
                              }
                       }


                        if($thumb != '')
                            echo "<a href='{$post->url}'><img src='{$thumb}' class=' img-responsive img-full-width' /></a>";


                        echo "<div style='padding:10px 20px;'>";

                            echo " <h3 style='margin-top:0px;padding-top:6px;padding-bottom:6px;'><a href='{$post->url}'>{$post->title}</a></h3>";


                            $bodyCopy = truncate(strip_tags($post->body), 500);


                            if($post->summary != '')
                            {
                                //$summary = $post->summary;

                                $summary = truncate(strip_tags($post->summary), 500);
                            } else {
                                $summary = $bodyCopy;
                            }
                            echo $summary;

                            echo "<div class='clearfix'></div>";
                            echo "<div class='mg-t-md mg-b-sm' style='display: none;'><a href='{$post->url}' class='btn btn-left btn-default'><i class='icon-right-4'></i> Read More</a></div>";


                            $i++;
                         echo '</div>';
                         echo '</div>';
                       echo '</div>';
                    }
                ?>
        </div>
