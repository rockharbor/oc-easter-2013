<?php

class Process extends Upload {

	public function GET($matches) {
		$this->set('title', 'Share A Story');
		$filename = $this->processStorePath . DS . $matches[1];
		if (!file_exists($filename)) {
			$this->redirect('/victory/upload');
		}

		$this->set('tmpname', $matches[1]);
		$this->render('Process');
	}

	public function POST($matches) {
		$this->set('title', 'Share A Story');
		$filename = $this->processStorePath . DS . $matches[1];
		if (!file_exists($filename)) {
			$this->redirect('/victory/upload');
		}

		$filename = $this->createImage($matches[1], $_POST);
		if ($filename !== false) {
			$data = array(
				'filename' => $filename,
				'note' => $_POST['note'],
				'created' => date('Y-m-d')
			);
			$db = new Db();
			if ($db->save($data)) {
				$this->redirect('/victory/view/'.$matches[1]);
			} else {
				$this->set('error', $db->error);
			}
		} else {
			$this->set('error', 'Could not save image. Please try again.');
		}

		$this->render('Process');
	}

}