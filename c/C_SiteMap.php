<?php

class C_SiteMap extends C_Base
{
	// исходные данные
	protected $source_url = "http://mysite.loc/sitemap-data/index.php";
	protected $authorization = ['demo','123']; //login password
	protected $site = 'http://site.ru';
	//
	protected $ref;


	function __construct()
	{
	   parent::__construct();
	}
	
	protected function OnInput()
	{
		parent::OnInput();
		
		$ns = new M_GetData($this->source_url, $this->authorization);

		$dataArray = $ns->GetArray();

		$mModel = M_Model::Instance();

		$this->ref = $mModel->GetRef($dataArray, $this->site);
	} 
	
	protected function OnOutput()
	{
		
		$time = date('Y-m-d\Th:i:sP', time());

		$vars = array('refers' => $this->ref, 'time' => $time);
														
		$this->content = $this->Template('v/sitemap_c.php', $vars);
		parent::OnOutput();
		
	}	
}
