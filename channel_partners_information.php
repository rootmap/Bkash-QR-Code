<?php 
include("class/auth.php");
include("plugin/plugin.php");
$plugin=new cmsPlugin();
$table="channel_partners_information"; ?>
<?php 
if(isset($_POST['create'])){
 extract($_POST);

 if(!empty($channel_partner) && !empty($agent_wallet_number) && !empty($address) && !empty($partner_status))
 { 
    if($channel_partner!=3)
    {
        if(empty($name_of_the_agent) || empty($name_of_the_distributor) || empty($name_of_the_region) || empty($owners_name))
        {
            $plugin->Error("Fields is Empty",$obj->filename());
        }
    }

    $channel_partner_name=$obj->SelectAllByVal('channel_partners','id',$channel_partner,'name');
    if($channel_partner!=3)
    {
        $insert=array(
        'channel_partner'=>$channel_partner,
        'channel_partner_name'=>$channel_partner_name,
        'agent_wallet_number'=>$agent_wallet_number,
        'name_of_the_agent'=>$name_of_the_agent,
        'name_of_the_distributor'=>$name_of_the_distributor,'name_of_the_region'=>$name_of_the_region,'owners_name'=>$owners_name,'address'=>$address,'partner_status'=>$partner_status,'date'=>date('Y-m-d'),'status'=>1);
    }
    else
    {
        $insert=array(
        'channel_partner'=>$channel_partner,
        'channel_partner_name'=>$channel_partner_name,
        'agent_wallet_number'=>$agent_wallet_number,
        'name_of_the_agent'=>'',
        'name_of_the_distributor'=>'',
        'name_of_the_region'=>'',
        'owners_name'=>'',
        'address'=>$address,
        'partner_status'=>$partner_status,
        'date'=>date('Y-m-d'),
        'status'=>1);
    }
    
    if($obj->insert($table,$insert)==1)
    {
       $plugin->Success("Successfully Saved",$obj->filename());
   }
   else 
   {
       $plugin->Error("Failed",$obj->filename());
   }
}
else 
{
    $plugin->Error("Fields is Empty",$obj->filename());
}   
}
elseif(isset($_POST['update'])) 
{
 extract($_POST);
 if(!empty($channel_partner) && !empty($agent_wallet_number) && !empty($name_of_the_agent) && !empty($address) && !empty($partner_status))
 {


    if($channel_partner!=3)
    {
        if(empty($name_of_the_agent) || empty($name_of_the_distributor) || empty($name_of_the_region) || empty($owners_name))
        {
            $plugin->Error("Fields is Empty",$obj->filename());
        }
    }

    $channel_partner_name=$obj->SelectAllByVal('channel_partners','id',$channel_partner,'name');
    if($channel_partner!=3)
    {
        $updatearray=array("id"=>$id);
        $upd2=array('channel_partner'=>$channel_partner,'agent_wallet_number'=>$agent_wallet_number,'name_of_the_agent'=>$name_of_the_agent,'name_of_the_distributor'=>$name_of_the_distributor,'name_of_the_region'=>$name_of_the_region,'owners_name'=>$owners_name,'address'=>$address,'partner_status'=>$partner_status,'date'=>date('Y-m-d'),'status'=>1);
        $update_merge_array=array_merge($updatearray,$upd2);
    }
    else
    {
       $updatearray=array("id"=>$id);
       $upd2=array('channel_partner'=>$channel_partner,'agent_wallet_number'=>$agent_wallet_number,'name_of_the_agent'=>$name_of_the_agent,'name_of_the_distributor'=>'','name_of_the_region'=>'','owners_name'=>'','address'=>$address,'partner_status'=>$partner_status,'date'=>date('Y-m-d'),'status'=>1);
        $update_merge_array=array_merge($updatearray,$upd2);
    }

    
 if($obj->update($table,$update_merge_array)==1)
 { 
     $plugin->Success("Successfully Updated",$obj->filename());
 } 
 else 
 { 
     $plugin->Error("Failed",$obj->filename()); 
 }}}
 elseif(isset($_GET['del'])=="delete") 
 {
     $delarray=array("id"=>$_GET['id']);if($obj->delete($table,$delarray)==1)
     { 
        $plugin->Success("Successfully Delete",$obj->filename());  
    } 
    else 
    { 
        $plugin->Error("Failed",$obj->filename()); 
    }
}
?><!doctype html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
<head><?php  
echo $plugin->softwareTitle("Channel Partners Information");
echo $plugin->TableCss();  ?></head>
<body class="">
  <?php include('include/topnav.php'); include('include/mainnav.php'); ?>





  <div id="content">
   <h1 class="content-heading bg-white border-bottom">Channel Partners Information</h1>
   <div class="innerAll bg-white border-bottom">
    <ul class="menubar">
        <li class="active"><a href="#">Create New Channel Partners Information</a></li>
        <li><a href="channel_partners_information_data.php">Channel Partners Information List</a></li>
    </ul>
