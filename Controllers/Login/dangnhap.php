<?php 
session_start();
require_once 'Model/dangnhap.php';
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}
else
{
	$action = NULL;
}
switch ($action) {
	case 'damg_ky':
		if (isset($_POST['Dangky'])) {
			$txtfirstName = $_POST['txtfirstName'];
			$txtlastName = $_POST['txtlastName'];
			$txtUsername = $_POST['txtUsername'];
			$txtEmail = $_POST['txtEmail'];
			$txtPassword = md5($_POST['txtPassword']);
			$txtCfPassword = md5($_POST['txtCfPassword']);

			$txtHote = $txtfirstName." ".$txtlastName;

			if ($txtPassword == $txtCfPassword) {
				if (Dangnhap::ADD($txtHote,$txtUsername,$txtPassword,$txtEmail)) {
					header('location:index.php?controllers=login');
				}
			}
			else
			{
				$thatbai = "<p style ='color:red'>* Đăng ký Thất bại do mặt khẩu nhập lại không khớt.!</p>";
			}
		}
		require_once 'View/register.php';
		break;
	case 'cai_dat':
		if (isset($_GET['username'])) {
			$username = $_GET['username'];
			$user = Dangnhap::List_id($username);

			if (isset($_POST['Luu'])) {
				$txtfirstName = $_POST['txtfirstName'];
				$txtUsername = $_POST['txtUsername'];
				$txtEmail = $_POST['txtEmail'];
				$txtPassword = md5($_POST['txtPassword']);

				if (Dangnhap::Edit($txtfirstName,$txtUsername,$txtPassword,$txtEmail,$username)) {
					$_SESSION['username'] = $txtUsername;
					header('location:index.php?controllers=quanly&action=Admin');
				}
				else
				{
					$thatbai = "Lưu thất bại.!";
				}
			}
		}
		foreach ($user as $value) {
			# code...
		}
		require_once 'View/caidat.php';
		break;
	case 'Xoa_tk':
		if ($_SESSION["username"]) {
			$text_username = $_SESSION["username"];
			if (Dangnhap::Delete($text_username)) {
				session_destroy();
				header('location:index.php');
			}
		}
		break;
	case 'quen_mk':
		
		require_once 'View/forgot-password.php';
		break;
	case 'Admin':
		
		if (isset($_POST['login'])) {
			$text_email = $_POST['email'];
			$text_password = md5($_POST['password']);
			if (filter_var($text_email, FILTER_VALIDATE_EMAIL)) {
			if(strlen($_POST['password'])>=8){
				$list_user = Dangnhap::Login($text_email, $text_password);
				if ($list_user > 0) {
					$_SESSION["username"] = $text_email;
					header('location:index.php?controllers=quanly&action=Admin');
				}
				else
				{
					$thatbai = "<p style ='color:red'>* Mật khẩu hoặc gmail không chính xác!</p>";
					//header('location:index.php');
					require_once 'View/login.php';
				}
			}else{
				$thatbai = "<p style ='color:red'>* Mật khẩu không đủ 8 ký tự trở lên!</p>";
					//header('location:index.php');
					require_once 'View/login.php';			
			}	
			}else{
				$thatbai = "<p style ='color:red'>* Định dạng email (example@gmail.com) bị sai!</p>";
					//header('location:index.php');
					require_once 'View/login.php';
			}
			//}
		}
		//require_once 'View/login.php';
		break;
	case 'logout':
		require_once 'View/logout.php';
		break;
	default:
		if (isset($_SESSION["username"])) {
			header('location:index.php?controllers=quanly&action=Admin');
		} else{
			require_once 'View/login.php';
		}
		break;
}


 ?>