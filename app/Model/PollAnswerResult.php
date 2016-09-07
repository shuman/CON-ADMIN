<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class PollAnswerResult extends AppModel {

	public $primaryKey = 'poll_answer_result_id';
    public $name = 'PollAnswerResult';
    // public $hasMany = array(
    //     'Question' => array(
    //         'className' => 'Question',
    //         'foreignKey' => 'survey_id'
    //     )
    // );

}
