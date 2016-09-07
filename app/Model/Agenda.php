<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class Agenda extends AppModel {

	public $primaryKey = 'agenda_id';
    public $name = 'Agenda';
    public $hasMany = array(
        'Session' => array(
            'className' => 'Session',
            'foreignKey' => 'agenda_id'
        )
    );

}
