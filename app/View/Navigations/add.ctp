<div class="navigations form">
<?php echo $this->Form->create('Navigation'); ?>
	<fieldset>
		<legend><?php echo __('Add Navigation'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
		echo $this->Form->input('position');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Navigations'), array('action' => 'index')); ?></li>
	</ul>
</div>
