<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="<?php echo base_url(); ?>main">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#"><?php echo ucfirst($this->uri->segment(1)); ?></a></li>
				
			</ul>
    <div class="row-fluid">
    <?php $this->load->view('common/listtable'); ?>
    </div> 
			</div>