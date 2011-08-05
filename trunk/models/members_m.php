<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * The members module enables users to manage members
 *
 * @author 		Buonzz
 * @package 	BuonzzSystems
 * @subpackage 	Membership
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Members_m extends MY_Model {

	/**
	 * Get all members 
	 *
	 * @author Buonzz
	 * @access public
	 * @return mixed
	 */
	public function get_all()
	{
		$members = parent::get_all();
		$results	= array();

		// Loop through each member
		foreach ($members as $member)
		{
			$results[] = $member;
		}
		// Return the results
		return $results;
	}//get all

	/**
	 * Insert a new member into the database
	 *
	 * @author Buonzz
	 * @access public
	 * @param array $input The data to insert (a copy of $_POST)
	 * @return bool
	 */
	public function insert($input)
	{

		return (int) parent::insert(array(
			'firstname'				=> $input['firstname'],
			'middlename'				=> $input['middlename'],
			'lastname'			=> $input['lastname'],
			'title'		=> $input['title'],
			'email'	=> $input['email'],
			'birthdate'			=> $input['birthdate'],
			'gender'		=> $input['gender'],
			'civilstatus'				=> $input['civilstatus'],
			'country'				=> $input['country'],
			'timezone'				=> $input['timezone']
		));
	}//insert

	/**
	 * Update an existing member
	 *
	 * @author Buonzz
	 * @access public
	 * @param int $id The ID of the row to update
	 * @param array $input The data to use for updating the DB record
	 * @return bool
	 */
	public function update($id, $input)
	{
        return parent::update($id, array(
			'firstname'				=> $input['firstname'],
			'middlename'				=> $input['middlename'],
			'lastname'			=> $input['lastname'],
			'title'		=> $input['title'],
			'email'	=> $input['email'],
			'birthdate'			=> $input['birthdate'],
			'gender'		=> $input['gender'],
			'civilstatus'				=> $input['civilstatus'],
			'country'				=> $input['country'],
			'timezone'				=> $input['timezone']
		));
	}//update
}//class