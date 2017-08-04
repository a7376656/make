<?php
namespace app\index\controller;

use think\Controller;
use think\request;
use think\Url;
use think\Db;

class Login extends Controller
{
	/**
	 * 登录时检测
	 * @return json
	 */
	 public function login()
	{
		$username = input('get.username');
		$password = md5(input('get.password'));

		echo $password;
	}
}
