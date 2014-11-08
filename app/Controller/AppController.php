<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
define("SITE_URL", "/game-store/");
define("API_LOGIN_ID", '467w2QbtZ8N');
define("TRANSACTION_KEY", '684jAnrPPL323J4v');

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $uses = array('User');
        public $components = array('Session', 'RequestHandler');
	protected $products = array('VideoGame'=>'VgOrderItem', 'TradingCardGame'=>'TcgOrderItem');
	protected $order_items = array('VgOrderItem', 'TcgOrderItem');
	/*public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'video_games',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login',
                'home'
            )
        )
    );

    /*public function beforeFilter() {
        $this->Auth->allow('index', 'view');
    }*/
	
        // returns true if a user is logged in and is valid
	protected function check_user($check_admin=true) {
         
            if ($this->Session->check('User.username')) {

                $admin = $this->User->find('first', 
                        array('conditions'=>array('User.username'=>$this->Session->read('User.username'))));
                //if username not valid
                if(count($admin) <= 0) {
                    echo "count zero";
                    return false;
                }
                //  if its an admin
                if ($check_admin && $admin['User']['user_type'] != 'admin') {

                    return false;
                }
                return true;
            }
            else {
                return false;
            }
            return true;
	}

}
