<?php
//TODO: add a create date for each comment int the database
class ConsoleReview extends AppModel {
	$belongs_to = array(
		'Console'=>array('className'=>'Console', 'foreignKey'=>'console_id')
	);
}

?>