<?PHP

add_action("admin_menu", "timed_posts_editor_make");

add_action('admin_enqueue_scripts', 'display_css_javascript' );
	
function display_css_javascript() {
	
	wp_register_style( 'thickbox_css', plugins_url('/css/anytime.css', __FILE__) );
	wp_enqueue_style( 'thickbox_css' );
		
	wp_enqueue_script( 'anytimec', plugins_url('/js/anytimec.js', __FILE__));		
	wp_enqueue_script( 'timed_posts', plugins_url('/js/add_timed_posts.js', __FILE__));	
	
}

function timed_posts_editor_make(){

	add_meta_box("timed_posts_editor", "Timed Posts", "timed_posts_editor", "post");
	
}

function timed_posts_editor(){

	global $post;
	
	$wp_dir = wp_upload_dir();
	
	?>
	<p>If the 'enable' box isn't ticked then the time won't be added (meaning the timed post will have no start or end date - you may want this). To give a post a start and an end date make sure both boxes are ticked. All boxes are enabled by default.</p>
	<p><label>Start Date</label><input type="text" id="start1" name="field1" class="hasDatepicker" />
	<label>Start Hour</label><input type="text" id="start2" name="field2" class="hasDatepicker" />
	<label>Enable </label><input type="checkbox" id="start_enable" checked onclick="enable_start();" /></p>
	<script type="text/javascript">

	AnyTime.picker( "start1",
    { format: "%z-%m-%d", firstDOW: 1 } );
  jQuery("#start2").AnyTime_picker(
    { format: "%H:%i:%s" } );
	
	</script>
	<p><label>End Date</label><input type="text" id="end1" name="field1" class="hasDatepicker" />
	<label>End Hour</label><input type="text" id="end2" name="field2" class="hasDatepicker" />
	<label>Enable </label><input type="checkbox" id="end_enable" checked onclick="enable_end()" /></p>
	<script type="text/javascript">

	AnyTime.picker( "end1",
    { format: "%z-%m-%d", firstDOW: 1 } );
  jQuery("#end2").AnyTime_picker(
    { format: "%H:%i:%s" } );
	
	</script>
	<p>Choose a draft post to publish during this window</p>
	<?PHP
	
	$args = array( 'post_status' => 'draft' );
	$myposts = get_posts( $args );
	
	echo "<select id='timed_posts_post_id'>";
	
	foreach( $myposts as $post ){ ?>
	<option value="<?PHP echo $post->ID; ?>"><?php the_title(); ?></option>
	<?php
	
	}
	
	echo "</select>";
	?>
	<p>Shortcode <input id="shortcode_display" type="text" style="width:100%" /></p>
	<p><span onclick="javascript:add_timed_posts()" style="font-weight:bold; cursor:hand; cursor:pointer; background:#fff; border:1px solid black; padding:10px;">Add Timed Post</span></p><?PHP
	
}

?>