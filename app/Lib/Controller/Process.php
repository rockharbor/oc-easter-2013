<?php

class Process extends Upload {

	public function GET($matches) {
		$filename = $this->processStorePath . DS . $matches[1];
		if (!file_exists($filename)) {
			$this->redirect('/victory/upload');
		}

		$this->set('tmpname', $matches[1]);
		$this->render('Process');
	}

	public function POST($matches) {
		$filename = $this->processStorePath . DS . $matches[1];
		if (!file_exists($filename)) {
			$this->redirect('/victory/upload');
		}

		$filename = $this->createImage($matches[1], $_POST);
		if ($filename !== false) {

		} else {
			$this->set('error', 'Could not save image. Please try again.');
		}
	}

}