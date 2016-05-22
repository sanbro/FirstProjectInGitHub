<div id="content" class="span6">
<div class="row-fluid ui-sortable">
<div class="box span12">
<div class="box-header">
<h2><span class="break"></span>Form Elements</h2>
</div>
<div class="box-content">
<?php if(isset($message)){echo $message;} 

?>
<form class="form-horizontal" action="javascript:void(0)" data-action="<?php echo base_url($formUrl); ?>" role="form" id="addUserForm" enctype="multipart/form-data">
<?php if (isset($office)) {
	
?>
<div class="control-group">
	<label class="control-label" for="User Previlage">Office</label>
		<div class="controls">
		  <select id="selectError" data-rel="chosen" name="office">
		   <option value="0">Select One</option>

		  <?php foreach ($office as $ofc) {
		  ?>
		 		  <option value="<?php echo $ofc->ofc_id ;?>" <?php if(isset($content) && $content->ofc_id==$ofc->ofc_id){?> selected="selected"<?php }?>>
		 		  <?php echo $ofc->name; ?></option>
			<?php }?>	
				
			  </select>
		</div>
  </div>
  <?php }?>


<div class="control-group">
 <label class="control-label" for="fName">Username</label>
 <div class="controls">

<input type="text" class="span6 typeahead" id="typeahead" name="username" placeholder="Username" value="<?php if (isset($content)){ echo $content->username;}?>">
 
 
 </div>
</div>

<div class="control-group">
 <label class="control-label" for="Password">Password</label>
 <div class="controls">

<input type="password" class="span6 typeahead" id="typeahead" name="password" >

 </div>
</div>	

<div class="control-group">
 <label class="control-label" for="Repassword">Repassword</label>
 <div class="controls">
<input type="password" class="span6 typeahead" id="typeahead" name="password_confirm" >

 </div>
</div>

<div class="control-group">
 <label class="control-label" for="fName">First Name</label>
 <div class="controls">

<input type="text" class="span6 typeahead" id="typeahead" name="first_name" placeholder="First Name" value="<?php if (isset($content)){ echo $content->first_name;} ?>" >
 
 
 </div>
</div>

<div class="control-group">
 <label class="control-label" for="lName">Last Name</label>
 <div class="controls">

<input type="text" class="span6 typeahead" id="typeahead" name="last_name" placeholder="Last Name" value="<?php if (isset($content)){ echo $content->last_name; }?>" >
 <?php echo form_error('last_name', '<div class="error">', '</div>'); ?>
 
 </div>
</div>

<div class="control-group">
 <label class="control-label" for="email">Email</label>
 <div class="controls">
<input type="text" class="span6 typeahead" id="typeahead" name="email" placeholder="Email" value="<?php if (isset($content)){ echo $content->email;} ?>">
 <?php echo form_error('email', '<div class="error">', '</div>'); ?>
 
 </div>
</div>	



<div class="control-group">
 <label class="control-label" for="Contact">Contact Number</label>
 <div class="controls">
<input type="text" class="span6 typeahead" id="typeahead" name="phone" placeholder="Contact Number" value="<?php if (isset($content)){ echo $content->phone;} ?>">
 <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
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
success:function(response){
	if (response.status==1) {
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