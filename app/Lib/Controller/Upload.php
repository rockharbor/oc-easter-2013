<?php

class Upload extends Page {

	protected $processStorePath;

	protected $finishedStorePath;

	protected $error = false;

	protected $types = array(
		'image/jpg' => 'jpeg',
		'image/jpeg' => 'jpeg',
		'image/gif' => 'gif',
		'image/png' => 'png'
	);

	public function __construct() {
		$this->processStorePath = APP . DS . 'tmp';
		$this->finishedStorePath = WEBROOT . DS . 'uploads';
	}

	public function GET() {
		$this->set('title', 'Upload');
		$this->render('Upload');
	}

	public function POST() {
		$success = false;
		if (!$this->validate($_FILES)) {
			$this->set('error', $this->error);
			$this->render('Upload');
		} else {
			$tmpFile = $this->createThumbnail($_FILES);
			$this->redirect("/victory/process/$tmpFile");
		}
		$this->render('Upload.Success');
	}

	protected function createThumbnail($files) {
		$name = uniqid();
		$filename = $this->processStorePath . DS . $name . '.png';

		$ext = $this->types[$files['file']['type']];

		// get dimensions and crop points
		list($cropWidth, $cropHeight) = array(300, 300);
		list($width, $height) = getimagesize($files['file']['tmp_name']);
		$centerX = round($width / 2);
		$centerY = round($height / 2);
		$x1 = max(0, $centerX - round($cropWidth / 2));
		$y1 = max(0, $centerY - round($cropHeight / 2));

		// get image
		$image = call_user_func("imagecreatefrom$ext", $files['file']['tmp_name']);
		imagealphablending($image, true);
		imagesavealpha($image, true);

		// create thumbnail
		$thumb = imagecreatetruecolor($cropWidth, $cropHeight);
		imagesavealpha($thumb, true);

		// copy the uploaded image onto the new cropped one at the crop points
		imagecopy($thumb, $image, 0, 0, $x1, $y1, $cropWidth, $cropHeight);

		// fill the rest with transparency
		$transparent = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
		imagefill($thumb, 0, 0, $transparent);

		// save to $processStorePath
		imagepng($thumb, $filename);

		imagedestroy($image);
		imagedestroy($thumb);

		return "$name.png";
	}

	protected function createImage($filename, $post) {
		// get image
		$image = imagecreatefrompng($this->processStorePath . DS . $filename);

		// get mark
		$markFilename = WEBROOT . DS . 'img' . DS . 'mark.png';
		$mark = imagecreatefrompng($markFilename);
		list($width, $height) = getimagesize($markFilename);
		imagesavealpha($mark, true);

		// copy the mark onto the image where user specified
		imagecopy($image, $mark, $post['x'], $post['y'], 0, 0, $width, $height);

		$newFilename = $this->finishedStorePath . DS . $filename;

		// save to $processStorePath
		imagepng($image, $newFilename);

		imagedestroy($image);
		imagedestroy($mark);

		if (file_exists($newFilename)) {
			unlink($this->processStorePath . DS . $filename);
			return $filename;
		}

		return false;
	}

	protected function validate($files) {
		if (!array_key_exists($files['file']['type'], $this->types)) {
			$this->error = 'Invalid image. Please upload an image file!';
		}

		switch ($files['file']['error']) {
			case UPLOAD_ERR_OK:
				// do nothing
				break;

			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				$this->error = 'The file was too large. Please try uploading a file under 10Mb.';
				break;

			case UPLOAD_ERR_NO_FILE:
				$this->error = 'Please choose a picture to upload.';
				break;

			case UPLOAD_ERR_NO_TMP_DIR:
			case UPLOAD_ERR_PARTIAL:
			case UPLOAD_ERR_EXTENSION:
			case UPLOAD_ERR_CANT_WRITE:
			default:
				$this->error = 'System error! Please contact website@rockharbor.org if this persists.';
				break;
		}

		return $this->error === false;
	}

}