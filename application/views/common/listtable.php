<?php
echo script_tag('dhtmlx/dhtmlxcommon.js');
echo link_tag('dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.css');
echo script_tag('dhtmlx/dhtmlxGrid/codebase/dhtmlxgrid.js');
echo link_tag('dhtmlx/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_blue.css');
echo link_tag('dhtmlx/dhtmlxGrid/codebase/skins/dhtmlxgrid_dhx_web.css');

echo script_tag('dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_pgn.js');
echo link_tag('dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_pgn_bricks.css');
///////////filter/////////////
echo script_tag('dhtmlx/dhtmlxGrid/codebase/ext/dhtmlxgrid_filter.js');
echo script_tag('dhtmlx/dhtmlxGrid/codebase/dhtmlxgridcell.js');

echo script_tag('dhtmlx/dhtmlxToolbar/codebase/dhtmlxtoolbar.js');
echo link_tag('dhtmlx/dhtmlxToolbar/codebase/skins/dhtmlxtoolbar_dhx_skyblue.css');

echo link_tag('dhtmlx/dhtmlxWindows/codebase/dhtmlxwindows.css');
echo link_tag('dhtmlx/dhtmlxWindows/codebase/skins/dhtmlxwindows_dhx_web.css');
echo script_tag('dhtmlx/dhtmlxWindows/codebase/dhtmlxcontainer.js');
echo script_tag('dhtmlx/dhtmlxWindows/codebase/dhtmlxwindows.js');

echo script_tag('dhtmlx/dhtmlxcommon.js');
echo link_tag('dhtmlx/dhtmlxMessage/codebase/themes/message_default.css');
echo script_tag('dhtmlx/dhtmlxMessage/codebase/message.js');

echo script_tag('dhtmlx/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js');
echo script_tag('dhtmlx/connector/codebase/connector.js');

 
?>

  
         
					<div class="box span10">              
					<div class="box-content">
                       <div id="toolbarObj" ></div>
                        <div id="toolbarObjNew" ></div>
                        <div id="mygrid_container" style="width:100%;"></div>
                            <div id="forPaging" >
                                <span id="pagingArea"></span>&nbsp;
                                <span id="infoArea" ></span>
                                <p><i>Note: If pagination no. doesn't appear, click on any column head for once.</i><br/>
                                
                                </p>
                            </div>
                        <div id="UIBlocker">Please wait,&nbsp;</div>
                        </div>
                    </div>

