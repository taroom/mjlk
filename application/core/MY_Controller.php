<?php
class MY_Controller extends CI_Controller{
	public $apps;
	public $title = 'MJLK';
	function __construct(){
		parent::__construct();
		$this->apps = [
			'apps_title' => $this->title,
			'apps_head_assets' => 'layouts/head',
			'apps_foot_assets' => 'layouts/foot',
			'apps_pages' => 'front',
		];
	}

	protected function setting($key, $value)
	{
		$this->apps[$key] = $value;
	}
}