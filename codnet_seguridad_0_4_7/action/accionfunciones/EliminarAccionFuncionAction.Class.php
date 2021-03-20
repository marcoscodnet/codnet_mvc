<?php

/**
 * Acción para eliminar un AccionFuncion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class EliminarAccionFuncionAction extends Action {

    /**
     * se elimina un AccionFuncion.
     */
    public function execute() {

        $id = FormatUtils::getParam('id');

        //se inicia una transacción.
        DbManager::begin_tran();

        try {
            
            $manager = new AccionFuncionManager();
            $manager->eliminarAccionFuncion($id);
            $forward = 'eliminar_accionfuncion_success';
            //commit de la transacción.
            DbManager::save();
            
        } catch (GenericException $ex) {
            $forward = 'eliminar_accionfuncion_error';
            $this->setDs_forward_params('er=1' . '&msg=' . $ex->getMessage() . '&code=' . $ex->getCode());
            //rollback de la transacción.
            DbManager::undo();
        }

        return $forward;
    }



}
