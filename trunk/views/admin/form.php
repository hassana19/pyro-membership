<?php if ($this->method === 'create'): ?>
<h3><?php echo lang('membership.new_member_label'); ?></h3>
<?php else: ?>
<h3><?php echo sprintf(lang('membership.manage_member_label'), $member->firstname); ?></h3>
<?php endif; ?>

<?php echo form_open(uri_string(), 'class="crud"'); ?>

	<div>
			<ol>
				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="firstname"><?php echo lang('membership.firstname_label'); ?></label>
					<?php echo form_input('firstname', $member->firstname, 'class="width-15"'); ?>
				</li>
				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="middlename"><?php echo lang('membership.middlename_label'); ?></label>
					<?php echo form_input('middlename', $member->middlename, 'class="width-15"'); ?>
				</li>
				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="lastname"><?php echo lang('membership.lastname_label'); ?></label><br />
					<?php echo form_input('lastname', $member->lastname, 'class="width-15"'); ?>
				</li>
				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="email"><?php echo lang('membership.email_label'); ?></label><br />
					<?php echo form_input('email', $member->email, 'class="width-15"'); ?>
					<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
				</li>
			</ol>
		</div>
	<div class="buttons align-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
	</div>

<?php echo form_close(); ?>