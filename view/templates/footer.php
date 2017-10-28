
<!-- </div>
</div> -->
</body>
<script>
$(document).ready(function(){

  isSmallScreen = false;
  // Execute on load
  checkWidth();
  // Bind event listener
  $(window).resize(checkWidth);

  function checkWidth() {
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    if (width > 760)
    { 
        isSmallScreen = false;
        return;
    }
    else if (width <= 760 && isSmallScreen == true)
        return;
    
    isSmallScreen = true;
      //assuming single table on a page find the table
      $table = $("tbody");
      $thead = $("thead.thead-inverse>tr");
      $tableheaders = $thead.children();

      $tableheaders.each( function( index ) {
        //search within table'
        $th = $( "th:nth-of-type("+(index+1)+")" , $thead);
        $content = $th.text()+":";

        $td = $( "td:nth-of-type("+(index+1)+")" , $table);
        $td.append('<style> td:nth-of-type('+(index+1)+'):before { content: "'+$content+'"; }</style>')
        $td.before().css("content", $content);
        console.log($td);
      });
  }
});

</script>
<footer class="footer">
      <div class="container-fluid">
        <span class="text-muted"> <p style="color:white; font:bold;" class="text-center">©Elegant 2017</p> </span>
      </div>
</footer>
</html>
<!-- <div id="footer-padding-top"></div>
<div id="buttons">
    <a class="btn btn-primary" href=".">Get Booklist</a>
    <a class="btn btn-primary" href='./?customerslist'>Get Customers' Orders List</a>
    <form class="btn btn-warning" method="POST"><input style="background-color:inherit; border:none;" type="submit" name="resetBooks" value="Reset Books Table"></form>
</div>
</body>
</html> -->