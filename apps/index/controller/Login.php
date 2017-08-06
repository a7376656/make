<?php
namespace app\index\controller;

// use app\index\Controller\Base;
use think\Controller;
use think\request;
use think\Url;
use think\Db;
use think\Session;

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

		if(!$username || !$password){
			$this->error('请求错误','Index/index');
			return;
		}

		$result = Db::name('users')->where('username', $username)->find(); //检测用户名
		if(!$result)
			$result = Db::name('users')->where('email', $username)->find(); //检测邮箱
		if(!$result){
			echo '{"success":false,"msg":"用户名或邮箱不存在"}';
			return;
		}

		$username = $result['username'];

		if($password != $result['password']){
			echo '{"success":false,"msg":"密码错误"}';
			return;
		}else{
			$nowtime=date("Y-m-d H:i:s"); //此次登录时间
			$update = Db::name('users')->where('username', $username)->update(['last_login_time'=>$nowtime]); //更新最后一次登录时间
			Session::set('username', $username);
			echo '{"success":true,"msg":"登录成功"}';
		}
	}

	/**
	 * 用户注册
	 * @return json
	 */
	public function register()
	{
		$username  = input('post.username');
		$password  = md5(input('post.password'));
		$password2 = md5(input('post.password2'));
		$email     = input('post.email');

		if(!$username || !$password || !$password2){
			$this->error('请求错误','Index/index');
			return;
		}

		$check = Db::name('users')->where('username', $username)->find();
		$check_email = Db::name('users')->where('email', $email)->find();
		if($check){
			echo '{"success":false,"msg":"用户名已存在"}';
			return;
		}
		if($check_email){
			echo '{"success":false,"msg":"邮箱已存在"}';
		}
		if($password != $password2){
			echo '{"success":false,"msg":"两次输入的密码不一致"}';
			return;
		}

		$nowtime = date("Y-m-d H:i:s"); //此次登录时间 & 创建时间
		$insert = Db::name('users')->insert(['username'=>$username, 'password'=>$password, 'email'=>$email, 'last_login_time'=>$nowtime, 'create_time'=>$nowtime]); // 将数据插入数据表
		Session::set('username', $username);

		echo '{"success":true,"msg":"注册成功"}';
	}

	/**
	 * 导航显示登录状态
	 * @return msg -- 头像地址
	 */
	public function nav_login()
	{
		// $this->check_login();
		$result = $this->request->session('username');
		if(empty($result)){
			echo '{"success":false}';
			return;
		}else{
			$avatar = Db::name('users')->where('username', $result)->value('avatar');
			$avatar = json_encode($avatar);
			echo '{"success":true,"msg":'.$avatar.'}';
		}
	}

	/**
	 * 用户退出登录
	 */
	public function Logout()
	{
		Session::set('username', null);
		// $redirect=$_SERVER['HTTP_REFERER']; //退出登录前页面

		// $this->redirect($redirect);
	}
}
