<?php
$table="upload_channel_info_using_excel"; ?><?php 
include('class/auth.php');
include('plugin/plugin.php');
$plugin=new cmsPlugin(); 
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
    <head>
		<?php 
		echo $plugin->softwareTitle();
		echo $plugin->TableCss();
		echo $plugin->KendoCss();
		 ?>
    </head>
    <body class="">
		<?php 
		include('include/topnav.php'); 
		include('include/mainnav.php'); 
		?>
        <div id="content">
        	<h1 class="content-heading bg-white border-bottom">Upload Channel Info Using Excel Data</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li><a href="upload_channel_info_using_excel.php">Create New Upload Channel Info Using Excel</a></li>
                    <li class="active"><a href="#">Upload Channel Info Using Excel Data List</a></li>
                </ul>
            </div>
          <div class="innerAll spacing-x2">
                <div class="col-sm-12" id="upload_channel_info_using_excel_64"></div>
            </div>
        </div>
        <!-- // Upload Channel Info Using Excel END -->

        <div class="clearfix"></div>
        <!-- // Sidebar menu & Upload Channel Info Using Excel wrapper END -->
        
        <?php include('include/footer.php'); ?>
        <!-- // Footer END -->
    </div>
    <!-- // Main Container Fluid END -->
    <!-- Global -->

    <script id="delete_upload_channel_info_using_excel" type="text/x-kendo-template">
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
            </script>        
    <script type="text/javascript">
                function deleteClick(upload_channel_info_using_excel_id) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "./controller/upload_channel_info_using_excel_controller.php",
                            data: {id: upload_channel_info_using_excel_id,table:"upload_channel_info_using_excel",acst:3},
                            success: function (result) {
							if(result==1)
							{
								location.reload();
							}
							else
							{
								$(".k-i-refresh").click();
							}
                            }
                        });
                    }
                }

            </script>
            <script type="text/javascript">
                jQuery(document).ready(function () {
					var postarray={"id":1};
                    var dataSource = new kendo.data.DataSource({
                        pageSize: 5,
                        transport: {
                            read: {
                                url: "./controller/upload_channel_info_using_excel_controller.php",
                                type: "POST",
								data:
								{
									"acst":1, //action status sending to json file
									"table":"upload_channel_info_using_excel",
									"cond":0,
									"multi":postarray
									
								}
                            }
                        },
                        autoSync: false,
                        schema: {
                            data: "data",
                            total: "data.length",
                            model: {
                                id: "id",
                                fields: {
                                    id: {nullable: true},channel_partner_name: {type: "string"},excel: {type: "string"},
									date: {type: "string"}
                                }
                            }
                        }
                    });
                    jQuery("#upload_channel_info_using_excel_64").kendoGrid({
                        dataSource: dataSource,
                        filterable: true,
                        pageable: {
                            refresh: true,
                            input: true,
                            numeric: false,
                            pageSizes: true,
                            pageSizes: [5, 10, 20, 50],
                        },
                        sortable: true,
                        groupable: true,
                        columns: [{field: "id", title: "#"},{field: "channel_partner_name", title: "Channel Partner"},{field: "excel", title: "Excel"},
							{field: "date", title: "Record Added", width: "150px"}
                        ]
                    });
                });

            </script>    
    <?php 
	echo $plugin->TableJs(); 
	echo $plugin->KendoJS(); 
	?>
    
</body>
</html>