<?php

function admin_user_messages_sent_messages($content) {

    global $wpdb;
    // global $current_user;
    // get_currentuserinfo();


    // Read user ID from the Front End User plugin Level 10 is Administrator

   					global $ewd_feup_user_table_name, $ewd_feup_levels_table_name, $ewd_feup_user_fields_table_name;
   					$UserCookie = CheckLoginCookie();
   					$User = $wpdb->get_row($wpdb->prepare("SELECT * FROM $ewd_feup_user_table_name WHERE Username='%s'", $UserCookie['Username']));
				$current_user->ID = $User->User_ID;


    include('admin_user_messages_settings.php');
    	$table_name = $wpdb->prefix . 'admin_user_message';
    //$table_users = $wpdb->prefix . 'users';

	// Read from FEU instead of blog users
	$table_users = $ewd_feup_user_table_name;



    /*
    // Caution, this line in original file references a specific multisite install, do not use without WP prefix
	//finde alle Nachrichten, die an current_user versendet hat
	$query = "SELECT * FROM yojoma_admin_user_messages WHERE sender = '$current_user->ID' ORDER BY date DESC, time DESC";
        $result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
    */


    if(isset($_POST['pageingSubmitted'])) {

	$actualPageOrg = $_POST['actualPage'];
	$userid = $_POST['userid'];
	$actualPage = $actualPageOrg-1;
	$actualPage = $actualPage * 10;
	$query = "SELECT * FROM $table_name where sender = '$userid' ORDER BY date DESC, time DESC limit $actualPage,10";
	$result = mysql_query($query);
    } else {
	$query = "SELECT * FROM $table_name WHERE sender = '$current_user->ID' ORDER BY date DESC, time DESC limit 0,10";
	$result = mysql_query($query);
	$firstCall = "true";
    }
    	$num_rows = mysql_num_rows($result);
    	$queryPageingObject = "SELECT * FROM $table_name WHERE sender = '$current_user->ID' ORDER BY date DESC, time";
	$resultPageingObject = mysql_query($queryPageingObject);
	$num_rowsPageingObject = mysql_num_rows($resultPageingObject);
?>





	<table border="0" cellpadding="0" cellspacing="0" width="100%">

	    	<tr>
			<td><a href="<?php echo 'http://' . $aum_btn_back_to_inbox; ?>"><?php echo $aum_term_link_inbox; ?></a> | <a href="<?php echo 'http://' . $aum_btn_post_message; ?>"><?php echo $aum_term_link_post_a_message; ?></a> | <span class="nav_strong"><?php echo $aum_term_link_sent_messages; ?></span> | <a href="<?php echo 'http://' . $aum_btn_search; ?>"><?php echo $aum_term_search_button; ?></a></td>

		</tr>

		<tr>
			<td>
<?php
				//echo "Anzahl von Nachrichten in deinem Postfach: " . $num_rowsPageingObject;
				echo $aum_term_quantity_message . ": " . $num_rowsPageingObject;
?>
			</td>
		<tr>
			<td align="right">
<?php
				$pageObjectMailsCount = $num_rowsPageingObject;
				$pageObjectPages = $pageObjectMailsCount / 10;
				$tempzahl = explode(".", $pageObjectPages);
				if (isset($tempzahl[1])) {
				    // Zahl hat nachkommastellen
				    $pageObjectPagesFinal = ceil ($pageObjectPages);
				}

				//echo "Anzahl Seiten: " . $pageObjectPagesFinal;

				//echo "Seite: ";

				echo $aum_term_page . ":";


 				$count = 1;
				while($count <= $pageObjectPagesFinal)
				{
					if ($count == $pageObjectPagesFinal) {
						if ($actualPageOrg == $count) {
							echo $count;
						} else {

							if ($firstCall == 'true' && $count == '1') {
								echo $count;
							} else  {
								echo "<span style='font-weight:bold;'><a href='javascript:setActualPage(" . $count . ")'>" . $count . "</a></span>";
							}
						}
					} else {
						if ($actualPageOrg == $count) {
							echo $count . " | ";
						} else {
							if ($firstCall == 'true' && $count == '1') {
								echo $count . " | ";
							} else  {
								echo "<span style='font-weight:bold;'><a href='javascript:setActualPage(" . $count . ")'>" . $count . "</a></span>"," | ";
							}
}
					}

					$count++;
				}
?>
			</td>
		</tr>
	</table>















	<script>

		function showMessage (x) {
			document.getElementById("messageId").value = x;
			document.showMessage.submit();
		}

	</script>

	<form name="showMessage" method="post" action="http://<?php echo $aum_btn_read_message ?>">
		<input type="hidden" name="messageId" id="messageId" value="">
		<input type="hidden" name="submitted" id="submitted" value="true">
	</form>


	<script>

	function setActualPage (x) {


		document.getElementById('actualPage').value = x;
		document.pageingObjectForm.submit()

	}

	</script>
	<form name="pageingObjectForm" method="Post" action="<?php the_permalink(); ?>">
		<input type="hidden" name="actualPage" id="actualPage" value="">
		<input type="hidden" name="userid" value="<?php echo $current_user->ID ?>">
		<input type="hidden" name="pageingSubmitted" value="true">
	</form>




<table>
		<tr valign="top">

			<td>
				<table class="aum_table">
					<tr valign="top" style="background-color: <?php echo $aum_tablecolorheader ?>;">

						<td class="aum_td"><?php echo $aum_term_to ?>:</td>
						<td class="aum_td"><?php echo $aum_term_subject ?>:</td>
						<td class="aum_td"><?php echo $aum_term_received ?>:</td>
						<td class="aum_td"><?php echo $aum_term_time ?>:</td>

					</tr>
<?php
						if ($num_rows >= '1') {
							while($row = mysql_fetch_row($result)) {
								//finde den Empf�nger Nickname aus der Usertabelle
								$queryReceiver = "SELECT User FROM $table_users WHERE User_ID = '$row[2]'";
								$resultReceiver = mysql_query($queryReceiver);
?>
					<tr valign="top">
								<td class="aum_td">


<?php
								    while($rowReceiver = mysql_fetch_row($resultReceiver)) {
									echo $rowReceiver[0];
								    }


								    	if (strlen($row[7]) > 45) {
										$cutString = "...";
									} else {
										$cutString = "";
									}
?>

								</td>
								<td class="aum_td">

										<a style="color:#91c8d4" href=javascript:showMessage(<?php echo $row[0]; ?>);><?php echo substr($row[7], 0, 45); echo $cutString; ?></a>


								</td>
								<td class="aum_td">
<?php
								$d    =    explode("-",$row[4]);

								echo $d[2] . "." . $d[1] . "." . $d[0];
?>

								</td>
								<td class="aum_td"><?php echo $row[3]; ?></td>

					</tr>
<?php
							}
						} else {
?>
						    <tr>
							<td colspan="4" class="aum_td">
							    &nbsp;
							</td>
						    </tr>

<?php
						}
?>
				</table>
			</td>
		</tr>
	</table>




        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>





<?php
}
add_shortcode( 'admin_user_messages_sent_messages', 'admin_user_messages_sent_messages' );
?>