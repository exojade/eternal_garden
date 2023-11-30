<?php
// use PHPJasper\PHPJasper;  
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump(get_defined_constants(true));
		if($_POST["action"] == 'add_user'){
			// dump($_POST);
			$userid = create_uuid("USR");
			$password = "secret";
			$salt = '$2a$10$' . bin2hex(random_bytes(22));
			if (query("insert INTO tbl_users (user_id,username,password,role,fullname) 
				VALUES(?,?,?,?,?)", 
				$userid,$_POST["username"], crypt($password,$salt),$_POST["role"],$_POST["fullname"]) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}


				$res_arr = [
					"result" => "success"
					];
					echo json_encode($res_arr); exit();
		
		
		}

		else if($_POST["action"] == 'reset_password'){
			// dump($_POST);
			query("update mtop_users SET userPassword = ? WHERE userId = ?", crypt('!1234#',''), $_POST["user_id"]);
		}
    }
	else {

		$users = query("select * from tbl_users");
		render("public/users_system/usersform.php", ["users" => $users]);
	}
?>
