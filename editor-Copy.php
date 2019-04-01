<?php $root = $_SERVER['DOCUMENT_ROOT']."/"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editor | NoMoreCode</title>

    <?php include($root."assets/shared/css.html") ?>

    <?php include($root."assets/shared/scripts.html"); ?>
    
    <style>
    .lyrow {
        margin-bottom: 10px;
    }
    </style>
</head>

<body class="edit" ng-app="">
    <div class="navbar navbar-inverse navbar-fixed-top navbar-htmleditor" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
        <div class="navbar-header">
            <button data-target="navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="glyphicon-bar"></span> <span class="glyphicon-bar"></span> <span class="glyphicon-bar"></span> </button> <a class="navbar-brand" href="javascript:;"><i class="fa fa-puzzle-piece "></i> NoMoreCode</a> 
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav" id="menu-htmleditor">
                <li>Zoom
                    <button class="btn btn-primary">
                        <input type="range" class="form-control-range" id="zoomLevel" min="50" val="77" max="100">
                    </button>
                    <div class="btn-group btn-group-sm" role="group">
                        <form method="post" id="importZipForm" enctype="multipart/form-data" action="">
                            <input type="file" class="hidden" name="importZipInput" id="importZipInput" />
                        </form>
                        <button type="button" data-toggle="tooltip" title="Undo" class="btn upperIcon imageManagerBtn">
                            <i class="fa fa-image "></i> <!-- undo -->
                        </button>
                        <button type="button" data-toggle="tooltip" title="Save Current Build" class="btn upperIcon saveCurrentBuild" >
                            <i class="fa fa-file "></i> <!-- undo -->
                        </button>
                        <button type="button" data-toggle="tooltip" title="Undo" class="btn upperIcon undoFunctionBtn" disabled="true">
                            <i class="fa fa-chevron-left "></i> <!-- undo -->
                        </button>
                        <button type="button" data-toggle="tooltip" title="Redo" class="btn upperIcon redoFunctionBtn" disabled="true">
                            <i class="fa fa-chevron-right "></i> <!-- redo -->
                        </button>
                        <button type="button" data-toggle="tooltip" title="Clear Page" class="btn upperIcon clearLocalStorageBtn">
                            <i class="fa fa-eraser "></i> <!-- Clear -->
                        </button>
                        <button type="button" id="importFromZip" data-toggle="tooltip" title="Upload" class="btn upperIcon">
                            <i class="fa fa-upload"></i> <!-- Import -->
                        </button>
                        <button type="button" id="save" data-toggle="tooltip" title="Download" class="btn upperIcon">
                            <i class="fa fa-download"></i><!-- Export -->
                        </button>
                        <button type="button" id="sourcepreview" data-toggle="tooltip" title="Preiview" class="btn upperIcon" >
                            <i class="fa fa-eye"></i> <!-- Preview -->
                        </button>
                        <button type="button" onclick="location.reload();" data-toggle="tooltip" title="Refresh" class="btn upperIcon" >
                            <i class="fa fa-refresh"></i>
                        </button>
                        <button type="button" data-toggle="modal" data-target="#shortcutsInfo" class="btn upperIcon" >
                            <i class="fa fa-info" data-toggle="tooltip" title="Info"></i>
                        </button>
                        <button type="button" data-toggle="modal" data-target="#pdfToPng" class="btn upperIcon" >
                            <i class="fa fa-file" data-toggle="tooltip" title="Pdf"></i>
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="">
                <div class="sidebar-nav" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
                <div id="gridRowProcessing" style="display: none"></div>

                    <ul class="nav nav-list">
                        <li class="nav-header"><i class="fa fa-html5"></i>&nbsp; Html Elements </li>
                        <li class="boxes" id="elmBase">
                            <div class="box box-element previewImg" data-type="image"> 
                                <a href="#close" class="remove btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a> 
                                <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-move"></i></a> 
                                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy Img to TD">
                                    <i class="glyphicon glyphicon-copy"></i>
                                </a> 
                    
                                <div class="preview"> <i class="fa fa-picture-o fa-2x"></i>
                                    <div class="element-desc">Image</div>
                                </div>
                                <div class="view"> <img src="http://placehold.it/50x50" class="img-responsive images" alt="" width="50" height="50"/> </div>
                            </div>
                        </li>
                    </ul>

                    <ul class="nav nav-list ">
                        <li class="nav-header"> <i class="fa fa fa-th"> </i>&nbsp; Grid System <i id="refreshGrid" data-toggle="tooltip" title="Refresh Grids" class="fa fa-refresh pull-right" data-toggle="tooltip" title="Load Snippets"></i></li>
                        <li class="rows gridSystemElements" id="estRows">
                            <div class="lyrow firstGridRow">
                                <a href="#close" class="remove btn btn-danger btn-xs"><i class="glyphicon-remove glyphicon"></i></a>
                                <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag"><i class="glyphicon glyphicon-move"></i></a>
                                <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element"><i class="glyphicon glyphicon-copy"></i></a>

                                <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After"><i class="fa fa-angle-double-down"></i></a>

                                <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout"><i class="glyphicon glyphicon-plus"></i></a>
                                <a href="#" class="btn btn-info btn-xs clone"><i class="fa fa-clone"></i></a>
                                <a href="#" class="btn btn-info btn-xs addSnippet"><i class="fa fa-database"></i></a>
                        
                                <div class="preview">
                                    <input id="gridInput" type="text" value="" class="form-control">
                                </div>
                                <div class="view">
                                    <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
                                        <tr>
                                            <td class="column" valign="top" width="5" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                            <td class="column" valign="top" width="590" style="font-family:Arial, Helvetica, sans-serif;  color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                            <td class="column" valign="top" width="5" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="htmlpage" id="htmlpage" style="overflow:  auto;">
            </div>
            
            <div>
            </div>

            <div class="">
                <div class="sidebar-nav-2" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>

                <div id="myTabContent" class="tab-content">
                    <a id="savedURL" style="display: none;" download="index.html" class="btn btn-warning float-right"><i class="fa fa-save"></i>&nbsp;download</a>

                    <label class="header cssHeader" data-header="content_header" for="header_content_header">
                        <i class="fa fa-file-pdf-o"></i> &nbsp;<span>PDf Content </span>
                    </label>
                    <input class="header_check" type="checkbox" checked="true" id="header_content_header">
                    <div class="section" data-section="content_header">
                        <div class="form-group col-sm-12 d-inline-block" id="" data-key="font-family">
                        <textarea id="contentFromPDF" readonly="" style="width:100%;max-width: 100%;min-width: 100%;"></textarea>
                        </div>
                    </div>

                    <label class="header cssHeader" data-header="css_header" for="header_css_header">
                        <i class="fa fa-paint-brush"></i> &nbsp;<span>Content Styles</span>
                    </label>
                    <input class="header_check" type="checkbox" checked="true" id="header_css_header">
                    <div class="section" data-section="css_header">
                        <div class="form-group col-sm-12 d-inline-block " data-key="font-family">
                            <label class=" control-label" for="input-model">Font family</label>
                            <div class=" input">
                                <div>
                                    <div>
                                        <input name="fontFamily" type="text" value="" class="form-control input_field_j" id="font_family" placeholder="Seperate each font name by comma(,)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-sm-6 d-inline-block ml5" data-key="color">
                            <label class=" control-label" for="input-model">Text Color</label>
                            <div class=" input">
                                <div>
                                    <input name="color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j" id="text_color" placeholder="Ex: #ffffff"> 
                                    <div style="display: none; color: red;" id="colorError"><p>Invalid Hex Code</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 d-inline-block mr5" data-key="text-align">
                            <label class=" control-label" for="input-model">Text align</label>
                            <div class="input">
                                <div id="text_align">
                                    <select class="form-control input_field_j allInputs_j custom-select">
                                        <option value="none">None</option>
                                        <option value="left">Left</option>
                                        <option value="center">Center</option>
                                        <option value="right">Right</option>
                                        <option value="justify">Justify</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 d-inline-block ml5" data-key="font-size">
                            <label class=" control-label" for="input-model">Font Size</label>
                            <div class=" input">
                                <div class="input-group" id="cssunit-line-height">
                                    <input name="number" type="number" id="font_size" value="left" class="form-control input_field_j allInputs_j" placeholder="Ex: 17">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 d-inline-block mr5" data-key="line-height">
                            <label class=" control-label" for="input-model">Line height</label>
                            <div class=" input">
                                <div class="input-group" id="cssunit-line-height">
                                    <input name="number" type="number" id="line_height" value="left" class="form-control input_field_j allInputs_j" placeholder="Ex: 20">
                                </div>
                            </div>
                        </div>

                    </div>

                    <label class="header cssTDHeader" data-header="cssTD_header" for="header_cssTD_header">
                        <i class="fa fa-columns"></i> &nbsp;<span>TD Styles</span>
                    </label>
                    <input class="header_check" type="checkbox" checked="true" id="header_cssTD_header">
                    <div class="section" data-section="cssTD_header">
                        <div class="form-group col-md-6 col-sm-6 d-inline-block ml5" data-key="width">
                            <label class=" control-label" for="input-model">Width</label>
                            <div class="input">
                                <div class="input-group" id="cssunit-width">
                                    <input name="number" id="table_width" type="number" value="solid" class="form-control input_field_j allInputs_j" placeholder="Ex: 590">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-6 d-inline-block mr5" data-key="height">
                            <label class=" control-label" for="input-model">Height</label>
                            <div class=" input">
                                <div class="input-group" id="cssunit-height">
                                    <input name="number" id="table_height" type="number" class="form-control input_field_j allInputs_j" placeholder="Ex: 10">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label class=" control-label">Padding</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class=" input">
                                    <div class="input-group" id="cssunit-padding-top">
                                        <input name="number" type="number" value="" id="p_top" class="form-control input_field_j allInputs_j text-center" placeholder="Top">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class=" input">
                                    <div class="input-group" id="cssunit-padding-left">
                                        <input name="number" type="number" value="" id="p_left" class="form-control input_field_j allInputs_j text-center" placeholder="Left">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class=" input">
                                    <div class="input-group" id="cssunit-padding-right">
                                        <input name="number" type="number" value="" id="p_right" class="form-control input_field_j allInputs_j text-center" placeholder="Right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class=" input">
                                    <div class="input-group" id="cssunit-padding-bottom">
                                        <input name="number" type="number" value="" id="p_bottom" class="form-control input_field_j allInputs_j text-center" placeholder="Bottom">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group  col-md-6 col-sm-6 d-inline-block ml5" data-key="padding-right">
                            <label class=" control-label" for="input-model">P Right</label>
                            <div class=" input">
                                <div class="input-group" id="cssunit-padding-right">
                                    <input name="number" type="number" value="" id="p_right" class="form-control input_field_j allInputs_j" placeholder="Ex: 10">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-sm-6 d-inline-block mr5" data-key="padding-Left">
                            <label class=" control-label" for="input-model">P Left</label>
                            <div class=" input">
                                <div class="input-group" id="cssunit-padding-Left">
                                    <input name="number" type="number" id="p_left" value="0px" class="form-control input_field_j allInputs_j" placeholder="Ex: 10">
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group  col-md-6 col-sm-6 d-inline-block ml5" data-key="td-bg-color">
                            <label class=" control-label" for="input-model">TD BG Color</label>
                            <div class=" input">
                                <div>
                                    <input name="td-bg-color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j" id="td_bg_color" placeholder="Ex: #007bff">
                                    <div style="display: none; color: red;" id="tdBGColorError"><p>Please input valid Hex Code</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-sm-6 d-inline-block mr5" data-key="border-style">
                            <label class=" control-label" for="input-model">B Style</label>
                            <div class="input">
                                <div id="b_style">
                                    <select class="form-control input_field_j allInputs_j custom-select">
                                        <option value="none">None</option>
                                        <option value="solid">Solid</option>
                                        <option value="dotted">Dotted</option>
                                        <option value="dashed">Dashed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-sm-6 d-inline-block ml5" data-key="border-width">
                            <label class=" control-label" for="input-model">Border Width</label>
                            <div class=" input">
                                <div class="input-group" id="cssunit-border-width">
                                    <input name="number" id="b_width" type="number" value="" class="form-control input_field_j allInputs_j" placeholder="Ex: 1">
                                </div>
                            </div>
                        </div>

                        <div class="form-group  col-md-6 col-sm-6 d-inline-block mr5" data-key="border-color">
                            <label class=" control-label" for="input-model">Border Color</label>
                            <div class=" input">
                                <div>
                                    <input name="border-color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j" id="border_color" placeholder="Ex: #007bff">
                                    <div style="display: none; color: red;" id="BorderColorError"><p>Please input valid Hex Code</p></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group  col-md-6 d-inline-block mr5" data-key="border-style">
                            <label class=" control-label" for="input-model">TD valign</label>
                            <div class="input">
                                <div id="td_valign">
                                    <select class="form-control input_field_j allInputs_j custom-select">
                                        <option value="none">None</option>
                                        <option value="top">Top</option>
                                        <option value="bottom">Bottom</option>
                                        <option value="middle">Middle</option>
                                        <option value="baseline">Baseline</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <label class="header" data-header="tablecss_header" for="header_tablecss_header">
                        <i class="fa fa-table"></i> &nbsp;<span>Table Styles</span>
                    </label>
                    <input class="header_check" type="checkbox" checked="true" id="header_tablecss_header">
                    <div class="section" data-section="tablecss_header">
                        <div class="form-group  col-sm-6 d-inline-block" data-key="bg-color">
                            <label class=" control-label" for="input-model">Table BG Color</label>
                            <div class=" input">
                                <div>
                                    <input name="bg-color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j" id="table_bg_color" placeholder="Ex: #007bff">
                                    <div style="display: none; color: red;" id="tableBGColorError"><p>Please input valid Hex Code</p></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  col-md-6  d-inline-block" data-key="border-style">
                            <label class=" control-label" for="input-model">Table Align</label>
                            <div class="input">
                                <div id="table_align">
                                    <select class="form-control input_field_j allInputs_j custom-select">
                                        <option value="none">None</option>
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                                        <option value="center">Center</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>
                </div>
                </div>
            </div>

        </div>


        <div id="image_modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Manage Images</h4>
                    </div>
                    <div class="modal-body">
                       <!--  <label class="header" data-header="image_header" for="header_image_header">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp; <span>Image</span>
                        </label> -->
                        <input class="header_check" type="checkbox" checked="true" id="header_image_header">
                        <div class="section imageHedaer" data-section="image_header">
                            <div class="row" id="imagePaddingBoxModel"> 
                                <div class="col-md-6 ">
                                    <div class="row" >
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="text" name="" value="" id="imageTopPadding" placeholder="Padding Top" class="input_field_j allInputs_j form-control placeholderMiddle" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="text" name="" value="" id="imageLeftPadding" placeholder="Left" class="input_field_j allInputs_j form-control" />
                                        </div>    
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" name="" value="" id="imageWidth" placeholder="Width" class="input_field_j allInputs_j form-control" />
                                                </div>
                                                <div class="col-md-2 cal" >*</div>
                                                <div class="col-md-5">
                                                    <input type="text" name="" value="" id="imageHeight" placeholder="height" class="input_field_j allInputs_j form-control" />
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="col-md-2">
                                            <input type="text" name="" value="" id="imageRightPadding" placeholder="Right" class="input_field_j allInputs_j form-control" />
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3">
                                            <input type="text" name="" value="" id="imageBottomPadding" placeholder="Padding Bottom" class="input_field_j allInputs_j form-control placeholderMiddle" />
                                        </div>
                                        <div>
                                            <input type="text" name="alt" value="" id="imageAlt" placeholder="Alt" class="input_field_j allInputs_j form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-2">
                                    <!-- <img src="#" id="selected-thumbnail" /> -->
                                    <form method="post" id="uploadForm" enctype="multipart/form-data" action="processreq/upload.php">
                                        <input type="file" name="images[]" id="images" multiple >
                                        <br>
                                        <br>
                                        <div class="btn-group btn-group-sm" role="group" >
                                            <input type="submit" name="submit" value="UPLOAD" class="btn btn-default" />
                                            <a href="javascript:;" class="btn btn-default showImagesAjaxBtn" ><i class="fa fa-refresh"> Refresh</i></a>
                                            <a href="javascript:;" class="btn btn-default" id="confirmDeleteImages"><i class="fa fa-trash"> Delete</i></a>
                                        </div>
                                    </form>
                                    <!-- display upload status -->
                                    <div id="uploadStatus"></div>
                                </div>    
                            </div>
                        </div>

                        <div class="form-group" style="padding: 0px 17px">
                            <hr>
                            <div class="row">
                                <div class="gallery" id="imagesPreview"></div>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="mySidenav" class="sidenav">
            <div class="">
            
            </div>
        </div>

        <div id="download-layout">
            <div class="container"></div>
        </div>

        <div ng-include="'components/modals.html'"></div>

        <div ng-include="'components/contextMenu.html'"></div>
    
        <pre id="asciiReplace" class="hidden"></pre>

        <!-- dont delete this used for internal processing -->
        <div id="cloneResolver" class="hidden"></div>
        <!-- dont delete this used for internal processing -->

</body>

</html>