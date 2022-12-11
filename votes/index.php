<?php
if(isset($_GET['search']) && $_GET['search'])
{
	if(!empty($_POST["search"]) && !empty($_POST["nic"]))
	{
		require_once "vote-view.php";
		exit();
	}
	require_once "search-view.php";
	exit();
}
if(!empty($_POST["type"])) 
{
	$type = $_POST['type'];

	$save = 1;
	foreach ($_POST as $key => $value) 
	{
		if(empty($value))
		{
			$save = 0;
			$message = 'All fields are required';
			$type = "error";
			break;
		}
	}

	if($save)
	{
	    $block_number = $_POST['block_number'];
		$s_number = $_POST['s_number'];
		$f_number = $_POST['f_number'];
		$name = $_POST['name'];
		$fh_name = $_POST['fh_name'];
		$nic = $_POST['nic'];
		$age = $_POST['age'];
		$village = $_POST['village'];
		$tehcil = $_POST['tehcil'];
		$district = $_POST['disctrict'];
		$created = time();

		$conn = mysqli_connect("localhost", "techeofr_vote", 'D@u+8~?e?YjT', "techeofr_votes") or die("Connection Error: " . mysqli_error($conn));

		$checkDuplicate = "Select nic from voters where nic=".$nic;
		$checkDuplicate = mysqli_query($conn, $checkDuplicate);
		
		if(mysqli_num_rows($checkDuplicate) > 0 && $type != 'update')
		{
			$message = "Already exist.";
		    $type = "error";
		}
		else
		{
			if($type == 'save')
			{
				mysqli_query($conn, "INSERT INTO voters (block_number, s_number, f_number,name,fh_name,nic,age,village,tehcil,district,created) VALUES ('" . $block_number. "','" . $s_number. "', '" . $f_number. "','" . $name. "','" . $fh_name. "','" . $nic. "','" . $age. "','" . $village. "','" . $tehcil. "','" . $district. "','" . $created. "')");

				$insert_id = mysqli_insert_id($conn);

				if(!empty($insert_id)) {
				   $message = "Voter information is saved successfully.";
				   $type = "success";
				}
				else
				{
					$message = "Something went wrong.";
				    $type = "error";
				}
			}
			else
			{
				mysqli_query($conn, "UPDATE `voters` SET `block_number`='" . $block_number. "',`s_number`='" . $s_number. "',`f_number`='" . $f_number. "',`name`='" . $name. "',`fh_name`='" . $fh_name. "',`nic`='" . $nic. "',`age`='" . $age. "',`village`='" . $village. "',`tehcil`='" . $tehcil. "',`district`='" . $district. "',`created`='" . $created. "' WHERE nic=".$nic);

				$message = "Voter information is update successfully.";
				$type = "success";
			}
		}
	}
}
require_once "contact-view.php";
?>