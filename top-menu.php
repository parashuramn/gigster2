<header class="navbar-fixed-top" style="border-top: 13px solid #e95436;">      
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <a href="<?php echo $serverpath;?>"><img src="<?php echo $serverpath;?>images/logo.png"></a>
          </div>
          <div class="col-md-10">
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                <?php if(isset($_SESSION['uId']))
				{
					?>
                      <li><a data-toggle="modal" href="#postgigmodel" onClick="reset_post_gig()">POST GIG</a></li>
                      <?php
				}
				else
				{
					?>
                      <li><a data-toggle="modal" href="#loginmodel">POST GIG</a></li>
                      <?php
				}
					  ?>
                      <li><a href="<?php echo $serverpath;?>allgigs">LIST GIGS</a></li>
                      <li><a href="<?php echo $serverpath;?>gigsters">GIGSTERS</a></li>
                   <!--  <li><a data-toggle="modal" href="#invitemodal">INVITE</a></li> -->



                      <?php if(isset($_SESSION['uId']))
					  {
						  $uInfo=get_user_Info($_SESSION['uId']);
						  $uProfilepic=$uInfo['profileimage'];
						  if(!$uProfilepic)
						  {
							  $uProfilepic="images/admin.png";
						  }
						  else{
							  $uProfilepic="uploads/profileimage/".$uProfilepic;
						  }
						  ?>
						  <li><a href="<?php echo $serverpath;?>mygigs" >MY GIGS</a></li>                                          
   						  <li><a href="<?php echo $serverpath;?>assignments" >MY ASSIGNMENT</a></li>
                          <li><a href="<?php echo $serverpath;?>myaccount" >
                          <img src="<?php echo $serverpath;?>image.php?image=/<?=$uProfilepic;?>&width=25&height=25&cropratio=1:1" />
                          </a></li>  
                          <?php $unread=get_user_messages($uInfo['userId']);
						  if($unread)
						  {
						  ?>
              			  <li><a  href="<?php echo $serverpath;?>inbox" >INBOX(<?php echo $unread['count'];?>)</a></li>                                          
						  <?php
						  }
						   else
						   {
							    ?>
              			  <li><a  href="<?php echo $serverpath;?>inbox" >INBOX(0)</a></li>                                          
						  <?php
						   }
					  }
					  else
					  {
						  ?>
                      <li><a data-toggle="modal" href="#loginmodel" >LOGIN</a></li>   
                      <?php
					 
					  }
					  ?>
                 </ul>
              </div>
          </div>
          <div class="clearfix"></div> 
        </div>
      </div>
    </header>
