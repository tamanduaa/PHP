<?
error_reporting(E_ALL);
function valid_email($email)
{
        // The check email pattern
        $pattern = "/^([\w\d]+)([-_.][\w\d]+)*@(([\w\d]+)([-.][\w\d]+)((?:[-.][\w\d]+)+)*)$/";

        // If no match return false
        if (!preg_match($pattern, $email, $regs)) {
                return false;
        }

        // +--------------+
        // | Debugging    |
        // +--------------+
        // echo "<pre>";
        // print_r($regs);
        // echo "</pre>";

        // If we get an ip from gethostbyname we know
        // we're dealing with a valid domain name.
        if (gethostbyname('www.' . $regs[3]) != $regs[3]) {
                return true;
				
        } 
        return false;
} // End valid_email()

?>