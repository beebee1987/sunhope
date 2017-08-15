<?php if ($this->session->flashdata('message')):?>
<div class="alert alert-info">
	<a class="close" data-dismiss="alert">X</a>
	<?php echo $this->session->flashdata('message');?>
</div>
<?php endif;?>

<?php if ($this->session->flashdata('error')):?>
<div class="alert alert-error">
	<a class="close" data-dismiss="alert">X</a>
	<?php echo $this->session->flashdata('error');?>
</div>
<?php endif;?>

<?php if (!empty($error)):?>
<div class="alert alert-error">
	<a class="close" data-dismiss="alert">X</a>
	<?php echo $error;?>
</div>
<?php endif;?>