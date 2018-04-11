<?php

class M_Model
{
    protected static $instance; 	

	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Model();
		
		return self::$instance;
	}

	public function GetRef($data, $site)
	{
	   $priority = 1;
	   unset($refer);
	   $refer[0]['r'] = $site;
	   $refer[0]['p'] = $priority;
	   
	  
		function Convers($data, $site, $priority, &$refer)
		{
			$priority = ($priority > 0.2)? $priority - 0.2: $priority;
			
			foreach ($data as $key => $value) {
				if ( is_array($value)) {	
					$site_b = $site . '/' .$key;
					$refer[] = ['r' => $site_b, 'p' => $priority];

					Convers($value, $site_b, $priority, $refer);

				} else {
					$refer[] = ['r' => $site . '/' . $value, 'p' => $priority];
				}
			}	
		}

		Convers($data, $site, $priority, $refer);

		return $refer;
	}

}