<?php
//
// Базовый контроллер сайта.
//
abstract class C_Base extends C_Controller
{
	protected $content;	

    function __construct()
    {
	}
	
	protected function OnInput()
	{
      	$this->content = '';
	}
	
	protected function OnOutput()
	{
        $a = explode('://', $this->site);
        $site = $a[1];
        
        $vars = array('content' => $this->content);	
		$page = $this->Template('v/sitemap_h.php', $vars);				
		
        echo nl2br(htmlspecialchars($page));
        
        if (!file_exists('./sitemaps/'.$site)) {
                mkdir('./sitemaps/'.$site, 0777, true);
            } 
        
        file_put_contents('./sitemaps/'.$site.'/sitemap.xml', $page);
	}	
}
