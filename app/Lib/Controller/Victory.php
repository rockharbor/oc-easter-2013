<?php

class Victory extends Upload {

	public function GET($matches) {
		$this->set('title', 'Share A Story');
		$filename = $matches[1];

		$db = new Db();

		if ($filename) {
			$result = $db->find($filename);
			if ($result === false) {
				$this->set('error', $db->error);
			} else {
				if (empty($result)) {
					$this->set('error', 'Invalid image.');
				}
				if (isset($matches[2]) && $matches[2] == 'download=1') {
					header('Content-type: image/png');
					header('Content-disposition: attachment;');
					echo file_get_contents($this->finishedStorePath . DS . $filename);
					exit();
				}
				$this->set('result', $result[0]);
			}

			$this->render('Victory');
		} else {
			$results = $db->findAllApproved();
			$this->set('results', $results);
			$this->render('Victory.All');
		}
	}

}