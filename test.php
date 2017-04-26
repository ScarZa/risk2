<html>
<head>
<title>ThaiCreate.Com Tutorials</title>
</head>
<body>
    <form action="process/prcupload_file.php" name="form1" method="post" enctype="multipart/form-data" target="iframe_target" onSubmit="return ChkSubmit();">
            <input type="text" name="test">
	<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
	<script language="JavaScript">

		function ChkSubmit(result)
		{
			if(document.getElementById("filUpload").value == "")
			{
				alert('Please select file...');
				return false;
			}
			
			document.getElementById("progress").style.visibility="visible"; 
			document.getElementById("divresult").innerHTML ="Uploading....";
			return true;
		}

		function showResult(result)
		{
			document.getElementById("progress").style.visibility="hidden"; 
			if(result==1)
			{
				document.getElementById("divresult").innerHTML = "<font color=green> Save successfully! </font>  <br>";
			}
			else
			{
				document.getElementById("divresult").innerHTML = "<font color=red> Error!! Cannot upload data </font> <br>";
			}
		}
	</script>
	<div id="divresult"></div>
	<div id="progress" style="visibility:hidden"><img src="progress.gif"></div>
	<input type="file" name="filUpload" id="filUpload">
	  <input type="submit" name="submit" value="submit">
	  </form>
</body>
</html>


<?php
sleep(3);
if(isset($_FILES["filUpload"])){

if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
{
	echo "<script>alert('Upload file successfully!');</script>";
	echo "<script>window.top.window.showResult('1');</script>";
}
else
{
	echo "<script>alert('Error! Cannot upload data');</script>";
	echo "<script>window.top.window.showResult('2');</script>";
}
}
?>
