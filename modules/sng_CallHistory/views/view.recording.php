<?php
class sng_CallHistoryViewRecording extends SugarView{
	public function display() {
		ob_end_clean();
		$account = BeanFactory::getBean('sng_CallHistory')->retrieve_by_string_fields(array('linkedid'=>$_REQUEST['uuid']));
		$recordings = array();
		if(!empty($account->linkedid) && !empty($account->recording_location)) {
			$uuid = str_replace(".","_",$account->linkedid);
			foreach(glob($account->recording_location."/".$uuid."*") as $file) {
				$info = pathinfo($file);
				$k = $info['filename'];
				$ext = $info['extension'];
				$ext = ($ext == 'ogg') ? 'oga' : $ext;
				$recordings[$k]['supplied'][] = $ext;
				$recordings[$k]['data']['title'] = $account->name;
				$recordings[$k]['data'][$ext] = $this->getUrlPrefix().'/index.php?module=sng_CallHistory&action=recordingStream&uuid='.$account->linkedid.'&file='.basename($file);
			}
		}
		if(!empty($recordings)) {
			include(__DIR__."/recording.html");
		} else {
			echo "No Recording Files Found";
		}

		exit();
	}

	private function getUrlPrefix() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";

		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"];
		}

		$pageURL .= dirname(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

		return $pageURL;
	}
}
