<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		
    }
	else {
		$for_schedule = query("select *,bs.services_availed as services_availed from burial_schedule bs
								left join profile_list profile
								on bs.profile_id = profile.profile_id
								where remarks = 'FOR SCHEDULING' order by date asc, time asc");
		if($_GET["action"] == "list"){
			render("public/pending_system/pending_list.php",
			[
				"for_schedule" => $for_schedule,
			]);
		}
	}
?>
