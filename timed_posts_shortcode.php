<?PHP

	function make_time($time){
	
		$units = explode(" ", $time);
		
		$date = explode("-", $units[0]);
		
		$time = explode(":", $units[1]);
		
		return mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]);
		
	}
	
	function timed_post_display($post_id){
	
		$post = get_post($post_id);
	
		echo $post->post_content;
	
	}

	function timed_posts_shortcode( $atts ) {
	
		if(isset($atts['timed_post_start'])){
		
			if(make_time($atts['timed_post_start'])<time()){			
		
				if(isset($atts['timed_post_end'])){
			
					if(make_time($atts['timed_post_end'])>time()){

						timed_post_display($atts['timed_post_id']);

					}
				
				}else{
				
					timed_post_display($atts['timed_post_id']);				
				
				}
				
			}
		
		}else if(isset($atts['timed_post_end'])){
			
			if(make_time($atts['timed_post_end'])>time()){

				timed_post_display($atts['timed_post_id']);

			}
	
		}
		
	}
	
	add_shortcode('timed_post', 'timed_posts_shortcode' );
	
?>