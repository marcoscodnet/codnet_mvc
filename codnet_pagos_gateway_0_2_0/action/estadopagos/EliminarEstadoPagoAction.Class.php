<?php

/**
 * Acción para eliminar un estadoPago.
 * 
 * @author modelBuilder
 * @since 20-07-2011
 * 
 */
class EliminarEstadoPagoAction extends Action {

    /**
     * se elimina un estadoPago.
     */
    public function execute() {

        $id = FormatUtils::getParam('id');

        //se inicia una transacción.
        DbManager::begin_tran();

        try {
            
            $manager = new EstadoPagoManager();
            $manager->eliminarEstadoPago($id);
            $forward = 'eliminar_estadopago_success';
            //commit de la transacción.
            DbManager::save();
            
        } catch (GenericException $ex) {
            $forward = 'eliminar_estadopago_error';
            $this->setDs_forward_params('er=1' . '&msg=' . $ex->getMessage() . '&code=' . $ex->getCode());
            //rollback de la transacción.
            DbManager::undo();
        }

        return $forward;
    }

}
