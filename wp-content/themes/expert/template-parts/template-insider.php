<?php
/*
Template Name: Insider Page
*/
/***********************Filter Queries************/
$join ='';
$where ='';
if(!empty($_POST['search']))
{
   $s = $_POST['search'];
   $join .= ' LEFT JOIN wp_postmeta AS wpp5 on wpp5.post_id = wps.ID';
   $where .= " AND (wps.post_title like '%$s%' or wps.post_content='%$s%' or (wpp5.meta_key ='advice_topic' AND wpp5.meta_value like '%$s%') or (wpp5.meta_key ='employer' AND wpp5.meta_value like '%$s%') or (wpp5.meta_key ='function' AND wpp5.meta_value like '%$s%') or (wpp5.meta_key ='language' AND wpp5.meta_value like '%$s%' ))";
}
else{
	$s ='';
}	
if(!empty($_POST['advice']))
{ 
	$advice =$_POST['advice'];
	$Advicefilter  = implode("', '", $advice);
	$Advicefilter_seprated = "'".$Advicefilter."'";
	$join .= ' LEFT JOIN wp_postmeta AS wpp1 on wpp1.post_id = wps.ID';
	$where .= ' AND ';
	$count = count($advice);
	if($count>1)
	{
		$where .= '(';
	}
		foreach($advice as $val) {
	$tt[] = "(wpp1.meta_key ='advice_topic' AND wpp1.meta_value like '%$val%' )";
	}
      $where .= implode(' OR ',$tt);
	  if($count>1)
	{
		$where .= ')';
	}
}
else{
	$advice=array();
}
if(!empty($_POST['employer']))
{ 
	$employer =$_POST['employer'];
	$employerfilter  = implode("', '", $employer);
	$employerfilter_seprated = "'".$employerfilter."'";
	 $join .= ' LEFT JOIN wp_postmeta AS wpp2 on wpp2.post_id = wps.ID';
	 $where .= " AND (wpp2.meta_key ='employer' AND wpp2.meta_value IN ($employerfilter_seprated))";
}
else{
	$employer=array();
}
if(!empty($_POST['function']))
{ 
	$function =$_POST['function'];
	$functionfilter  = implode("', '", $function);
	$functionfilter_seprated = "'".$functionfilter."'";
	 $join .= ' LEFT JOIN wp_postmeta AS wpp3 on wpp3.post_id = wps.ID';
	 $where .= " AND (wpp3.meta_key ='function' AND wpp3.meta_value IN ($functionfilter_seprated))";
}
else{
	$function=array();
}
if(!empty($_POST['language']))
{ 
	$language =$_POST['language'];
	$join .= ' LEFT JOIN wp_postmeta AS wpp4 on wpp4.post_id = wps.ID';
	$where .= ' AND ';
	$counts = count($language);
	if($counts>1)
	{
		$where .= '(';
	}
		foreach($language as $vals) {
	$tts[] = "(wpp4.meta_key ='language' AND wpp4.meta_value like '%$vals%' )";
	}
      $where .= implode(' OR ',$tts);
	  if($counts>1)
	{
		$where .= ')';
	}
}
else{
	$language=array();
}	
get_header(); 
?>
<link rel='stylesheet' id='fontawesome-css'  href="<?php echo get_site_url(); ?>/wp-content/plugins/stars-rating/includes/css/font-awesome.min.css?ver=4.7.0" type='text/css' media='all' />
<link rel='stylesheet' id='bar-rating-theme-css'  href="<?php echo get_site_url(); ?>/wp-content/plugins/stars-rating/includes/css/fontawesome-stars.css?ver=2.6.3" type='text/css' media='all' />
<link rel='stylesheet' id='stars-rating-styles-css'  href="<?php echo get_site_url();?>/wp-content/plugins/stars-rating/includes/css/style.css?ver=1.0.0" type='text/css' media='all' />
<div class="title-wrap">
	<div class="container">
		<h1 class="heading heaidng-left"><?php the_title();?></h1>
	</div>
