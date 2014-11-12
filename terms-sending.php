<?php
include('cfg/cfg.php');
include('cfg/more-functions.php'); 

$projectId=filter_text($_POST['projectId']);
$ownerId=filter_text($_SESSION['uId']);
$ownerId=get_user_Info($_SESSION['uId']);
$ownerId=$ownerId['userId'];
$awardedto=filter_text($_POST['awardedto']);
$terms=filter_text($_POST['terms']);
$startdate=date('y-m-d');
$enddate=filter_text($_POST['enddate']);
$ownerInfo=get_user_Info(encrypt_str($ownerId));
$startfrom=$startdate;
$to=$enddate;

$amount=filter_text($_POST['amount']);
$checkQuery="select * from btr_assignment where projectId=$projectId";
$checkSql=@db_query($checkQuery);
if($checkSql['count']>0)
{
	?>
		<script type="text/javascript">
	
		window.parent.document.getElementById("successmsg").style.display="none";		
		window.parent.document.getElementById("errormsg").style.display="block";				
		window.parent.document.getElementById("errormsg").innerHTML="Error, Project Already Awarded.";				
		</script>
		<?php
		die();
}
else
{
	$insertQuery="insert into btr_assignment(projectId,awardedto,assignedon,startdate,completiondate,projectowner,terms,amount,termsaccepted)";
	$insertQuery.="values($projectId,$awardedto,".gmmktime().",'$startfrom','$to',$ownerId,'$terms',$amount,'1')";	
	$insertQuery=@db_query($insertQuery,3);
	if($insertQuery)
	{
		$updateQuery=@db_query("update btr_projects set status='2' where prjId=$projectId");
		$userInfo=get_user_Info(encrypt_str($awardedto));
		$gigdetails=get_gig_details($projectId);
		$gigname=$gigdetails['prjTitle'];
		$usermail=$userInfo['usermail'];
	$usernametodisplay=$userInfo['fname']." ".$userInfo['lname'];
	$usernametodisplay1=str_replace(" ","",$usernametodisplay);
	if(!$usernametodisplay1)
	{
		$usernametodisplay=$userInfo['username'];
	}
		$mailmatter="<p>Congratulation</p>
				<p>Your proposal on gig <strong>$gigname</strong> is selected.
				<p>To View Details and accept the terms , please click on following link</p>
				<p><a href='".$serverpath."acceptGig/".encrypt_str($insertQuery)."/".encrypt_str($awardedto)."'>Click Here To Accept</a></p>
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";
				
						
								$mailto=filter_text($usermail);
								$mailsubject="Congratulation, your proposal is chosen";
								$mail=send_my_mail($mailto,$mailmatter,$mailsubject);	
								$mailmatter=strip_tags($mailmatter);
								$mailmatter=nl2br($mailmatter);
								$mailmatter=htmlentities($mailmatter);
								$msgquery="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values($ownerId,$awardedto,'$mailmatter',".gmmktime().",".$projectId.",'0','d')";
				$msgsql=@db_query($msgquery);
				
				// Sending mail to gig owner
				
				$mailmatter1="<p>Congratulation</p>
				<p>You have selected proposal of ".$usernametodisplay." on gig <strong>$gigname</strong>.
				<p>&nbsp;</p>
				<p>Regards</p>
				<p>$sitename</p>";
				
				$mailto=filter_text($ownerInfo['usermail']);
								$mailsubject1="Congratulation, your gig is awawrded.";
								$mail1=send_my_mail($ownerInfo['usermail'],$mailmatter1,$mailsubject1);	
								$mailmatter1=strip_tags($mailmatter1);
								$mailmatter1=nl2br($mailmatter1);
								$mailmatter1=htmlentities($mailmatter1);
								$msgquery1="insert into btr_messages(msgfrom,msgto,msgcontent,msgon,projectId,isread,msgtype)";
				$msgquery.="values($awardedto,$ownerId,'$mailmatter1',".gmmktime().",".$projectId.",'0','d')";
				$msgsql=@db_query($msgquery);
				// Sending mail to gig owner ends
		?>
		<script type="text/javascript">
		window.parent.location="<?php echo $serverpath;?>gigDetails/<?php echo mera_url_noslash($gigdetails['prjTitle']);?>/<?php echo $gigdetails['prjId'];?>";	
		</script>
		<?php
		die();
	}
	else
	{
		print_r($GLOBALS['debug_sql']);
	}
}

?>