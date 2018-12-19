<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); 
?>

<div class="title-wrap">
	<div class="container">
		<h1 class="heading heaidng-left">Insider</h1>
	</div>
</div>
<div class="wrappar insider-detail">
	<div class="container">
		<div class="insiders-wrap">
		<?php 	// Start the loop.
            while ( have_posts() ) : the_post();
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		?>
			<div class="id-top">
				<div class="id-logo"><img src="<?php echo $feat_image;?>" alt="" /></div>
				<h3><?php the_title();?></h3>
				<?php the_content();?>
				<a href="javascript:void(0)" id="book" class="btn btn-pink">Book this insider</a>
			</div>
			<div class="detail-row">
				<h3>Employer</h3>
				<p><?php the_field('employer',$post->ID);?></p>
			</div>
			<div class="detail-row">
				<h3>Languages</h3>
				<p><?php the_field('language',$post->ID);?></p>
			</div>
			<div class="detail-row bb-none">
				<h3>Advice Topic</h3>
				<?php $CareerConversationsPrice = get_field('career_conversations_price',$post->ID); 
				$BusinessConsultingPrice = get_field('business_consulting_price',$post->ID);
				  $BackgroundCheckPrice = get_field('background_check_price',$post->ID);
				  $adviceTopic ='';
				  if($CareerConversationsPrice !=''){
					  $adviceTopic .='Career Conversations($'.$CareerConversationsPrice.')';
				  }
				 if($BusinessConsultingPrice !=''){
					  $adviceTopic .=',Business Consulting($'.$BusinessConsultingPrice.')';
				  }
				  if($BackgroundCheckPrice !=''){
					  $adviceTopic .=',Background Check($'.$BackgroundCheckPrice.')';
				  }
				  $adviceTopic = explode(',',$adviceTopic);
				  $adviceTopics = array_filter($adviceTopic);
					 // print_r($adviceTopic);
				?>
				<select class="select" id="topic">
				<?php foreach ($adviceTopics as $topic)
				    {
				?>
				    <option value="<?php echo $topic;?>"><?php echo $topic;?></option>
				<?php } ?>
				</select>
			</div>
			<div class="consult">
			<?php 
			//Consultation count
			global $wpdb;
            $Consultcount = $wpdb->get_var("SELECT COUNT(*) FROM `wp_book_insiders` WHERE InsiderId = $post->ID");
			?>
				<span><img src="<?php echo get_template_directory_uri();?>/images/chat.png" alt="" /> <?php echo $Consultcount;?> Consults</span>
			<?php	$args = array(
                'post_id' => $post->ID,
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
            } ?>
			<?php	if ( 0 != count( $ratings )  ) { 
			        $avg = round( array_sum( $ratings ) / count( $ratings ) );
			 ?>
				<span><?php echo rating_stars11( $avg );  echo $count; ?> Reviews</span>
			<?php } else { ?>
			<span>No Reviews</span>
			<?php } ?>
			</div>
			<div class="reviews">
				
				<?php	if ( comments_open() || get_comments_number() ) {
				comments_template();
			}?>
				
			</div>
		<form>
            <input type="hidden" name="insiderId" id="insiderId" value="<?php echo $post->ID;?>" >
            <input type="hidden" name="insiderName" id="insiderName" value="<?php the_title();?>" >
        </form>
		<?php	endwhile;
		?>
		</div>
		<div class="filter-wrap">
			<?php get_sidebar(); ?>
		</div>
		<div class="clr"></div>
	</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
/***************Booking Request Jquery**************/
jQuery(document).ready(function(){
	jQuery('#book').click(function(){
		<?php 
		    if(is_user_logged_in())
		    { 
	     ?>
			   var InsiderID = jQuery('#insiderId').val();
			   var InsiderName = jQuery('#insiderName').val();
			jQuery.ajax({
				type: 'post',
				url: "<?php echo get_site_url();?>/wp-admin/admin-ajax.php",
				dataType:'text',
				async:false,
				data:{action:'book_insider',InsiderID:InsiderID,InsiderName:InsiderName},
                success: function(response){
                    if(response==1)
					{
						swal({
                            title: "Thanks!",
                            text: "You Booking request submitted successfully!",
                            icon: "success",
                            });
					}
					else{
						swal("Something went wrong.");
					}
                }
            });
		<?php  
		    }
		    else
		    { 
		?>
		    swal({
					title: "Sorry!",
					text: "Please login to book this insider!",
					icon: "error",
				});
		 <?php  } ?>
    });
});
</script>
<?php get_footer(); ?>
