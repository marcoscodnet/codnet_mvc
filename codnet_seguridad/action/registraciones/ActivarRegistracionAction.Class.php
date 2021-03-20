<?php

/**
 * Acción para registrarse en el sistema.
 * 
 * @author bernardo
 * @since 09-05-2011
 * 
 */
class ActivarRegistracionAction extends Action {

    /**
     * se activa la registración de un usuario.
     * @return forward.
     */
    public function execute() {


        $codigoActivacion = FormatUtils::getParam('codigoactivacion');

        try {

            DbManager::begin_tran();

            $manager = new UsuarioManager();
            $manager->activarRegistracion( $codigoActivacion );
            $forward = 'activar_registracion_success';

            DbManager::save();
            //DbManager::close();
        } catch (GenericException $ex) {
            DbManager::undo();
            //DbManager::close();
            $_POST['title'] = CDT_SEGURIDAD_MSG_REGISTRAR_USUARIO_TITULO;
            $forward = $this->doForwardException($ex, 'activar_registracion_error');
        }



        return $forward;
    }



}