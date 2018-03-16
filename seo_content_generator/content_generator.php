<?php
 /**
 * Plugin Name: Content Generator
 * Plugin URI: 
 * Description: Generate Content from Keywords
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Vikas Gautam
 * Author URI:
 * License: GPL2
 */
 defined('ABSPATH') or die("No script kiddies please!");
 add_action('admin_enqueue_scripts', 'content_generator_admin_scripts');
 function content_generator_admin_scripts() {
		  wp_enqueue_media();
		  wp_enqueue_script('validationscript', plugins_url('/js/jquery.validate.min.js',__FILE__), array('jquery'));
		   wp_enqueue_style( 'content-generator', plugins_url('/css/content_generator.css',__FILE__) );
 }

/*************Create Content Generator Setting menu*****/
add_action('admin_menu', 'con_generator_menu');
function con_generator_menu() {
	//create new top-level menu
	add_menu_page('Content Generator Settings', 'Content Generator Settings', 'administrator', __FILE__, 'cont_generator_menu_page');
	
}


function cont_generator_menu_page() {  ?>
		
		<style> #cat { width:100%; }</style>
	  <div class="left-form">
	  <h1>Content Generator Settings</h1>
		<form method="post" action="" id="form2">
			<table >
			
			<tr>
			 <td valign="top">
			  <label for="content_keyword">Focus Keyword *</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_keyword" size="50" placeholder="Content added here will replace 'Keyword' in your article">
			 </td>
			</tr>
			 
			<tr>
			 <td valign="top">
			  <label for="content_phone">Phone Number *</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_phone" size="50" placeholder="Content added here will replace 'Telephone' in your article">
			 </td>
			</tr>
			
			<tr>
			 <td valign="top">
			  <label for="content_domain">Domain*</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_domain" required size="50" placeholder="Content added here will replace 'Domain' in your article">
			 </td>
			 
			</tr>
			
			
			<tr>
			 <td valign="top">
			  <label for="content_city">City State*</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_city" size="50" placeholder="Content added here will replace 'City State' in your article">
			  <p>Please enter comma separated list of City State.</p>
			 </td>
			 
			</tr>
			
			
			
			
			
			
			<tr>
			 <td valign="top">
			  <label for="content_seo_title">All in One SEO Title *</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_seo_title"  size="50" placeholder="Enter All in One SEO Title Here">
			 </td>
			</tr>
			<tr>
			 <td valign="top">
			  <label for="content_seo_desc">All in One SEO Description *</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_seo_desc"  size="50" placeholder="Enter All in One SEO Description Here">
			 </td>
			</tr>
			<tr>
			 <td valign="top">
			  <label for="content_seo_keywords">All in One SEO Keywords *</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_seo_keywords"  size="50" placeholder="Enter All in One SEO Keywords Here">
			 </td>
			</tr>
			<tr>
			 <td valign="top">
			  <label for="content_title">Post Title *</label>
			 </td>
			 <td valign="top">
			  <input  type="text" name="content_title" size="50" placeholder="Enter Post title here">
			 </td>			 
			</tr>
			<tr>
			 <td valign="top">
			  <label for="content_title">Choose Category *</label>
			 </td>
			 <td valign="top">
			<?php wp_dropdown_categories( 'hide_empty=0' ); ?>
			 </td>			 
			</tr>
            
			<tr>
			 <td valign="top">
			  <label for="content_desp">Content </label>
			 </td>
			 <td valign="top">
			   <?php 
					wp_editor( '', 'content_description' );
				?>
			 
			 </td>
			 
			</tr>
			<tr>
			 <td colspan="2" style="text-align:center">
			  <input type="submit" value="Submit" name="submit" onclick="validationForm();"> 
			 </td>
			</tr>
			</table>
		</form>
	 </div>
	 <div class="right-panel">
		
		<?php 
		
		

		/** On Submission of Form**/
		if(isset($_POST['submit']) == "Submit"){
		
        if( $_POST['content_city'] && $_POST['content_keyword'] ){
		    $keywords = explode(',',$_POST['content_keyword']);
			$cities = explode(',',$_POST['content_city']);
			if( !empty( $keywords ) ){
			     $i = 1;
			    echo "<h1>Generated Posts:</h1></br>";
				echo "<h2><b>Post Title:</b></h2></br>";
				foreach( $keywords as $keyword ){
					if(!empty($cities)){
					  
					  
						foreach( $cities as $city_state ){
                            $space = substr($city_state, -3, 1);
                             $cities_states = trim($city_state);
                            //echo "<br/>";
                            $citystatedata = array_filter( explode(' ',$city_state));
							$domain = $_POST['content_domain'];
						   
						   // print_r(array_filter($citystatedata));
							echo "<br/>";
						   //echo $cities_states;//explode(" ",ltrim($city_state));
                           //$num = count($cities_states);
						   // $city = trim(trim($city_state));
                           
						   $ctycount= count($citystatedata);
						 
						 
						   $city = implode(" ",array_slice($citystatedata,0,-1));
						 
					   
					   //    echo "city--".trim($city)."--city";//$cities_states[0];
						  // if($space == " "){
                            if($cities_states){
							  //$state = $cities_states;
                             
							  $state = end($citystatedata);
							  
							  //echo $state = end(array_values($citystatedata));
							
							 // $city = trim(substr(trim($city_state),0, -2));
						    }
						    else{
							   $state = "";
                              // $city = trim($city_state);
						    }
						  //  echo "state--".$state."--state";//$cities_states[0];
						
							$str_to_replace = array("city","City","State","state","Telephone","telephone","keyword","Keyword");
							
							
							
							$lower_case_city = strtolower($city);
							$lower_case_state = strtolower($state);
							
							$lower_case_keyword = $keyword;
							
							
							$str_replace_to = array( $lower_case_city,$city,$state,$lower_case_state,$_POST['content_phone'],$_POST['content_phone'],$lower_case_keyword,$keyword );
							
							$str_to_replace_array= array("/\bcity\b/"=>$lower_case_city,
							                             "/\bCity\b/"=>$city,
														 "/\bDomain\b/"=>$domain,
														 "/\bdomain\b/"=>$domain,
														 "/\bState\b/"=>$state,
														 "/\bstate\b/"=>$lower_case_state,
														 "/\bTelephone\b/"=>$_POST['content_phone'],
														 "/\btelephone\b/"=>$_POST['content_phone'],
														 "/\bkeyword\b/"=>$lower_case_keyword,
														 "/\bKeyword\b/"=>$keyword);
							
							
							/**replacing keyword,city,state,telephone in title**/
							//$post_title = preg_replace($str_to_replace, $str_replace_to, $_POST['content_title']);
							
							$post_title = preg_replace(array_keys($str_to_replace_array), array_values($str_to_replace_array), $_POST['content_title']);
							
							
							//$p_title = $post_title ." in " . $city . " ( " . $keyword . " ) ";
							$p_title = $post_title;
							$post_categories = $_POST['cat'];
							
							//$post_content = preg_replace($str_to_replace, $str_replace_to, $_POST['content_description']);
							$post_content = preg_replace(array_keys($str_to_replace_array), array_values($str_to_replace_array), $_POST['content_description']);
							
							$args = array(
								  'post_title'    => $p_title,
								  'post_content'  => $post_content,
								  'post_status'   => 'publish'
								 
								);

								// Insert the post into the database
							$new_post_id = wp_insert_post( $args );

							wp_set_post_terms( $new_post_id, $post_categories, 'category', false );
					
							$seo_title = $_POST['content_seo_title'];
							
							$final_seo_title = preg_replace(array_keys($str_to_replace_array), array_values($str_to_replace_array), $seo_title);
							
							$seo_descp = $_POST['content_seo_desc'];
							
							
						    $final_seo_description = preg_replace(array_keys($str_to_replace_array), array_values($str_to_replace_array), $seo_descp);
							
							$seo_keywords = $_POST['content_seo_keywords'];
							
							
							$final_seo_keywords = preg_replace(array_keys($str_to_replace_array), array_values($str_to_replace_array),$seo_keywords);
							/*** Updating the Seo title, description, keywords ***/
							
								update_post_meta( $new_post_id,'_aioseop_title',$final_seo_title);
								update_post_meta( $new_post_id,'_aioseop_description',$final_seo_description);
								update_post_meta( $new_post_id,'_aioseop_keywords',$final_seo_keywords);
								echo "<h2>".$i.") <a href=".get_permalink($new_post_id)."> ".$p_title. " </a></h2>";
								$i++;
								
						
							
						}
					}
				}
		   }
		}
		
	  } ?>
	 </div>
<script type="text/javascript">		
		function validationForm() {

        jQuery("#form2").validate({
            rules: {
                'content_keyword': {
                    required: true,
                },
				'content_phone': {
                    required: true,
					
                },
				'content_city': {
                    required: true,
                },
				'content_seo_title': {
                    required: true,
                },
				'content_seo_desc': {
                    required: true,
					
                },
				'content_seo_keywords': {
                    required: true,
                },
				'content_title': {
                    required: true,
                },
				'content_description': {
                    required: true,
                },
            },
            messages: {
                'content_keyword': {
                    required: "Please enter the keyword",
                },
				'content_phone': {
                    required: "Please enter the Phone Number",
                },
				'content_city': {
                    required: "Please enter the City",
                },
				'content_seo_title': {
                    required: "Please enter the SEO Title",
                },
				'content_seo_desc': {
                    required: "Please enter the SEO Description",
                },
				'content_seo_keywords': {
                    required: "Please enter the SEO Keywords",
                },
				'content_title': {
                    required: "Please enter the title",
                },
				'content_description': {
                    required: "Please enter the Content",
                },
                
            },
            invalidHandler: function(event, validator) {
                return false;
            }
        });
    }
</script> 
<?php } ?>