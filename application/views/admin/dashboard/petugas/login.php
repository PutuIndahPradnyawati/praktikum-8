<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <style media="screen">
    body
    {
      font-family: sans-serif;
     background: #90b6f4;
    }
    .kotak
    {
      width: 350px;
      background: white;
      margin-top: 150px;
      padding: 100px 30px;
    }
    .oke
    {
    background: #46de4b;
   color: white;
   font-size: 13pt;
   border-radius: 3px;
   padding: 10px 20px;
    text-decoration: none;
    }
    .input
    {
      box-sizing : border-box;
      width: 100%;
      padding: 6px;
      font-size: 11pt;
      margin-bottom: 10px;
    }
    </style>
	
</head>
<body>
	<center>
	<div class="kotak">
	<form action="<?php echo base_url('login/aksi_login'); ?>" method="post">	
		<h1 style="margin-top:-20px">LOGIN</h1>	
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Login"></td>
			</tr>
		</table>
	</form>
	</div>
	</center>
</body>
</html>



