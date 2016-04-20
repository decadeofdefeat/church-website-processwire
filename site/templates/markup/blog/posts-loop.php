  <?php
                    $totalPosts = count($posts);
                    $i = 0;
                    foreach ($posts as $post) {
                       echo '<div class="post-list-item">';

                       $thumb = $pages->get('/blog')->images->first()->size(640,360)->url;



                       if( count($post->thumbnail) > 0)
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

                        $mystring = 'Recap';
                        $pos = strpos($post->title, $mystring);

                        //$cat_recap = wire('pages')->get("/blog/topics/message-recap/");

                        if ($pos !== false || $post->message_recap == 1) {

                            //$thumb = '/site/assets/files/2837/twitter-recap-1.640x360.jpg';
                            //$thumb = '/site/assets/files/2837/recap-default.jpg';
                            $thumb = '';
                        }


                            echo " <h2><a href='{$post->url}'>{$post->title}</a></h2>";
                            $authorURL = $sanitizer->pageName($post->createdUser->title);
                            echo "<p class='post-author text-muted'>By <a href='/blog/author/{$authorURL}'>{$post->createdUser->title}</a>";

                            if( count($post->category) > 0 ){
                                 echo "<span class='mg-l-sm mg-r-sm'>&middot;</span>Topic: ";
                                 $out = '';
                                 foreach ($post->category as $cat) {
                                    $out .=  "<a href='{$cat->url}'>{$cat->title}</a>, ";
                                 }
                                 echo rtrim($out, ", ");
                            }

                            echo "</p>";
                            if($thumb != '')
                              echo " <div class='mg-b-sm2 mg-t-sm2'><a href='{$post->url}'><img src='{$thumb}' class=' img-responsive img-full-width' /></a></div>";

                            //echo shortenString($post->body, 300);

                            $bodyCopy = truncate(strip_tags($post->body), 350);


                            if($post->summary != '')
                            {
                                $summary = $post->summary;
                            } else {
                                $summary = $bodyCopy;
                            }
                            echo $summary;

                            echo "<div class='clearfix'></div>";
                            echo "<div class='mg-t-md'><a href='{$post->url}' class='btn btn-left btn-default'><i class='icon-right-4'></i> Continue Reading</a></div>";

                            //print "total posts ".$totalPosts." ".$i;
                            if( $totalPosts != $i+1 )
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
                    $blog_count = $pages->count("parent=/blog/,  category=$category, template=post");
                    if( $blog_count  > 0 ){
                      $data .= "<li><a href='".$category->url."'>".$category->title."</a></li>";
                    }

                }
                $data .= "</ul></div>";
                $cache->save($data);
            }
            echo $data;
        ?>



        </div>