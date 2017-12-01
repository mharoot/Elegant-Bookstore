<?php
ini_set('display_errors',1);
error_reporting(E_ALL); 

echo  <<<_END
<form method='POST'>
Username <input type='text' maxlength='16' name='user' />
<br>
Password <input type='password' maxlength='16' name='pass' />
<br>
Re-enter Password <input type='password' maxlength='16' name='pass2' />
<br>
<input type='submit' value='Sign Up' />
</form>

_END;

if ( isset($_POST['status']) )
{
    if ($_POST['status'] == 'correct')
    {
        echo "Sign up successful!";
    }
    else
    {
        echo "There was an error in the sign up";
    }

}
?>