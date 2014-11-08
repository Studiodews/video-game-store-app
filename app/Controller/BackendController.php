<?php

class BackendController extends AppController {
	public $components = array('Paginator');
	public $uses = array('VideoGame', 'TradingCardGame', 'Console', 'TcgBrand', 'TcgExpansion', 'Platform', 'VgGenre');

public $layout = 'admin';

  public function beforeFilter() {
      parent::beforeFilter(); //call parent before filter

      $this->layout = $this->layout;
  }

	public function index() {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
	}

	public function vg_index() {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
		if($this->request->is('post')) {
			$games = $this->VideoGame->get_games_with_conds($this->request->data);
		} else {
			$games = $this->VideoGame->find('all');
			//print_r($games);
		}
		$this->set('game_list', $games);

	}

	public function tcg_index() {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
		$this->set('tcg_list',$this->TradingCardGame->find('all'));
	}

	public function console_index() {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
		$this->set('console_list', $this->Console->find('all'));
	}

	public function tcg_brand_index() {
		$save_edit_url= Router::url(array('controller'=>'tcg_brands', 'action'=>'save_brand'));
		$this->Paginator->settings = array('order'=>array('id'=>'DESC'), 'limit'=>20, 'offset'=>0, 'contain'=>array());
		$brands = $this->Paginator->paginate('TcgBrand');
		//print_r($brands);
		$this->set('tcg_brands', $brands);
		//print_r($genres);
		//$this->set('vg_genres', $this->VgGenre->find('all', array('order'=>array('id'=>'DESC'))));
		$this->set('save_edit_url',$save_edit_url);
		//$this->set('tcg_brand_list', $this->TcgBrand->find('all', array('contain'=>array())));
	}

	public function tcg_expansion_index() {
		$this->set('tcg_expansion_list', $this->TcgExpansion->find('all'));
	}

	public function platform_index() {
		$this->set('platform_list', $this->Platform->find('all'));
	}

	public function vg_genre_index() {
		$save_edit_url= Router::url(array('controller'=>'vg_genres', 'action'=>'save_genre'));
		$this->Paginator->settings = array('order'=>array('id'=>'DESC'), 'limit'=>20, 'offset'=>0);
		$genres = $this->Paginator->paginate('VgGenre');
		$this->set('vg_genres', $genres);
		//print_r($genres);
		//$this->set('vg_genres', $this->VgGenre->find('all', array('order'=>array('id'=>'DESC'))));
		$this->set('save_edit_url',$save_edit_url);
	}
}

?>