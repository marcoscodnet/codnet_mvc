<?php
class PermisoQuery {
	
	static function permisosDeUsuario($cd_usuario, $nombreFuncion) {
		//$db = Db::conectar ();
		$db = DbManager::getConnection();
		
		$sql = "SELECT f.ds_funcion nombre FROM ".  CDT_SEGURIDAD_TABLA_FUNCION . " f ";
		$sql .= " INNER JOIN ".  CDT_SEGURIDAD_TABLA_PERFIL_FUNCION . " pf ON (f.cd_funcion = pf.cd_funcion)";
		$sql .= " INNER JOIN ".  CDT_SEGURIDAD_TABLA_PERFIL . " p ON (p.cd_perfil = pf.cd_perfil)";
		$sql .= " INNER JOIN ".  CDT_SEGURIDAD_TABLA_USUARIO . " u ON (u.cd_perfil = p.cd_perfil)";
		$sql .= " WHERE u.cd_usuario='$cd_usuario' AND UPPER(f.ds_funcion)='" . strtoupper($nombreFuncion)."'";
		$res = $db->sql_query ( $sql );
		if(!$res)//hubo un error en la bbdd.
			throw new DBException();
		$tiene =  $db->sql_numrows () > 0;
		$db->sql_freeresult($res);
		return $tiene;
	}
	
	static function tienePermiso($cd_usuario, $cd_funcion) {
		//$db = Db::conectar ();
		$db = DbManager::getConnection();
		
		$sql = "SELECT * FROM ".  CDT_SEGURIDAD_TABLA_FUNCION . " f ";
		$sql .= " INNER JOIN ".  CDT_SEGURIDAD_TABLA_PERFIL_FUNCION . " pf ON (f.cd_funcion = pf.cd_funcion)";
		$sql .= " INNER JOIN ".  CDT_SEGURIDAD_TABLA_PERFIL . " p ON (p.cd_perfil = pf.cd_perfil)";
		$sql .= " INNER JOIN ".  CDT_SEGURIDAD_TABLA_USUARIO . " u ON (u.cd_perfil = p.cd_perfil)";
		$sql .= " WHERE u.cd_usuario=$cd_usuario AND f.cd_funcion=$cd_funcion";
		$res = $db->sql_query ( $sql );
		if(!$res)//hubo un error en la bbdd.
			throw new DBException();
		$tiene =  $db->sql_numrows () > 0;
		$db->sql_freeresult($res);
		return $tiene;
	}	
}
?>