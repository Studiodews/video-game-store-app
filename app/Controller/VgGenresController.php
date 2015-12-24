<?php
class VgGenresController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session', 'RequestHandler');
	public $uses = array('Product', 'Platform', 'User', 'VgReview', 'VideoGame', 'VgGenreMembership', 'VgGenre',
		'Xml', 'Utility');


	public function save_genre() {
		Configure::write('debug', 0);
            $this->RequestHandler->setContent('json');
            $this->autoRender = false;
            //header("Content-Type: application/json");
        $response = [];
        $response['status'] = false;
        $response['new_item'] = false;
       
        if($this->request->is("ajax", "post")) {
        	$genre_id = isset($this->request->data['VgGenre']['id']) ? $this->request->data['VgGenre']['id'] : 0;
        	$name = isset($this->request->data['VgGenre']['name']) ? $this->request->data['VgGenre']['name'] : '';

        	// new video game genre
        	if($genre_id<=0) {
                $this->request->data['VgGenre']['name'] = strip_tags($this->request->data['VgGenre']['name']);
        		// new genre goes here
        		$this->VgGenre->create();
        		/*$this->VgGenre->name = $name;*/
        		unset($this->request->data['VgGenre']['id']);

        		if($this->VgGenre->save($this->request->data['VgGenre'])) {
        			$id = $this->VgGenre->id;
        			$response['genre'] = $this->VgGenre->findById($id);
        			$response['status'] = true;
        			$response['new_item'] = true;
        		}
        	} else {
        		
        		if($this->VgGenre->save($this->request->data['VgGenre'])) {
        			//print_r("Testetset");
        			$id = $this->VgGenre->id;
        			$response['genre'] = $this->VgGenre->findById($id);
        			$response['status'] = true;
        		}
        	}
        	//$response['type'] = 'post';
        }
		//print_r($this->request->data);
		echo json_encode($response);
	}


    public function delete_genre() {
        Configure::write('debug', 0);
        $this->RequestHandler->setContent('json');
        $data = [];
        $data['success'] = false;
        $this->autoRender = false;
        $id = $this->request->data('VgGenre.id');
        //$id = $this->request->data['VgGenre']['id'];
        $this->VgGenre->delete($id);
        $data['success']  = true;
        echo json_encode($data);
        exit();
    }   
}

?>