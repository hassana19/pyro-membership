<?php if ($this->method === 'create'): ?>
<h3><?php echo lang('membership.new_member_label'); ?></h3>
<?php else: ?>
<h3><?php echo sprintf(lang('membership.manage_member_label'), $member->firstname); ?></h3>
<?php endif; ?>

<?php echo form_open(uri_string(), 'class="crud"'); ?>

	<div>
			<ol>
				<li class="<?php echo alternator('', 'even'); ?>">
					<?php echo form_label(lang('galleries.folder_label'), 'folder_id'); ?>
					<?php echo form_dropdown('folder_id', array(lang('select.pick')) + $folders_tree, $gallery->folder_id, 'id="folder_id" class="required"'); ?>
				</li>

				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="title"><?php echo lang('galleries.title_label'); ?></label>
					<input type="text" id="title" name="title" maxlength="255" value="<?php echo $gallery->title; ?>" />
					<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
				</li>

				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="slug"><?php echo lang('galleries.slug_label'); ?></label>
					<?php echo form_input('slug', $gallery->slug, 'class="width-15"'); ?>
					<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
				</li>

				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="description"><?php echo lang('galleries.description_label'); ?></label><br />
					<?php echo form_textarea(array('id'=>'description', 'name'=>'description', 'value' => $gallery->description, 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>
				</li>

				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="comments"><?php echo lang('galleries.comments_label'); ?></label>
					<?php echo form_dropdown('enable_comments', array('1'=>lang('galleries.comments_enabled_label'), '0'=>lang('galleries.comments_disabled_label')), $gallery->enable_comments); ?>
				</li>

				<li class="<?php echo alternator('', 'even'); ?>">
					<label for="published"><?php echo lang('galleries.published_label'); ?></label>
					<?php echo form_dropdown('published', array('1'=>lang('galleries.published_yes_label'), '0'=>lang('galleries.published_no_label')), $gallery->published); ?>
				</li>
			</ol>
		</div>
	<div class="buttons align-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
	</div>

<?php echo form_close(); ?>