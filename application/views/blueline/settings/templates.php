<script type="text/javascript" src="<?=base_url()?>assets/blueline/js/plugins/ckeditor/ckeditor.js"></script>
<div id="row">
	
		<div class="col-md-3">
			<div class="list-group">
				<?php foreach ($submenu as $name=>$value):
				$badge = "";
				$active = "";
				if($value == "settings/updates"){ $badge = '<span class="badge badge-success">'.$update_count.'</span>';}
				if($name == $breadcrumb){ $active = 'active';}?>
	               <a class="list-group-item <?=$active;?>" id="<?php $val_id = explode("/", $value); if(!is_numeric(end($val_id))){echo end($val_id);}else{$num = count($val_id)-2; echo $val_id[$num];} ?>" href="<?=site_url($value);?>"><?=$badge?> <?=$name?></a>
	            <?php endforeach;?>
			</div>
		</div>


<div class="col-md-9">

<div class="table-head"><?=$this->lang->line('application_'.$template.'_email_template');?>

<div class="btn-group pull-right">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <?php if($template){echo $this->lang->line('application_'.$template.'_email_template');}?> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right" role="menu">
         <?php foreach ($template_files as $value) { ?>
         	 <li><a href="<?=base_url()?>settings/templates/<?=$value;?>"><?=$this->lang->line('application_'.$value.'_email_template');?></a></li>
        <?php } ?>
        </div>
</div>
<?php   
$attributes = array('class' => '', 'id' => 'template_form');
echo form_open_multipart($form_action, $attributes); 
?>
<div class="table-div">
<br>
	<div class="form-group">
		<?php if(isset($settings->{$template.'_mail_subject'})){ ?>
			<label><?=$this->lang->line('application_subject');?></label>
			<input type="text" name="<?=$template;?>_mail_subject" class="required no-margin form-control" value="<?=$settings->{$template.'_mail_subject'};?>">
		<?php } ?>
	</div>
	<div class="form-group filled">
		<label><?=$this->lang->line('application_mail_body');?></label>
		<textarea class="required ckeditor"  name="mail_body"><?=$email;?></textarea>
	</div>
<div class="form-group">
<label><?=$this->lang->line('application_short_tags');?></label>
				<small style="padding-left:10px"> 
					<br/>
					<span class="tag">{logo}</span> 
					<span class="tag">{invoice_logo}</span>
					<span class="tag">{client_link}</span>
					<span class="tag">{client_contact}</span>
					<span class="tag">{client_company}</span>
					<span class="tag">{due_date}</span>
					<span class="tag">{invoice_id}</span>
					<span class="tag">{company}</span>
				</small>
			</div>
<div class="form-group no-border">			
<input type="submit" name="send" class="btn btn-primary" value="<?=$this->lang->line('application_save');?>"/>
<a href="<?=base_url()?>settings/settings_reset/email_<?=$template;?>" class="btn btn-danger tt pull-right" title=""><i class="icon dripicons-retweet"></i> <?=$this->lang->line('application_reset_default');?></a>
</div>
	
	<?php echo form_close(); ?>
</div>
</div>