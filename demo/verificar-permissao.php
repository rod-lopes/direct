<?php 

//VERIFICAR PERMISSÃO
if(@$_SESSION['nivel_usuario'] != 'User'){
	echo "<script language='javascript'>window.location='login.php'</script>";
}
 ?>