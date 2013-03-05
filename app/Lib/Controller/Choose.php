<?php

class Choose extends Page {

	function GET() {
		$this->set('title', 'Share A Story');
		$this->render('Choose');
	}

}
