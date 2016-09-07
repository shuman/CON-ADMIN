<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class Poll extends AppModel {

	public $primaryKey = 'poll_id';
    public $name = 'Poll';
    // public $hasMany = array(
    //     'Question' => array(
    //         'className' => 'Question',
    //         'foreignKey' => 'survey_id'
    //     )
    // );

}
