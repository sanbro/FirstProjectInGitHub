<div id="content" class="span6">
<div class="row-fluid ui-sortable">
<div class="box span12">
<div class="box-header">
<h2><span class="break"></span>Form Elements</h2>
</div>
<div class="box-content">
<?php if(isset($error)){echo $error;}  
 ?>
<form class="form-horizontal" action="javascript:void(0)" data-action="<?php echo base_url($formUrl); ?>" role="form" id="addUserForm" enctype="multipart/form-data">

<div class="control-group">
 <label class="control-label" for="officeName">Office Name</label>
 <div class="controls">
<input type="text" class="span6 typeahead" id="typeahead" name="office_name" placeholder="First Name" value="<?php if (isset($content)){ echo $content->name ;}?>">
 </div>
</div>

<div class="control-group">
 <label class="control-label" for="email">Email</label>
 <div class="controls">
<input type="text" class="span6 typeahead" id="typeahead" name="email" placeholder="Email " value="<?php if (isset($content)){ echo $content->email ;}?>">
 </div>
</div>	


<div class="control-group">
 <label class="control-label" for="Contact">Contact Number</label>
 <div class="controls">
<input type="text" class="span6 typeahead" id="typeahead" name="phone" placeholder="Contact Number " value="<?php if (isset($content)){ echo $content->phone ;}?>">
 </div>
</div>	

<div class="control-group">
 <label class="control-label" for="Database">Database Name</label>
 <div class="controls">
<input type="text" class="span6 typeahead" id="typeahead" name="dbname" value="<?php if (isset($content)){ echo $content->name ;}?>" >
 </div>
</div>	



<div class="form-actions">
 <button type="submit" class="btn btn-primary" id="addBtn">Save</button>
  <button type="reset" class="btn" id="cancelBtn">Cancel</button>
</div>
</form>	
</div>	
</div>	
</div>
</div>
<script type="text/javascript">
$(function  () {
$("#addBtn").click(function(){
var url=$('#addUserForm').data("action");
var data=$('#addUserForm').serialize();
$.ajax({
type:'POST',
dataType:'json',
url:url,
data:data,
success: function(response){
		if(response.status==1){
		$.gritter.add({
                            text: response.message
                        });
				location.reload();
			}else{
			 $.gritter.add({
                            text: response.error
                        });
								
					}
	}
});
});
});	

</script>