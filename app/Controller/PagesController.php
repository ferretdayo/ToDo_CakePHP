<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
    //Home画面
    public function index(){
    	$todolist = array("aaaaaa", "iiiii");
		//TODO MySQLからデータの取得
    	$this->set('todolist', $todolist);
    	$this->render('/Pages/home');
    }

    //MyPage画面
    public function mypage(){
        $this->render('/Pages/mypage');
    }

    //TODOのPOST
    public function store(){
    	if($this->request->is('post')){
			//if($this->todo_app->save($this->request->data)){
				// メッセージをセットしてリダイレクトする
				$this->Session->setFlash('ToDo Saved!');
				$this->redirect("/");
			//}
    	}
        //$todo = $this->request->data['entry_comment'];
        //home.ctpにリダイレクト
        $this->redirect('/');
    }

}
