<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class Speaker extends AppModel {

	public $primaryKey = 'speaker_id';
    public $name = 'Speaker';
    // public $belongsTo = array(
    //     'Agenda' => array(
    //         'className' => 'Agenda',
    //         'foreignKey' => 'agenda_id'
    //     )
    // );

}
