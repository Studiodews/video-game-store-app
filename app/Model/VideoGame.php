<?php
class VideoGame extends AppModel {
	/*
	table model corresponds
	video_games database table:
	id INT UNSIGNED PRIMARY KEY
	platform_id INT UNSIGNED REFERENCES platforms(id)
	title varchar(50)
	price decimal(8,2)
	user_rating INT
	description TEXT
	main_image_url VARCHAR(60)
	views INT
	created DATETIME
	modified DATETIME
	*/
	
	//public $actsAs = array('Containable');
	public $hasMany = array(
		'VgReviews' => array('className' => 'VgReview', 'dependent'=>true),
		'VgGenreMembership'=>array(
			'className'=>'VgGenreMembership',
			'foreignKey'=>'video_game_id',
			'dependent'=>true,
			)
		

	);

	public $belongsTo = array(
		'Platform' => array('className' => 'Platform', 'foreignKey' => 'platform_id'),
		'Product' => array('className'=>'Product', 'foreignKey' => 'product_id')
	);
	

	public $validate = array(
		
		
		'platform_id' => array(
			'rule' => array('notEmpty', true, 'numeric', true)
		),
		
		
	);


	public function get_games_with_conds($request_data) {
			$conditions = array();
			//print_r('test');
			//  find all products based on keyword on name
			if(isset($request_data['VideoGame']['keywords'])) {
				$array_keywords = explode(' ', $request_data['VideoGame']['keywords']);
				foreach($array_keywords as $keyword) {
					$conditions['Product']['AND'][] = array('Product.name LIKE'=>'%'.$keyword.'%');
				}

				$products = $this->Product->find('all', array('conditions'=>$conditions['Product']));
				$conditions['VideoGame']['VideoGame.product_id'] = array();
				foreach ($products as $product) {
					$conditions['VideoGame']['VideoGame.product_id'][] = $product['Product']['id'];
				}
				//print_r($products);
				//print_r($conditions);
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
                        // specify how to order
                        //$conditions['VideoGame']['order'] = array('VideoGame.platform_id');
			$results = $this->find('all',
					array(
						'conditions'=>$conditions['VideoGame'],
                                                'order'=>array('VideoGame.platform_id'),
						)
					);
			return $results;
	}
}

?>