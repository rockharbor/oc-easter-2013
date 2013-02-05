<?php

class Admin extends Upload {

	public function GET($matches) {
		$db = new Db();
		$count = $db->findCount();

		// pagination
		$page = 1;
		$limit = 20;
		if (isset($matches[1])) {
			$page = $matches[1];
		}
		$maxpages = ceil($count / $limit);

		$results = $db->findAll($page);

		$this->set(compact('results', 'count', 'page', 'limit', 'maxpages'));
		$this->render('Admin');
	}

	public function POST($matches) {
		$filename = null;
		if (isset($matches[1])) {
			$filename = $matches[1];
		}

		$db = new Db();
		$this->set('success', $db->approve($filename));
		$this->render('Admin.Complete');
	}

}