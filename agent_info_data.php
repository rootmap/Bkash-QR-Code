<?php
$table="agent_info"; ?><?php 
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
        	<h1 class="content-heading bg-white border-bottom">Agent Info Data</h1>
            <div class="innerAll bg-white border-bottom">
                <ul class="menubar">
                    <li><a href="agent_info.php">Create New Agent Info</a></li>
                    <li class="active"><a href="#">Agent Info Data List</a></li>
                </ul>
            </div>
          <div class="innerAll spacing-x2">
                <div class="col-sm-12" id="agent_info_62"></div>
            </div>
        </div>
        <!-- // Agent Info END -->

        <div class="clearfix"></div>
        <!-- // Sidebar menu & Agent Info wrapper END -->
        
        <?php include('include/footer.php'); ?>
        <!-- // Footer END -->
    </div>
    <!-- // Main Container Fluid END -->
    <!-- Global -->
    <script id="edit_agent_info" type="text/x-kendo-template">
             <a class="k-button k-button-icontext k-grid-edit" href="agent_info.php?edit=#= id#"><span class="k-icon k-edit"></span>Edit</a>
            </script>
    <script id="delete_agent_info" type="text/x-kendo-template">
                    <a class="k-button k-button-icontext k-grid-delete" onclick="javascript:deleteClick(#= id #);" ><span class="k-icon k-delete"></span>Delete</a>
            </script>        
    <script type="text/javascript">
                function deleteClick(agent_info_id) {
                    var c = confirm("Do you want to delete?");
                    if (c === true) {
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "./controller/agent_info_controller.php",
                            data: {id: agent_info_id,table:"agent_info",acst:3},
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
                                url: "./controller/agent_info_controller.php",
                                type: "POST",
								data:
								{
									"acst":1, //action status sending to json file
									"table":"agent_info",
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
                                    id: {nullable: true},agent_wallet_number: {type: "string"},name_of_the_agent: {type: "string"},name_of_the_distributor: {type: "string"},name_of_the_region: {type: "string"},owners_name: {type: "string"},address: {type: "string"},
									date: {type: "string"}
                                }
                            }
                        }
                    });
                    jQuery("#agent_info_62").kendoGrid({
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
                        columns: [{field: "id", title: "#"},
                        {field: "agent_wallet_number", title: "Wallet number"},
                        {field: "name_of_the_agent", title: "Agent Name"},{field: "name_of_the_distributor", title: "Distributor"},
                        {field: "name_of_the_region", title: "Region"},
                        {field: "owners_name", title: "Owners"},{field: "address", title: "Address"},

							{field: "date", title: "Record Added", width: "150px"},
							{
                                title: "Edit",
                                template: kendo.template($("#edit_agent_info").html())
                            },
							{
                                title: "Delete",
                                template: kendo.template($("#delete_agent_info").html())
                            }
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