</div>
<div class="innerAll spacing-x2">
    <?php echo $plugin->ShowMsg(); ?>
    <!-- Widget -->

    <!-- Widget -->
    <div class="widget widget-inverse" >
     <?php 
     if(isset($_GET['edit']))
     {
         ?>
         <!-- Widget heading -->
         <div class="widget-head">
            <h4 class="heading">Update/Change - Channel Partners Information</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form">
            <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                <label  for="inputEmail3" class="col-sm-2 control-label"> Channel Partner </label>

                <div class='col-sm-9'>
                    <select id='form-field-1' name='channel_partner' class='form-control'><option value='0'>Please Select</option><?php 
                    $ex_channel_partner_data=$obj->SelectAllByVal($table,'id',$_GET['edit'],'channel_partner');
                    $sqlchannel_partner=$obj->FlyQuery('SELECT id,name FROM `channel_partners`');
                    if(!empty($sqlchannel_partner))
                    {
                        foreach ($sqlchannel_partner as $channel_partner): ?><option <?php if($channel_partner->id==$ex_channel_partner_data){ ?> selected='selected' <?php } ?> value='<?=$channel_partner->id?>'><?=$channel_partner->name?></option><?php endforeach; ?><?php } ?></select>
                    </div>
                </div>
                <div class='form-group'>
                    <label  for="inputEmail3" class="col-sm-2 control-label" id="agent_wallet_number"> Agent wallet number </label>

                    <div class='col-sm-9'>
                        <input type='text' id='agent_wallet_number_placeholder' name='agent_wallet_number' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"agent_wallet_number"); ?>' placeholder='Agent wallet number' class='form-control' />
                    </div>
                </div>
                <div class='form-group'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"  id="name_of_the_agent"> Name of the Agent </label>

                    <div class='col-sm-9'>
                        <input type='text' id='name_of_the_agent_placeholder' name='name_of_the_agent' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"name_of_the_agent"); ?>' placeholder='Name of the Agent' class='form-control' />
                    </div>
                </div>
                <div class='form-group merchant_hide'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"> Name of the distributor </label>

                    <div class='col-sm-9'>
                        <input type='text' id='form-field-1' name='name_of_the_distributor' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"name_of_the_distributor"); ?>' placeholder='Name of the distributor' class='form-control' />
                    </div>
                </div>
                <div class='form-group merchant_hide'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"> Name of the region </label>

                    <div class='col-sm-9'>
                        <input type='text' id='form-field-1' name='name_of_the_region' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"name_of_the_region"); ?>' placeholder='Name of the region' class='form-control' />
                    </div>
                </div>
                <div class='form-group merchant_hide'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"> Owners name </label>

                    <div class='col-sm-9'>
                        <input type='text' id='form-field-1' name='owners_name' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"owners_name"); ?>' placeholder='Owners name' class='form-control' />
                    </div>
                </div>
                <div class='form-group'>
                    <label  for="inputEmail3" class="col-sm-2 control-label" id="address"> Address </label>

                    <div class='col-sm-9'>
                        <input type='text' id='address' name='address' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"address"); ?>' placeholder='Address' class='form-control' />
                    </div>
                </div>
                <div class='form-group'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"> Partner Status </label>

                    <div class='col-sm-9'>
                        <?php $ex_partner_status=$obj->SelectAllByVal($table,'id',$_GET['edit'],'partner_status'); ?><label class='radio'>
                            <input <?php if($ex_partner_status=='Active'){ ?> checked='checked' <?php } ?> type='radio' id='partner_status_active_0' name='partner_status'  class='checkbox' value='Active' />
                            Active
                        </label><label class='radio'>
                            <input <?php if($ex_partner_status=='Inactive'){ ?> checked='checked' <?php } ?> type='radio' id='partner_status_inactive_1' name='partner_status'  class='checkbox' value='Inactive' />
                            Inactive
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button  onclick="javascript:return confirm('Do You Want change/update These Record?')"  type="submit" name="update" class="btn btn-primary">Save Change</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <?php }else{ ?>
        <!-- Widget heading -->
        <div class="widget-head">
            <h4 class="heading">Create New Channel Partners Information</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body"><form  class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
            <label  for="inputEmail3" class="col-sm-2 control-label"> Channel Partner </label>

            <div class='col-sm-9'>
                <select id='form-field-1' name='channel_partner' class='form-control'><option value='0'>Please Select</option><?php $sqlchannel_partner=$obj->FlyQuery('SELECT id,name FROM `channel_partners`');
                if(!empty($sqlchannel_partner))
                {
                    foreach ($sqlchannel_partner as $channel_partner): ?><option value='<?=$channel_partner->id?>'><?=$channel_partner->name?></option><?php endforeach; ?><?php } ?></select>
                </div>
            </div>
            <div class='form-group'>
                <label  for="inputEmail3" class="col-sm-2 control-label" id="agent_wallet_number"> Agent wallet number </label>

                <div class='col-sm-9'>
                    <input type='text' id='agent_wallet_number_placeholder' name='agent_wallet_number' placeholder='Agent wallet number' class='form-control' />
                </div>
            </div>
            <div class='form-group'>
                <label  for="inputEmail3" class="col-sm-2 control-label" id="name_of_the_agent"> Name of the Agent </label>

                <div class='col-sm-9'>
                    <input type='text' id='name_of_the_agent_placeholder' name='name_of_the_agent' placeholder='Name of the Agent' class='form-control' />
                </div>
            </div>
            <div class='form-group merchant_hide'>
                <label  for="inputEmail3" class="col-sm-2 control-label"> Name of the distributor </label>

                <div class='col-sm-9'>
                    <input type='text' id='form-field-1' name='name_of_the_distributor' placeholder='Name of the distributor' class='form-control' />
                </div>
            </div>
            <div class='form-group merchant_hide'>
                <label  for="inputEmail3" class="col-sm-2 control-label"> Name of the region </label>

                <div class='col-sm-9'>
                    <input type='text' id='form-field-1' name='name_of_the_region' placeholder='Name of the region' class='form-control' />
                </div>
            </div>
            <div class='form-group merchant_hide'>
                <label  for="inputEmail3" class="col-sm-2 control-label"> Owners name </label>

                <div class='col-sm-9'>
                    <input type='text' id='form-field-1' name='owners_name' placeholder='Owners name' class='form-control' />
                </div>
            </div>
            <div class='form-group'>
                <label  for="inputEmail3" class="col-sm-2 control-label" id="address"> Address </label>

                <div class='col-sm-9'>
                    <input type='text' id='address_placeholder' name='address' placeholder='Address' class='form-control' />
                </div>
            </div>
            <div class='form-group'>
                <label  for="inputEmail3" class="col-sm-2 control-label"> Partner Status </label>

                <div class='col-sm-9'>
                    <label class='radio'>
                        <input type='radio' id='partner_status_active_0' name='partner_status'  class='checkbox' value='Active' />
                        Active
                    </label><label class='radio'>
                        <input type='radio' id='partner_status_inactive_1' name='partner_status'  class='checkbox' value='Inactive' />
                        Inactive
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit"   onclick="javascript:return confirm('Do You Want Create/save These Record?')"  name="create" class="btn btn-info">Save</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
    </div>
    <?php } ?>
