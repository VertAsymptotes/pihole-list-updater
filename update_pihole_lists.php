<?php
// suppress any sqlite messages, specifically unique constraint violations.
error_reporting(0);

$dbconn = new SQLite3('/etc/pihole/gravity.db', SQLITE3_OPEN_READWRITE);
// pull the adlists from the firebog site.
$adlists = explode("\n", trim(file_get_contents("https://v.firebog.net/hosts/lists.php?type=tick")));
// append the fancy list from oisd.
$adlists[] = "https://dbl.oisd.nl/";

$comment = 'Inserted by update_pihole_lists.php';

// insert the list address - there's a unique constraint on the table, so we can just attempt to insert it and don't do anything with the failure.
foreach($adlists as $adlist) {
	$stmt = $dbconn->prepare('insert into adlist (address, comment) values (:address, :comment)');
	$stmt->bindParam('address', $adlist);
	$stmt->bindParam('comment', $comment);

	$stmt->execute()->finalize();
}