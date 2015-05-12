<?php

include "meekrodb.2.3.class.php";

$id = $_GET['id'];

$users = DB::query("SELECT * FROM users WHERE id = %d", $id);

if (count($users) == 1) {
    $sql = "SELECT type FROM events WHERE user_id = %d ORDER BY time DESC LIMIT 1";
    $type_result = DB::query($sql, $id);

	$type = '';
	if (count($type_result) == 1) {
        $last_type = $type_result[0]['type'];
        if ($last_type == 'in') {
			$type = 'out';
		} else if ($last_type == 'out') {
			$type = 'in';
		}
	} else {
		$type = "in";
	}

	$insert = DB::insert('events', array('user_id' => $id, 'type' => $type));
        
	if ($insert === TRUE) {
		if ($type == 'in') {
			echo 'Hello ' . $users[0]['name'];
		} else {
			echo 'Goodbye ' . $users[0]['name'];
		}
	} else {
		echo 'ERROR';
	}
}


?>