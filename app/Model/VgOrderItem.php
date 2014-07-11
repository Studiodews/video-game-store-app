<?php
class VgOrderItem extends AppModel {
	/*
	vg_order_items database table:
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
	quantity INT
	video_game_id INT UNSGINED REFERNCES video_games(id)
	order_id INT UNSIGNED REFERENCES orders(id) //TODO: need to add this

	*/
	
	public $belongsTo = array('Order');

}
?>