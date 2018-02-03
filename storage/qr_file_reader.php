<?php
include('../class/db_Class.php');	
$obj = new db_class();
/** define the directory **/
$dir = "./qrcode/";
$filenew=array();
/*** cycle through all files in the directory ***/
$process=0;
foreach (glob($dir."*") as $file) {
    	//$filenew[]=$file;
    	$fileSplit=explode('_',explode('/',$file)[2])[0];
    	if($fileSplit)
    	{
    		$exists=$obj->exists_multiple('channel_partners_information',array('agent_wallet_number'=>$fileSplit,'partner_status'=>'Inactive'));
    		if($exists!=0)
    		{
    			$process++;
    			$obj->update('channel_partners_information',array('agent_wallet_number'=>$fileSplit,'partner_status'=>'Active'));
    		}
    	}
}

if($process==0)
{
	echo "Noting new to read.";
}
else
{
	echo "Process Done for = ".$process;
}

?>