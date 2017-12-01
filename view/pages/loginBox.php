<?php
echo  <<<_END
<form method='POST'>
Username <input type='text' maxlength='16' name='userLogin' />
<br>
Password <input type='password' maxlength='16' name='passLogin' />
<br>
<input type='submit' value='Login' />
</form>

_END;
?>