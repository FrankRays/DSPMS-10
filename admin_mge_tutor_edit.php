<?php include("session_start.php"); ?>

<?php include("admin_authenticate.php"); ?>

<?php

// form submited code
if(isset($_POST['tutor_id']))
{	
	include('db_connection.php');
  
	$sql = "UPDATE tutor SET " . 
		"   login = '" . $_POST['login'] . 
		"', password = '" . $_POST['password'] . 
		"', name = '" . $_POST['name'] . 
		"' WHERE tutor_id = " . $_POST['tutor_id'] . " LIMIT 1;"; 

	//echo '<br />sql = ' . $sql . '<br />';
	//exit;

	if(!mysql_query($sql))
	{
		if(mysql_errno() == 1062) // rec exists
		{
			//print 'Record already exists for "' . $_REQUEST['txtFullName'] . '"';
			$_SESSION['msg'] = 'Record already exists with this login: ' . $_POST['login'];
		}
		else
		{
			$_SESSION['msg'] = mysql_errno() . '<br />Error: ' . mysql_error();
		}
	} // if(!mysql_query($sql))
	else
	{
		$_SESSION['msg'] =  $_POST['login'] . "'s Record updated successfully.";
	}

	$_GET['tutor_id'] = $_POST['tutor_id'];
	//header('Location: admin_mge_tutor_main.php');		
	//exit;


	//mysql_close($con);
	//echo "<br>end";
}


// else code
if(isset($_GET['tutor_id']))
{
	include('db_connection.php');
  
	$sql = 'SELECT * FROM tutor WHERE tutor_id = ' . $_GET['tutor_id'];
	$result = mysql_query($sql);

	//echo '<br />sql = ' . $sql . '<br />';
	//exit;

	$row = mysql_fetch_array($result);

	//mysql_close($con);
	//echo "<br>end";
}

?>

<?php include("top.php"); ?>

<?php include("admin_submenu.php"); ?>

<div id="contenttext">

<div style="padding:10px">
<span class="titletext">Edit Tutor</span> </div>

<div class="bodytext" style="padding:12px;" align="justify">
<strong>Edit Tutor</strong>
<p>Here we will edit tutor.</p>

<table align="center" border="1">
<form action="admin_mge_tutor_edit.php" method="post">
<tr>
	<td><strong>Tutor ID:</strong>		</td>
	<td>
		<?php echo $row['tutor_id'];?> &nbsp;
		<input type="hidden" name="tutor_id" value="<?php echo $row['tutor_id'];?>"  />
	</td>
</tr>
<tr><td><strong>Login:</strong>		</td><td><input type="text" name="login" value="<?php echo $row['login'];?>" /> 		</td></tr>
<tr><td><strong>Password:</strong>	</td><td><input type="password" name="password" value="<?php echo $row['password'];?>" />	</td></tr>
<tr><td><strong>Name:</strong>		</td><td><input type="text" name="name" value="<?php echo $row['name'];?>" />	</td></tr>
<tr><td align="center">
	<input type="button" value="Back" onclick="location.href = 'admin_mge_tutor_main.php';"/> 
</td><td align="center" />
	<input type="submit" value="Update" />
	<input type="reset" />
</td></tr>
</form>
</table>

</div>
</div>

<?php include("bottom.php"); ?>
