<?php 
include("class/auth.php");
include("plugin/plugin.php");
$plugin=new cmsPlugin();
$table="qr_code_reader"; ?>
<?php 
if(isset($_POST['create'])){
   extract($_POST);
   if(!empty($_FILES['image_name']['name']) && !empty($location) && !empty($channel_partner_status))
       {  
        include('class/uploadImage_Class.php'); 
        $imgclassget=new image_class();  
        $image_name=$imgclassget->upload_fiximageFIxName("storage/qrcode","image_name");  
        $insert=array('image_name'=>$image_name,
                    'location'=>$location,
                    'channel_partner_status'=>$channel_partner_status,
                    'date'=>date('Y-m-d'),
                    'status'=>1);
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
   extract($_POST);if(!empty($location) && !empty($channel_partner_status))
   {$updatearray=array("id"=>$id); include('class/uploadImage_Class.php'); $imgclassget=new image_class(); 
   if(!empty($_FILES['image_name']['name']))
   { 
    @unlink("upload/".$ex_image_name); 
    $image_name_1=$imgclassget->upload_fiximageFIxName("storage/qrcode","image_name"); 
    $image_name=$image_name_1; 
}
else
{ 
    $image_name=$ex_image_name; 
}$upd2=array('image_name'=>$image_name,'location'=>$location,'channel_partner_status'=>$channel_partner_status,'date'=>date('Y-m-d'),'status'=>1);
$update_merge_array=array_merge($updatearray,$upd2);
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
   $delarray=array("id"=>$_GET['id']);$photolink=$obj->SelectAllByVal($table,'id',$_GET['id'],'image_name'); @unlink("upload/".$photolink);if($obj->delete($table,$delarray)==1)
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
echo $plugin->softwareTitle("QR Code Reader");
echo $plugin->TableCss();  echo $plugin->FileUploadCss();  ?></head>
<body class="">
  <?php include('include/topnav.php'); include('include/mainnav.php'); ?>





  <div id="content">
     <h1 class="content-heading bg-white border-bottom">QR Code Reader</h1>
     <div class="innerAll bg-white border-bottom">
        <ul class="menubar">
            <li class="active"><a href="#">Create New QR Code Reader</a></li>
            <li><a href="qr_code_reader_data.php">QR Code Reader List</a></li>
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
                <h4 class="heading">Update/Change - QR Code Reader</h4>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body"><form enctype='multipart/form-data' class="form-horizontal" method="post" action="" role="form">
                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"> Image Name </label>

                    <div class='col-sm-3'>
                        <?php 
                        $ex_image_name_data=$obj->SelectAllByVal($table, "id", $_GET['edit'], "image_name");
                        echo $plugin->FileUploadBox(1,$ex_image_name_data,'image_name');
                        ?>
                    </div>
                </div><div class='form-group'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"> Location </label>

                    <div class='col-sm-9'>
                        <input type='text' id='form-field-1' name='location' value='<?php echo $obj->SelectAllByVal($table,"id",$_GET['edit'],"location"); ?>' placeholder='Location' class='form-control' />
                    </div>
                </div><div class='form-group'>
                    <label  for="inputEmail3" class="col-sm-2 control-label"> Status </label>

                    <div class='col-sm-7' style="padding-left: 20px !important;">
                        <?php $ex_channel_partner_status=$obj->SelectAllByVal($table,'id',$_GET['edit'],'channel_partner_status'); ?><label class='radio'>
                            <input <?php if($ex_channel_partner_status=='Match'){ ?> checked='checked' <?php } ?> type='radio' id='channel_partner_status_match_0' name='channel_partner_status'  class='checkbox' value='Match' />
                            Match
                        </label><br>
                        <label class='radio'>
                            <input <?php if($ex_channel_partner_status=='Mismatch'){ ?> checked='checked' <?php } ?> type='radio' id='channel_partner_status_mismatch_1' name='channel_partner_status'  class='checkbox' value='Mismatch' />
                            Mismatch
                        </label>
                    </div>
                </div><div class="form-group">
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
            <h4 class="heading">Create New QR Code Reader</h4>
        </div>
        <!-- // Widget heading END -->

        <div class="widget-body"><form enctype='multipart/form-data' class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
            <label  for="inputEmail3" class="col-sm-2 control-label"> Image Name </label>

            <div class='col-sm-3'>
                <?php 
                echo $plugin->FileUploadBox(0,'','image_name');
                ?>
            </div>
        </div><div class='form-group'>
            <label  for="inputEmail3" class="col-sm-2 control-label"> Location </label>

            <div class='col-sm-9'>
                <input type='text' id='form-field-1' name='location' placeholder='Location' class='form-control' />
            </div>
        </div><div class='form-group'>
            <label  for="inputEmail3" class="col-sm-2 control-label"> Status </label>

            <div class='col-sm-7' style="padding-left: 20px !important;">
                <label class='radio'>
                    <input type='radio' id='channel_partner_status_match_0' name='channel_partner_status'  class='checkbox' value='Match' />
                    Match
                </label>
                <br>
                <label class='radio'>
                    <input type='radio' id='channel_partner_status_mismatch_1' name='channel_partner_status'  class='checkbox' value='Mismatch' />
                    Mismatch
                </label>
            </div>
        </div><div class="form-group">
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

<?php echo $plugin->TableJs();  echo $plugin->FileUploadJS();  ?> <script type='text/javascript'>
    jQuery(function($) {
     $('#id-input-file-1').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:true,
        onchange:null,
        thumbnail:true
    });

 })
</script></body>
</html>