</div>
<div class="copyrights">
	 <p>© <?php echo date("Y")." Job Application System"; ?>. All Rights Reserved</p>
</div>	
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> 
		  	<a href="index.php" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 			      
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
		        <li><a href="#"><i class="fa fa-cogs"></i><span>Qualifications</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="addqualifications.php">Add New</a></li>
		            <li><a href="qualifications.php">View All</a></li>		            
		          </ul>
		        </li>
		        <li id="menu-comunicacao" ><a href="#"><i class="fa fa-book nav_icon"></i><span>Jobs</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul id="menu-comunicacao-sub" >		            
		            <li id="menu-arquivos" ><a href="addjob.php">Add New</a></li>
		            <li id="menu-arquivos" ><a href="jobs.php">View All</a></li>
		          </ul>
		        </li>
		          <!--<li><a href="<?php echo $applicants; ?>"><i class="fa fa-map-marker"></i><span>Applicants</span></a></li>-->
		        
		      <li id="menu-comunicacao" ><a href="#"><i class="fa fa-users nav_icon"></i><span>Users</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul id="menu-comunicacao-sub" >		            
		            <li id="menu-arquivos" ><a href="adduser.php">Add New</a></li>
		            <li id="menu-arquivos" ><a href="users.php">View All</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
<script src="js/bootstrap.js"> </script>
<script src="js/select2.min.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
    $('#q').select2();
</script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
    };
</script>
</body>
</html>                     