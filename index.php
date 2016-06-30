<html>
<head>
<?php
	require "modules/title.php";
?>
</head>

<body>

<div class="mainbox">
	<div class="headerbox">
		<?php
			require "modules/header.php";
		?>
	</div>

	<div class="navbox">
		<?php
			require "modules/navigation.php";
		?>
	</div>
	</div>

	<div class="leftsidebox">
		<div class = "backbannertop"> </div>
		<?php
			require "modules/leftpanel.php";
		?>
		<div class = "backbannerbottom"> </div>
	</div>
	<div class="centerbox">
		<div class = "backbannertop"> </div>
		
			<!-- News Posts -->
			<div class="box_shell_short" style="top:-55px;">
				<!-- rows! -->
				<div class="box_row_top">
					<div class="box_top_left_short"></div><div class="box_top_center_short"></div><div class="box_top_right_short"></div>
					<div class="box_title" style="width:calc(100% - 51px);position:relative;left:25px;top:11px;">
						News
					</div>
				</div>
			</div>
		
			
			
		
			<?php
				//Pull DB
				include 'connection/connection.php'; 
				//establishSession();

				// Create connection
				$con=mysqli_connect($host,$user,$password,$db);

				// Check connection
				if (mysqli_connect_errno()) {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();}
				
				function GET($name=NULL, $value=false)
				{
					$content=(!empty($_GET[$name]) ? trim($_GET[$name]) : (!empty($value) && !is_array($value) ? trim($value) : false));
					if(is_numeric($content))
						return preg_replace("@([^0-9])@Ui", "", $content);
					else if(is_bool($content))
						return ($content?true:false);
					else if(is_float($content))
						return preg_replace("@([^0-9\,\.\+\-])@Ui", "", $content);
					else if(is_string($content))
					{
						if(tag_var ($content, tag_VALIDATE_URL))
							return $content;
						else if(tag_var ($content, tag_VALIDATE_EMAIL))
							return $content;
						else if(tag_var ($content, tag_VALIDATE_IP))
							return $content;
						else if(tag_var ($content, tag_VALIDATE_FLOAT))
							return $content;
						else
							return preg_replace("@([^a-zA-Z0-9\+\-\_\*\@\$\!\;\.\?\#\:\=\%\/\ ]+)@Ui", "", $content);
					}
					else false;
				}
				$tagString = "";
				if(isset ($_GET["tag"]))
				{
					//if this is what we have, then we have a tag
					$tagString = " WHERE tags LIKE '%".$_GET["tag"]."%'";
				}
				  
				  
				$result = mysqli_query($con,"SELECT * FROM news".$tagString." ORDER BY post_date DESC LIMIT 0,5");

				while($row = mysqli_fetch_array($result))
				{
					echo '<div class="box_shell" style="top:-55px;">
						<div class="box_row_top">
							<div class="box_top_left"></div><div class="box_top_center"></div><div class="box_top_right"></div>
							<div class="box_title" style="width:calc(100% - 51px);position:relative;left:25px;top:11px;">
								' . $row['title'] . '
							</div>
						</div>
						<div class="box_row_mid">
							<div class="box_mid_left"></div>
							<div class="box_mid_center"></div>
							<div class="box_mid_right"></div>
							
							<div class="box_text" style="text-align:left;padding:30px;">
								' . str_replace("\\t", "&nbsp&nbsp&nbsp&nbsp", str_replace("\\n", "<br />", $row['content'])) . '
									<br />
									<hr class="box_line">
									<div class="box_text_small">Posted by <a href="./">' . $row['poster_id'] . "</a> on " . date('F d, Y', $row['post_date']) . '</div>
									<div class="box_text_small">Tags: ';

					$tags = explode(", ",$row['tags']);
					
					foreach($tags as $tag)
					{
						echo '<a href="./?tag='.$tag.'">'.$tag.'</a>&nbsp&nbsp';
					}
					
					echo '</div>
							</div>
								
						</div>
						<div class="box_row_bot"><div class="box_bot_left"></div><div class="box_bot_center"></div><div class="box_bot_right"></div></div>
					</div>';
				}

				mysqli_free_result($result);
				mysqli_close($con);
			
			?>		
			<br />
		<div class="footer">
		<?php
			require "modules/footer.php";
		?>
		</div>
		<div class = "backbannerbottom"> </div>
	</div>
	<div class="sidebox">
		<div class = "backbannertop"> </div>
		<?php
			require "modules/rightpanel.php";
		?>
		<div class = "backbannerbottom"> </div>
	</div>
</div>

</body>

</html>