<?php
//  the folder where all video game images will be stored
define("VG_IMAGES_FOLDER", 'vg');
//  full path name where images are stored
define("VIDEO_GAME_IMAGES_UPLOAD_PATH", WWW_ROOT .'img'.DIRECTORY_SEPARATOR . VG_IMAGES_FOLDER . DIRECTORY_SEPARATOR);
//  actual url link where you can access the images
define("VIDEO_GAME_IMAGES_UPLOAD_URL", WWW_ROOT . 'img/'.VG_IMAGES_FOLDER . '/');

class VideoGamesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session', 'RequestHandler');
	public $uses = array('Product', 'Platform', 'User', 'VgReview', 'VideoGame', 'VgGenreMembership', 'VgGenre',
		'Xml', 'Utility');
	//var $helpers = array('Html','Ajax','Javascript');
    //var $components = array( 'RequestHandler' );

	
		
	public function index() {
		//print_r($_GET['test']);
		//  the title for this page
		$this->set('title_for_layout', 'Video Games');
		//  if a certain category is selected
		if ($this->request->is('post'))
		{
			//print_r($this->request);
			$games = $this->VideoGame->get_games_with_conds($this->request->data);
			$this->set('video_games', $games);
			
			
		}
		else {
			//  get every item from every category
			$this->set('video_games', $this->VideoGame->find('all', 
				array(
					'order'=>array('VideoGame.platform_id')
				)
			));
			//$test = $this->VideoGame->find('all');
			//print_rf($test[1]);
			
		}
		
		$this->set('genre_options', $this->VgGenre->get_all_genres());
		$this->set('platform_options', $this->Platform->get_all_platforms());
		
	}
	
	
	public function add() {
		//  check if someone is logged in, if not redirect to previous page
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
		//  set title for this page
		$this->set('title_for_layout', 'Add A New Video Game');
		//  if request is a POST method
		if ($this->request->is('post')) {
                    $video_game_data = array();
                    /**
                     * want to nest VgGenreMembership in VideoGame model array 
                     * in order to save everything at once.
                     */
                    $video_game_data['VideoGame']['platform_id'] = $this->request->data['VideoGame']['platform_id'];
                    foreach ($this->request->data['VgGenreMembership']['genre_id'] as $value) {
                            $video_game_data['VideoGame']['VgGenreMembership'][] = array('genre_id'=>$value);
                    }
                    $this->Product->create();
                    $this->request->data['Product']['main_image_url'] = self::save_image($this->request->data['Product']['main_image_url'], 
                        VIDEO_GAME_IMAGES_UPLOAD_PATH, 
                        VG_IMAGES_FOLDER
                    );
                    
                    $this->request->data['VideoGame'] = $video_game_data['VideoGame'];
                    unset($this->request->data['VgGenreMembership']);
					

                    //  save video game to database
                    if($this->Product->saveAssociated($this->request->data, array('deep'=>true))) {
                        $this->Session->setFlash(__('A new video game with id='.$this->Product->id.' was added'));
                    } else {
                        $this->Session->setFlash(__('Unable to add video game'));
                    }
                }	
            $this->set('platforms', $this->Platform->find('all'));
            $this->set('genre_options', $this->VgGenre->get_all_genres());
	}
	
        
        
	public function view($id = null) {
		if ($id != null) {
			//  this will return every type of associated model with it
			//  in order to return specific associated models, will need to use find with
			//  the contain parameter to specify the models
			$item_exists = $this->VideoGame->findById($id);
			
			
			if(isset($item_exists['VideoGame']))
			{
				//  increases counter every time item gets accessed.
				//  might break if being accessed at same time
				//$view_count = (int)$item_exists['VideoGame']['views'];
				//$view_count++;
				
				$this->set('video_game', $item_exists);
				//$this->VideoGame->id = $id;
				//$this->VideoGame->saveField('views',$view_count);
			}
		}
	}
	
	/*
	called to edit a video game. 
	@param $id: the id of the video game. this is the primary key in the video_games table
	*/
	public function edit($id = null) {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
		if (!$id) {
			throw new NotFoundException(__('invalid id'));
		}
		$video_game = $this->VideoGame->findById($id);

		if(!$video_game) {
			throw new NotFoundException(('Invalid video game'));
		}
                
                // TODO: might want to add genres in this view so that an admin can edit everything in one place
		if ($this->request->is(array('post', 'put'))) {
			//print_r($this->request->data);
			//exit;
            $old_image_name = $video_game['Product']['main_image_url'];
            $this->request->data['Product']['main_image_url'] = self::save_image($this->request->data['Product']['main_image_url'],
                    VIDEO_GAME_IMAGES_UPLOAD_PATH, VG_IMAGES_FOLDER);
            if($this->request->data['Product']['main_image_url'] == "") {
                unset($this->request->data['Product']['main_image_url']);
            } else {
                unlink(VIDEO_GAME_IMAGES_UPLOAD_PATH . $old_image_name);
            }
            $this->request->data['VideoGame']['id'] = $id;
            if ($this->Product->saveAssociated($this->request->data)) {
            	$genres_to_save = self::parse_checkbox($this->request->data['VgGenreMembership']['genre_id'], 
                    'genre_id',
                    array('video_game_id'=>$this->request->data['VideoGame']['id']));
            
	            /*print_r($genres_to_save);
	            exit;*/
	            if(isset($this->request->data['VgGenreMembership']['genre_remove_id']) && count($this->request->data['VgGenreMembership']['genre_remove_id'])>0) {
	                $this->VgGenreMembership->deleteAll(
	                        array('genre_id'=>$this->request->data['VgGenreMembership']['genre_remove_id'],
	                            'video_game_id'=>$id));
	            }
	            
	            //if(isset($this->request->data['VgGenreMembership']['genre_id']) && count($this->request->data['VgGenreMembership']['genre_id'])>0) {
	            $this->VgGenreMembership->saveMany($genres_to_save);
                $this->Session->setFlash(__("video game information updated."));
            }
            else {
                $this->Session->setFlash(__('unable to update video game information.'));
            }
			
		}
		if (!$this->request->data) {
			$this->set('title_for_layout', 'Edit Video Game');
			$this->request->data = $video_game;
		}
        
        /*START: Obtain genres in video game and not in video game*/
    	$conditions = array();
        $conditions2= array();
        $video_game = $this->VideoGame->find('first', array(
               'contain' => array('VgGenreMembership'=>array('VgGenre'), 'Product'=>array('fields'=>array('name'))),
                'conditions'=>array('VideoGame.id'=>$id)
                
            ));
        foreach($video_game['VgGenreMembership'] as $membership) {
            $conditions['NOT']['VgGenre.id'][] = $membership['VgGenre']['id'];
            $conditions2['VgGenre.id'][] = $membership['VgGenre']['id'];
            //print_r($membership['VgGenre']);
        }
        
        $genres_list['IN'] = $this->VgGenre->get_all_genres($conditions2);
        if(count($conditions)<= 0) {
            unset($genres_list['IN']);
        }
        $genres_list['NOT'] = $this->VgGenre->get_all_genres($conditions);
        $this->set('video_game', $video_game);
        $this->set('genres', $genres_list);
        /*START: Obtain genres in video game and not in video game*/

		$this->set('platforms', $this->Platform->find('all'));
	}

        public function edit_genres($id = null) {
            if($id == null) {
                return $this->redirect(array('controller', 'backend', 'action'=>'vg_index'));
            }
            $video_game = $this->VideoGame->find('first', array(
               'contain' => array('VgGenreMembership'=>array('VgGenre'), 'Product'=>array('fields'=>array('name'))),
                'conditions'=>array('VideoGame.id'=>$id)
                
            ));
            $conditions = array();
            $conditions2= array();
            foreach($video_game['VgGenreMembership'] as $membership) {
                $conditions['NOT']['VgGenre.id'][] = $membership['VgGenre']['id'];
                $conditions2['VgGenre.id'][] = $membership['VgGenre']['id'];
                //print_r($membership['VgGenre']);
            }
            
            $genres_list['IN'] = $this->VgGenre->get_all_genres($conditions2);
            if(count($conditions)<= 0) {
                unset($genres_list['IN']);
            }
            $genres_list['NOT'] = $this->VgGenre->get_all_genres($conditions);
            $this->set('video_game', $video_game);
            $this->set('genres', $genres_list);
            //$this->set('vg_genres', $genres_in_vg);
            
        }
        
        public function save_genres() {
            //print_r($this->request->data);
            //exit();
            $video_game_id = $this->request->data['VideoGame']['video_game_id'];
            $genres_to_save = array();
  
            $genres_to_save = self::parse_checkbox($this->request->data['VgGenreMembership']['genre_id'], 
                    'genre_id',
                    $this->request->data['VideoGame']);
            
            /*print_r($genres_to_save);
            exit;*/
            if(isset($this->request->data['VgGenreMembership']['genre_remove_id']) && count($this->request->data['VgGenreMembership']['genre_remove_id'])>0) {
                $this->VgGenreMembership->deleteAll(
                        array('genre_id'=>$this->request->data['VgGenreMembership']['genre_remove_id'],
                            'video_game_id'=>$video_game_id
                ));
            }
            
            //if(isset($this->request->data['VgGenreMembership']['genre_id']) && count($this->request->data['VgGenreMembership']['genre_id'])>0) {
            $this->VgGenreMembership->saveMany($genres_to_save);
            //}
            $this->redirect(array('controller'=>'video_games', 'action'=>'edit_genres/'.$video_game_id));
        }
        
        
        
	public function delete($id = null) {
		if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}
		if (!$id) {
			throw new NotFoundException(__('invalid id'));
		}
		$this->VideoGame->delete($id);
		
	}

	public function add_genres($id=null) {
		$this->check_user();
		if(!$id) {
			throw new NotFoundException(__('invalid id'));
		}
		$video_game = $this->VideoGame->find('first',
			array(
				'conditions'=>array('VideoGame.id'=>$id),
				'contain'=>array(''),
				'fields'=>array('id','title')
			)
		);
	}

	

	public function details($id=null) {
		if($id==null) {
			$this->redirect(array('controller'=>'backend', 'action'=>'vg_index'));
		}
		$game = $this->VideoGame->find('first',
			array(
				'contain'=>array('Product','Platform','VgGenreMembership'=>array('VgGenre')),
				'conditions'=>array('VideoGame.id'=>$id)
				)
			);
		$this->set('game', $game); 

	}
	public function test() {
            $s = '06/9/2011 19:00:02';
            $date = strtotime($s);
            echo date('Y-m-d H:i:s', $date);
		
		/*$timestamp = '31/05/2001 12:22:56';
		$timestamp = date_create_from_format('d/m/Y H:i:s', $timestamp);
		print_r(date_format($timestamp, 'Y-m-d H:i:s'));
		print_r($this->Product->find('first', array('fields'=>'created')));*/
		/*	print_r($test = $this->VideoGame->find('all', 
				array(

					'contain' =>array('Product'),
					'conditions'=>array('VideoGame.product_id' =>array(1)))));
			//foreach($test as)
		/*print_r(
			$this->VideoGame->find('all',
				array(
					'contain'=>array(
						'VgGenreMembership'=>array(
							//'conditions'=>array('VgGenreMembership.genre_id'=>3),
							'VgGenre')
					),

					'conditions'=>array(
						array('VideoGame.title LIKE'=> '%Zelda%'), 
						array('VideoGame.title LIKE'=>'%Mario%')
					
					)
				)
			)
			);*/
		/*print_r(
			$this->VgGenreMembership->find('all',
				array(
					'contain'=>array(
						'VideoGame'=>array(
							'conditions'=>array('VideoGame.id'=>1) //can only do this 
							//if this contained model belongs to the find model used above
							)
					),
					'conditions'=>array(
						'genre_id'=>array(3,6)
					)
				)
			)
		);*/
		
		/*print_r(
			$this->VideoGame->find('all',
				array(
					/*'contain'=>array(
						'VgGenreMembership'=>array(
							//'conditions'=>array('VgGenreMembership.genre_id'=>3),
							'VgGenre')
					),
					'recursive'=>-1,
					'conditions'=>$conditions['VideoGame']
					
					)
				)

			);*/
		
			
			//print_r($xmlString);
		/*$conditions=array();
		$conditions['VideoGame']['keywords'] = '2';
		//print_r($conditions);
		$games = $this->VideoGame->get_games_with_conds($conditions);
		//print_r($products = $this->Product->find('all'));
		print_r($games);
		/*print_r($this->VideoGame->find('all', array(
			'limit'=> 3,
			'offset'=>3
			)));*/
		/*$this->set('genre_options', $this->VgGenre->get_all_genres());
		$this->set('platform_options', $this->Platform->get_all_platforms());*/
		
	}

	public function ajax_test() {
		$this->autoRender = false; // We don't render a view in this example
    	$this->request->onlyAllow('ajax');
    	//$conditions = array();
    	//$conditions['VideoGame']['keywords'] = 'test';
		$games = $this->VideoGame->get_games_with_conds($this->request->data);
    	//$games = $this->VideoGame->get_games_with_conds($conditions);
		$xmlGamesArray = array();
		$xmlGamesArray['VideoGames'] = array();
		foreach ($games as $game) {
			$xmlGamesArray['VideoGames']['VideoGame'][] = $game['Product'];
		}

		//print_r($xmlGamesArray);
		$xmlObject = Xml::fromArray($xmlGamesArray); // You can use Xml::build() too
		$xmlString = $xmlObject->asXML();
			
		return $xmlString;
	}
        /**
         * returns a json object of video games
         */
        public function get_video_games() {
            Configure::write('debug', 0);
            $this->RequestHandler->setContent('json');
            $this->autoRender = false;
            header("Content-Type: application/json");
            $games = $this->VideoGame->get_games_with_conds($this->request->data);
            echo json_encode($games);
        }
	

        
        
        //  PRIVATE FUNCTIONS
        
        
        /**
         * 
         * @param type $data
         * @param type $options
         * @return type
         */
        private static function parse_checkbox($data,$field_name, $options = array()) {
            $return_data = array();
            if(!is_array($data)) {
                return $return_data;
            }
            foreach($data as $value) {
                
                $return_data[] = array_merge(array($field_name=>$value), $options);
            } 
            
            return $return_data;
        }
        
        
        /**
         * 
         * @param type $file: this is the file array of the image uploaded
         * @param type $images_upload_path: the path where the image will be stored
         * @param type $folder_name: the folder name in the default upload path of images folder
         * @return string: name of file along with its folder name
         */
        private static function save_image($file, $images_upload_path, $folder_name) {
            
           
            $current_time = strftime("%Y%m%d%H%M%S", time());
            if ($file && !empty($file) && is_array($file) && $file['error'] != 4 && is_uploaded_file($file['tmp_name'])){
            
                if(!file_exists($images_upload_path)) {
                    mkdir($images_upload_path);
                }
                if(move_uploaded_file(
                    $file['tmp_name'],
                    $images_upload_path .
                    $current_time . 
                    $file['name']
                )) {
                    return $current_time . $file['name'];
                }
            }
            return "";
        }
        
        
        private function get_games_with_conds($request_data) {
			$conditions = array();
			$conditions['VideoGame'] = array();
			if(isset($request_data['VideoGame']['keywords'])) {
				$array_keywords = explode(' ', $request_data['VideoGame']['keywords']);
				foreach($array_keywords as $keyword) {
					$conditions['VideoGame']['AND'][] = array('VideoGame.title LIKE'=>'%'.$keyword.'%');
				}
			}
			if(isset($request_data['VideoGame']['platforms'])) {
				if (is_array($request_data['VideoGame']['platforms'])) {
					$conditions['VideoGame']['platform_id'] = $request_data['VideoGame']['platforms'];
				} 
			}
			if(isset($request_data['VideoGame']['genres'])) {
				//print_r($this->request->data['VideoGame']['genres']);
				if (is_array($request_data['VideoGame']['genres'])) {
					//print_r($request_data['VideoGame']['genres']);
					$conditions['VgGenreMembership']['genre_id'] = $request_data['VideoGame']['genres'];
					//find all video games with the specified genre
					$vg_genres_cond = $this->VgGenreMembership->find('all',
						array(
							'recursive'=>-1,
							'conditions'=>$conditions['VgGenreMembership']
						)
					);
					
					$conditions['VideoGame']['VideoGame.id'] = array();
					foreach ($vg_genres_cond as $genres) {
						$conditions['VideoGame']['VideoGame.id'][] = $genres['VgGenreMembership']['video_game_id'];
					}
				} 
			}

			$results = $this->VideoGame->find('all',
					array(
                                                'contain'=>array('Product'),
						'conditions'=>$conditions['VideoGame']
						)
					);
			return $results;
	}
}
?>