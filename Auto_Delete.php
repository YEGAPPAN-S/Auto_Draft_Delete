<?php

/*
  Plugin Name: Automatic Draft Delete
  Plugin URI: http://wordpress.org
  Description: Drafts are Automatically Deleted at 10:00 AM.....
  Author: Yega
  Author URI: http://cartrabbit.io/
  Version: 1.0.0 
*/

function Draft_Delete() {

  $post_list = get_posts( array('post_status'=>'draft') );

  foreach($post_list as $post){
    $post_id= $post->ID;
    wp_delete_post($post_id,true);
  }
}

function Draft_Delete_Time(){
  $current_time = strtotime(wp_date("g:i a"));
  $delete_time = strtotime('04:30 am');

  if ($current_time==$delete_time){
    Draft_Delete();
  }
  else {
  }
}
Draft_Delete_Time();
?>