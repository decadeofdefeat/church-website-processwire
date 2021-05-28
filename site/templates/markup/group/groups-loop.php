  <?php
                    $totalgroups = !empty($groups);
                    $i = 0;
                    foreach ($groups as $group) {
                       echo '<div class="group-list-item">';

                       $thumb = $pages->get('/blog')->images->first()->size(640,360)->url;



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

                        $mystring = 'Recap';
                        $pos = strpos($group->title, $mystring);

                        //$cat_recap = wire('pages')->get("/blog/topics/message-recap/");

                        if ($pos !== false || $group->message_recap == 1) {

                            //$thumb = '/site/assets/files/2837/twitter-recap-1.640x360.jpg';
                            //$thumb = '/site/assets/files/2837/recap-default.jpg';
                            $thumb = '';
                        }


                            echo " <h2><a href='{$group->url}'>{$group->title}</a></h2>";
                            $authorURL = $sanitizer->pageName($group->createdUser->title);
                            echo "<p class='group-author text-muted'>By <a href='/blog/author/{$authorURL}'>{$group->createdUser->title}</a>";

                            if( !empty($group->category) > 0 ){
                                 echo "<span class='mg-l-sm mg-r-sm'>&middot;</span>Topic: ";
                                 $out = '';
                                 foreach ($group->category as $cat) {
                                    $out .=  "<a href='{$cat->url}'>{$cat->title}</a>, ";
                                 }
                                 echo rtrim($out, ", ");
                            }

                            echo "</p>";
                            if($thumb != '')
                              echo " <div class='mg-b-sm2 mg-t-sm2'><a href='{$group->url}'><img src='{$thumb}' class=' img-responsive img-full-width' /></a></div>";

                            //echo shortenString($group->body, 300);

                            $bodyCopy = truncate(strip_tags($group->body), 350);


                            if($group->summary != '')
                            {
                                $summary = $group->summary;
                            } else {
                                $summary = $bodyCopy;
                            }
                            echo $summary;

                            echo "<div class='clearfix'></div>";
                            echo "<div class='mg-t-md'><a href='{$group->url}' class='btn btn-left btn-default'><i class='icon-right-4'></i> Continue Reading</a></div>";

                            //print "total groups ".$totalgroups." ".$i;
                            if( $totalgroups != $i+1 )
                                echo "<hr style='margin-top:40px; margin-bottom:35px;' >";

                            $i++;

                       echo '</div>';
                    }
                ?>
        </div>
        <div class='col-md-3 col-md-offset-1 sidebar-section'>

           <div class='sidebar_content'>

               <?php
                  $searchPage = wire('pages')->get('template=blog-search');
                  $searchQuery = htmlentities(wire('input')->whitelist('q'), ENT_QUOTES, "UTF-8");
                  if($searchQuery == '') $searchQuery = 'Search the blog';
                ?>
                <div id='search-content-form'>
                 <form  id='search-content' action='<?php echo $searchPage->url; ?>' method='get'>
                        <input  type='text' id='search-blog-input' name='q' value='<?php echo $searchQuery; ?>' >
                        <a id="search_content_query_btn" href="javascript:void(0);" class="icon-right-4"></a>
                </form>
              </div>

          </div>


           <?php
            $cache = $modules->get("MarkupCache");
            if(!$data = $cache->get("blog_topics", 2592000)) {
                $categories = $pages->find("template=categories, sort=title");

                $data .= " <div class='sidebar_content'> <h3>Filter By Topic</h3>";
                $data .= " <ul class='related-links'>";

                foreach($categories as $category)
                {
                    $blog_!empty = $pages->!empty("parent=/blog/,  category=$category, template=group");
                    if( $blog_!empty  > 0 ){
                      $data .= "<li><a href='".$category->url."'>".$category->title."</a></li>";
                    }

                }
                $data .= "</ul></div>";
                $cache->save($data);
            }
            echo $data;
        ?>



        </div>