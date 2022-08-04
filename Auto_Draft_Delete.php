<?php

/*
  Plugin Name: Automatic Draft Delete
  Plugin URI: http://wordpress.org
  Description: Drafts are Automatically Deleted at 10:00 AM.....
  Author: Yega
  Author URI: http://cartrabbit.io/
  Version: 2.0
*/


class DraftPosts
{
    function __construct()
    {
        register_activation_hook(__FILE__, array($this, 'Activation'));
        
        add_action('active_cron_hook', array($this, 'Draft_Delete'));

        register_deactivation_hook(__FILE__, array($this, 'Deactivation'));

    }

    function Activation()
    {
        if(!wp_next_scheduled('active_cron_hook'))
        {
            $time=get_gmt_from_date('10:00 am','g:i a');
            wp_schedule_event(strtotime($time), 'daily', 'active_cron_hook');
        } 
    }

    function Draft_Delete(){

        $post_list = get_posts( array('post_status'=>'draft') );
      
        foreach($post_list as $post)
        {
          $post_id= $post->ID;
          wp_delete_post($post_id,true);
        }
    }

    function Deactivation()
    {
        wp_clear_scheduled_hook('active_cron_hook');
    }
}

$draftPosts = new DraftPosts();

