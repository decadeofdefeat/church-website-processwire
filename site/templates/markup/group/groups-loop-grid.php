  <?php
                    $totalGroups = !empty($groups);
                    $i = 0;
                    foreach ($Groups as $group) {
                       echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">';

                       echo "<div style='background-color:#ffffff;padding-bottom:10px;' class='serif serif-md'>";

                       $thumb = $pages->get('/lifegroup')->images->first()->size(640,360)->url;



                       if( !empty($group->thumbnail) > 0)
                       {
                             if( ($group->thumbnail->width() == '1280' &&  $group->thumbnail->height() == '720')
                                  || ($group->thumbnail->width() == '640' &&  $group->thumbnail->height() == '360'))
                              {
                                   $thumb = $group->thumbnail->url;
                              }
                              else
                              {
                                   $thumb = $group->thumbnail->size(640,360)->url;
                              }
                       }


                        if($thumb != '')
                            echo "<a href='{$group->url}'><img src='{$thumb}' class=' img-responsive img-full-width' /></a>";


                        echo "<div style='padding:10px 20px;'>";

                            echo " <h3 style='margin-top:0px;padding-top:6px;padding-bottom:6px;'><a href='{$group->url}'>{$group->title}</a></h3>";


                            $bodyCopy = truncate(strip_tags($group->body), 250);


                            if($group->summary != '')
                            {
                                //$summary = $group->summary;

                                $summary = truncate(strip_tags($group->summary), 250);
                            } else {
                                $summary = $bodyCopy;
                            }
                            echo $summary;

                            echo "<div class='clearfix'></div>";
                            echo "<div class='mg-t-md mg-b-sm'><a href='{$group->url}' class='btn btn-left btn-default'><i class='icon-right-4'></i> Read More</a></div>";


                            $i++;
                         echo '</div>';
                         echo '</div>';
                       echo '</div>';
                    }
                ?>
        </div>