</div>
<div class="wrappar">
	<div class="container">
		<div class="filter-wrap">
		<form method="post" id="target">
			<input type="text" class="search-bar" id="search" value="<?php echo $s;?>" name="search" />
			<h2>Filter insiders by:</h2>
			<h3>Advice Topics</h3>
			<ul class="filter-links advice">
				<li><input type="checkbox" name="advice[]" value="Career Conversations" <?php if(in_array("Career Conversations",$advice)){ echo 'checked';}?>/> Career Conversations</li>
				<li><input type="checkbox" name="advice[]" value="Business Consulting" <?php if(in_array("Business Consulting",$advice)){ echo 'checked';}?>/> Business Consulting</li>
				<li><input type="checkbox" name="advice[]" value="Background Check" <?php if(in_array("Background Check",$advice)){ echo 'checked';}?>/> Background Check</li>
			</ul>
			<h3>Employers</h3>
			<ul class="filter-links employer">
				<li><input type="checkbox" name="employer[]" value="Google" <?php if(in_array("Google",$employer)){ echo 'checked';}?>/> Google</li>
				<li><input type="checkbox" name="employer[]" value="Facebook" <?php if(in_array("Facebook",$employer)){ echo 'checked';}?>/> Facebook</li>
			</ul>
			<h3>Function</h3>
			<ul class="filter-links function">
				<li><input type="checkbox" name="function[]" value="Engineering" <?php if(in_array("Engineering",$function)){ echo 'checked';}?>/> Engineering</li>
				<li><input type="checkbox" name="function[]" value="Product / Design" <?php if(in_array("Product / Design",$function)){ echo 'checked';}?>/> Product / Design</li>
				<li><input type="checkbox" name="function[]" value="Sales & Marketing" <?php if(in_array("Sales & Marketing",$function)){ echo 'checked';}?>/> Sales & Marketing</li>
				<li><input type="checkbox" name="function[]" value="Others" <?php if(in_array("Others",$function)){ echo 'checked';}?>/> Others</li>
			</ul>
			<h3>Languages</h3>
			<ul class="filter-links language">
				<li><input type="checkbox" name="language[]" value="English" <?php if(in_array("English",$language)){ echo 'checked';}?>/> English</li>
				<li><input type="checkbox" name="language[]" value="Chinese" <?php if(in_array("Chinese",$language)){ echo 'checked';}?>/> Chinese</a></li>
			</ul>
			</form>
		</div>
		<div class="insiders-wrap">
		<div id="ajx_insider">
		<?php 
		global $wpdb;
		$sql1 = "SELECT distinct  wps.* FROM wp_posts AS wps ".$join." WHERE `post_type` = 'insider' ".$where." and `post_status` = 'publish' order by id DESC";
		$results1 = $wpdb->get_results($sql1, OBJECT);
		$sql = "SELECT distinct  wps.* FROM wp_posts AS wps ".$join." WHERE `post_type` = 'insider' ".$where." and `post_status` = 'publish' order by id DESC LIMIT 5"; 
	    $results = $wpdb->get_results($sql, OBJECT);
	    $totalrecords = count($results1);
        if(!empty($results))
				{
				foreach($results as $row):
			//print_r($row);
			$post_id = $row->ID;	
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
			/*****************Get Cooments***********/
            $args = array(
                'post_id' => $post_id,
                'status' => 'approve'
            );

            $comments = get_comments( $args );
            $ratings = array();
            $count = 0;

            foreach( $comments as $comment ) {

                $rating = get_comment_meta( $comment->comment_ID, 'rating', true );

                if ( ! empty( $rating ) ) {
                    $ratings[] = absint( $rating );
                    $count++;
                }
            }

            /*if ( 0 != count( $ratings )  ) {

                $avg = round( array_sum( $ratings ) / count( $ratings ) );

                echo '<div class="stars-avg-rating">';
                echo rating_stars11( $avg );
                echo $avg . ' based on '. $count .' reviews';
                echo '</div>';
            }*/

      			
	 ?>
			<div class="insider-row">
				<div class="i-logo"><a href="<?php echo $row->guid;?>"><img src="<?php echo $feat_image;?>" alt="" /></a></div>
				<div class="i-about">
					<h3><a href="<?php echo $row->guid;?>" style="color:#22262d;text-decoration:none;"><?php echo $row->post_title ;?></a></h3>
					<?php echo $row->post_content ;?>
				</div>
				<div class="i-ratings">
				<?php	if ( 0 != count( $ratings )  ) { ?>
					<div class="ratings">
				<?php
                $avg = round( array_sum( $ratings ) / count( $ratings ) );
                echo rating_stars11( $avg ); 
                ?>
					</div>
					<p><?php echo $count;?> reviews</p>
			<?php  }
				    else
				    {
			?>
					<p>no reviews</p>
			<?php } 	
			//Consultation count
			global $wpdb;
            $Consultcount = $wpdb->get_var("SELECT COUNT(*) FROM `wp_book_insiders` WHERE InsiderId = $post_id");
			?>				
					<p><?php echo $Consultcount;?> consult</p>
					
				</div>
				<div class="clr"></div>
			</div>
				<?php endforeach; ?>
			</div>
			<?php if($totalrecords >5) { ?>
			<div class="show_more_main" id="show_more_main<?php echo $post_id; ?>">
			<span id="<?php echo $post_id; ?>" class="show_more" title="Load more posts">Show more</span>
			<span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
			</div>	
			<?php }	} ?>
			
			<div class="insider-row talk-connx">
				<div class="i-logo"><img src="images/CHAT.png" alt="" /></div>
				<div class="i-about">
					<h3>Can't find the insider you want?</h3>
					<p>Let Connexis team help you!</p>
					
				</div>
				<div class="i-ratings">
					<a href="<?php echo site_url();?>/contact" class="btn">Talk to Connexis Team</a>
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
</div>
<script>
	jQuery(document).ready(function(){
		
		jQuery("#target :checkbox").click(function() {
           jQuery( "#target" ).submit();
        });
		/*jQuery(".employer input:checked").each(function() {
           employerCheckboxes.push(jQuery(this).val());
        });
		jQuery(".function input:checked").each(function() {
           functionCheckboxes.push(jQuery(this).val());
        });
		jQuery(".language input:checked").each(function() {
           languageCheckboxes.push(jQuery(this).val());
        });
		jQuery.ajax({
			type: 'post',
			url: "<?php echo get_site_url();?>/wp-content/themes/expert/template-insider.php",
			dataType:'text',
			async:false,
			data:{advicefilter:adviceCheckboxes,employerfilter:employerCheckboxes,functionfilter:functionCheckboxes,languagefilter:languageCheckboxes},
			success : function(html) {
            alert(html);
			}
	});*/
    jQuery(document).on('click','.show_more',function(){
		var adviceCheckboxes = new Array();
		var employerCheckboxes  = new Array();
		var functionCheckboxes  = new Array();
		var languageCheckboxes  = new Array();
        var ID = jQuery(this).attr('id');
		var s = jQuery("#search").val();
        jQuery('.show_more').hide();
        //jQuery('.loding').show();
        jQuery.ajax({
			type: 'post',
			url: "<?php echo get_site_url();?>/wp-admin/admin-ajax.php",
			dataType:'text',
			async:false,
			data:{action:'get_insider',insiderid:ID,search:s},
			success: function(response) {
			    jQuery('#ajx_insider').append(response);

				}
       });
	});
});
</script>
<?php get_footer(); ?>
