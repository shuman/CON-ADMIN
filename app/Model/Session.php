<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class Session extends AppModel {

	public $primaryKey = 'session_id';
    public $name = 'Session';
    public $belongsTo = array(
        'Agenda' => array(
            'className' => 'Agenda',
            'foreignKey' => 'agenda_id'
        )
    );
    public $hasMany = array(
        'Breakout' => array(
            'className' => 'Breakout',
            'foreignKey' => 'session_id'
        ),
        'SessionSpeaker' => array(
            'className' => 'SessionSpeaker',
            'foreignKey' => 'session_id'
        )
    );

}
