<div class="moduleTypes form">
<?php echo $this->Form->create('ModuleType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Module Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
		echo $this->Form->input('content');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ModuleType.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('ModuleType.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Module Types'), array('action' => 'index')); ?></li>
	</ul>
</div>
