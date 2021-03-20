<?php 

/** 
 * CdtUser class 
 *  
 * @author codnet archetype builder
 * @since 26-10-2011
 */ 
class CdtUser { 
	
	//variables de instancia.
	
	private $cd_user;
	
	private $ds_username;
	
	private $ds_name;
	
	private $ds_email;
	
	private $ds_password;
	
	private $oCdtUserGroup;
	
	private $ds_phone;
	
	private $ds_address;

	private $functions;

	//Constructor.
	public function CdtUser() { 
		//inicializar variables.
		
		
		$this->cd_user = '';
		
		$this->ds_username = '';
		
		$this->ds_name = '';
		
		$this->ds_email = '';
		
		$this->ds_password = '';
		
		$this->ds_phone = '';
		
		$this->ds_address = '';
		
		
		$this->oCdtUserGroup = new CdtUserGroup();
		
	}

	//Getters	
		
	public function getCd_user() { 
		return $this->cd_user;
	}
		
	public function getDs_username() { 
		return $this->ds_username;
	}
		
	public function getDs_name() { 
		return $this->ds_name;
	}
		
	public function getDs_email() { 
		return $this->ds_email;
	}
		
	public function getDs_password() { 
		return $this->ds_password;
	}
		
	public function getCdtUserGroup() { 
		return $this->oCdtUserGroup;
	}

	public function getDs_usergroup() { 
		return $this->getCdtUserGroup()->getDs_usergroup();
	}
	
	public function getDs_phone() { 
		return $this->ds_phone;
	}
		
	public function getDs_address() { 
		return $this->ds_address;
	}
	
		
	public function getCd_usergroup() { 
		return $this->oCdtUserGroup->getCd_usergroup();
	}
	

	//Setters
	
	public function setCd_user( $value ) { 
		$this->cd_user = $value;
	}
	
	public function setDs_username( $value ) { 
		$this->ds_username = $value;
	}
	
	public function setDs_name( $value ) { 
		$this->ds_name = $value;
	}
	
	public function setDs_email( $value ) { 
		$this->ds_email = $value;
	}
	
	public function setDs_password( $value ) { 
		$this->ds_password = $value;
	}
	
	public function setCdtUserGroup( $value ) { 
		$this->oCdtUserGroup = $value;
	}
	
	public function setDs_phone( $value ) { 
		$this->ds_phone = $value;
	}
	
	public function setDs_address( $value ) { 
		$this->ds_address = $value;
	}
	
	
	public function setCd_usergroup( $value ) { 
		$this->oCdtUserGroup->setCd_usergroup( $value );
	}
	

	public function getFunctions()
	{
	    return $this->functions;
	}

	public function setFunctions($functions)
	{
	    $this->functions = $functions;
	}
} 
?>
