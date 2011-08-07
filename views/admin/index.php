<?php echo form_open('admin/membership/delete');?>

<?php if ( ! empty($members)): ?>

	<table border="0" class="table-list">
		<thead>
			<tr>
				<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th><?php echo lang('membership.name_label'); ?></th>
				<th width="140"><?php echo lang('membership.email_label'); ?></th>
				<th width="140"><?php echo lang('membership.gender_label'); ?></th>
				<th width="350" class="align-center"><?php echo lang('membership.action_label'); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach( $members as $member ): ?>
			<tr>
				<td><?php echo form_checkbox('action_to[]', $member->id); ?></td>
				<td><?php echo $member->lastname . ", ". $member->firstname; ?></td>
				<td><?php echo $member->email; ?></td>
				<td><?php echo $member->gender; ?></td>
				<td class="align-center buttons buttons-small">
					<?php echo anchor('admin/membership/manage/'	. $member->id, 			lang('membership.manage_member_label'), 'class="button"'); ?>
					<?php echo anchor('admin/membership/delete/'	. $member->id, 			lang('membership.delete_label'), array('class'=>'confirm button delete')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="buttons align-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
	</div>

<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('membership.no_members_error'); ?></h2>
	</div>
<?php endif;?>

<?php echo form_close(); ?>