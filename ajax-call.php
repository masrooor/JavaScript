<script>
    //get unique record using data attribute and call php function using ajax
    jQuery(document).ready(function() { 
    jQuery(".submit-btn").click(function(){
        
        var clientID = jQuery(this).attr('data-client-id');
        var entryID = jQuery(this).attr('data-entry-id');
  
        jQuery.ajax({ 
        type: "POST",
        
         url : "<?php echo admin_url('admin-ajax.php'); ?>?action=submitProposedInterviewsRecords",
 
         data: {
            action: 'submitProposedInterviewsRecords',
            //  data: 'update=1&id='+clientID+'&upurls='+entryID,
            entryId : entryID,
            clientId : clientID,
         },
        success : function(response)
                  {
                    // alert("Successfully Assigned User "+ response);
                    // you can console the responseText and do what ever you want with responseText
                    // console.log(response);
                    location.reload();
                  },
                  error: function(response) {
					alert("ajax error, json: " + response);
				}
   
      });
      
    });
    return false;
    });
    jQuery(document).ready(function() {

    jQuery(".reject-btn").click(function(){
    var deleteEntryID = jQuery(this).attr('data-entry-id-delete');
    // alert('Entry ID ' + deleteEntryID);
    jQuery.ajax({ 
    type: "POST",
    url : "<?php echo admin_url('admin-ajax.php'); ?>?action=deleteApplication",
    data: {
        // action: 'deleteApplication',
        deleteEntry : deleteEntryID,
        // clientId : clientID, 
    },
    success : function(response)
              {
                location.reload();
              },
              error: function(response) {
                alert("ajax error, json: " + response);
            }
});
});
return false;
});
</script>
<?php
add_action('wp_ajax_submitProposedInterviewsRecords', 'submitProposedInterviewsRecords');

   
function submitProposedInterviewsRecords()
    {

        global $wpdb;
        $entryId = $_POST['entryId']; 

        $clientId = $_POST['clientId'];
        $assessor = $_POST['assessor'];
 
            $current_user = wp_get_current_user();
        $query_entry = "UPDATE wp_client_status 
        SET  assessor = '$current_user->display_name', status = 'Under Review'
        WHERE entry_id = '$entryId' AND client_id = '$clientId' ";
        $wpdb->query($query_entry); 
     //   ob_clean();
        echo 'successfully!';
 
        //  } 
       // wp_die();

     //   wp_die();
    //  die();
        
}
add_action('wp_ajax_deleteApplication', 'deleteApplication');
    function deleteApplication()
    {
        global $wpdb;
        $deleteEntry = $_POST['deleteEntry']; 
        $delete_query = "DELETE FROM wp_client_status
        WHERE id = '$deleteEntry'";
        $wpdb->query($delete_query); 
    }
?>
