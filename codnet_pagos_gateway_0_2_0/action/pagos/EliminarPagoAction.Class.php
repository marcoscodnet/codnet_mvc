<?php

/**
 * Acción para eliminar un pago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class EliminarPagoAction extends Action {

    /**
     * se elimina un pago.
     */
    public function execute() {

        $id = FormatUtils::getParam('id');

        //se inicia una transacción.
        DbManager::begin_tran();

        try {
            
            $manager = new PagoManager();
            $manager->eliminarPago($id);
            $forward = 'eliminar_pago_success';
            //commit de la transacción.
            DbManager::save();
            
        } catch (GenericException $ex) {
            $forward = 'eliminar_pago_error';
            $this->setDs_forward_params('er=1' . '&msg=' . $ex->getMessage() . '&code=' . $ex->getCode());
            //rollback de la transacción.
            DbManager::undo();
        }

        return $forward;
    }

}
