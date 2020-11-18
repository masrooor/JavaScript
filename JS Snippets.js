    //radio button selected after loading
    window.addEventListener('load', function() {
        var entryInfo = document.getElementById('entry-info').value;
        // var appID = <?php echo $applicationId?>;
        var currentID = document.getElementsByClassName('radio-btn-'+appID);
        for( var i = 0 ; i<currentID.length ; i++ ){
                if(appID == entryInfo){
                    currentID[i].checked = true; 
                    }
                }
    });
    //hide whole form 
    var f = document.getElementById("hide");
    for(var i=0,fLen=f.length;i<fLen;i++){
    f.elements[i].disabled = true; z//As @oldergod noted, the "O" must be upper case
    }
    //get radio button checked values
    jQuery('input:radio[name="id"]').change(
    function(){
        var id = jQuery('input[name="id"]:checked').val();
        // var id = (jQuery('input[name="id"]:checked').length > 0);
        // let val = document.getElementById("assessor-name" ).value;
        let val2 = document.getElementById("app-status").value;
        var newStatus = "<?php echo $getStatus?>";
        // alert(newStatus);
        
        var entry = jQuery(this).attr('data-entry');
        if(newStatus == 'yes' ){  
        // window.history.pushState(site_url + '/wp-admin/admin.php?page=documents_detail&id=' +<?php echo $applicationId ?>+'&submittedstatusrecords=yes',  '', site_url +'/wp-admin/admin.php?page=documents_detail&id='+id+'&submittedstatusrecords=yes' );
        location.reload(); 
        }
        else{
        // window.history.pushState(site_url + '/wp-admin/admin.php?page=documents_detail&id=' +<?php echo $applicationId ?>+'&submittedstatusrecords=no',  '', site_url +'/wp-admin/admin.php?page=documents_detail&id='+id+'&submittedstatusrecords=no' );
        location.reload(); 
        }
      });

      //show text on those cell their is no links
      var myElement = document.getElementById('records-'+<?php echo $client->entry_id ?>).getElementsByClassName('formTableData-');
      for( var i = 0 ; i  < myElement.length ; i++ ){
          myElement[i].innerHTML = 'No Document Submitted';
      }