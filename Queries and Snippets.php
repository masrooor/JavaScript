<?php
        // remove  extra brackets from url
        $entryId = $entry['id'];
        $URL = content_url() . '/uploads/gravity_forms/1-e39d8bc7f4675898795e292d17197b9a/entries/';
        //require_once(WP_CONTENT_DIR. 'uploads/gravity_forms/1-1818d01131bbf1f97650c3717a3c7156/2020/04/0400006956864Mar-2020.pdf');
        $url = '["https:\/\/www.medicpro.london\/wp-content\/uploads\/gravity_forms\/1-e39d8bc7f4675898795e292d17197b9a\/entries\/';
        $remainingString = '"]';
        $json  =  json_encode($url, JSON_UNESCAPED_SLASHES);
    
        if (isset($_POST['pdf']))
        {
                $file = $_POST['fileToUpload'];
                $updatedFile = $json . $file . $remainingString;
                $removeInvertedComma = implode('[',explode('"[',$updatedFile));
                $removeInverted = implode('/',explode('/"',$removeInvertedComma));
                $metaId = $_POST['meta-id'];
                $entryId = $entry['id'];
                $query = "UPDATE wp_gf_entry_meta
                SET   meta_value = '$removeInverted'
                WHERE meta_key = '$metaId' AND entry_id = '$entryId' "; 
                $wpdb->query($query);
        } 
    //sending email using wp_mail function
    $data = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM wp_posts WHERE post_type = 'submitter_email' AND ID = '6531' " ) );
    // echo $data->post_title;
    $subject = $data->post_title;
    $userObj = get_user_by('id', $clientId);
    $emailBody = "<html><body>" . str_replace("XYZ",$userObj->display_name,$data->post_content) . "</body></html>";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($userObj->user_email, $subject, $emailBody, $headers); 


// get email templates post titles in drop down 
$type = 'email_template'; // your post type
$args=array(
  'post_type' => $type,
  'post_status' => 'publish');

$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
    <option value = '<?php the_ID() ?>'  name = '<?php the_ID() ?>' > <?php the_title() ?></option>
    <?php
  endwhile;
}
wp_reset_query();

// get current user
$current_user = wp_get_current_user();
//get query string
$getStatus = $_GET['submittedstatusrecords'];
// get data according to current user
$data = $wpdb->get_results("SELECT *  FROM wp_client_status WHERE assessor = '$current_user->display_name'  ORDER BY entry_id DESC ");
//get record where status is not equal to task complete and submitted and assessor is current user
$data = $wpdb->get_results("SELECT *  FROM wp_client_status WHERE (status <> 'Task Complete' AND status  <> 'Submitted'  )    AND  assessor = '$current_user->display_name' " );  
// for getting single row 
$dropDownData = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM wp_client_status WHERE entry_id = '$applicationId'  " )) ;
//


?>
