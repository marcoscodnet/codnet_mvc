<?php

/**
 * Acción para eliminar un MenuOption.
 * 
 * @author modelBuilder
 * @since 05-07-2011
 * 
 */
class EliminarMenuOptionAction extends Action {

    /**
     * se elimina un MenuOption.
     */
    public function execute() {

        $id = FormatUtils::getParam('id');

        //se inicia una transacción.
        DbManager::begin_tran();

        try {
            
            $manager = new MenuOptionManager();
            $manager->eliminarMenuOption($id);
            $forward = 'eliminar_menuoption_success';
            //commit de la transacción.
            DbManager::save();
            
        } catch (GenericException $ex) {
            $forward = 'eliminar_menuoption_error';
            $this->setDs_forward_params('er=1' . '&msg=' . $ex->getMessage() . '&code=' . $ex->getCode());
            //rollback de la transacción.
            DbManager::undo();
        }

        return $forward;
    }

}
