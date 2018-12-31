<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beli extends MY_Controller {
	public $apps;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_beli');
	}

	public function index()
	{
		$this->setting('apps_title', 'Beli | '.$this->title);
		$this->setting('apps_pages', 'beli/daftar');
		$this->setting('data', $this->m_beli->get()->result());
		
		$this->load->view('index', $this->apps);
	}

	public function list()//frontend
	{
		$this->setting('apps_title', 'Beli | '.$this->title);
		$this->setting('apps_pages', 'beli/list');
		$this->setting('data', $this->m_beli->get()->result());
		
		$this->load->view('index', $this->apps);
	}

	public function baru()
	{
		//detect post
		if($this->input->post()){
			$data['data_upload'] = $this->m_beli->upload('userfile',time());
			if($data['data_upload']['state']){
				$this->m_beli->foto = $data['data_upload']['upload_data']['file_name'];
			} else {
				$this->m_beli->foto = 'none.jpg';
			}
			$this->m_beli->tambah();
		}

		$this->setting('apps_title', 'Beli | '.$this->title);
		$this->setting('apps_pages', 'beli/list');
		$this->setting('data', $this->m_beli->get()->result());

		$this->load->view('index', $data);
	}

	public function ubah($id)
	{
		//detect post
		if($this->input->post()){
			$data['data_upload'] = $this->m_beli->upload('userfile',time());
			if($data['data_upload']['state']){
				$this->m_beli->foto = $data['data_upload']['upload_data']['file_name'];
			}

			$this->m_beli->ubah();
		}

		$dataone = $this->m_beli->one(['id_member' => $id]);

		$this->setting('apps_title', 'Beli | '.$this->title);
		$this->setting('apps_pages', 'beli/list');
		$this->setting('data', $dataone);

		$this->load->view('index', $data);
	}

	public function hapus($id)
	{
		if($this->input->post()){
			$this->m_beli->hapus();
		}
	}
}
