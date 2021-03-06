<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
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
App::uses ( 'Controller', 'Controller' );

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array (
			'Session',
			'Auth' => array (
					'loginRedirect' => array (
							'controller' => 'users',
							'action' => 'schedule'
					),
					'logoutRedirect' => array (
							'controller' => 'users',
							'action' => 'login'
					),
					// 'authError' => "You cannot access that page",
					'authorize' => array (
							'Controller'
					),
					'authenticate' => array (
							'Form' => array (
									'userModel' => 'User',
									'fields' => array (
											'username'=>'username',
											'password'=>'password'
									)
							)
					)
			)
	);

	/**
	 * Determines what logged in users can do
	 *
	 * @param unknown $user
	 * @return boolean
	 */
	public function isAuthorized($user) {
		// well they can basically do anything
		return true;
	}

	/**
	 * determines what not logged in users can do
	 */
	public function beforeFilter() {
		// they can acces the index and view actions of any controller
		// as long as they dont override
		$this->Auth->allow ( 'index', 'view', 'about_us' );
		$this->set ( 'loggedIn', $this->Auth->loggedIn () );
	}
}
