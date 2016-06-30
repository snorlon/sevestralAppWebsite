<script>
var frame = 0;
var timeLeft = 1000;

function tickSprite() {
    if(frame == 0)
		frame = 1;
	else
		frame = 0;
	
	//update the offset of the image
	
    document.getElementById("sprite").style.backgroundPosition = 144*frame+"px 0px";
	//setInterval(tickSprite(), 500);
}
</script>

<div class="contentbox" style="position:absolute;left:-35px;"">

<!-- Game Tips -->

<?php
		//Pull DB
		include 'connection/connection.php'; 
		//establishSession();

		// Create connection
		$con=mysqli_connect($host,$user,$password,$db);


		// Check connection
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();}

		$result = mysqli_query($con,"SELECT * FROM tips");
		
		$maxVal = mysqli_num_rows($result);
		
		//pick a random index
		$index = rand(1,$maxVal) - 1;
		
		mysqli_data_seek($result, $index);

		if($row = mysqli_fetch_array($result))
		{
			
			echo '<div class="box_shell">
				<div class="box_row_top">
					<div class="box_top_left_dark"></div><div class="box_top_center_dark"></div><div class="box_top_right_dark"></div>
					<div class="box_title_dark" style="width:calc(100% - 51px);position:relative;left:25px;top:11px;">Game Tip</div>
				</div>
				<div class="box_row_mid">
					<div class="box_mid_left_dark"></div>
					<div class="box_mid_center_dark"></div>
					<div class="box_mid_right_dark"></div>
					
					<div class="box_text">
						' . $row['content'] . '
							<br />
							<hr class="box_line">
							<div class="box_text_small">' . $row['game'] . '</div>
					</div>
						
				</div>
				<div class="box_row_bot"><div class="box_bot_left_dark"></div><div class="box_bot_center_dark"></div><div class="box_bot_right_dark"></div></div>
			</div>';
		}

		mysqli_free_result($result);

		// fact corner
		$result = mysqli_query($con,"SELECT * FROM facts");
		
		$maxVal = mysqli_num_rows($result);
		
		//pick a random index
		$index = rand(1,$maxVal) - 1;
		
		mysqli_data_seek($result, $index);

		if($row = mysqli_fetch_array($result))
		{
			
			echo '<div class="box_shell">
				<div class="box_row_top">
					<div class="box_top_left_dark"></div><div class="box_top_center_dark"></div><div class="box_top_right_dark"></div>
					<div class="box_title_dark" style="width:calc(100% - 51px);position:relative;left:25px;top:11px;">Sevestral Facts</div>
				</div>
				<div class="box_row_mid">
					<div class="box_mid_left_dark"></div>
					<div class="box_mid_center_dark"></div>
					<div class="box_mid_right_dark"></div>
					
					<div class="box_text">
						' . str_replace("\\n", "<br />", $row['details']) . '
							<br />
							<hr class="box_line">
							<div class="box_text_small">Regarding ' . $row['subject'] . '</div>
					</div>
						
				</div>
				<div class="box_row_bot"><div class="box_bot_left_dark"></div><div class="box_bot_center_dark"></div><div class="box_bot_right_dark"></div></div>
			</div>';
		}

		mysqli_free_result($result);
		mysqli_close($con);
	
	?>


</div>

<script>
var a = setInterval(function () {tickSprite()}, timeLeft);
</script>