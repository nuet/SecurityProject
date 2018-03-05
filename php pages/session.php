<?php
	$stmt = $conn->prepare($sqlSession);
	$stmt->bindparam(':email',$_SESSION['email']);
	$stmt->bindparam(':password',$_SESSION['password']);
	$stmt->bindparam(':priv',$_SESSION['priv']);
	$stmt->execute();
	if($stmt->rowCount() == 0){
		session_unset();
		session_destroy();
		header("Location: ".$PATH."login.php?u=3");
	}
?>