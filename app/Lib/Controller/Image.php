<?php

class Image extends Upload {

	public function GET($matches) {
		$filename = $this->processStorePath . DS . $matches[1];
		if (!file_exists($filename)) {
			$this->redirect('/victory/upload');
		}

		header('Content-Type: image/png');
		$image = imagecreatefrompng($filename);
		imagepng($image);
		imagedestroy($image);
	}

}