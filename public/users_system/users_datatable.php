<?php
$q = $_POST["action"];
$hint = "";
if($q == 'search'){
	// dump($_POST);
	$sql = query("select * from mtop_users where userName like '%".$_POST["wildcard"]."%'
				or fullname like '%".$_POST["wildcard"]."%' or userLevel like '%".$_POST["wildcard"]."%'  
				LIMIT 0, 40");					
	// dump($sql);
	foreach($sql as $row):
		$hint = $hint . '<tr id="'.$row["userId"].'" class="rowings">';
		// $hint = $hint . '<td><a class="btn btn-primary btn-flat" href="p_spec?t='.$row["tblid"].'">View</a></td>';
		$hint = $hint . '<td><div class="input-group margin">
		<div class="input-group-btn">
		  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
			<span class="fa fa-caret-down"></span></button>
		  <ul class="dropdown-menu">
			<li><a href="p_spec?t='.$row["userId"].'">Edit</a></li>
			<li><a data-id="'.$row["userId"].'" data-name="'.$row["fullName"].'" href="#" id="reset">Reset Password</a></li>
		  </ul>
		</div>
	  </div></td>';
		$hint = $hint . '<td>'.$row["userName"].'</td>';
		$hint = $hint . '<td>'.$row["fullName"].'</td>';
		$hint = $hint . '<td>'.$row["userLevel"].'</td>';
		$hint = $hint . '</tr>';
	endforeach;
}

else{
	$ctr = $_POST['ctr'];
	$sql = query("select * from mtop_users where userName like '%".$_POST["wildcard"]."%'
					or fullname like '%".$_POST["wildcard"]."%' or userLevel like '%".$_POST["wildcard"]."%'  
						LIMIT ?, 3", $ctr);		
			
			
				foreach($sql as $row):
					$hint = $hint . '<tr id="'.$row["userId"].'" class="rowings">';
					// $hint = $hint . '<td><a class="btn btn-primary btn-flat" href="p_spec?t='.$row["tblid"].'">View</a></td>';
					$hint = $hint . '<td><div class="input-group margin">
					<div class="input-group-btn">
					  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<span class="fa fa-caret-down"></span></button>
					  <ul class="dropdown-menu">
						<li><a href="user_details?t='.$row["userId"].'">Edit</a></li>
						<li><a data-id="'.$row["userId"].'" data-name="'.$row["fullName"].'" href="#" id="reset">Reset Password</a></li>
					  </ul>
					</div>
				  </div></td>';
					$hint = $hint . '<td>'.$row["userName"].'</td>';
					$hint = $hint . '<td>'.$row["fullName"].'</td>';
					$hint = $hint . '<td>'.$row["userLevel"].'</td>';
					$hint = $hint . '</tr>';
				endforeach;
}
echo $hint === "" ? "" : $hint;
?>