</div>
<!-- // Widget END -->




<!-- // Widget END -->
</div>
</div>
<!-- // Content END -->

<div class="clearfix"></div>
<!-- // Sidebar menu & content wrapper END -->
<?php include('include/footer.php'); ?>
<!-- // Footer END -->
</div>
<!-- // Main Container Fluid END -->
<!-- Global -->

<?php echo $plugin->TableJs();  ?> 
<script type="text/javascript">
    $(document).ready(function(){
        <?php 
        if(isset($_GET['edit'])){ 
            if($ex_channel_partner_data==3){
                ?>
                $(".merchant_hide").fadeOut('fast');
                $("#agent_wallet_number").html("Merchant wallet number");
                $("#agent_wallet_number_placeholder").attr("placeholder","Merchant wallet number");
                $("#name_of_the_agent").html("Name of the merchant");
                $("#name_of_the_agent_placeholder").attr("placeholder","Name of the merchant");
                $("#address").html("Address of the merchant");
                $("#address_placeholder").attr("placeholder","Address of the merchant");
                $(".merchant_hide").fadeOut('slow');
                <?php
            }
            else
            {
                ?>
                $(".merchant_hide").fadeIn('fast');
                $("#agent_wallet_number").html("Agent wallet number");
                $("#agent_wallet_number_placeholder").attr("placeholder","Agent wallet number");
                $("#name_of_the_agent").html("Name of the Agent");
                $("#name_of_the_agent_placeholder").attr("placeholder","Name of the Agent");
                $("#address").html("Address");
                $("#address_placeholder").attr("placeholder","Address");
                $(".merchant_hide").fadeIn('slow');
                <?php
            }
        }
        else
        {
            ?>
            $(".merchant_hide").fadeOut('fast');
            <?php
        } 
        ?>    
        
        $("select[name=channel_partner]").change(function(){
            var channel_partner=$(this).val();
            if(channel_partner==3)
            {
                $("#agent_wallet_number").html("Merchant wallet number");
                $("#agent_wallet_number_placeholder").attr("placeholder","Merchant wallet number");
                $("#name_of_the_agent").html("Name of the merchant");
                $("#name_of_the_agent_placeholder").attr("placeholder","Name of the merchant");
                $("#address").html("Address of the merchant");
                $("#address_placeholder").attr("placeholder","Address of the merchant");
                $(".merchant_hide").fadeOut('slow');

            }
            else
            {
                $("#agent_wallet_number").html("Agent wallet number");
                $("#agent_wallet_number_placeholder").attr("placeholder","Agent wallet number");
                $("#name_of_the_agent").html("Name of the Agent");
                $("#name_of_the_agent_placeholder").attr("placeholder","Name of the Agent");
                $("#address").html("Address");
                $("#address_placeholder").attr("placeholder","Address");
                $(".merchant_hide").fadeIn('slow');
            }
            //alert(channel_partner);
        });
    });
</script>
</body>
</html>