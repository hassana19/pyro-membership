<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * The membership module provides an isolated records of Members which can be used in any purpose.
 *
 * @author 		Buonzz
 * @package 	BuonzzSystems
 * @subpackage 	PyroAddOns
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller
{
	public $id = 0;

	/**
	 * Validation rules for creating a new Member
	 *
	 * @var array
	 * @access private
	 */
	private $member_validation_rules = array(
		array(
			'field' => 'firstname',
			'label' => 'lang:membership.firstname_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'middlename',
			'label' => 'lang:membership.middlename_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'lastname',
			'label' => 'lang:membership.lastname_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'title',
			'label' => 'lang:membership.title_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'email',
			'label' => 'lang:membership.email_label',
			'rules' => 'trim|max_length[255]|required'
		),
		array(
			'field' => 'birthdate',
			'label' => 'lang:membership.birthdate_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'gender',
			'label' => 'lang:membership.gender_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'civilstatus',
			'label' => 'lang:membership.civilstatus_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'country',
			'label' => 'lang:membership.country_label',
			'rules' => 'trim|max_length[255]'
		),
		array(
			'field' => 'timezone',
			'label' => 'lang:membership.timezone_label',
			'rules' => 'trim|max_length[255]'
		)
	);

	/**
	 * Constructor method
	 *
	 * @author Buonzz
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('members_m');
		$this->load->library('form_validation');
		$this->lang->load('membership');
		$this->load->helper('html');

		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	}

	/**
	 * List all existing members
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
		// Get all the members
		$members = $this->members_m->get_all();

		// Load the view
		$this->template
			->title($this->module_details['name'])
			->set('members', $members)
			->build('admin/index');
	}

	/**
	 * Create a new member
	 *
	 * @access public
	 * @return void
	 */
	public function create()
	{
		// Set the validation rules
		$this->form_validation->set_rules($this->member_validation_rules);

		if ($this->form_validation->run() )
		{
			if ($id = $this->members_m->insert($this->input->post()))
			{
				// Everything went ok..
				$this->session->set_flashdata('success', lang('membership.member_create_success'));

				// Redirect back to the form or main page
				$this->input->post('btnAction') == 'save_exit'
					? redirect('admin/membership')
					: redirect('admin/membership/manage/' . $id);
			}
			
			// Something went wrong..
			else
			{
				$this->session->set_flashdata('error', lang('membership.member_create_error'));
				redirect('admin/membership/create');
			}
		}

		// Required for validation
		foreach ($this->member_validation_rules as $rule)
		{
			$member->{$rule['field']} = $this->input->post($rule['field']);
		}

		$this->template
			->title($this->module_details['name'], lang('membership.new_member_label'))
			->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
			->append_metadata( js('codemirror/codemirror.js') )
			->set('member',		$member)
			->build('admin/form');
	}

	/**
	 * Manage an existing member
	 *
	 * @author Darwin
	 * @access public
	 * @param int $id The ID of the member to manage
	 * @return void
	 */
	public function manage($id)
	{
			
		$this->form_validation->set_rules($this->member_validation_rules);

		// Get the member
		$member	= $this->members_m->get($id);

		if ( empty($member) )
		{
			$this->session->set_flashdata('error', lang('membership.exists_error'));
			redirect('admin/membership');
		}

		$this->id = $id;

		// Valid form data?
		if ($this->form_validation->run() )
		{
			// Try to update the gallery
			if ($this->members_m->update($id, $this->input->post()) === TRUE )
			{
				$this->session->set_flashdata('success', lang('membership.update_success'));

				// Redirect back to the form or main page
				$this->input->post('btnAction') == 'save_exit'
					? redirect('admin/membership')
					: redirect('admin/membership/manage/' . $id);
			}
			else
			{
				$this->session->set_flashdata('error', lang('membership.update_error'));
				redirect('admin/membership/manage/' . $id);
			}
		}

		// Required for validation
		foreach ($this->member_validation_rules as $rule)
		{
			if ($this->input->post($rule['field']))
			{
				$member->{$rule['field']} = $this->input->post($rule['field']);
			}
		}

		$this->template
			->title($this->module_details['name'], sprintf(lang('membership.manage_member_label'), $member->lastname . ', ' . $member->firstname))
			->append_metadata( $this->load->view('fragments/wysiwyg', $this->data, TRUE) )
			->append_metadata( js('codemirror/codemirror.js') )
			->set('member',		$member)
			->build('admin/form');
	}


	/**
	 * Delete an existing member
	 *
	 * @author Darwin
	 * @access public
	 * @param int $id The ID of the member to delete
	 * @return void
	 */
	public function delete($id = NULL)
	{
		$id_array = array();

		// Multiple IDs or just a single one?
		if ($this->input->post('action_to') )
		{
			$id_array = $this->input->post('action_to');
		}
		else
		{
			if ($id !== NULL )
			{
				$id_array[0] = $id;
			}
		}

		if ( empty($id_array) )
		{
			$this->session->set_flashdata('error', lang('membership.id_error'));
			//redirect('admin/membership');
		}

		// Loop through each ID
		foreach ( $id_array as $id)
		{
			// Get the member
			$member = $this->members_m->get($id);

			// Does the member exist?
			if ( !empty($member) )
			{

				// Delete the member
				if ($this->members_m->delete($id))
				{
					//redirect('admin/membership');
				}
				else
				{
					$this->session->set_flashdata('error', sprintf( lang('membership.delete_error'), $member->lastname . ', ' . $member->firstname));
					redirect('admin/membership');
				}
			}
		}

		$this->session->set_flashdata('success', lang('membership.delete_success'));
		redirect('admin/membership');
	}
}
