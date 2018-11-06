<?php 
function submit() {
	if (empty($_POST['new_user']) || empty($_POST['new_pass'])){
		 $GLOBALS['message'] = '请输入用户名和密码';
		return;
		
	}
$data = json_decode(file_get_contents('box.json'),true);	
	$username = $_POST['new_user'];
	$password = $_POST['new_pass'];
foreach ($data as $item) {
	 if ($item['user'] === $username){
	$GLOBALS['message'] = '用户名已存在';
	 return;
	 }
	}
	$userinfo = array(
		'user' => $username,
		'pass' =>$password
		);
	$data[] = $userinfo;
	file_put_contents('box.json', json_encode($data));
	
	header('Location: login.html');
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	submit();	
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/Ajax_php/css/header.css">
</head>
<body style="background-color: #ccc">
	<div class="submit-form">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<?php if (isset($message)): ?>
				 <div><?php echo $message ?></div>
			<?php endif ?>
		<ul>
			<li><label for="name">用户名</label><input type="text" name="new_user" id="name" autocomplete="off"></li>
			<li><label for="mima">密码</label><input type="password" name="new_pass" id="mima" autocomplete="off"></li>
			<li><button>提交</button></li>
		</ul>		
		</form>
	</div>	
</body>
</html>