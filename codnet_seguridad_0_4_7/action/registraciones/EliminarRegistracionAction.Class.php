<?php

/**
 * Acción para eliminar un registracion.
 * 
 * @author modelBuilder
 * @since 13-07-2011
 * 
 */
class EliminarRegistracionAction extends Action {

    /**
     * se elimina un registracion.
     */
    public function execute() {

        $id = FormatUtils::getParam('id');

        //se inicia una transacción.
        DbManager::begin_tran();

        try {
            
            $manager = new RegistracionManager();
            $manager->eliminarRegistracion($id);
            $forward = 'eliminar_registracion_success';
            //commit de la transacción.
            DbManager::save();
            
        } catch (GenericException $ex) {
            $forward = 'eliminar_registracion_error';
            $this->setDs_forward_params('er=1' . '&msg=' . $ex->getMessage() . '&code=' . $ex->getCode());
            //rollback de la transacción.
            DbManager::undo();
        }

        return $forward;
    }

}
