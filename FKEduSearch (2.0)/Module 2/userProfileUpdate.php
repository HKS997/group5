<?php

session_start();
//Connect to the database server.
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

$userID = $_REQUEST['userID'];

$email = $_REQUEST['email'];

$researchAreaName = $_REQUEST['researchAreaName'];

$academicStatusType = $_REQUEST["academicStatus_type"];
$academicStatus_type = implode(',', $academicStatusType);

$instagram_userName = $_REQUEST['instagram_userName'];
$linkedin_userName = $_REQUEST['linkedin_userName'];

// Begin the transaction.
mysqli_query($link, "START TRANSACTION") or die(mysqli_error($link));

$query = "
    UPDATE user
    SET user_email = '$email'
    WHERE user_ID = '$userID';

    UPDATE research_area
    SET researchAreaName = '$researchAreaName'
    WHERE researchArea_ID = '$userID';

    UPDATE academic_status
    SET academicStatus_type = '$academicStatus_type'
    WHERE academicStatus_ID = '$userID';
	
    UPDATE socialmedia
    SET instagram_userName = '$instagram_userName',
        linkedin_userName = '$linkedin_userName'
    WHERE user_ID = '$userID';
";

$result = mysqli_multi_query($link, $query) or die("Could not execute query in userProfile.php");

// Iterate over the result sets and discard them
while (mysqli_more_results($link) && mysqli_next_result($link)) {
    if ($result = mysqli_store_result($link)) {
        mysqli_free_result($result);
    }
}

// Commit the transaction if all operations are successful.
mysqli_query($link, "COMMIT") or die(mysqli_error($link));

$alert_message = "User Profile Information has been updated!";
echo "<script>alert('$alert_message');</script>";
echo "<script type='text/javascript'> window.location='userProfile.php' </script>";
?>
