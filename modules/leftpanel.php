<div class="contentbox"">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- News Post Overview -->
<div class="box_shell">
	<!-- rows! -->
	<div class="box_row_top">
		<div class="box_top_left_dark"></div><div class="box_top_center_dark"></div><div class="box_top_right_dark"></div>
		<div class="box_title_dark" style="width:calc(100% - 51px);position:relative;left:25px;top:11px;">
			Recent News
		</div>
	</div>
	<div class="box_row_mid">
		<div class="box_mid_left_dark"></div>
		<div class="box_mid_center_dark"></div>
		<div class="box_mid_right_dark"></div>
			<div class="box_text">
		
		<?php
				//Pull DB
				include 'connection/connection.php'; 
				//establishSession();

				// Create connection
				$con=mysqli_connect($host,$user,$password,$db);


				// Check connection
				if (mysqli_connect_errno()) {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();}

				$result = mysqli_query($con,"SELECT * FROM news ORDER BY post_date DESC LIMIT 0,5");

				while($row = mysqli_fetch_array($result))
				{
					echo '
							<a href="./"><hr class="box_line" style="width:90%;position:relative;left:5%;margin-bottom:5px;margin-top:5px;">' . $row['title'] . '
									<br />
									<div class="box_text_small">' . date('F d, Y', $row['post_date']) . '</div></a>
							
							';
				}

				mysqli_free_result($result);
				mysqli_close($con);
			
			?>
			
			<hr class="box_line" style="width:90%;position:relative;left:5%;margin-bottom:5px;margin-top:5px;">
			</div>
			
	</div>
	<div class="box_row_bot"><div class="box_bot_left_dark"></div><div class="box_bot_center_dark"></div><div class="box_bot_right_dark"></div></div>
</div>

<!-- Social Connection Tools -->
<div class="box_shell">
	<!-- rows! -->
	<div class="box_row_top">
		<div class="box_top_left_dark"></div><div class="box_top_center_dark"></div><div class="box_top_right_dark"></div>
		<div class="box_title_dark" style="width:calc(100% - 51px);position:relative;left:25px;top:11px;">
			Social
		</div>
	</div>
	<div class="box_row_mid">
		<div class="box_mid_left_dark"></div>
		<div class="box_mid_center_dark"></div>
		<div class="box_mid_right_dark"></div>
		
		<div class="box_text">
			<div class="fb-like" data-href="https://www.facebook.com/pages/Sevestral/386862594846442" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div><br /><br />
			<a href="https://twitter.com/Snorlon" class="twitter-follow-button" data-show-count="true" data-dnt="true">Follow @Snorlon</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
			
	</div>
	<div class="box_row_bot"><div class="box_bot_left_dark"></div><div class="box_bot_center_dark"></div><div class="box_bot_right_dark"></div></div>
</div>

</div>