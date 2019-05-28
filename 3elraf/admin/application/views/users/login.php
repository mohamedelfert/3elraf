<?php if(validation_errors() != false || isset($_SESSION['errorMsg'])) { ?>
<div class="bg-warning with-padding block-inner">
    <?=  validation_errors(' ' ,'/');?>
    <?=  $this->session->flashdata('errorMsg');?>
</div>
        <?php }?>
<div class="login-wrapper">
<?php echo form_open();?>
			<div class="popup-header">
				<span class="text-semibold">تسجيل الدخول</span>
			</div>
			<div class="well">
				<div class="form-group has-feedback">
					<label>الايميل</label>
					<?php echo form_input('email',$this->input->post('email'),'class="form-control"'); ?>
					<i class="icon-users form-control-feedback"></i>
				</div>

				<div class="form-group has-feedback">
					<label>الباسورد</label>
					<?php echo form_password('password','','class="form-control"'); ?>
					<i class="icon-lock form-control-feedback"></i>
				</div>

				<div class="row form-actions">
					<div class="col-xs-6">
					</div>

					<div class="col-xs-6">
                                            <?php echo form_submit('submit', 'تسجيل الدخول', 'class="btn btn-warning pull-right"'); ?>
					</div>
				</div>
			</div>
<?php echo form_close();?>
	</div>  
	<!-- /login wrapper -->
