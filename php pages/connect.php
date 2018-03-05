<?php
	$host ="localhost";
	$user ="root";
	$pass ="";
	$db   ="databasesecurity";
	$dsn  ="mysql:host=$host;dbname=$db";
	$options = array( 
		PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8', 
	);
	
	try{
		$conn = new PDO($dsn,$user,$pass,$options);
		
	}
	catch(PDOException $e){
		echo "Not connected : ".$e->getMessage();
	}


	/* sql query*/
	$sqlSaveData = "INSERT INTO user_info (u_no, first_name, parent_name, last_name, email, birthday, id, social_security_no, priv) VALUES (NULL, AES_ENCRYPT(:name, :password), AES_ENCRYPT(:namep, :password), AES_ENCRYPT(:namel, :password), AES_ENCRYPT(:email, :password), AES_ENCRYPT(:date, :password) , AES_ENCRYPT(:id, :password), AES_ENCRYPT(:SSN, :password), 2)";//data.php
	$sqlSaveData2 = "INSERT INTO password_info (p_no, password, salt) VALUES (LAST_INSERT_ID(), SHA(:salt_pass), AES_ENCRYPT(:_salt, :password))";//data.php

	$sqllogin    = "SELECT user_info.u_no AS no,user_info.priv AS priv FROM  user_info JOIN password_info ON password_info.p_no = user_info.u_no WHERE AES_DECRYPT (user_info.email, :password) = :email AND password_info.password = SHA( CONCAT( AES_DECRYPT(password_info.salt,:password), :password) )";//login.php

	$sqlSession = "SELECT user_info.u_no AS no FROM  user_info JOIN password_info ON password_info.p_no = user_info.u_no WHERE ( password_info.password = SHA( CONCAT( AES_DECRYPT(password_info.salt,:password), :password) ) ) AND user_info.priv = :priv";//session.php
	
	$sqlDisplay    = "SELECT user_info.u_no AS no, AES_DECRYPT(user_info.first_name,:password) AS _first_name,  AES_DECRYPT(user_info.parent_name,:password) AS _parent_name, AES_DECRYPT(user_info.last_name,:password) AS _last_name, AES_DECRYPT(user_info.email,:password) AS _email, AES_DECRYPT(user_info.birthday,:password) AS _birthday, AES_DECRYPT(user_info.id,:password) AS _id, AES_DECRYPT(user_info.social_security_no,:password) _SSN, user_info.priv AS priv, AES_DECRYPT(password_info.salt,:password) AS _salt, user_info.first_name AS first_name, user_info.parent_name AS parent_name, user_info.last_name AS last_name, user_info.email AS email, user_info.birthday AS birthday, user_info.id AS id, user_info.social_security_no AS SSN,password_info.salt AS salt,password_info.password AS pass FROM  user_info JOIN password_info ON password_info.p_no = user_info.u_no WHERE user_info.u_no = :no";//display.php

	$sqlSaveBynewPassword	= "UPDATE user_info SET first_name = AES_ENCRYPT(AES_DECRYPT (first_name, :old_password),:newpassword), parent_name = AES_ENCRYPT(AES_DECRYPT (parent_name, :old_password),:newpassword), last_name = AES_ENCRYPT(AES_DECRYPT (last_name, :old_password),:newpassword), email = AES_ENCRYPT(AES_DECRYPT (email, :old_password),:newpassword), birthday = AES_ENCRYPT(AES_DECRYPT (birthday, :old_password),:newpassword), id = AES_ENCRYPT(AES_DECRYPT (id, :old_password),:newpassword), social_security_no = AES_ENCRYPT(AES_DECRYPT (social_security_no, :old_password),:newpassword) WHERE u_no = :no ";//change_password.php
	$sqlNewPassword	= "UPDATE password_info SET p_no = :no, password = SHA( CONCAT( AES_DECRYPT(salt,:old_password),:newpassword ) ), salt = AES_ENCRYPT(AES_DECRYPT(salt,:old_password),:newpassword ) WHERE p_no = :no"; //change_password.php

/*
	$sqlSaveBynewPassword	= "UPDATE user_info SET first_name = AES_ENCRYPT(AES_DECRYPT (first_name, ? ), ? ), parent_name = AES_ENCRYPT(AES_DECRYPT (parent_name, ? ), ? ), last_name = AES_ENCRYPT(AES_DECRYPT (last_name, ? ), ? ), email = AES_ENCRYPT(AES_DECRYPT (email, ? ), ? ), birthday = AES_ENCRYPT(AES_DECRYPT (birthday, ? ), ? ), id = AES_ENCRYPT(AES_DECRYPT (id, ? ), ? ), social_security_no = AES_ENCRYPT(AES_DECRYPT (social_security_no, ? ), ? ) WHERE u_no = ? ";//change_password.php
	
	$sqlNewPassword	= "UPDATE password_info SET p_no = ? , password = SHA( CONCAT( AES_DECRYPT(salt, ? ), ? ) ), salt = AES_ENCRYPT(AES_DECRYPT(salt, ? ), ? ) WHERE p_no = ? "; //change_password.php
*/
?>