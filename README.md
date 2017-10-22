# Elegant-Bookstore
Elegant-Bookstore - Elegant is an open source ORM where the functionalities are demonstrated by the Bookstore.

# In this version
- The ORMall functionality is giving expected results as a typical ORM would but it is unnecessarily slow.
- The save functionality knows to update or insert based on what the value of $hasWhereClause is in QueryBuilder, $hasWhereClause is no longer private.
