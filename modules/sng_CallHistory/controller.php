<?php
class sng_CallHistoryController extends SugarController {
	public function action_recordingview() {
		$this->view = 'recording';
	}
	public function action_recordingstream() {
		$this->view = 'stream';
	}
}
