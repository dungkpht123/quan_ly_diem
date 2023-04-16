<?php 

require_once 'Connect/connect.php';
class MonHP extends Database_ql_diem
{
	public static function ADD($txt_maHocphan,$txt_tenHocphan,$txt_stc,$txt_mahocky)
	{
		$sql = "INSERT INTO monhocphan(ma_mon, ten_mon, sotinchi, ma_hk) VALUES ('$txt_maHocphan','$txt_tenHocphan','$txt_stc','$txt_mahocky')";
		return parent::Execute($sql);
	}
	public static function id_DHP($txt_maHocphan)
	{
		$sql = "SELECT * FROM monhocphan WHERE monhocphan.ma_mon='$txt_maHocphan'";
		return parent::Getdata($sql);
	}
	public static function Edit($txt_maHocphan,$txt_tenHocphan,$txt_stc,$txt_mahocky,$id_ma_monHp)
	{
		$sql = "UPDATE monhocphan SET ma_mon='$txt_maHocphan',ten_mon='$txt_tenHocphan',sotinchi='$txt_stc',ma_hk='$txt_mahocky' WHERE monhocphan.ma_mon='$id_ma_monHp'";
		return parent::Execute($sql);
	}
	public static function Delete($txt_maHocphan)
	{
		$sql = "DELETE FROM monhocphan WHERE monhocphan.ma_mon='$txt_maHocphan'";
		return parent::Execute($sql);
	}
	public static function List()
	{
		$sql = "SELECT * FROM monhocphan";
		return parent::Getdata($sql);
	}
}

 ?>