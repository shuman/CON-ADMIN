<?php

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ConveneController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

	public function index() {
		
	}

	public function agenda() {
		ClassRegistry::init('Agenda')->bindModel(array('hasMany' => ['Session']));
		$agendas = ClassRegistry::init('Agenda')->find('all', ['conditions' => ['Agenda.deleted' => 0], 'order' => 'Agenda.event_day DESC']);	
		$navigation = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.slug' => 'agenda']]);
		$this->set('navigation', $navigation);
		$this->set('agendas', $agendas);
	}

	public function sessionElement() {

		if ($this->RequestHandler->isAjax()) { 
		$speakers = ClassRegistry::init('Speaker')->find('list', ['fields' => ['speaker_id', 'name'], 'conditions' => ['Speaker.deleted' => 0]]);
		$this->set('speakers', $speakers);
         $this->render('/Elements/sessionAgenda'); 
     	} 
	}

	public function maps() {
		// $allMap = ClassRegistry::init('Map')->find('all');
		// $i = 1;
		// foreach ($allMap as $key => $eachMap) {
		// 	ClassRegistry::init('Map')->id = $eachMap['Map']['map_id'];
		// 	ClassRegistry::init('Map')->saveField('show_order', $i);
		// 	$i = $i + 1;
		// }

		$maps = ClassRegistry::init('Map')->find('all', ['fields' => ['map_id', 'name'], 'conditions' => ['Map.deleted' => 0], 'limit' => 10, 'order' => 'Map.show_order ASC']);
		$navigation = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.slug' => 'maps']]);
		$this->set('navigation', $navigation);
		$this->set('maps', $maps);
	}

	public function createMapElement() {
		if ($this->RequestHandler->isAjax()) { 
         $this->render('/Elements/createMap'); 
     	} 
	}

	public function createSpeakerElement() {
		if ($this->RequestHandler->isAjax()) {
		$speakerBg = ClassRegistry::init('Conference')->find('first');
		$this->set('speakerBg', $speakerBg); 
         $this->render('/Elements/createSpeaker'); 
     	} 
	}

	public function saveSpeaker() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
		if (ClassRegistry::init('Speaker')->save($this->request->data)) {
			$speakerId = ClassRegistry::init('Speaker')->getlastInsertID();
			return json_encode((int)$speakerId);
		} else {
			return json_encode(0);
		}
	}

	public function notes() {

	}

	public function speakers() {
		$speakerBg = ClassRegistry::init('Conference')->find('first');
		$this->set('speakerBg', $speakerBg);
		$speakers = ClassRegistry::init('Speaker')->find('all', ['limit' => 10, 'conditions' => ['Speaker.deleted' => 0], 'order' => 'show_order ASC']);
		$navigation = ClassRegistry::init('Navigation')->find('first', ['conditions' => ['Navigation.slug' => 'speakers']]);
		$this->set('navigation', $navigation);
		$this->set('speakers', $speakers);
	}

	public function mapImageUpload() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);

		//check if the file type is image and then extension
		// store the files to upload folder
		//echo '0' if there is an error
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& in_array($extension, $allowedExts)) {
		  if ($_FILES["file"]["error"] > 0) {
		    echo "0";
		  } else {
		    $target = "files/image/map/";

		    move_uploaded_file($_FILES["file"]["tmp_name"], $target. $_FILES["file"]["name"]);
		    echo  $_FILES["file"]["name"];
		  }
		} else {
		  echo "0";
		}
	}

	public function appLogoUpload() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);

		//check if the file type is image and then extension
		// store the files to upload folder
		//echo '0' if there is an error
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& in_array($extension, $allowedExts)) {
		  if ($_FILES["file"]["error"] > 0) {
		    echo "0";
		  } else {
		    $target = "files/image/app/";

		    move_uploaded_file($_FILES["file"]["tmp_name"], $target. $_FILES["file"]["name"]);
		    echo  $_FILES["file"]["name"];
		  }
		} else {
		  echo "0";
		}
	}

	public function speakerBgUpload() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);

		//check if the file type is image and then extension
		// store the files to upload folder
		//echo '0' if there is an error
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& in_array($extension, $allowedExts)) {
		  if ($_FILES["file"]["error"] > 0) {
		    echo "0";
		  } else {
		    $target = "files/image/speaker/";

		    move_uploaded_file($_FILES["file"]["tmp_name"], $target. $_FILES["file"]["name"]);
		    // Save img to db
		    $speakerBg = ClassRegistry::init('Conference')->find('first', ['fields' => ['conference_id']]);
		    ClassRegistry::init('Conference')->id = $speakerBg['Conference']['conference_id'];
		    ClassRegistry::init('Conference')->saveField('speaker_bkimg', $_FILES["file"]["name"]);
		    echo  $_FILES["file"]["name"];
		  }
		} else {
		  echo "0";
		}
	}

	public function speakerImageUpload() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);

		//check if the file type is image and then extension
		// store the files to upload folder
		//echo '0' if there is an error
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& in_array($extension, $allowedExts)) {
		  if ($_FILES["file"]["error"] > 0) {
		    echo "0";
		  } else {
		    $target = "files/image/speaker/";

		    move_uploaded_file($_FILES["file"]["tmp_name"], $target. $_FILES["file"]["name"]);
		    // Save img to db
		    // $speakerBg = ClassRegistry::init('Conference')->find('first', ['fields' => ['conference_id']]);
		    // ClassRegistry::init('Conference')->id = $speakerBg['Conference']['conference_id'];
		    // ClassRegistry::init('Conference')->saveField('speaker_bkimg', $_FILES["file"]["name"]);
		    echo  $_FILES["file"]["name"];
		  }
		} else {
		  echo "0";
		}
	}

	public function makeThumbnails($updir, $img, $id) {
	    $thumbnail_width = 134;
	    $thumbnail_height = 189;
	    $thumb_beforeword = "thumb";
	    $arr_image_details = getimagesize("$updir" . $id . '_' . "$img"); // pass id to thumb name
	    $original_width = $arr_image_details[0];
	    $original_height = $arr_image_details[1];
	    if ($original_width > $original_height) {
	        $new_width = $thumbnail_width;
	        $new_height = intval($original_height * $new_width / $original_width);
	    } else {
	        $new_height = $thumbnail_height;
	        $new_width = intval($original_width * $new_height / $original_height);
	    }
	    $dest_x = intval(($thumbnail_width - $new_width) / 2);
	    $dest_y = intval(($thumbnail_height - $new_height) / 2);
	    if ($arr_image_details[2] == 1) {
	        $imgt = "ImageGIF";
	        $imgcreatefrom = "ImageCreateFromGIF";
	    }
	    if ($arr_image_details[2] == 2) {
	        $imgt = "ImageJPEG";
	        $imgcreatefrom = "ImageCreateFromJPEG";
	    }
	    if ($arr_image_details[2] == 3) {
	        $imgt = "ImagePNG";
	        $imgcreatefrom = "ImageCreateFromPNG";
	    }
	    if ($imgt) {
	        $old_image = $imgcreatefrom("$updir" . $id . '_' . "$img");
	        $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
	        imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
	        $imgt($new_image, "$updir" . $id . '_' . "$thumb_beforeword" . "$img");
	    }
	}


	public function updateSpeakerImage() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);

		//check if the file type is image and then extension
		// store the files to upload folder
		//echo '0' if there is an error
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& in_array($extension, $allowedExts)) {
		  if ($_FILES["file"]["error"] > 0) {
		    echo "0";
		  } else {
		    $target = "files/image/speaker/";

		    move_uploaded_file($_FILES["file"]["tmp_name"], $target. $_FILES["file"]["name"]);
		    echo  $_FILES["file"]["name"];
		  }
		} else {
		  echo "0";
		}
	}

	public function saveNewMap() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $lastMaporder = ClassRegistry::init('Map')->find('first', ['fields' => ['show_order'],'order' => ['map_id' => 'DESC']]);
        $this->request->data['show_order'] = $lastMaporder['Map']['show_order'] + 1;
        if (empty($this->request->data['map_image'])) {
        	unset($this->request->data['map_image']);
        }
        if (ClassRegistry::init('Map')->save($this->request->data)) {
        	$mapId = ClassRegistry::init('Map')->getlastInsertID();
        	return json_encode((int)$mapId);
        } else {
        	return json_encode(0);
        }
	}

	public function saveSession() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if (ClassRegistry::init('Session')->save($this->request->data)) {
        	$sessionId = ClassRegistry::init('Session')->getlastInsertID();
        	if (isset($this->request->data['breakout'])) {
        		foreach ($this->request->data['breakout'] as $eachBreakout) {
        			$data['session_id'] = $sessionId;
        			$data['name'] = $eachBreakout['name'];
        			$data['location'] = $eachBreakout['location'];
        			$data['event_time'] = $eachBreakout['time'];
        			ClassRegistry::init('Breakout')->create();
        			ClassRegistry::init('Breakout')->save($data);
        		}
        	}
        	
        	if ($this->request->data['speaker_id']) {
        		foreach ($this->request->data['speaker_id'] as $eachSpeaker) {
        			$sdata['session_id'] = $sessionId;
        			$sdata['speaker_id'] = $eachSpeaker;
        			ClassRegistry::init('SessionSpeaker')->create();
        			ClassRegistry::init('SessionSpeaker')->save($sdata);
        		}
        	}
        	return json_encode((int)$sessionId);
        } else {
        	return json_encode(0);
        }
	}

	public function updateSession() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $this->request->data['event_time'] = $this->request->data['hour'].':'.$this->request->data['minute'];
        $sessionId = $this->request->data['session_id'];
        $breakoutIds = [];
        ClassRegistry::init('Session')->id = $sessionId;
        if (ClassRegistry::init('Session')->save($this->request->data)) {
        	if (isset($this->request->data['breakout'])) {
        		foreach ($this->request->data['breakout'] as $eachBreakout) {
        			$data['session_id'] = $sessionId;
        			$data['name'] = $eachBreakout['name'];
        			$data['location'] = $eachBreakout['location'];
        			$data['event_time'] = $eachBreakout['time'];
        			if (isset($eachBreakout['breakout_id'])) {
        				ClassRegistry::init('Breakout')->id = $eachBreakout['breakout_id'];
        			} else {
        				ClassRegistry::init('Breakout')->create();
        			}
        			ClassRegistry::init('Breakout')->save($data);
        			if (isset($eachBreakout['breakout_id'])) {
        				$breakoutIds[] = $eachBreakout['breakout_id'];
        			}
        		}
        	}
        	// Delete breakout
        	$trashBreakot = ClassRegistry::init('Breakout')->find('list', ['fields' => ['breakout_id'], 'conditions' => ['AND' => ['Breakout.session_id' => $sessionId], ['Breakout.breakout_id' != $breakoutIds]]]);
        	if ($breakoutIds && $trashBreakot) {
        		$deleteIds = array_diff(array_values($trashBreakot), array_values($breakoutIds));
        		foreach ($deleteIds as $key => $eachId) {
        			ClassRegistry::init('Breakout')->id = $eachId;
        			ClassRegistry::init('Breakout')->delete();
        		}
        	}
        	
        	if ($this->request->data['speaker_id']) {
        		// Delete previous session's speaker
        		$allSessionSpeakers = ClassRegistry::init('SessionSpeaker')->find('all', ['fields' => ['session_speaker_id', 'speaker_id'], 'conditions' => ['SessionSpeaker.session_id' => $sessionId]]);
        		if (!empty($allSessionSpeakers)) {
        			foreach ($allSessionSpeakers as $eachSid) {
        				ClassRegistry::init('SessionSpeaker')->id = $eachSid['SessionSpeaker']['session_speaker_id'];
        				ClassRegistry::init('SessionSpeaker')->delete();
        			}
        		}

        		foreach ($this->request->data['speaker_id'] as $eachSpeaker) {
        			$sdata['session_id'] = $sessionId;
        			$sdata['speaker_id'] = $eachSpeaker;
        			ClassRegistry::init('SessionSpeaker')->create();
        			ClassRegistry::init('SessionSpeaker')->save($sdata);
        		}
        	}
        	return json_encode((int)$sessionId);
        } else {
        	return json_encode(0);
        }
	}

	public function deleteSession() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Session')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Session')->delete()) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function deleteAgenda() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Agenda')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Agenda')->saveField('deleted', 1)) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function deleteSpeaker() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Speaker')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Speaker')->saveField('deleted', 1)) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function deleteSpeakerBg() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Conference')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Conference')->saveField('speaker_bkimg', '')) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	public function deleteMap() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Map')->id = $this->request->data['contentJson']['id'];
        if (ClassRegistry::init('Map')->saveField('deleted', 1)) {
        	return json_encode(1);
        } else {
        	return json_encode(0);
        }
	}

	// public function addDay() {
	// 	$this->autoLayout = false;
 //        $this->autoRender = false;
 //        $this->response->type('application/javascript');
 //        $data['event_day'] = date('Y-m-d H:i:s', strtotime($this->request->data['date'] . ' +1 day'));
 //        if (ClassRegistry::init('Agenda')->save($data)) {
 //        	$agendaId = ClassRegistry::init('Agenda')->getlastInsertID();
 //        	return json_encode((int)$agendaId);
 //        }
 //        return json_encode(0);
	// }

	public function addDay() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        $data['event_day'] = date('Y-m-d H:i:s', strtotime($this->request->data['date']));
        if (ClassRegistry::init('Agenda')->save($data)) {
        	$agendaId = ClassRegistry::init('Agenda')->getlastInsertID();
        	return json_encode((int)$agendaId);
        }
        return json_encode(0);
	}

	public function saveConference() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        ClassRegistry::init('Conference')->id = 1;
        if (ClassRegistry::init('Conference')->save($this->request->data)) {
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function updateMapList() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data['Map']) {
        	foreach ($this->request->data['Map'] as $key => $value) {
	        	ClassRegistry::init('Map')->id = $value;
	        	ClassRegistry::init('Map')->saveField('show_order', $key + 1);
        	}
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function updateSpeakerList() {
		$this->autoLayout = false;
        $this->autoRender = false;
        $this->response->type('application/javascript');
        if ($this->request->data['Speaker']) {
        	foreach ($this->request->data['Speaker'] as $key => $value) {
	        	ClassRegistry::init('Speaker')->id = $value;
	        	ClassRegistry::init('Speaker')->saveField('show_order', $key + 1);
        	}
        	return json_encode(1);
        }
        return json_encode(0);
	}

	public function mapedit($id) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$id) {
				return false;
			}
			$map = ClassRegistry::init('Map')->find('first', ['conditions' => ['Map.map_id' => $id]]);
			$this->set('map', $map);
         	$this->render('/Elements/mapEdit'); 
     	}
	}

	public function sessionEdit($id) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$id) {
				return false;
			}
			$session = ClassRegistry::init('Session')->find('first', ['conditions' => ['Session.session_id' => $id]]);
			if ($session) {
				foreach ($session['SessionSpeaker'] as $key => $value) {
					$sessionSpeaker[] = $value['speaker_id'];
				}
			}

			$this->set('sessionSpeaker', $sessionSpeaker);
			$this->set('session', $session);
			$speakers = ClassRegistry::init('Speaker')->find('list', ['fields' => ['speaker_id', 'name'], 'conditions' => ['Speaker.deleted' => 0]]);
			$this->set('speakers', $speakers);
         	$this->render('/Elements/sessionEdit'); 
     	}
	}

	public function speakerEdit($id) {
		if ($this->RequestHandler->isAjax()) { 
			if (!$id) {
				return false;
			}
			$speaker = ClassRegistry::init('Speaker')->find('first', ['conditions' => ['Speaker.speaker_id' => $id]]);
			$speakerBg = ClassRegistry::init('Conference')->find('first');
			$this->set('speakerBg', $speakerBg);
			$this->set('speaker', $speaker);
         	$this->render('/Elements/speakerEdit'); 
     	}
	}

}
