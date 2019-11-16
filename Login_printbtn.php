<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Print All database</title>
</head>

<body>
	<?php
	if($sub_print=="Print All")
		{
			$print="SELECT * FROM coursetable where 1";
			$res=mysqli_query($dbcon,$print);
	?>
			<table class="class_print_table" style="margin-top: 50px; font-size: 25px;" cellspacing=0px;>
				<tr>
					<td style="color:chartreuse; padding:10px;">Plant name</td>
					<td style="color:chartreuse; padding:10px;">Scientific name</td>
				</tr>
	<?php
			while($row=mysqli_fetch_array($res,MYSQLI_ASSOC))
			{
	?>
				<tr style="">
					<td style="border: 2px chartreuse solid; padding:10px;">
					<?php	print_r( $row["plant_name"] ); ?>
					</td>
					
					<td style="border:2px chartreuse solid; font-family: serif; font-style: italic; padding: 10px;">
					<?php	print_r( $row["sci_plant_name"] ); ?>
					</td>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
		} ?>
</body>
</html>