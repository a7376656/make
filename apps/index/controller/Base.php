<?php
namespace app\index\controller;

use think\Controller;
use think\request;
use think\Url;
use think\Db;
use think\Session;

class Base extends Controller
{
	/**
	 * 检测登录,用于用户操作时
	 */
	protected function check_login()
	{
		$redirect=$_SERVER['HTTP_REFERER']; //判断前页面
		$username = $this->request->session('username');
		if(empty($username)){
			$this->error('操作失败，您还没有登录',$redirect);
		}
	}
}

