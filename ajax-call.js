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