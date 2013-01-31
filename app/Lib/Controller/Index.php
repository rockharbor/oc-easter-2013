<?php

class Index extends Page {

	public function GET() {
		$this->set('title', 'Home');
		$this->render('Index');
	}

}