<div class="moduleTypes index">
	<h2><?php echo __('Module Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($moduleTypes as $moduleType): ?>
	<tr>
		<td><?php echo h($moduleType['ModuleType']['id']); ?>&nbsp;</td>
		<td><?php echo h($moduleType['ModuleType']['name']); ?>&nbsp;</td>
		<td><?php echo h($moduleType['ModuleType']['slug']); ?>&nbsp;</td>
		<td><?php echo h($moduleType['ModuleType']['content']); ?>&nbsp;</td>
		<td><?php echo h($moduleType['ModuleType']['status']); ?>&nbsp;</td>
		<td><?php echo h($moduleType['ModuleType']['created']); ?>&nbsp;</td>
		<td><?php echo h($moduleType['ModuleType']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $moduleType['ModuleType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $moduleType['ModuleType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $moduleType['ModuleType']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $moduleType['ModuleType']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Module Type'), array('action' => 'add')); ?></li>
	</ul>
</div>
