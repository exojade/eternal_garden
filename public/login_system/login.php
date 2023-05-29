<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      
        $rows = query("SELECT * FROM tbl_users WHERE username = ?", $_POST["username"]);
        if (count($rows) == 1)
        {
            $row = $rows[0];
			if (crypt($_POST["password"], $row["password"]) == $row["password"]){
				$_SESSION["eternal_garden"] = [
					"userid" => $row["user_id"],
					"uname" => $row["username"],
					"role" => $row["role"],
					"fullname" => $row["fullname"],
					"application" => "eternal_garden"
				];

				$activity = $row["fullname"] . " successfully logged in into the system";
				echo("proceed");
            }
			else {
				$activity = $row["fullname"] . " entered " . $_POST["password"];
				echo("wrong_password");
			}
		}
		else {
			echo("wrong_password");
		}  
    }
    else
    {
	
        renderview("public/login_system/loginform.php", ["title" => "Log In"]);
    }
?>