<?php 
		include("class/auth.php");
		include("plugin/plugin.php");
		$plugin=new cmsPlugin();
		$table="upload_channel_info_using_excel"; ?>
		<?php 
		if(isset($_POST['create'])){
			extract($_POST);
			if(!empty($channel_partner_id) && !empty($_FILES['excel']['name']))
			{  
                include('class/uploadImage_Class.php'); 
                $imgclassget=new image_class(); 
			     $excel=$imgclassget->fileUpload("excel","excel_upload_".time(),"storage/excel");  
                 $channel_partner_name=$obj->SelectAllByVal('channel_partners','id',$channel_partner_id,'name');
                 $insert=array(
                    'channel_partner_id'=>$channel_partner_id,
                    'channel_partner_name'=>$channel_partner_name,
                    'excel'=>$excel,'date'=>date('Y-m-d'),'status'=>1);
				if($obj->insert($table,$insert)==1)
				{

                    
                    require 'phpspreadsheet/spreadsheet/vendor/autoload.php';
                    $fxls ='storage/excel/'.$excel;
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
                    $xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                    $recordSaved=0;
                    $nr = count($xls_data); //number of rows
                    for($i=3; $i<=$nr; $i++){
                            //echo "<pre>";
                          //print_r($xls_data[$i]); die(); 
                        $obj->insert('channel_partners_information',
                            array(
                                'channel_partner'=>$channel_partner_id,
                                'channel_partner_name'=>$channel_partner_name,
                                'agent_wallet_number'=>$xls_data[$i]['D'],
                                'name_of_the_agent'=>$xls_data[$i]['E'],
                                'name_of_the_distributor'=>$xls_data[$i]['F'],
                                'name_of_the_region'=>$xls_data[$i]['G'],
                                'owners_name'=>$xls_data[$i]['H'],
                                'address'=>$xls_data[$i]['I'],
                                'partner_status'=>'Inactive',
                                'date'=>date('Y-m-d'),
                                'status'=>'1'
                            )
                        );

                        $recordSaved++;                    
                    }


                    //echo "DOne Working"; die();

					$plugin->Success("Successfully Partners (".$channel_partner_name.") Saved (".$recordSaved.").",$obj->filename());
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
			extract($_POST);if(!empty($channel_partner_id))
			{$updatearray=array("id"=>$id); include('class/uploadImage_Class.php'); $imgclassget=new image_class(); 
                                                    if(!empty($_FILES['excel']['name']))
                                                    {
                                                            $excel_1=$imgclassget->fileUpload("excel","excel_upload_".$table_name."_".time(),"upload");
                                                            $excel=$excel_1; 
                                                            @unlink("upload/".$ex_);      
                                                    }
                                                    else
                                                    {
                                                            $excel=$ex_excel;
                                                    }$upd2=array('channel_partner_id'=>$channel_partner_id,'excel'=>$excel,'date'=>date('Y-m-d'),'status'=>1);
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
			$delarray=array("id"=>$_GET['id']);$photolink=$obj->SelectAllByVal($table,'id',$_GET['id'],'excel');  @unlink("upload/".$photolink);if($obj->delete($table,$delarray)==1)
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
    echo $plugin->softwareTitle("Upload Channel Info Using Excel");
    echo $plugin->TableCss();  echo $plugin->FileUploadCss();  ?></head>
    <body class="">
		<?php include('include/topnav.php'); include('include/mainnav.php'); ?>
        




        <div id="content">
        	<h1 class="content-heading bg-white border-bottom">Upload Channel Info Using Excel</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li class="active"><a href="#">Create New Upload Channel Info Using Excel</a></li>
                    <li><a href="upload_channel_info_using_excel_data.php">Upload Channel Info Using Excel List</a></li>
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
                                <h4 class="heading">Update/Change - Upload Channel Info Using Excel</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body"><form enctype='multipart/form-data' class="form-horizontal" method="post" action="" role="form">
								<input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>"><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Channel Partner ID </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='channel_partner_id' class='form-control'><option value='0'>Please Select</option><?php 
                        $ex_channel_partner_id_data=$obj->SelectAllByVal($table,'id',$_GET['edit'],'channel_partner_id');
                        $sqlchannel_partner_id=$obj->FlyQuery('SELECT id,name FROM `channel_partners`');
                        if(!empty($sqlchannel_partner_id))
                        {
                            foreach ($sqlchannel_partner_id as $channel_partner_id): ?><option <?php if($channel_partner_id->id==$ex_channel_partner_id_data){ ?> selected='selected' <?php } ?> value='<?=$channel_partner_id->id?>'><?=$channel_partner_id->name?></option><?php endforeach; ?><?php } ?></select>
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Excel </label>

                            <div class='col-sm-3'>
                                    <?php 
                    $ex_excel_data=$obj->SelectAllByVal($table, "id", $_GET['edit'], "excel");
                    echo $plugin->FileUploadBox(1,$ex_excel_data,'excel');
                    ?>
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
                                <h4 class="heading">Create New Upload Channel Info Using Excel</h4>
                            </div>
                            <!-- // Widget heading END -->
							
                            <div class="widget-body"><form enctype='multipart/form-data' class="form-horizontal" method="post" action="" role="form"><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Channel Partner ID </label>

                            <div class='col-sm-9'>
                                    <select id='form-field-1' name='channel_partner_id' class='form-control'><option value='0'>Please Select</option><?php $sqlchannel_partner_id=$obj->FlyQuery('SELECT id,name FROM `channel_partners`');
                        if(!empty($sqlchannel_partner_id))
                        {
                            foreach ($sqlchannel_partner_id as $channel_partner_id): ?><option value='<?=$channel_partner_id->id?>'><?=$channel_partner_id->name?></option><?php endforeach; ?><?php } ?></select>
                            </div>
                    </div><div class='form-group'>
                            <label  for="inputEmail3" class="col-sm-2 control-label"> Excel </label>

                            <div class='col-sm-3'>
                                    <?php 
                    echo $plugin->FileUploadBox(0,'','excel');
                   ?>
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