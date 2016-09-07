<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class PresetPollAnswer extends AppModel {

	public $primaryKey = 'preset_poll_answer_id';
    public $name = 'PresetPollAnswer';
    // public $hasMany = array(
    //     'Question' => array(
    //         'className' => 'Question',
    //         'foreignKey' => 'survey_id'
    //     )
    // );

}
