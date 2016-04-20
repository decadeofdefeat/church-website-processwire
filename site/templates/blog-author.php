<?php

/**
 * Author Filter posts template
 *
 */

include_once("./includes/blog.inc");


// display paginated blog list
$headline = $page->get('headline|title');

include("./includes/head.inc");

$authorNotFound = false;
$slug = "-";

$inputSeg = $input->urlSegment(1) ? $input->urlSegment(1) : "Unknown Author";
$slug = ucwords(str_replace('-', ' ',$inputSeg ));
$author = $users->get("title=$slug");

if(!$author->id)
{
    $authorNotFound = true;

}


?>


<div class='section ' style='background-color:#efefef;'>

            <div class="container serif">
                <div class="row">
                    <div class="col-md-12 mg-t-lg mg-b-sm">

                             <h1><?php echo $page->title;?></h1>


                               <h3 class='mg-t-none pg-t-none'>Sorted by: <?php echo $slug;?></h3>

                               <?php
                             if(!$authorNotFound) {
                                //print $author->staff_page;
                                if( $author->staff_page)
                                {
                                    $staff = $pages->get("id=$author->staff_page");
                                    if($staff->id)
                                        echo "<p><a href='{$staff ->url}'><i class='icon-right-circle-12 fa-fw'></i>{$staff->title} Staff Page</a></p>";
                                }


                             }
                             ?>

                    </div>
                </div>
            </div>



        <?php if( $authorNotFound ){ ?>

            <div class="container  serif mg-b-lg">
                <div class="row ">
                    <div class='col-md-12'>
                            <p>Sorry, we can't find any posts for this author.</p>
                     </div>
                     </div>
         </div>

        <?php } else { ?>

        <div class="container pd-t-md pd-b-lg ">
            <div class="row multi-columns-row ">
                <?php
                    $posts =  $pages->find("parent=/blog/,  created_users_id=$author, sort=-date, template=post, limit=6");


                    $pagination =  $posts->renderPager(array(
                    'nextItemLabel' => "&raquo;",
                    'numPageLinks' => 5,
                    'previousItemLabel' => "&laquo;",
                    'listMarkup' => "<div class='text-center '><ul class='pagination'>{out}</ul></div>",
                    'itemMarkup' => "<li class='{class}'>{out}</li>",
                    'linkMarkup' => "<a href='{url}'>{out}</a>",
                    'currentItemClass' => 'active',
                    'separatorItemLabel' => "<a href='#'>&hellip;</a>"
                ));


                    $t = new TemplateFile(wire('config')->paths->templates . 'markup/blog/posts-loop-grid.php');
                    $t->set('posts', $posts);
                    $out = $t->render();
                    echo $out;

            ?>

   <div class='clearfix clear'></div>
    </div>

    <div class='container  pd-b-lg'>
        <div class='row'>
            <div class='col-md-12'>
            <?php

             echo $pagination;
            ?>
        </div>
        </div>

    </div>



</div><!-- end section -->


 <?php } ?>


<div class='container'>
 <div class='row mg-t-lg mg-b-lg'>

     <?php
                                  $searchPage = wire('pages')->get('template=blog-search');
                                  $searchQuery = htmlentities(wire('input')->whitelist('q'), ENT_QUOTES, "UTF-8");

                                ?>
                                <div class='col-md-8 col-md-offset-2 mg-b-sm2'>
                               <div id='search-content-form' class='search-series'>
                                 <form  id='search-content' action='<?php echo $searchPage->url; ?>' method='get'>
                                        <input  type='text' id='search-blog-input' placeholder='Search the blog' name='q' value='<?php echo $searchQuery; ?>' >
                                        <a id="search_content_query_btn" href="javascript:void(0);" class="icon-right-4"></a>
                                </form>
                              </div>
                          </div>


                      <?php
                        $cache = $modules->get("MarkupCache");
                        if(!$data = $cache->get("blog_topics", 29990)) {
                            $categories = $pages->find("template=categories, sort=title");

                            $data .= " <div class='col-md-8 col-md-offset-2 mg-b-sm2 '><h4 class='mg-b-sm2'>Filter by Topics</h4>";

                            foreach($categories as $category)
                            {
                                $blog_count = $pages->count("parent=/blog/,  category=$category, template=post");
                                if( $blog_count  > 0 ){
                                  $data .= "<a class='badge' href='".$category->url."'>".$category->title."</a>";
                                }

                            }
                            $data .= "</div></div>";
                            $cache->save($data);
                        }
                        echo $data;
                    ?>


    </div>
</div>




<?php

include("./includes/foot.inc");


