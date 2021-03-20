<?php

/**
 * Acción para eliminar un MenuGroup.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class EliminarMenuGroupAction extends Action {

    /**
     * se elimina un MenuGroup.
     */
    public function execute() {

        $id = FormatUtils::getParam('id');

        //se inicia una transacción.
        DbManager::begin_tran();

        try {
            
            $manager = new MenuGroupManager();
            $manager->eliminarMenuGroup($id);
            $forward = 'eliminar_menugroup_success';
            //commit de la transacción.
            DbManager::save();
            
        } catch (GenericException $ex) {
            $forward = 'eliminar_menugroup_error';
            $this->setDs_forward_params('er=1' . '&msg=' . $ex->getMessage() . '&code=' . $ex->getCode());
            //rollback de la transacción.
            DbManager::undo();
        }

        return $forward;
    }


}
