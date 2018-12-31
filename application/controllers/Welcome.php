<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	public function index()
	{
		$this->setting('apps_title', 'Halaman Depan | '.$this->title);
		$this->setting('apps_head_custom', 'layouts/head-custom');
		$this->load->view('index', $this->apps);
	}
}

// endang st dan ratih purwasih layu sebelum berkembang
// Bing Titik Puspa