<div class="navigations view">
<h2><?php echo __('Navigation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($navigation['Navigation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($navigation['Navigation']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($navigation['Navigation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($navigation['Navigation']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Position'); ?></dt>
		<dd>
			<?php echo h($navigation['Navigation']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($navigation['Navigation']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Navigation'), array('action' => 'edit', $navigation['Navigation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Navigation'), array('action' => 'delete', $navigation['Navigation']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $navigation['Navigation']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Navigations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Navigation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
