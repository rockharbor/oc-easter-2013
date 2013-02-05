<?php

class Victory extends Upload {

	public function GET($matches) {
		$filename = $matches[1];

		$db = new Db();
		$result = $db->find($filename);
		if ($result === false) {
			$this->set('error', $db->error);
		} else {
			if (empty($result)) {
				$this->set('error', 'Invalid image.');
			}
			$this->set('result', $result[0]);
		}

		$this->render('Victory');
	}

}