<?php 
	//ToDo 接受用户名和密码，判断是否存在数据库里。成功则返回首页
	function login(){
		//Todo 判断用户名和密码是否为空
		if(empty($_POST['login_username']) || empty($_POST['login_password'])){
			$GLOBALS['message'] = '请输入用户名和密码';
			return;
		}
		//获取json数据库判断是否存在用户且密码相同
		$name = $_POST['login_username'];
		$pass = $_POST['login_password'];
		var_dump($name,$pass);
		$data = json_decode(file_get_contents('box.json'), true);
		var_dump($data);
		foreach ($data as $item) {
			if ($item['user'] !== $name) {
				$GLOBALS['message'] = '用户不存在';
				return;
			} 
			if ($item['pass'] !== $pass) {
				$GLOBALS['message'] = '用户密码错误';
				return;
			}
			setcookie('user',$name);
			setcookie('word',$pass);
			header('Location: login.html');
		}
		//用户存在且密码正确
		
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		login();
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/Ajax_php/css/login-user.css">
</head>
<body>
	<div class="wrap">

				

	 <?php if (isset($message)): ?> 
				<div class="error">
					<p><?php echo $message ?><p>
				</div>
			<?php endif ?>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
			<table cellspacing="0" cellpadding="0" >
			
				<tr>
					<td> <input type="text" name="login_username" autocomplete="off" placeholder="输入用户名" value="<?php if (!empty($_POST['login_username'])) {
						if ($message == '用户不存在') {
							echo "" ;
						}else {
						echo $_POST['login_username'];}
					} ?>"></td>
				</tr>
				<tr>
					<td> <input type="password" name="login_password" autocomplete="off" placeholder="输入密码"></td>
				</tr>
				<tr>
					<td><button>登陆</button></td>
				</tr>
				
			</table>
		</form>

	</div>
</body>
</html>