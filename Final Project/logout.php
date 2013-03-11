<?
$page_title = 'Logout';
include ('./sessions/session_delete.php');
include ('./header.inc');

//4 steps to closing a session (logging out)

//2. Unset all session variables

//3. Destroy session cookie

//4. Destroy the session


header("https://depts.washington.edu/wts2010b/students/lperry87/Final%20Project/index.php?logout=1");

echo "You have been logged out of the system.";

?>