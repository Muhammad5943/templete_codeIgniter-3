<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		// ini_set('display_errors', 'off'); // for disabled error
		parent::__construct();
		$this->load->dbforge();
		if ($this->db->table_exists('tbl_super_admin') == FALSE) {
		} else {
		}
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function created()
	{
		if ($this->db->table_exists('tbl_super_admin') == FALSE) {
			$this->create_table_tbl_super_admin();
			$this->create_table_tbl_jabatan();
			$this->create_table_tbl_menu();
			$this->create_table_tbl_hak_akses();
			
			$this->relation_tbl_hak_akses_tbl_jabatan();
			$this->relation_tbl_hak_akses_tbl_menu();

			redirect('');
		} else {
			$this->session->set_flashdata('error', 'Database Error');
			redirect('');
		}
	}

	public function create_table_tbl_super_admin()
	{
		if ($this->db->table_exists("tbl_super_admin") == FALSE) {
			$this->dbforge->add_field("id");
			$this->dbforge->add_field("`nib` VARCHAR(20) NOT NULL");
			$this->dbforge->add_field("`nama_perusahaan` VARCHAR(100) NOT NULL");
			$this->dbforge->add_field("`nama_pemilik` VARCHAR(100) NOT NULL");
			$this->dbforge->add_field("`telepon_perusahaan` VARCHAR(20) NOT NULL");
			$this->dbforge->add_field("`email_perusahaan` VARCHAR(50) NOT NULL");
			$this->dbforge->add_field("`alamat_perusahaan` TEXT NOT NULL");
			$this->dbforge->add_field("`password_perusahaan` VARCHAR(100) NOT NULL");

			$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL");

			$this->dbforge->create_table("tbl_super_admin");
		} else {
			redirect('');
		}
	}

	public function create_table_tbl_jabatan()
	{
		if ($this->db->table_exists('tbl_jabatan') == FALSE) {
			$this->dbforge->add_field("id");
			$this->dbforge->add_field("`nama_jabatan` VARCHAR(100) NOT NULL");

			$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL");

			$this->dbforge->create_table("tbl_jabatan");
		} else {
			redirect('');
		}
	}

	public function create_table_tbl_menu()
	{
		if ($this->db->table_exists('tbl_menu') == FALSE) {
			$this->dbforge->add_field("id");
			$this->dbforge->add_field("`nama_menu` VARCHAR(100) NOT NULL");
			$this->dbforge->add_field("`icon` VARCHAR(100) NOT NULL");
			$this->dbforge->add_field("`routes` VARCHAR(100) NOT NULL");

			$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL");

			$this->dbforge->create_table("tbl_menu");
		} else {
			redirect('');
		}
	}
	
	public function create_table_tbl_hak_akses()
	{
		if ($this->db->table_exists('tbl_hak_akses') == FALSE) {
			$this->dbforge->add_field("id");
			$this->dbforge->add_field("`id_jabatan` INT NOT NULL");
			$this->dbforge->add_field("`id_menu` INT NOT NULL");

			$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL");

			$this->dbforge->create_table("tbl_hak_akses");
		} else {
			redirect('');
		}
	}

	public function relation_tbl_hak_akses_tbl_jabatan()
	{
		return $this
			->db
			->query(
				"ALTER TABLE
					tbl_hak_akses
				ADD FOREIGN KEY
					tbl_hak_akses_ibfk_1(id_jabatan)
				REFERENCES
					tbl_jabatan(id)
				ON DELETE CASCADE ON UPDATE NO ACTION"
			);
	}

	public function relation_tbl_hak_akses_tbl_menu()
	{
		return $this
			->db
			->query(
				"ALTER TABLE
					tbl_hak_akses
				ADD FOREIGN KEY
					tbl_hak_akses_ibfk_2(id_menu)
				REFERENCES
					tbl_menu(id)
				ON DELETE CASCADE ON UPDATE NO ACTION"
			);
	}
}
