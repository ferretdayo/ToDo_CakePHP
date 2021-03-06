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
	//利用するModel名をarrayに追加
	public $uses = array('TodoList');
    //Home画面
    public function index(){
		//$this->loadModel('TodoList');
		$todolist = $this->TodoList->find('all');
		//TODO MySQLからデータの取得
    	$this->set('todolist', $todolist);
    	$this->render('/Pages/home');
    }

    //MyPage画面
    public function mypage(){
        $this->render('/Pages/mypage');
    }

    //TODOデータの保存
    public function store(){
    	if($this->request->is('post')){
			$this->request->data['TodoList']['done'] = 0;
			$this->request->data['TodoList']['create_at'] = date("Y/m/d H:i:s");
			$this->request->data['TodoList']['delete_at'] = null;
			if($this->TodoList->save($this->request->data)){
				// メッセージをセットしてリダイレクトする
				$this->Session->setFlash('ToDo Saved!');
				$this->redirect("/");
			}
    	}
        //home.ctpにリダイレクト
        $this->render('/Pages/home');
    }
    
    //TODOデータの削除
    public function delete(){
        //$this->request->data['TodoList']['id'] = $id;
        //指定されたidがあれば削除
        if($this->params['id']){
            if($this->TodoList->delete($this->params['id'])){
                $this->redirect('/');
            }
        }
        $this->redirect('/');
    }
    
    //TODOデータのDONE
    public function done(){
        $data = array();
        $conditions = array('id' => $this->params['id']);
        if($this->params['id']){
            if($this->params['done']){
                $data = array('done' => 0);
            }else{
                $data = array('done' => 1);
            }
            if($this->TodoList->updateAll($data, $conditions)){
                $this->redirect('/');
            }
        }
        $this->redirect('/');
    }

}