<script type="text/javascript">

	var mygrid,win,dhxWin;
	var gridheader = '<?php echo $gridheader; ?>';
	var attachHeader = '<?php echo $attachheader; ?>';
	var width = '<?php echo $width; ?>';
	var colalign = '<?php echo $colalign; ?>';
	var coltypes = '<?php echo $coltypes; ?>';
	var sorting = '<?php echo $sorting ?>';
	var hiddencount = '<?php echo $hiddencount; ?>';
	var hiddenarray = '<?php echo json_encode($hiddenarray); ?>';
	var paginglimit = '<?php echo $paginglimit; ?>';
	var showpageno = '<?php echo $showpageno; ?>';
	var title = '<?php echo $title; ?>';
	var editwidth = '<?php echo $editwidth; ?>';
	var editheight = '<?php echo $editheight; ?>';

	
	mygrid = new dhtmlXGridObject('mygrid_container');
	mygrid.setImagePath("<?php echo base_url('dhtmlx/imgs');?>/");
	mygrid.setHeader(gridheader);
	mygrid.attachHeader(attachHeader);
	mygrid.setInitWidths(width);
	mygrid.setSkin("dhx_blue");
	mygrid.enableAutoHeight(true);
	mygrid.enableMultiline(false); 
	mygrid.enableRowsHover(true,'grid_hover');
	mygrid.setColAlign(colalign);
	mygrid.setColTypes(coltypes);
	mygrid.setColSorting(sorting);
	mygrid.setStyle("font-weight:bold;", "border-right:solid 1px #DCDFE0;", "","color:#23238E;", "");
	for (var i = 0 ; i < (hiddencount -(-(hiddencount-1)) - (-2)); i++) {
		mygrid.setColumnHidden(hiddenarray[i],true);	
	};	
	mygrid.attachEvent("onXLS",function(){document.getElementById("UIBlocker").style.display="block";});
	mygrid.attachEvent("onXLE",function(){
		document.getElementById("UIBlocker").style.display="none";	
	});
	mygrid.init();
	mygrid.enableAutoHeight(true);
	mygrid.loadXML("<?php echo base_url($loadxml);?>");
	mygrid.enablePaging(true,paginglimit,showpageno, "pagingArea", true, "infoArea");
	mygrid.setPagingSkin("bricks");

	myDataProcessor = new dataProcessor("<?php echo base_url($loadxml);?>");
	myDataProcessor.enableUTFencoding(true);
	myDataProcessor.attachEvent("onAfterUpdate",function(sid,action,tid,xml_node)
    {
		alert(xml_node);
		if(action=="updated"){
		
			dhtmlx.message({id:1,text:'Updated Successfully !',lifetime:1000,type:"success"});
		}
	});
	
	myDataProcessor.init(mygrid); 
	var toolbar = new dhtmlXToolbarObject("toolbarObj");
	toolbar.setSkin("dhx_skyblue");
	toolbar.setIconsPath("<?php echo base_url('images/contextmenu');?>/"); 
	toolbar.loadXML("<?php echo base_url($toolbarxml);?>");	
	toolbar.attachEvent("onclick",function(id){ 
	        if (id=="add") addoffice();   		
			if(id=="edit") edit();
			if(id=="delete") deletes();	
			if (id=="permisson") permission();	
			if (id=="list") listuser();	
		});

   function addoffice(){
  
   	dhxWin= new dhtmlXWindows();
   	dhxWin.setImagePath("<?php echo base_url("dhtmlx/imgs");?>/");
   	wins=dhxWin.createWindow("addoffice",0,0,800,400);
   	dhxWin.window("addoffice").center();
   	wins.setText("ADD "+title);
   	dhxWin.setSkin('dhx_web');
   	dhxWin.window("addoffice").centerOnScreen();
   	dhxWin.window("addoffice").progressOn();
   	dhxWin.attachEvent("onContentLoaded",function(win){
    dhxWin.window("addoffice").setModal(true);
    dhxWin.enableAutoViewport(true);
    dhxWin.window("addoffice").keepInViewport(true);
    dhxWin.window("addoffice").stick();
    dhxWin.window("addoffice").progressOff;
   	});
   	wins.attachURL("<?php echo base_url($attachURLForAdd); ?>");
   	wins.attachEvent("onClose", refreshgrid);
   }

	function edit(){
		var rowId=mygrid.getSelectedRowId();
	if(rowId==null)
    {
        dhtmlx.message({id:1,text:'Please select a row.',lifetime:500,type:"error"});return false;}

			 dhxWin= new dhtmlXWindows();
             dhxWin.setImagePath("<?php echo base_url("dhtmlx/imgs");?>/");
             wins = dhxWin.createWindow("edit_content", 0, 0, editwidth, editheight);
             dhxWin.window("edit_content").center();
             wins.setText("EDIT "+title);
             dhxWin.setSkin('dhx_web');
			 dhxWin.window("edit_content").centerOnScreen();
	 		 dhxWin.window("edit_content").progressOn();
	 		 dhxWin.attachEvent("onContentLoaded", function(win){
			 dhxWin.window("edit_content").setModal(true);
			 dhxWin.enableAutoViewport(true);
			 dhxWin.window("edit_content").keepInViewport(true);
			 dhxWin.window("edit_content").stick();
			 dhxWin.window("edit_content").progressOff();
    		});
            wins.attachURL("<?php echo base_url($attachURLForEdit);?>/"+rowId);
            wins.attachEvent("onClose",refreshgrid);
	}
	function listuser(){
		dhxWin= new dhtmlXWindows();
		dhxWin.setImagePath("<?php echo base_url("dhtmlx/imgs") ;?>/");
		wins=dhxWin.createWindow("list_content",0,0,1000,600);
        dhxWin.window("list_content").center();
		wins.setText("All "+title);
		dhxWin.setSkin('dhx_web');
		dhxWin.window("list_content").centerOnScreen();
		dhxWin.window("list_content").progressOn();
		dhxWin.attachEvent("onContentLoaded",function(win){
			dhxWin.window("list_content").setModal(true);
			dhxWin.enableAutoViewport(true);
			dhxWin.window("list_content").keepInViewport(true);
			dhxWin.window("list_content").stick();
			dhxWin.window("list_content").progressOff();
		});
	  wins.attachURL("<?php echo base_url($attachURlForList); ?>");
		wins.attachEvent("onClose",refreshgrid);
	}

	function deletes()
{
	var rowId=mygrid.getSelectedRowId();
    
	if(rowId==null){dhtmlx.message({id:1,text:'Please select a row to delete.',lifetime:5000,type:"error"});return false;}
	dhtmlx.confirm("Are you sure you want to delete?",function(result){
		if(result==true){
			dhtmlxAjax.get("<?php echo base_url($attachURLForDelete);?>/"+rowId,function(loader){
				var deleteaddressbook=loader.xmlDoc.responseText;
				if(deleteaddressbook==1){
					dhtmlx.message({id:1,text:'Data Deleted Successfully.',lifetime:5000,type:"success"});
					mygrid.clearAndLoad("<?php echo base_url($loadxml); ?>");
					return true;
				}else{
					dhtmlx.message({id:1,text:'Error in Deleting Data.',lifetime:5000,type:"error"});
					return true;
				}
			});
		}
	});
}

function refreshgrid(){
	 dhxWin.unload();
	 mygrid.clearAndLoad("<?php echo base_url($loadxml);?>");
	
}	

</script>