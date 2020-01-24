<?php

define('FLOWTXT','/data/flow.txt');
define('FLOWIMG','img/flow.png');

$sample_flow='
@startuml
actor User
entity Outlet
control IMW_UMB
control MFS
control SMSC
==Token Generation==
User -> IMW_UMB : Request for generate token
IMW_UMB -> MFS : Create Token Request\n(msisdn,amount)
MFS -> SMSC : Send Token on SMS
MFS -> IMW_UMB: Create Token Response
SMSC -> User : Receive Token
== Token Usage ==
User -> Outlet : Given Token Ask for Cash
Outlet -> IMW_UMB : Send request for Cash out
IMW_UMB -> MFS :Send Balance Transfer \nRequest with Token
Note over MFS : Validate User Details\nCredit Outlet\nDebit User
MFS -> IMW_UMB : Balance Transfer Response
IMW_UMB -> Outlet: Cash Out Response
Outlet -> User: Give Cash
@enduml';


if(isset($_POST['submit']))
{
    $fileName=__DIR__.FLOWTXT;
    
    file_put_contents($fileName, $_POST['flow']);
    $sample_flow = $_POST['flow'];
    $cmd = '/usr/bin/java -jar plantuml.jar -o '.__DIR__."/img ".$fileName;

    shell_exec($cmd);
}
else
{
    $fileName=__DIR__.FLOWTXT;
    
    file_put_contents($fileName, $sample_flow);
    $cmd = '/usr/bin/java -jar plantuml.jar -o '.__DIR__."/img ".$fileName;
    shell_exec($cmd);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>-----> UMLFLOW ---></title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>
    
    <div class="container-fluid">
	<div class="row">
	
	
	<h4 class="text-center text-info">For more documentation follow <a href="http://plantuml.com/sequence-diagram" target="_blank">plantuml</a></h4>
		</div>
	<div class="row">
		<div class="col-md-6">
			<form role="form" method="post">
				<div class="form-group">
					 
					
					<textarea cols="100" rows="20" name="flow" placerholder="Enter Flow description">
					<?php echo $sample_flow?></textarea>
				</div>
				
				<button name="submit" type="submit" class="btn btn-primary">
					Submit
				</button>
			</form>
		</div>
		<div class="col-md-6">
			<img alt="Bootstrap Image Preview" src="img/flow.png?<?php echo time()?>" class="img-thumbnail">
		</div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
