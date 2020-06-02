<?php
/*-----------------------------------------------------------------------------------*/
/* Include Theme Functions */
/*-----------------------------------------------------------------------------------*/
function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/* Modify RSS feeds to use a different unique ID based on the story modification date.  This is used by an RSS to email service so that changes to meetings are treated as new stories. */
function sudbury_do_feed_rss2($for_comments)
{
	if($for_comments)
	{
		load_template(ABSPATH . WPINC . "/feed-rss2-comments.php");
	}
	else
	{
		load_template(get_template_directory() . "/sudbury-feed-rss2.php");
	}
}
remove_all_actions("do_feed_rss2");
add_action("do_feed_rss2", "sudbury_do_feed_rss2", 10, 1);
