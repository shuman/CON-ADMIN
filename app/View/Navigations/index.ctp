<div class="navigations index">
	<h2><?php echo __('Navigations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('position'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($navigations as $navigation): ?>
	<tr>
		<td><?php echo h($navigation['Navigation']['id']); ?>&nbsp;</td>
		<td><?php echo h($navigation['Navigation']['type']); ?>&nbsp;</td>
		<td><?php echo h($navigation['Navigation']['name']); ?>&nbsp;</td>
		<td><?php echo h($navigation['Navigation']['slug']); ?>&nbsp;</td>
		<td><?php echo h($navigation['Navigation']['position']); ?>&nbsp;</td>
		<td><?php echo h($navigation['Navigation']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $navigation['Navigation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $navigation['Navigation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $navigation['Navigation']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $navigation['Navigation']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Navigation'), array('action' => 'add')); ?></li>
	</ul>
</div>
