<div class="moduleTypes view">
<h2><?php echo __('Module Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($moduleType['ModuleType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($moduleType['ModuleType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($moduleType['ModuleType']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($moduleType['ModuleType']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($moduleType['ModuleType']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($moduleType['ModuleType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($moduleType['ModuleType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Module Type'), array('action' => 'edit', $moduleType['ModuleType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Module Type'), array('action' => 'delete', $moduleType['ModuleType']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $moduleType['ModuleType']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Module Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Module Type'), array('action' => 'add')); ?> </li>
	</ul>
</div>
