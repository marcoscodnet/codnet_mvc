<?php

/**
 * Acción para eliminar un funcion.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class EliminarFuncionAction extends Action {

    /**
     * se elimina un funcion.
     */
    public function execute() {

        $id = FormatUtils::getParam('id');

        //se inicia una transacción.
        DbManager::begin_tran();

        try {
            
            $manager = new FuncionManager();
            $manager->eliminarFuncion($id);
            $forward = 'eliminar_funcion_success';
            //commit de la transacción.
            DbManager::save();
            
        } catch (GenericException $ex) {
            $forward = 'eliminar_funcion_error';
            $this->setDs_forward_params('er=1' . '&msg=' . $ex->getMessage() . '&code=' . $ex->getCode());
            //rollback de la transacción.
            DbManager::undo();
        }

        return $forward;
    }


}
