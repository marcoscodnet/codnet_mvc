<?php

class CMPFindObject extends CMPComponent{

	//clase que atiende el listado.
	private $requestClass;
	
	//el método para obtener el valor a mostrar en el input (por lo que se busca).
	private $itemLabel;
	//el código del item.
	private $itemCode;
	
	//función javascript a llamar una vez seleccionado un item.
	private $functionCallback;

	//table model para el popup
	private $tableModel;
	
	public function setRequestClass( $value ){ $this->requestClass = $value; }
	public function getRequestClass(){ return $this->requestClass; }

	public function setItemLabel($value){ $this->itemLabel=$value; }
	public function getItemLabel(){ return $this->itemLabel; }

	public function setItemCode($value){ $this->itemCode=$value; }
	public function getItemCode(){ return $this->itemCode; }

	public function setFunctionCallback( $value ){ $this->functionCallback = $value; }
	public function getFunctionCallback(){ return $this->functionCallback; }

	public function setTableModel( $value ){ $this->tableModel = $value; }
	public function getTableModel(){ return $this->tableModel; }
	
	public function show(){
		return $this->getContent();
	}



	public function getContent(){

		$xtpl = $this->getXTemplate();
			
		$this->parseFindObject( $xtpl );

		$xtpl->parse("main");

		$content .= $xtpl->text("main");

		return $content;
	}

	private function parseFindPopup( $xtpl ){


		$xtpl->assign('requestClass', $this->getRequestClass() );
		$xtpl->assign('itemCode', $this->getItemCode() );
		$xtpl->assign('itemLabel', $this->getItemLabel());

		$xtpl->assign('functionCallback', $this->getFunctionCallback() );

		$xtpl->assign('tableModel', $this->getTableModel());	
		
	}

	public function findItems(){

		$page = $_GET['page']; // get the requested page 
		$limit = $_GET['rows']; // get how many rows we want to have into the grid 
		$sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
		$sord = $_GET['sord']; // get the direction 
		if(!$sidx) $sidx =1; 
		
		// connect to the database 
		$db = mysql_connect($dbhost, $dbuser, $dbpassword) or die("Connection Error: " . mysql_error()); 
		mysql_select_db($database) or die("Error conecting to db."); 
		$result = mysql_query("SELECT COUNT(*) AS count FROM invheader a, clients b WHERE a.client_id=b.client_id"); 
		$row = mysql_fetch_array($result,MYSQL_ASSOC); 
		$count = $row['count']; 
		if( $count >0 ) { 
			$total_pages = ceil($count/$limit); 
		} else { $total_pages = 0; } 
		if ($page > $total_pages) 
			$page=$total_pages; 
		
		$start = $limit*$page - $limit; // do not put $limit*($page - 1) 
		$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM invheader a, clients b WHERE a.client_id=b.client_id ORDER BY $sidx $sord LIMIT $start , $limit"; 
		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		 
		$jsondata->page = $page; 
		$jsondata->total = $total_pages; 
		$jsondata->records = $count; 
		$i=0; 
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) { 
			$jsondata->rows[$i]['id']=$row[id]; 
			$jsondata->rows[$i]['cell']=array($row[id],$row[invdate],$row[name],$row[amount],$row[tax],$row[total],$row[note]); 
			$i++; 
		} 
		
		return $jsondata;
	}


	public function getXTemplate(){

		$xtpl = new XTemplate( CDT_CMP_TEMPLATE_FINDPOPUP );

		$xtpl->assign('WEB_PATH', WEB_PATH);


		return $xtpl;

	}
	
}
?>