<?php 

/** 
 * Autogenerated class 
 *  
 *  @author modelBuilder 
 *  @since 13-07-2011 
 */ 
class RegistracionManager implements IListar{ 

	public function agregarRegistracion(Registracion $oRegistracion) { 
		//TODO validaciones; 
		
		//que no exista el nombre de usuario.
		$oUsuario = new Usuario();
		$oUsuario->setDs_nomusuario( $oRegistracion->getDs_nomusuario() );
		if(UsuarioQuery::existeNombreUsuario( $oUsuario ))
			throw new GenericException( CDT_SEGURIDAD_MSG_USUARIO_REPETIDO );
		
		//que tampoco exista una registaci?n pendiente para el nombre de usuario.
		$criterio = new CriterioBusqueda();
		$criterio->addFiltro('ds_nomusuario', $oRegistracion->getDs_nomusuario(), "=", new FormatValorString());
		$repetido = $this->getRegistracion( $criterio );
		if($repetido!=null && $repetido->getCd_registracion()!=0){
			throw new GenericException( CDT_SEGURIDAD_MSG_USUARIO_REPETIDO );			
		}
		
		//generamos un c?digo de activaci?n y asignamos la fecha.
		$codigoactivacion=md5(uniqid(rand()));
		$fecha = date('Ymd');

		$oRegistracion->setDs_codigoactivacion( $codigoactivacion );
		$oRegistracion->setDt_fecha( $fecha );
		
		//persistir en la bbdd.
		RegistracionDAO::insertarRegistracion($oRegistracion);
		
		//env?o del email al usuario con el c?digo de activaci?n.
		$subject = CDT_SEGURIDAD_MSG_MAIL_REGISTRACION_SUBJECT;
		$nombre_destinario = $oRegistracion->getDs_apynom();
		$to = $oRegistracion->getDs_mail();
		
		$linkActivacion = WEB_PATH . CDT_SEGURIDAD_ACTIVAR_REGISTRACION_ACTION . '&codigoactivacion=' . $codigoactivacion;
		
		$xtpl = new XTemplate( CDT_SEGURIDAD_TEMPLATE_MAIL_ACTIVAR_REGISTRACION );
		$xtpl->parse('main');
		$msg = $xtpl->text('main');
		$params[] = $nombre_destinario;
		$params[] = $linkActivacion;
        $msg = FormatUtils::formatMessage($msg, $params);
		
        FuncionesComunes::enviarMail($nombre_destinario, $to, $subject, $msg);
		
	}


	public function modificarRegistracion(Registracion $oRegistracion) { 
		//TODO validaciones; 

		//persistir en la bbdd.
		RegistracionDAO::modificarRegistracion($oRegistracion);
	}


	public static function eliminarRegistracion($id) { 
		//TODO validaciones; 

		$oRegistracion = new Registracion();
		$oRegistracion->setCd_registracion($id);
		RegistracionDAO::eliminarRegistracion($oRegistracion);
	}


	public function getRegistraciones(CriterioBusqueda $criterio) { 
		return RegistracionDAO::getRegistraciones($criterio); 
	}


	public function getCantRegistraciones(CriterioBusqueda $criterio) { 
		return RegistracionDAO::getCantRegistraciones($criterio); 
	}


	public function getRegistracion(CriterioBusqueda $criterio) { 
		return RegistracionDAO::getRegistracion($criterio); 
	}

	//	interface IListar 
	public function getEntidades(CriterioBusqueda $criterio) { 
		return $this->getRegistraciones($criterio); 
	}


	public function getCantidadEntidades(CriterioBusqueda $criterio) { 
		return $this->getCantRegistraciones($criterio); 
	}


} 
?>
