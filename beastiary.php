<html>
<head>
<?php
	require "modules/title.php";
?>
</head>

<body>
<script>
var frame = 0;

function tickSprites() {
    if(frame == 0)
		frame = 1;
	else
		frame = 0;
	
	
	//update the offset of the image
	
	//allows up to 100 possible
	for(var i=0; i<100; i++)
	{
		document.getElementById("Sprite"+i.toString()).style.backgroundPosition = 72*frame+"px 0px";
	}
}
</script>

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
						Beastiary
					</div>
				</div>
			</div>
		
			<div class="box_shell" style="top:-55px;">
				<div class="box_row_top">
					<div class="box_top_left"></div><div class="box_top_center"></div><div class="box_top_right"></div>
					<div class="box_title" style="width:calc(100% - 51px);position:relative;left:25px;top:11px;">
					</div>
				</div>
				<div class="box_row_mid">
					<div class="box_mid_left"></div>
					<div class="box_mid_center"></div>
					<div class="box_mid_right"></div>
							
					<div class="box_text" style="text-align:left;padding:10px;">
			

			<!-- Generate a random creature file -->
			<?php
				function random_creature_file($dir = 'Sevestral Kingdoms/Game Data/Creatures')
				{
					$files = glob($dir . '/*.*');
					$file = array_rand($files);
					return $files[$file];
				}
			?>
		
			<?php
				$number = 25;
			
				//$filePath = random_creature_file();
				$fileData = file_get_contents("resources/beast_list.txt");
				
				//parse it!
				$rowData = explode(PHP_EOL, $fileData);
				
				$index = 0;
				$startIndex = 0;
				$spriteIndex = 0;
				
				$consecutive = 0;
				
				//shuffle($rowData);
				
				echo "<div style='width:90%;height:80px;background-size: 100% 100%;background-repeat: no-repeat;background-image:url(\"images/creature/creature_bg_row.png\");border:1px solid #000000;text-align:center;margin-left: auto;margin-right: auto;'>";
				
				foreach($rowData as $line)
				{
					if($index < $startIndex)
					{
					}
					else if($spriteIndex < $number)
					{
						$colData = explode("\t", $line);
						//echo $colData[0]."<br />";
						echo "<div style='width:calc(20% - 2px);;height:80px;float:left;border-right:1px solid #000000;border-left:1px solid #000000;'><div style='margin-left: auto;margin-right: auto;margin-top:4px;margin-bottom:4px;height:72px;width:72px;background-image:url(\"images/creature/creature_feature_".strtolower($colData[2]).".png\");'><div id='Sprite".$spriteIndex."' style='background-image:url(\"Sevestral Kingdoms/sprites/".$colData[1].".png\");width:72;height:72px;margin-bottom:-147px;background-size: 144px 72px;position:relative;top:0px;overflow:hidden;background-position: 0px 0px;' title='".$colData[0]."'>&nbsp</div></div></div>";
						
						$spriteIndex++;
						$consecutive++;
						
						if($consecutive >= 5 && count($rowData)-1 > $spriteIndex)
						{
							$consecutive = 0;
							
							echo "</div><div style='width:90%;height:80px;background-size: 100% 100%;background-repeat: no-repeat;background-image:url(\"images/creature/creature_bg_row.png\");border:1px solid #000000;text-align:center;margin-left: auto;margin-right: auto;'>";
						}
					}
					$index++;
				}
				
				if($spriteIndex < $number)
				{
					while($spriteIndex < $number)
					{
						$colData = explode("\t", $line);
						//echo $colData[0]."<br />";
						echo "<div style='width:calc(20% - 2px);;height:80px;float:left;border-right:1px solid #000000;border-left:1px solid #000000;'><div style='margin-left: auto;margin-right: auto;margin-top:4px;margin-bottom:4px;height:72px;width:72px;background-image:url(\"images/creature/creature_feature.png\");'><div id='Sprite".$spriteIndex."' style='background-image:url(\"Sevestral Kingdoms/sprites/mystery.png\");width:72;height:72px;margin-bottom:-147px;background-size: 144px 72px;position:relative;top:0px;overflow:hidden;background-position: 0px 0px;' title='Unknown'>&nbsp</div></div></div>";
						
						$spriteIndex++;
						$consecutive++;
						
						if($consecutive >= 5 && $number > $spriteIndex)
						{
							$consecutive = 0;
							
							echo "</div><div style='width:90%;height:80px;background-size: 100% 100%;background-repeat: no-repeat;background-image:url(\"images/creature/creature_bg_row.png\");border:1px solid #000000;text-align:center;margin-left: auto;margin-right: auto;'>";
						}
						
						$index++;
					}
				}
				
				echo "</div>";
				
				//get name
				//$nameData = preg_split("/[\t]/", $rowData[0]);
				//echo '<div style="font-size:24px;">'.$nameData[1]."</div><br />";
				
				//draw the stat box
				
				//get sprite
				/*$filename = preg_split("/[\t]/", $rowData[26]);
				
				//get animation speed
				$animationRate = preg_split("/[\t]/", $rowData[27]);
				
				//get some stat data
				//strength
				$strengthRaw = preg_split("/[\t]/", $rowData[1]);
				
				//toughness
				$toughnessRaw = preg_split("/[\t]/", $rowData[2]);
				
				//agility
				$agilityRaw = preg_split("/[\t]/", $rowData[3]);
				
				//dexterity
				$dexterityRaw = preg_split("/[\t]/", $rowData[4]);
				
				//intelligence
				$intelligenceRaw = preg_split("/[\t]/", $rowData[5]);
				
				//willpower
				$willpowerRaw = preg_split("/[\t]/", $rowData[6]);
				
				//charisma
				$charismaRaw = preg_split("/[\t]/", $rowData[7]);
				
				//luck
				$luckRaw = preg_split("/[\t]/", $rowData[8]);
				
				//get some resist data
				for($i=0; $i<9;$i++)
					$resistsRaw[$i] = preg_split("/[\t]/", $rowData[10+$i]);
				
				for($i = 0; $i<9; $i++)
					//calculate the scale of each time
					$scales[$i] = (2.0 - floatVal($resistsRaw[$i][1]))*33/2;
				
				//set our animation speed
				echo '<script>timeLeft = '.(floatval($animationRate[1])*100).'</script>';
				
				echo '<div style = "width:148px;height:147px;position:relative;left:calc($number% - 74px);display:inline;">';
					echo '<div id="sprite" style="background-image:url(\'Sevestral%20Kingdoms/sprites/'.trim($filename[1]).'\');width:144;height:140px;margin-bottom:-147px;background-size: 288px 140px;position:relative;top:-4px;overflow:hidden;background-position: 0px 0px;"></div>';
				
				echo "</div>";
				
				echo '<div title="Resistances (Left to Right): Neutral Fire Water Earth Wind Life Time Space Void" style = "background-image:url(\'images/stat_box.png\');width:148px;height:147px;position:relative;left:calc($number% - 74px);">';
					//draw the pretty resist bars
					echo '<div style="background-image:url(\'images/resists/neutral.png\');width:131px;height:'.$scales[0].'px;position:absolute;top:'.(106 + (33-$scales[0])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/fire.png\');width:131px;height:'.$scales[1].'px;position:absolute;top:'.(106 + (33-$scales[1])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/water.png\');width:131px;height:'.$scales[2].'px;position:absolute;top:'.(106 + (33-$scales[2])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/earth.png\');width:131px;height:'.$scales[3].'px;position:absolute;top:'.(106 + (33-$scales[3])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/wind.png\');width:131px;height:'.$scales[4].'px;position:absolute;top:'.(106 + (33-$scales[4])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/life.png\');width:131px;height:'.$scales[5].'px;position:absolute;top:'.(106 + (33-$scales[5])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/time.png\');width:131px;height:'.$scales[6].'px;position:absolute;top:'.(106 + (33-$scales[6])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/space.png\');width:131px;height:'.$scales[7].'px;position:absolute;top:'.(106 + (33-$scales[7])).'px;left:8px;"></div>';
					echo '<div style="background-image:url(\'images/resists/void.png\');width:131px;height:'.$scales[8].'px;position:absolute;top:'.(106 + (33-$scales[8])).'px;left:8px;"></div>';
				
					//draw the boss image
					//get boss
					$bossFlag = preg_split("/[\t]/", $rowData[24]);
					if($bossFlag[1] == "True")
					{
						echo '<div title="It\'s a boss creature!" style = "background-image:url(\'images/boss_icon.png\');width:45px;height:18px;position:relative;left:calc(100% - 52px);top:calc(100% - 60px);"></div>';
					}
				
				echo '</div>';
				
				
				//convert stats
				$strBase = floatVal($strengthRaw[1]);
				$strGain = floatVal($strengthRaw[3]);
				$touBase = floatVal($toughnessRaw[1]);
				$touGain = floatVal($toughnessRaw[3]);
				$agiBase = floatVal($agilityRaw[1]);
				$agiGain = floatVal($agilityRaw[3]);
				$dexBase = floatVal($dexterityRaw[1]);
				$dexGain = floatVal($dexterityRaw[3]);
				$intBase = floatVal($intelligenceRaw[1]);
				$intGain = floatVal($intelligenceRaw[3]);
				$wilBase = floatVal($willpowerRaw[1]);
				$wilGain = floatVal($willpowerRaw[3]);
				$chaBase = floatVal($charismaRaw[1]);
				$chaGain = floatVal($charismaRaw[3]);
				$lukBase = floatVal($luckRaw[1]);
				$lukGain = floatVal($luckRaw[3]);
				
				//get faction
				$factionData = preg_split("/[\t]/", $rowData[20]);
				
				echo '<br /><table style="width:100%;text-align:center;"><tr><td title="Strength base stat + growth rate">
					<div style="background-image:url(\'images/stats/strength.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$strBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$strGain.'</div></td><td title="Toughness base stat + growth rate">
					<div style="background-image:url(\'images/stats/toughness.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$touBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$touGain.'</div></td></tr>
					<tr><td title="Agility base stat + growth rate">
					<div style="background-image:url(\'images/stats/agility.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$agiBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$agiGain.'</div></td><td title="Dexterity base stat + growth rate">
					<div style="background-image:url(\'images/stats/dexterity.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$dexBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$dexGain.'</div></td></tr>
					<tr><td title="Intelligence base stat + growth rate">
					<div style="background-image:url(\'images/stats/intelligence.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$intBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$intGain.'</div></td><td title="Willpower base stat + growth rate">
					<div style="background-image:url(\'images/stats/willpower.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$wilBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$wilGain.'</div></td></tr>
					<tr><td title="Charisma base stat + growth rate">
					<div style="background-image:url(\'images/stats/charisma.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$chaBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$chaGain.'</div></td><td title="Luck base stat + growth rate">
					<div style="background-image:url(\'images/stats/luck.png\');width:39px;height:22px;float:left;position:relative;top:-4px;"></div>
					<div style="float:left;">'.$lukBase.'</div>
					<div style="background-image:url(\'images/stats/plus.png\');width:15px;height:22px;float:left;position:relative;top:-4px;margin-left:1px;margin-right:1px;"></div>
					<div style="float:left;">'.$lukGain.'</div></td></tr>
					<tr><td colspan="2">
					<div style="background-image:url(\'images/stats/faction.png\');width:74px;height:22px;position:relative;top:-4px;float:left;"></div>
					<div style="width:calc(100%-74px);text-align:center;">'.$factionData[1].'</div></td></tr>
					
					</table><br />';
				
				echo '<div class="box_text_small"><hr class="box_line"></div>';*/
			?>		
			
					
					</div>
				</div>
			<div class="box_row_bot"><div class="box_bot_left"></div><div class="box_bot_center"></div><div class="box_bot_right"></div></div>
		</div>;
			
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

<script>
var a;
a = setInterval(function () {tickSprites()}, 500);
</script>
</body>

</html>