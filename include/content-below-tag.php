<?php
    function for_content_below($contentBody){
        ob_start();
            echo $contentBody;
               $tag_contents = get_the_terms(get_the_ID(), 'post_tag' );
                    if(is_array($tag_contents)){
                        echo '<div class="d-flex flex-wrap mb-3"> <h5> Tags : </h5>';
                        foreach($tag_contents as $tag_content) {
                          echo  '<div class="m-1 bg-info px-2">
                                   <a class="text-white" href="'.get_tag_link($tag_content->term_id).'">'.$tag_content-> name.' </a>
                            </div>'; }
                        echo '</div>';
                        }
                return ob_get_clean();
    }

    add_filter('the_content', 'for_content_below', 11 );
?>