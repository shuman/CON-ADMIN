<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 */
class PresetAnswer extends AppModel {

	public $primaryKey = 'preset_answer_id';
    public $name = 'PresetAnswer';
    public $belongsTo = array(
        'Question' => array(
            'className' => 'Question',
            'foreignKey' => 'question_id'
        )
    );

}
