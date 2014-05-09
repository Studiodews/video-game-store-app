<?php
class TcgBrandsController extends AppController {
	public function index()
	{
		$this->set("brands", $this->TcgBrand->find('all'));
	}
}

?>