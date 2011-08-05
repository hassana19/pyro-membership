<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Membership extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Membership'
			),
			'description' => array(
				'en' => 'Generic Membership system which stores member\'s personal info etc.'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'users'
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('bzmembers');
		$sql = "CREATE  TABLE ". $this->db->dbprefix('bzmembers'). " (
					`id` INT NOT NULL AUTO_INCREMENT ,
					`firstname` VARCHAR(255) NULL ,
					`middlename` VARCHAR(255) NULL ,
					`lastname` VARCHAR(255) NULL ,
					`title` VARCHAR(255) NULL ,
					`email` VARCHAR(255) NULL ,
					`birthdate` VARCHAR(45) NULL ,
					`gender` VARCHAR(45) NULL ,
					`civil_status` VARCHAR(45) NULL ,
					`country` VARCHAR(45) NULL ,
					`timezone` VARCHAR(45) NULL ,
					PRIMARY KEY (`id`) )
					ENGINE = InnoDB;";
		
		if($this->db->query($sql))
			return TRUE;
	}//installer

	public function uninstall()
	{
		if($this->dbforge->drop_table('bzmembers'))
			return TRUE;
	}//uninstall

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "<h4>Overview</h4>
		<p>Sometimes, a web application needs some place to collect memberhip info, such as Shopping Cart, Recruitment Center, Download Center etc</p>
		<p>This module provides that kind of ability, without exposing the PyroCMS Users. This is to make sure that Web Users and Applications Users are in the different context.</p>
		";
	}
}
/* End of file details.php */