<?php
ini_set('display_errors',1);
error_reporting(E_ALL); 

echo  <<<_END
<form method='POST'>
<table>
<tr> <td>Username</td> <td><input type='text' maxlength='16' name='user' /></td> </tr>

<tr> <td>Password</td> <td><input type='password' maxlength='16' name='pass' /></td> </tr>

<tr> <td>Re-enter Password</td>  <td><input type='password' maxlength='16' name='pass2' /></td> </tr>

<tr><td><input type='submit' value='Sign Up' /></td></tr>
</table>
</form>

_END;

if ( isset($_GET['status']) )
{
    if ($_GET['status'] == 'correct')
    {
        echo "Sign up successful!" . "<br>";
        echo "Click ";
        echo "<a class='nav-link' href='./?home-page'>here</a>";
        echo " to go back to the home page";
    }
    else
    {
        echo "There was an error in the sign up";
    }

}

?>