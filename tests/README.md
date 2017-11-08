
<h2>In order to run tests on linux/mac use the following commands:</h2>

#QueryBuilderTest
phpunit --bootstrap  Elegant/QueryBuilder.php tests/QueryBuilderTest.php --testdox

#BookTest
phpunit --bootstrap  model/Book.php tests/BookTest.php --testdox
----------------------------------------------------------------------------

#In order to run tests on windows use the following commands:

#QueryBuilderTest
phpunit --bootstrap c:/xampp/htdocs/github/Elegant-Bookstore/Elegant/QueryBuilder.php tests/QueryBuilderTest.php --testdox

#BookTest
phpunit --bootstrap c:/xampp/htdocs/github/Elegant-Bookstore/model/Book.php tests/BookTest.php --testdox
phpunit --bootstrap c:/xampp/htdocs/github/Elegant-Bookstore/model/Book.php tests/BookTest.php --verbose 

#Customer Test
phpunit --bootstrap c:/xampp/htdocs/github/Elegant-Bookstore/model/Customer.php tests/CustomerTest.php --testdox


#Debugging in Terminal:
change --testdox to --verbose and use either var_dump($object);
or 
echo '| String qbQuery = "'.$qbQuery.'"; |'; // do a dump replace --testdox 


