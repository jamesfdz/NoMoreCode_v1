<?php $root = $_SERVER['DOCUMENT_ROOT']."/"; 
    
    $projectId = $_GET["_projectId"];
    $projectName = $_GET["_projectName"];
    $projectType = $_GET["_projectType"];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editor | NoMoreCode</title>
        <?php require_once($root."assets/shared/css.html") ?>
        <?php require_once($root."assets/shared/scripts.html"); ?>
    </head>
    <body id="editor" class="edit" ng-app="">
        <div class="navbar navbar-inverse navbar-fixed-top navbar-htmleditor" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
            <div class="navbar-header">
                <a class="navbar-brand" href="javascript:;"><i class="fa fa-chevron-right "></i> <span class="c1">N</span><span class="c2">M</span><span class="c3">C</span></a> 
            </div>
            <div class="navbar-collapse">
                <ul class="nav" id="menu-htmleditor">
                    <?php
                        if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
                    ?>
                            <li><button type="button" data-toggle="tooltip" title="Desktop" class="btn upperIcon" id="desktop_view">
                                <i class="fa fa-desktop"></i></button></li>
                            <li><button type="button" data-toggle="tooltip" title="Mobile" class="btn upperIcon" id="mobile_view">
                                        <i class="fa fa-mobile "></i></button></li>
                    <?php
                        }
                    ?>
                    
                    <li>
                        Zoom
                        <button class="slider-button">
                        <input type="range" class="form-control-range" id="zoomLevel" min="50" value="100" max="100">
                        </button>
                        <div class="btn-group btn-group-sm" role="group">
                            <form method="post" id="importZipForm" enctype="multipart/form-data" action="">
                                <input type="file" class="hidden" name="importZipInput" id="importZipInput" />
                            </form>
                            <button type="button" data-toggle="tooltip" title="Outline" class="btn upperIcon outlineElment activeButtonNav">
                                <i class="fa fa-square-o "></i> <!-- undo -->
                            </button>
                            <!-- <button type="button" data-toggle="tooltip" title="Image Manager" class="btn upperIcon imageManagerBtn">
                                <i class="fa fa-image "></i> 
                            </button> -->
                            <button type="button" data-toggle="tooltip" title="Save Current Build" class="btn upperIcon saveCurrentBuild" >
                                <i class="fa fa-file "></i> <!-- undo -->
                            </button>
                            <button type="button" data-toggle="tooltip" title="Undo" class="btn upperIcon undoFunctionBtn">
                                <i class="fa fa-chevron-left "></i> <!-- undo -->
                            </button>
                            <button type="button" data-toggle="tooltip" title="Redo" class="btn upperIcon redoFunctionBtn">
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
                            <button type="button" data-toggle="tooltip" title="Refresh" class="btn upperIcon refreshPage" >
                            <i class="fa fa-refresh"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#shortcutsInfo" class="btn upperIcon" >
                            <i class="fa fa-info" data-toggle="tooltip" title="Info"></i>
                            </button>
                            <!-- <button type="button" data-toggle="modal" data-target="#pdfToPng" class="btn upperIcon" >
                            <i class="fa fa-file" data-toggle="tooltip" title="Pdf Upload For Mopix"></i>
                            </button> -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div id="mainBody">
        <div class="sidebar-nav" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
        <div id="gridRowProcessing" style="display: none"></div>
        <ul class="nav nav-list ">
            <li class="nav-header"> <i class="fa fa fa-th"> </i>&nbsp; Grid System <i id="refreshGrid" data-toggle="tooltip" title="Refresh Grids" class="fa fa-refresh pull-right" data-toggle="tooltip" title="Load Snippets"></i></li>
            <div class="jtabs">
                <ul>
                    <li><a href="#tabs-1">Pixels</a></li>
                    <?php
                        if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
                    ?>
                    <li><a href="#tabs-2">Responsive</a></li>
                    <?php
                        }
                    ?>
                </ul>
                <div id="tabs-1">
                    <li class="rows gridSystemElements" id="estRows">
                        <div class="lyrow firstGridRow">
                            <a href="#close" class="remove btn btn-danger btn-xs"><i class="fa-remove fa"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag"><i class="fa fa-arrows-alt"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element"><i class="fa fa-copy"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After"><i class="fa fa-angle-double-down"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout"><i class="fa fa-plus"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone"><i class="fa fa-clone"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet"><i class="fa fa-database"></i></a>
                            <div class="preview">
                                <div class="row">
                                    <div class="col-md-8 gridInputColPadding">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding">
                                        <p id="gridInputCount">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
                                    <tr>
                                        <td class="column" valign="top" width="600" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </li>
                </div>
                <?php
                    if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
                ?>
                <div id="tabs-2" class="text-center">
                    <li class="rows gridSystemElements" id="estRows">
                        <div class="lyrow firstGridRow">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element"><i class="fa fa-copy"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After"><i class="fa fa-angle-double-down"></i></a>
                            <div class="preview">
                                <div class="row">
                                    <div class="col-md-8 gridInputColPadding">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
                                    <tr>
                                        <td class="column" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </li>
                </div>
                <?php
                    }
                ?>
            </div>
        </ul>
        <ul class="nav nav-list">
            <li class="nav-header"><i class="fa fa-html5"></i>&nbsp; Html Elements </li>
            <li class="boxes" id="elmBase">
                <div class="box box-element previewImg" data-type="image">
                    <a href="#close" class="remove btn btn-danger btn-xs"><i class="fa fa-remove"></i></a> 
                    <a class="drag btn btn-default btn-xs"><i class="fa fa-arrows-alt"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy Img to TD">
                    <i class="fa fa-copy"></i>
                    </a> 
                    <div class="preview">
                        <i class="fa fa-picture-o fa-2x"></i>
                        <div class="element-desc">Image</div>
                    </div>
                    <div class="view"> <img src="http://placehold.it/50x50" class="img-responsive images" alt="" width="50" height="50"/> </div>
                </div>
            </li>
        </ul>
        <ul class="nav nav-list" id="snippetsList">
            <li class="nav-header"><i class="fa fa-html5"></i>&nbsp; Snippets </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy Greetings to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/greetingsSalutation.PNG"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Greetings Salutation</div>
                    </div>
                </div>
                <div class="view">
                    <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                        <tr>
                            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                            <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858; font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-fs="17px" data-lh="20px" >{{customText[Hi | | Hello | Dear | Hey | Aloha | Good Morning | Good Afternoon | Hola]}} {{customText[Dr. | | Doctor | Miss | Mr. | Mrs. | Ms. | Sir | Admiral | Brigadier General | Captain | Commander | Colonel | Corporal | General | Lieutenant | Lieutenant Commander | Lieutenant Colonel | Lieutenant General | Major | Major General | Rear Admiral | Sergeant]}} {{customText(30|Insert first or last name)}},</td>
                            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="lyrow firstGridRow ui-draggable">
                    <div class="view">
                        <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                            <tr>
                                <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy Closing Salutation to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/closingSalutation.PNG"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Closing Salutation</div>
                    </div>
                </div>
                <div class="view">
                    <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                        <tr>
                            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" >&nbsp;</td>
                            <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858; font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-fs="17px" data-lh="20px">{{customText[Regards| Warm regards| Mahalo| Best| My best| Talk to you soon| See you soon| Thanks| Gracias]}},</td>
                            <td class="column" width="5" valign="top"  style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" >&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="lyrow firstGridRow ui-draggable">
                    <div class="view">
                        <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                            <tr>
                                <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy Name & Number to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/nameNumberSalutation.PNG"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Name & Number Salutation</div>
                    </div>
                </div>
                <div class="view">
                    <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                        <tr>
                            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                            <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858; font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-fs="17px" data-lh="20px">{{customText(30|Enter your name, no title)}}</td>
                            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"> &nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="lyrow firstGridRow ui-draggable">
                    <div class="view">
                        <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                            <tr>
                                <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                                <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858; font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-fs="17px" data-lh="20px">{{User.Phone}}</td>
                                <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="lyrow firstGridRow ui-draggable">
                    <div class="view">
                        <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                            <tr>
                                <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy Image with button to Canvas">
                    <i class="fa fa-copy"></i>
                    </a>
                    <div class="preview">
                        <div id="opening-sal-image">
                            <img src="img/imageWithButton.PNG"  class="img-responsive images SnippetsImg" border="none" />
                            <div class="element-desc snippetsMarginTop">Image with button</div>
                        </div>
                    </div>
                    <div class="view">
                        <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                            <tr>
                                <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" >&nbsp;</td>
                                <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">
                                    <div class="lyrow firstGridRow ui-draggable">
                                        <div class="view" >
                                            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="590">
                                                <tr>
                                                    <td class="column" width="216" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                                                    <td class="column" width="158" valign="top" height="116" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="116">
                                                        <div class="box box-element previewImg" data-type="image">
                                                            <div class="view"> <img src="images/logo_new.gif" class="img-responsive images" alt="" width="158" height="116"> </div>
                                                        </div>
                                                    </td>
                                                    <td class="column" width="216" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" >&nbsp;</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" >&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                    <div class="lyrow firstGridRow ui-draggable">
                        <div class="view">
                            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                                <tr>
                                    <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                    <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                    <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="lyrow firstGridRow ui-draggable">
                        <div class="view">
                            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                                <tr>
                                    <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                                    <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">
                                        <div class="lyrow firstGridRow ui-draggable">
                                            <div class="view">
                                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="590">
                                                    <tr>
                                                        <td class="column" width="590" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: #585858;background-color:#0557a3;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" bgcolor="#0557a3"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="lyrow firstGridRow ui-draggable">
                                            <div class="view">
                                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="590">
                                                    <tr>
                                                        <td class="column" width="590" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; background-color: #0557a3; color: #ffffff; text-align: center; font-size: 17px; line-height: 20px;" data-color="#ffffff" data-ff="Arial, Helvetica, sans-serif" data-height="10" bgcolor="#0557a3" data-ta="center" data-fs="17px" data-lh="20px"><strong>Click here to arrange an appointment</strong></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="lyrow firstGridRow ui-draggable">
                                            <div class="view">
                                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="590">
                                                    <tr>
                                                        <td class="column" width="590" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: #585858; background-color:#0557a3;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" bgcolor="#0557a3"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="lyrow firstGridRow ui-draggable">
                        <div class="view">
                            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                                <tr>
                                    <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                    <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                    <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy footer to Canvas">
                    <i class="fa fa-copy"></i>
                    </a>
                    <div class="preview">
                        <div id="opening-sal-image"><img src="img/footer.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Footer</div>
                    </div>
                </div>
                <div class="view">
                    <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only;" width="600">
                    <tr id="1553008740470_470_7476217">
                    <td class="column" width="5" valign="top" height="2" style="font-family: Arial, Helvetica, sans-serif; color: #585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" ></td>
                    <td class="column" width="590" valign="top" height="2" style="font-family: Arial, Helvetica, sans-serif; color: #585858;background-color:#B8B8B8;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"  bgcolor="#B8B8B8"></td>
                    <td class="column" width="5" valign="top" height="2" style="font-family: Arial, Helvetica, sans-serif; color: #585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553008740470_470_4428811" ></td>
                    </tr>
                    </table>
                    <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
                    <tr>
                    <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                    <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                    <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
                    </tr>
                    </table>
                </div>
            <div class="lyrow firstGridRow ui-draggable">
            <div class="view">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
            <tr>
            <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
            <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
            <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable">
            <div class="view">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
            <tr id="1553015071855_855_6972321">
            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015071855_855_9362435" ></td>
            <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015071855_855_1603054" >
            <div class="lyrow firstGridRow ui-draggable" id="1553015081614_614_3530184">
            <div class="view" id="1553015081614_614_7753627">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="590">
            <tr id="1553015081614_614_2680044">
            <td class="column" width="160" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 22px; padding-top: 10px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015081614_614_8713121" data-fs="12px" data-lh="22px" >{{userPhoto}}</td>
            <td class="column" width="430" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015081614_614_4012216" >
            <div class="lyrow firstGridRow ui-draggable" id="1553015130239_239_2895401">
            <div class="view" id="1553015130240_240_6612697">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="430">
            <tr id="1553015130240_240_9757597">
            <td class="column" width="430" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 15px; padding-top: 10px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015130240_240_4685183" data-fs="15px" >   
            <strong id="1553015346166_166_8506348">{{userName}}</strong>
            </td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015130766_766_8992089">
            <div class="view" id="1553015130766_766_1003854">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="430">
            <tr id="1553015130766_766_6113897">
            <td class="column" width="430" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015130766_766_1591599" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015131237_237_1881533">
            <div class="view" id="1553015131237_237_5382099">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="430">
            <tr id="1553015131237_237_2299325">
            <td class="column" width="430" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015131237_237_8824507" data-fs="12px" ><em id="1553015378186_186_3517054">{{customText[Merck Customer Representative | Representing Merck, employed by inVentiv | Publicis Touchpoint Solutions Representative, providing services on behalf of Merck | Merck Customer Team Leader | Merck Account Executive | Merck Key Account Manager | Merck Solutions Consultant | Nurse Educator, employed by Rx Crossroads]}}</em></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015131750_750_8726982">
            <div class="view" id="1553015131750_750_8419458">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="430">
            <tr id="1553015131750_750_9857317">
            <td class="column" width="430" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015131750_750_5057537" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015132174_174_2384551">
            <div class="view" id="1553015132174_174_9488385">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="430">
            <tr id="1553015132174_174_1674623">
            <td class="column" width="48" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015132174_174_7172346" >
            <div class="box box-element previewImg" data-type="image" id="1553015160806_806_3112324">
            <div class="view" id="1553015160807_807_4121493"> <a id="1553015489458_458_7485382" href="mailto:{{userEmailAddress}}" target="none"><img src="images/mail_icon.png" class="img-responsive images" alt="" width="48" height="48" id="1553015160807_807_2485680"></a> </div>
            </div>
            <div class="box box-element previewImg" data-type="image" id="1553015161806_806_2757203">
            <div class="view" id="1553015161806_806_5989203"> <a id="1553015499217_217_2743734" href="tel://{{User.Phone}}" target="none"><img src="images/call_icon2.png" class="img-responsive images" alt="" width="48" height="48" id="1553015161806_806_5028488" style="padding-left: 6px;"></a> </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            </div>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            </div>
            </td>
            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015071855_855_6614231" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable">
            <div class="view">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
            <tr>
            <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
            <td class="column" width="590" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
            <td class="column" width="5" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10">&nbsp;</td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable">
            <div class="view">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600">
            <tr id="1553015581570_570_8636610">
            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015581570_570_1757762" ></td>
            <td class="column" width="590" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015581570_570_5408651" >
            <div class="lyrow firstGridRow ui-draggable" id="1553015616103_103_4612847">
            <div class="view" id="1553015616103_103_9221634">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="590">
            <tr id="1553015616104_104_2053589">
            <td class="column" width="484" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015616104_104_9227499" >
            <div class="lyrow firstGridRow ui-draggable" id="1553015638337_337_3838857">
            <div class="view" id="1553015638337_337_2852017">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015638337_337_9245204">
            <td class="column" width="484" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015638337_337_4475712" >
            <div class="lyrow firstGridRow ui-draggable" id="1553015655193_193_1346363">
            <div class="view" id="1553015655193_193_9842488">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015655193_193_2649998">
            <td class="column" width="484" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 9px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015655193_193_7108292" data-fs="9px" data-lh="14px" >Should you have any questions regarding the content of this message, please contact your Merck representative at the number listed above.</td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015656272_272_1915730">
            <div class="view" id="1553015656272_272_6366560">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015656272_272_3321488">
            <td class="column" width="484" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015656272_272_5190298" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015656761_761_905118">
            <div class="view" id="1553015656761_761_7939523">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015656761_761_3597251">
            <td class="column" width="484" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 9px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015656761_761_2929235" data-fs="9px" data-lh="14px" >You received this e&amp;#00045;mail because you requested information from either your Merck representative, you previously signed up to receive e&amp;#00045;mail communications from <strong id="1553016084114_114_9035390">Merck &amp;#00038; Co., Inc.,</strong> or you had provided your e&amp;#00045;mail consent to one of our trusted 3rd party vendors. If you no longer wish to receive e&amp;#00045;mail communications from your representatives, please <a id="1553015992337_337_9238326" href="{{unsubscribe_product_link}}" target="_blank" style="color: rgb(0, 58, 202); text-decoration: underline;">click here</a> to submit your request to opt&amp;#00045;out.</td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015657216_216_8696021">
            <div class="view" id="1553015657216_216_952930">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015657216_216_1228522">
            <td class="column" width="484" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015657216_216_9891743" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015657736_736_7989381">
            <div class="view" id="1553015657736_736_9247259">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015657736_736_1526043">
            <td class="column" width="484" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 9px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015657736_736_5327668" data-fs="9px" data-lh="14px" >Copyright &amp;#00169; 2019 Merck Sharp &amp;#00038; Dohme Corp., a subsidiary of <strong id="1553016071333_333_825765">Merck &amp;#00038; Co., Inc.</strong> All rights reserved.</td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015670272_272_3271875">
            <div class="view" id="1553015670272_272_6978466">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015670272_272_1603226">
            <td class="column" width="484" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015670272_272_9554875" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015670809_809_1815961">
            <div class="view" id="1553015670809_809_6264387">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015670809_809_4791652">
            <td class="column" width="484" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 9px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015670809_809_8540707" data-fs="9px" data-lh="14px" >Please read our <a id="1553016037288_288_1757503" href="http://www.merck.com/about/how-we-operate/privacy/internet-privacy-policy.html" target="_blank" style="color: rgb(0, 58, 202); text-decoration: underline;">Privacy Policy</a> to learn more about how Merck protects personal information about you.</td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015671272_272_898724">
            <div class="view" id="1553015671272_272_3190778">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015671272_272_3497860">
            <td class="column" width="484" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015671272_272_4020339" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015671721_721_1637627">
            <div class="view" id="1553015671721_721_8724581">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015671721_721_6237817">
            <td class="column" width="484" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 9px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015671721_721_8110662" data-fs="9px" data-lh="14px" >Merck Privacy Office, 351 N Sumneytown Pike, UG4B&amp;#00045;24, North Wales, PA 19454, USA</td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015672119_119_3312425">
            <div class="view" id="1553015672119_119_2378031">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015672119_119_9884034">
            <td class="column" width="484" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015672119_119_6536669" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015672541_541_6731339">
            <div class="view" id="1553015672542_542_4975220">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="484">
            <tr id="1553015672542_542_7749635">
            <td class="column" width="484" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 9px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015672542_542_5390766" data-fs="9px" data-lh="14px" >US&amp;#00045;STE&amp;#00045;00307 03/19</td>
            </tr>
            </table>
            </div>
            </div>
            </td>
            </tr>
            </table>
            </div>
            </div>
            </td>
            <td class="column" width="106" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015616104_104_8809883" >
            <div class="lyrow firstGridRow ui-draggable" id="1553015820890_890_2590329">
            <div class="view" id="1553015820891_891_8992006">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="106">
            <tr id="1553015820891_891_1019180">
            <td class="column" width="106" valign="top" height="70" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015820891_891_5772097" ></td>
            </tr>
            </table>
            </div>
            </div>
            <div class="lyrow firstGridRow ui-draggable" id="1553015821337_337_3075500">
            <div class="view" id="1553015821337_337_5911864">
            <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="106">
            <tr id="1553015821338_338_7634563">
            <td class="column" width="106" valign="top" height="170" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1553015821338_338_5018962" >
            <div class="box box-element previewImg" data-type="image" id="1553015882522_522_6186641">
            <div class="view" id="1553015882522_522_568506"> <img src="images/ves.gif" class="img-responsive images" alt="" width="106" height="170" id="1553015882522_522_2114283"> </div>
            </div>
            </td>
            </tr>
            </table>
            </div>
            </div>
            </td>
            </tr>
            </table>
            </div>
            </div>
            </td>
            <td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1553015581570_570_9949444" ></td>
            </tr>
            </table>
            </div>
            </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/hollowBullet.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Hollow Bullet</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557760594497_497_7854373">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557760594497_497_6878383"><i class="fa-remove fa" id="1557760594497_497_1222825"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557760594497_497_1136044"><i class="fa fa-arrows-alt" id="1557760594497_497_8844321"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-7" id="1557760594497_497_1814025"><i class="fa fa-copy" id="1557760594497_497_7328726"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557760594497_497_4386527"><i class="fa fa-angle-double-down" id="1557760594497_497_2203851"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557760594497_497_8417136"><i class="fa fa-plus" id="1557760594497_497_3025638"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557760594497_497_4143238"><i class="fa fa-clone" id="1557760594497_497_6089096"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557760594497_497_6255579"><i class="fa fa-database" id="1557760594497_497_6045884"></i></a>
                            <div class="preview" id="1557760594497_497_6287698">
                                <div class="row" id="1557760594498_498_9604054">
                                    <div class="col-md-8 gridInputColPadding" id="1557760594498_498_4513099">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557760594498_498_5685653">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557760594498_498_4475270">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557760594498_498_4270917"><tr id="1557760594498_498_5610720"><td class="column" width="502" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557760594498_498_9765361">
                        <div class="lyrow firstGridRow ui-draggable" id="1557760648528_528_9326514">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557760648528_528_3448220"><i class="fa-remove fa" id="1557760648528_528_3067630"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557760648528_528_9355994"><i class="fa fa-arrows-alt" id="1557760648528_528_9892958"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-31" id="1557760648529_529_8381496"><i class="fa fa-copy" id="1557760648529_529_4491553"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557760648529_529_8498026"><i class="fa fa-angle-double-down" id="1557760648529_529_5658472"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557760648529_529_7937331"><i class="fa fa-plus" id="1557760648529_529_5883328"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557760648529_529_4795893"><i class="fa fa-clone" id="1557760648529_529_6311361"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557760648529_529_777350"><i class="fa fa-database" id="1557760648529_529_495469"></i></a>
                            <div class="preview" id="1557760648529_529_5097081">
                                <div class="row" id="1557760648529_529_8447332">
                                    <div class="col-md-8 gridInputColPadding" id="1557760648529_529_9144374">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557760648529_529_185490">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557760648529_529_5711027">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557760648529_529_1456862"><tr id="1557760648529_529_1963082"><td class="column" width="22" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557760648529_529_6815876">&nbsp;</td><td class="column" width="6" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 22px; text-align: center;color:#5a3f99;" data-color="#5a3f99" data-ff="Arial, Helvetica, sans-serif" id="1557760648529_529_5576642" data-fs="16px" data-lh="22px" data-ta="center"><strong id="1557760767181_181_5005648"></strong><strong id="1557760850252_252_6601361">&amp;#08226;</strong>  </td><td class="column" width="7" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557760648529_529_8906303">&nbsp;</td><td class="column" width="467" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 22px;color:#000000;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557760648530_530_5405890" data-fs="16px" data-lh="22px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557760938315_315_9046596">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557760938315_315_5695640"><i class="fa-remove fa" id="1557760938315_315_8270230"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557760938315_315_8428528"><i class="fa fa-arrows-alt" id="1557760938315_315_2329888"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557760938315_315_8317668"><i class="fa fa-copy" id="1557760938315_315_8032771"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-71" id="1557760938315_315_392198"><i class="fa fa-angle-double-down" id="1557760938315_315_9415252"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557760938315_315_1542123"><i class="fa fa-plus" id="1557760938315_315_189911"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557760938315_315_1476189"><i class="fa fa-clone" id="1557760938316_316_1503559"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557760938316_316_800235"><i class="fa fa-database" id="1557760938316_316_9711408"></i></a>
                            <div class="preview" id="1557760938316_316_9477572">
                                <div class="row" id="1557760938316_316_9810007">
                                    <div class="col-md-8 gridInputColPadding" id="1557760938316_316_3419834">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557760938316_316_2501241">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557760938316_316_884246">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557760938316_316_6925003"><tr id="1557760938316_316_1372876"><td class="column" width="502" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 10px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557760938316_316_7966151" data-lh="10px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557760608301_301_2195285">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557760608301_301_274887"><i class="fa-remove fa" id="1557760608302_302_6219353"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557760608302_302_1141139"><i class="fa fa-arrows-alt" id="1557760608302_302_6038162"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557760608302_302_4019798"><i class="fa fa-copy" id="1557760608302_302_5513780"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557760608302_302_6953339"><i class="fa fa-angle-double-down" id="1557760608302_302_7533405"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557760608302_302_8427855"><i class="fa fa-plus" id="1557760608302_302_202336"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557760608302_302_5515167"><i class="fa fa-clone" id="1557760608302_302_7941457"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557760608302_302_8555650"><i class="fa fa-database" id="1557760608302_302_9799663"></i></a>
                            <div class="preview" id="1557760608302_302_5730282">
                                <div class="row" id="1557760608302_302_2720377">
                                    <div class="col-md-8 gridInputColPadding" id="1557760608302_302_5811441">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557760608302_302_4969376">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557760608302_302_500291">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557760608302_302_1656632"><tr id="1557760608302_302_8336738"><td class="column" width="502" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557760608302_302_6881172">
                        <div class="lyrow firstGridRow ui-draggable" id="1557760677771_771_5237708">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557760677771_771_6993352"><i class="fa-remove fa" id="1557760677771_771_6529406"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557760677771_771_7253078"><i class="fa fa-arrows-alt" id="1557760677771_771_2688395"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-35" id="1557760677771_771_7196481"><i class="fa fa-copy" id="1557760677771_771_8341404"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557760677771_771_6422026"><i class="fa fa-angle-double-down" id="1557760677772_772_8430755"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557760677772_772_6587828"><i class="fa fa-plus" id="1557760677772_772_4608789"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557760677772_772_4832260"><i class="fa fa-clone" id="1557760677772_772_9638441"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557760677772_772_3040302"><i class="fa fa-database" id="1557760677772_772_1698518"></i></a>
                            <div class="preview" id="1557760677772_772_7527601">
                                <div class="row" id="1557760677772_772_4752420">
                                    <div class="col-md-8 gridInputColPadding" id="1557760677772_772_5548669">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557760677772_772_6620879">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557760677772_772_7885185">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557760677772_772_6793014"><tr id="1557760677772_772_4999359"><td class="column" width="32" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557760677772_772_6837594">&nbsp;</td><td class="column" width="6" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(90, 63, 153); font-size: 16px; line-height: 22px; text-align: center;" data-color="#5a3f99" data-ff="Arial, Helvetica, sans-serif" id="1557760677772_772_9149831" data-fs="16px" data-lh="22px" data-ta="center"><strong id="1557760850252_252_6601361">&amp;#9675;</strong></td><td class="column" width="14" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557760677772_772_5558745">&nbsp;</td><td class="column" width="450" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(0, 0, 0); font-size: 16px; line-height: 22px;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557760677772_772_6792131" data-fs="16px" data-lh="22px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/nestedBullets.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Nested Bullets</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557772842664_664_2583586">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557772842664_664_8488780"><i class="fa-remove fa" id="1557772842664_664_1371262"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557772842664_664_8582241"><i class="fa fa-arrows-alt" id="1557772842664_664_7905875"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-5" id="1557772842664_664_1761176"><i class="fa fa-copy" id="1557772842664_664_9918126"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557772842664_664_8210433"><i class="fa fa-angle-double-down" id="1557772842664_664_3718734"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557772842664_664_8820483"><i class="fa fa-plus" id="1557772842665_665_5658048"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557772842665_665_5535121"><i class="fa fa-clone" id="1557772842665_665_9099271"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557772842665_665_682243"><i class="fa fa-database" id="1557772842665_665_5761944"></i></a>
                            <div class="preview" id="1557772842665_665_4674252">
                                <div class="row" id="1557772842665_665_8943314">
                                    <div class="col-md-8 gridInputColPadding" id="1557772842665_665_9294925">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557772842665_665_4414229">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557772842665_665_8514466">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557772842665_665_9285612"><tr id="1557772842665_665_4042179"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557772842665_665_4055442">
                        <div class="lyrow firstGridRow ui-draggable" id="1557772872888_888_3707744">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557772872888_888_8014195"><i class="fa-remove fa" id="1557772872888_888_9971131"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557772872888_888_6292566"><i class="fa fa-arrows-alt" id="1557772872888_888_3956225"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-10" id="1557772872888_888_7199266"><i class="fa fa-copy" id="1557772872888_888_2794194"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557772872888_888_1048673"><i class="fa fa-angle-double-down" id="1557772872888_888_65306"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557772872888_888_4726959"><i class="fa fa-plus" id="1557772872888_888_3878247"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557772872888_888_5375144"><i class="fa fa-clone" id="1557772872888_888_4111980"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557772872888_888_5189397"><i class="fa fa-database" id="1557772872888_888_9808944"></i></a>
                            <div class="preview" id="1557772872888_888_2435555">
                                <div class="row" id="1557772872888_888_9941197">
                                    <div class="col-md-8 gridInputColPadding" id="1557772872888_888_2938769">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557772872888_888_1925446">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557772872888_888_6596639">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557772872888_888_5885653"><tr id="1557772872888_888_5451352"><td class="column" width="600" valign="top" height="5" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557772872888_888_3375166" data-lh="5px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557772886622_622_4030088">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557772886622_622_7636161"><i class="fa-remove fa" id="1557772886622_622_6624470"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557772886622_622_2306248"><i class="fa fa-arrows-alt" id="1557772886622_622_7216894"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557772886622_622_4208457"><i class="fa fa-copy" id="1557772886622_622_9267156"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-16" id="1557772886622_622_9136282"><i class="fa fa-angle-double-down" id="1557772886622_622_2063101"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557772886622_622_355790"><i class="fa fa-plus" id="1557772886622_622_9152304"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557772886622_622_9955530"><i class="fa fa-clone" id="1557772886622_622_8950421"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557772886622_622_6444037"><i class="fa fa-database" id="1557772886622_622_622705"></i></a>
                            <div class="preview" id="1557772886622_622_2742055">
                                <div class="row" id="1557772886622_622_8123357">
                                    <div class="col-md-8 gridInputColPadding" id="1557772886622_622_4629004">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557772886622_622_7234375">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557772886622_622_434864">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557772886622_622_8962855"><tr id="1557772886622_622_6589329"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557772886622_622_6860781">
                        <div class="lyrow firstGridRow ui-draggable" id="1557773722299_299_4376191">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557773722299_299_2503263"><i class="fa-remove fa" id="1557773722299_299_6965636"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557773722299_299_739646"><i class="fa fa-arrows-alt" id="1557773722299_299_3016824"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-26" id="1557773722299_299_2072321"><i class="fa fa-copy" id="1557773722299_299_3672991"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557773722299_299_7094719"><i class="fa fa-angle-double-down" id="1557773722299_299_60976"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557773722299_299_6843362"><i class="fa fa-plus" id="1557773722299_299_4267657"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557773722299_299_2868653"><i class="fa fa-clone" id="1557773722299_299_3098924"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557773722300_300_1137969"><i class="fa fa-database" id="1557773722300_300_9861975"></i></a>
                            <div class="preview" id="1557773722300_300_1236995">
                                <div class="row" id="1557773722300_300_1490035">
                                    <div class="col-md-8 gridInputColPadding" id="1557773722300_300_4446274">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557773722300_300_3156835">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557773722300_300_449664">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557773722300_300_2648775"><tr id="1557773722300_300_7818050"><td class="column" width="10" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773722300_300_5192277">&nbsp;</td><td class="column" width="5" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); text-align: center; font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773722300_300_9042420" data-ta="center" data-fs="17px" data-lh="20px">    &amp;#08226;    </td><td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773722300_300_1686846">&nbsp;</td><td class="column" width="580" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773722300_300_644521" data-fs="17px" data-lh="20px">Lorem ipsum dolor sit amet</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557772902936_936_840790">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557772902937_937_4659363"><i class="fa-remove fa" id="1557772902937_937_5963114"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557772902937_937_6497305"><i class="fa fa-arrows-alt" id="1557772902937_937_6583622"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557772902937_937_742908"><i class="fa fa-copy" id="1557772902937_937_1535354"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-20" id="1557772902937_937_5664147"><i class="fa fa-angle-double-down" id="1557772902937_937_1745773"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557772902937_937_973307"><i class="fa fa-plus" id="1557772902937_937_4641447"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557772902937_937_6464141"><i class="fa fa-clone" id="1557772902937_937_4795746"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557772902937_937_5046706"><i class="fa fa-database" id="1557772902937_937_370865"></i></a>
                            <div class="preview" id="1557772902937_937_4559129">
                                <div class="row" id="1557772902937_937_1747086">
                                    <div class="col-md-8 gridInputColPadding" id="1557772902937_937_3023997">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557772902937_937_5637237">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557772902937_937_733764">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557772902937_937_6232763"><tr id="1557772902938_938_3278177"><td class="column" width="600" valign="top" height="5" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557772902938_938_3317535" data-lh="5px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557772902426_426_7875259">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557772902426_426_6426981"><i class="fa-remove fa" id="1557772902426_426_6686828"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557772902426_426_2788155"><i class="fa fa-arrows-alt" id="1557772902426_426_743144"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557772902426_426_297268"><i class="fa fa-copy" id="1557772902426_426_4660969"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-20" id="1557772902426_426_8193667"><i class="fa fa-angle-double-down" id="1557772902426_426_5663416"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557772902426_426_5390736"><i class="fa fa-plus" id="1557772902426_426_1570490"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557772902426_426_116190"><i class="fa fa-clone" id="1557772902426_426_6655794"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557772902426_426_7065883"><i class="fa fa-database" id="1557772902426_426_5705825"></i></a>
                            <div class="preview" id="1557772902426_426_2476910">
                                <div class="row" id="1557772902426_426_573484">
                                    <div class="col-md-8 gridInputColPadding" id="1557772902426_426_1720257">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557772902426_426_807149">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557772902426_426_2416753">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557772902426_426_8059957"><tr id="1557772902427_427_5128482"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557772902427_427_2497928">
                        <div class="lyrow firstGridRow ui-draggable" id="1557773819294_294_1820205">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557773819294_294_500532"><i class="fa-remove fa" id="1557773819294_294_720108"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557773819294_294_3258226"><i class="fa fa-arrows-alt" id="1557773819294_294_2219000"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-37" id="1557773819294_294_2739778"><i class="fa fa-copy" id="1557773819294_294_3341460"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557773819294_294_1282016"><i class="fa fa-angle-double-down" id="1557773819294_294_5888317"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557773819294_294_4975668"><i class="fa fa-plus" id="1557773819294_294_5593120"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557773819294_294_5518873"><i class="fa fa-clone" id="1557773819294_294_2324553"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557773819294_294_4993963"><i class="fa fa-database" id="1557773819294_294_6342107"></i></a>
                            <div class="preview" id="1557773819294_294_2553041">
                                <div class="row" id="1557773819295_295_5725407">
                                    <div class="col-md-8 gridInputColPadding" id="1557773819295_295_9288371">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557773819295_295_3801963">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557773819295_295_2986086">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557773819295_295_8174305"><tr id="1557773819295_295_1463676"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773819295_295_9322221">&nbsp;</td><td class="column" width="6" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px; text-align: center;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773819295_295_4111445" data-fs="17px" data-lh="20px" data-ta="center">&amp;#09702;</td><td class="column" width="4" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773819295_295_5011882">&nbsp;</td><td class="column" width="570" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557773819295_295_6523289" data-fs="17px" data-lh="20px">Lorem ipsum dolor sit amet, consectetur adipiscing elit</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                    
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/singularBullet.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Singular Bullet</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557774154256_256_4640250">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557774154257_257_4912897"><i class="fa-remove fa" id="1557774154257_257_374272"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557774154257_257_7037345"><i class="fa fa-arrows-alt" id="1557774154257_257_8901711"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-18" id="1557774154257_257_9268975"><i class="fa fa-copy" id="1557774154257_257_9302280"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557774154257_257_482231"><i class="fa fa-angle-double-down" id="1557774154257_257_403281"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557774154257_257_6657584"><i class="fa fa-plus" id="1557774154257_257_87117"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557774154257_257_5132321"><i class="fa fa-clone" id="1557774154257_257_5328334"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557774154257_257_7566967"><i class="fa fa-database" id="1557774154257_257_1118473"></i></a>
                            <div class="preview" id="1557774154257_257_8232508">
                                <div class="row" id="1557774154257_257_1681188">
                                    <div class="col-md-8 gridInputColPadding" id="1557774154257_257_8400430">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557774154257_257_3684309">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557774154257_257_2257824">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557774154257_257_8426364"><tr id="1557774154257_257_3407319"><td class="column" width="600" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557774154257_257_8602245" contenteditable="true">
                        <div class="lyrow firstGridRow ui-draggable" id="1557774160567_567_1199831">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557774160567_567_5795307"><i class="fa-remove fa" id="1557774160567_567_3205082"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557774160567_567_3380567"><i class="fa fa-arrows-alt" id="1557774160567_567_6196393"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-19" id="1557774160567_567_6003823"><i class="fa fa-copy" id="1557774160567_567_1979358"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557774160567_567_9303892"><i class="fa fa-angle-double-down" id="1557774160567_567_4450010"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557774160567_567_3330138"><i class="fa fa-plus" id="1557774160567_567_1248457"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557774160567_567_402444"><i class="fa fa-clone" id="1557774160567_567_942525"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557774160567_567_3756795"><i class="fa fa-database" id="1557774160567_567_9177110"></i></a>
                            <div class="preview" id="1557774160567_567_4476629">
                                <div class="row" id="1557774160567_567_6514052">
                                    <div class="col-md-8 gridInputColPadding" id="1557774160567_567_1613932">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557774160567_567_7269702">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557774160567_567_6010359">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557774160567_567_3581136"><tr id="1557774160567_567_6718991"><td class="column" width="5" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px; text-align: center;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557774160567_567_1933737" contenteditable="true" data-fs="17px" data-lh="20px" data-ta="center">&amp;#08226;</td><td class="column" width="5" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88);" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557774160567_567_5245858" contenteditable="true" data-ta=""></td><td class="column" width="590" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557774160567_567_5176718" contenteditable="true" data-fs="17px" data-lh="20px">Lorem ipsum dolor sit amet, consectetur adipiscing elitLorem ipsum dolor sit amet, consectetur adipiscing elit</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <!-- responsive snippet -->
            <?php
                if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
            ?>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/responsiveBullet.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Responsive Bullet</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557775719818_818_7339023">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-47" id="1557775719818_818_4920631"><i class="fa fa-copy" id="1557775719818_818_9372469"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557775719818_818_561241"><i class="fa fa-angle-double-down" id="1557775719818_818_604569"></i></a>
                            <div class="preview" id="1557775719818_818_3917672">
                                <div class="row" id="1557775719818_818_1296508">
                                    <div class="col-md-8 gridInputColPadding" id="1557775719818_818_7146347">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557775719818_818_317789">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557775719818_818_8864689">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; border-collapse: collpase;" id="1557775719818_818_1108556"><tbody id="1557775719818_818_2355827"><tr id="1557775719818_818_321053"><td class="column" valign="top" style="width:px; font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557775719818_818_3454889">
                        <div class="lyrow firstGridRow ui-draggable" id="1557775799097_97_5644185">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-58" id="1557775799097_97_6549139"><i class="fa fa-copy" id="1557775799097_97_3690764"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557775799097_97_7035998"><i class="fa fa-angle-double-down" id="1557775799097_97_4103712"></i></a>
                            <div class="preview" id="1557775799097_97_8804029">
                                <div class="row" id="1557775799098_98_9296626">
                                    <div class="col-md-8 gridInputColPadding" id="1557775799098_98_868663">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557775799098_98_3874881">
                                        <p id="gridInputCountResp">= 598</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557775799098_98_106374">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557775799098_98_2445891"><tbody id="1557775799098_98_7504133"><tr id="1557775799098_98_982166"><td class="column" valign="top" style="width: 8px; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 16px; color: rgb(85, 85, 85); padding-bottom: 5px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557775799098_98_288586" data-fs="12px" data-lh="16px" data-pb="5px">&amp;#08226;</td><td class="column" valign="top" style="width: 590px; font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 16px; padding-bottom: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557775799098_98_6337847" data-fs="12px" data-lh="16px" data-pb="5px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <?php
                }
            ?>
            <!-- responsive bullet ends here -->
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/squareButton.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Square Button</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557776608651_651_6871099">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557776608652_652_9439969"><i class="fa-remove fa" id="1557776608652_652_7914186"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557776608652_652_7870065"><i class="fa fa-arrows-alt" id="1557776608652_652_5947963"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-7" id="1557776608652_652_8526914"><i class="fa fa-copy" id="1557776608652_652_9200672"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557776608652_652_3236922"><i class="fa fa-angle-double-down" id="1557776608652_652_5931638"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557776608652_652_6058711"><i class="fa fa-plus" id="1557776608652_652_6873024"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557776608652_652_2604689"><i class="fa fa-clone" id="1557776608652_652_7626488"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557776608652_652_7283961"><i class="fa fa-database" id="1557776608652_652_7873783"></i></a>
                            <div class="preview" id="1557776608652_652_392456">
                                <div class="row" id="1557776608652_652_3024389">
                                    <div class="col-md-8 gridInputColPadding" id="1557776608652_652_1006876">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557776608652_652_5255318">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557776608652_652_5698176">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557776608652_652_6845408"><tr id="1557776608652_652_9341574"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776608652_652_1228086">
                        <div class="lyrow firstGridRow ui-draggable" id="1557776697705_705_5589065">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557776697705_705_8900415"><i class="fa-remove fa" id="1557776697705_705_744970"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557776697705_705_699803"><i class="fa fa-arrows-alt" id="1557776697705_705_746784"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-19" id="1557776697705_705_4713310"><i class="fa fa-copy" id="1557776697705_705_9384147"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557776697705_705_7313842"><i class="fa fa-angle-double-down" id="1557776697705_705_9768636"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557776697705_705_9924779"><i class="fa fa-plus" id="1557776697705_705_7105316"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557776697705_705_2977696"><i class="fa fa-clone" id="1557776697705_705_3885950"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557776697705_705_7824340"><i class="fa fa-database" id="1557776697705_705_8182875"></i></a>
                            <div class="preview" id="1557776697705_705_6214594">
                                <div class="row" id="1557776697705_705_8734937">
                                    <div class="col-md-8 gridInputColPadding" id="1557776697705_705_796141">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557776697705_705_1565516">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557776697705_705_6663222">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only;" width="600"><tbody id="1557776697705_705_7400187"><tr id="1557776697705_705_6344651"><td class="column" width="152" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776697705_705_7873268">&nbsp;</td><td class="column" width="296" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88);background-color:#555555;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776697705_705_7519750" bgcolor="#555555">
                        <div class="lyrow firstGridRow ui-draggable" id="1557776719810_810_9499184">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557776719810_810_6696538"><i class="fa-remove fa" id="1557776719810_810_7011373"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557776719810_810_3090812"><i class="fa fa-arrows-alt" id="1557776719810_810_6806806"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-27" id="1557776719810_810_8917445"><i class="fa fa-copy" id="1557776719810_810_7175262"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557776719810_810_4659978"><i class="fa fa-angle-double-down" id="1557776719810_810_5843574"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557776719810_810_3346617"><i class="fa fa-plus" id="1557776719810_810_6353792"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557776719810_810_4503431"><i class="fa fa-clone" id="1557776719810_810_5132529"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557776719810_810_6796390"><i class="fa fa-database" id="1557776719810_810_9598044"></i></a>
                            <div class="preview" id="1557776719810_810_4702577">
                                <div class="row" id="1557776719810_810_3287404">
                                    <div class="col-md-8 gridInputColPadding" id="1557776719810_810_4699036">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557776719810_810_3173118">
                                        <p id="gridInputCount">= 296</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557776719810_810_7232985">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only;" width="296"><tbody id="1557776719810_810_9634485"><tr id="1557776719810_810_2073766"><td class="column" width="296" valign="top" height="20" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 20px;background-color:#555555;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776719810_810_1719357" data-lh="20px" bgcolor="#555555">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557776720324_324_2756639">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557776720324_324_521182"><i class="fa-remove fa" id="1557776720324_324_6307109"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557776720324_324_913108"><i class="fa fa-arrows-alt" id="1557776720324_324_2691106"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-27" id="1557776720324_324_2695768"><i class="fa fa-copy" id="1557776720324_324_8605647"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557776720324_324_8990284"><i class="fa fa-angle-double-down" id="1557776720324_324_2696543"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557776720324_324_3952315"><i class="fa fa-plus" id="1557776720324_324_8293653"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557776720324_324_205814"><i class="fa fa-clone" id="1557776720324_324_1869842"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557776720324_324_5352806"><i class="fa fa-database" id="1557776720324_324_7510358"></i></a>
                            <div class="preview" id="1557776720324_324_8863362">
                                <div class="row" id="1557776720324_324_2344870">
                                    <div class="col-md-8 gridInputColPadding" id="1557776720324_324_2958716">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557776720324_324_292361">
                                        <p id="gridInputCount">= 296</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557776720325_325_2822843">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="296"><tbody id="1557776720325_325_1156168"><tr id="1557776720325_325_3984746"><td class="column" width="296" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776720325_325_2351945">
                        <div class="lyrow firstGridRow ui-draggable" id="1557776894021_21_4021310">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557776894021_21_4495192"><i class="fa-remove fa" id="1557776894021_21_8176064"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557776894021_21_3819840"><i class="fa fa-arrows-alt" id="1557776894021_21_6329885"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-38" id="1557776894021_21_5512162"><i class="fa fa-copy" id="1557776894021_21_8755508"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557776894021_21_440346"><i class="fa fa-angle-double-down" id="1557776894021_21_9658781"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557776894021_21_5323591"><i class="fa fa-plus" id="1557776894021_21_7335189"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557776894021_21_1671935"><i class="fa fa-clone" id="1557776894021_21_6342378"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557776894021_21_9623005"><i class="fa fa-database" id="1557776894021_21_1095278"></i></a>
                            <div class="preview" id="1557776894021_21_6406626">
                                <div class="row" id="1557776894021_21_9307424">
                                    <div class="col-md-8 gridInputColPadding" id="1557776894021_21_3973050">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557776894021_21_8212568">
                                        <p id="gridInputCount">= 296</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557776894021_21_8755446">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="296"><tbody id="1557776894021_21_8445965"><tr id="1557776894021_21_2993941"><td class="column" width="28" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88);background-color:#555555;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776894021_21_3996" bgcolor="#555555">&nbsp;</td><td class="column" width="240" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 16px; text-align: center; color: rgb(255, 255, 255);background-color:#555555;" data-color="#ffffff" data-ff="Arial, Helvetica, sans-serif" id="1557776894021_21_4942048" data-fs="14px" data-lh="16px" data-ta="center" bgcolor="#555555"><a id="1557777059338_338_5872175" href="https://www.merckconnect.com/isentress/isentress-hd-clinical-efficacy/?&amp;source=Veeva_Email&amp;utm_medium=email&amp;utm_UID={{Account.Merck_ID_MRK__c}}&amp;utm_content=<US-MFA-00259>&amp;utm_campaign=<NONE>" alias="CTA" target="_blank" style="color: rgb(255, 255, 255); text-decoration: none;"><strong id="1557777091089_89_438323">Lorem ipsum dolor sit amet, consectetur adipiscing elit</strong></a></td><td class="column" width="28" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88);background-color:#555555;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776894021_21_3371661" bgcolor="#555555">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557776720735_735_7020201">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557776720735_735_3800691"><i class="fa-remove fa" id="1557776720735_735_6178955"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557776720735_735_7730016"><i class="fa fa-arrows-alt" id="1557776720735_735_8905550"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-27" id="1557776720735_735_9249839"><i class="fa fa-copy" id="1557776720735_735_3153584"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557776720735_735_8867066"><i class="fa fa-angle-double-down" id="1557776720735_735_1309755"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557776720735_735_4668361"><i class="fa fa-plus" id="1557776720735_735_4541987"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557776720735_735_7785430"><i class="fa fa-clone" id="1557776720735_735_8195377"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557776720735_735_3236578"><i class="fa fa-database" id="1557776720735_735_9414695"></i></a>
                            <div class="preview" id="1557776720735_735_1235826">
                                <div class="row" id="1557776720735_735_8436458">
                                    <div class="col-md-8 gridInputColPadding" id="1557776720735_735_5429653">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557776720735_735_4286212">
                                        <p id="gridInputCount">= 296</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557776720735_735_8077042">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="296"><tbody id="1557776720735_735_136625"><tr id="1557776720735_735_864476"><td class="column" width="296" valign="top" height="20" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 20px;background-color:#555555;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776720735_735_802990" data-lh="20px" bgcolor="#555555">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="152" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557776697705_705_8164695">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <?php
                if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
            ?>
            <!-- responsive button starts here -->
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/responsiveButton.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Responsive Big Button</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557835614322_322_1866460">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-8" id="1557835614322_322_3279918"><i class="fa fa-copy" id="1557835614322_322_880821"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557835614322_322_9399721"><i class="fa fa-angle-double-down" id="1557835614322_322_1554685"></i></a>
                            <div class="preview" id="1557835614322_322_2198481">
                                <div class="row" id="1557835614322_322_5205041">
                                    <div class="col-md-8 gridInputColPadding" id="1557835614322_322_2842739">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557835614322_322_9072986">
                                        <p id="gridInputCountResp">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557835614322_322_3285156">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557835614322_322_804142"><tbody id="1557835614322_322_3681210"><tr id="1557835614322_322_2773367"><td class="column mobile" valign="top" style="width:150px; font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557835614322_322_4358115">&nbsp;</td><td class="column mobile" valign="top" style="width:300px; font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557835614322_322_4916237">
                        
                        <div class="lyrow firstGridRow ui-draggable" id="1557835623584_584_3312276">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557835623584_584_5689740"><i class="fa fa-copy" id="1557835623584_584_5357573"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557835623584_584_6504940"><i class="fa fa-angle-double-down" id="1557835623584_584_2174311"></i></a>
                            <div class="preview" id="1557835623584_584_3434234">
                                <div class="row" id="1557835623584_584_8444699">
                                    <div class="col-md-8 gridInputColPadding" id="1557835623584_584_6628954">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557835623584_584_4573854">
                                        <p id="gridInputCountResp">= 300</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557835623584_584_5984746">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557835623584_584_7162877"><tbody id="1557835623584_584_2736617"><tr id="1557835623584_584_5947560"><td class="column fontSize" valign="top" style="width: 300px;font-family: Arial, Helvetica, sans-serif;text-align: center;color: rgb(255, 255, 255);background-color: rgb(88, 88, 88);padding: 15px 30px;font-size: 16px;line-height: 22px;border-radius: 50px;" data-color="#ffffff" data-ff="Arial, Helvetica, sans-serif" id="1557835623584_584_102452" data-ta="center" bgcolor="#585858" data-pt="15px" data-pl="30px" data-pr="30px" data-pb="15px" data-fs="16px" data-lh="22px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, s</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        
                    
                    </td><td class="column mobile" valign="top" style="width:150px; font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557835614322_322_9385809">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                        <style id="1557837628762_762_301021">@media screen and (max-width: 736px), print and (max-width: 320px){.fontSize {line-height: 16px !important; font-size: 12px !important; }}</style>
                        <style id="1557837659871_871_1252130">@media screen and (max-width: 736px), print and (max-width: 320px){.mobile { width: 100% !important; display: block !important; }}</style>
                        <style id="1557837731282_282_9261910">@media screen and (max-width: 736px), print and (max-width: 320px){.mobilePadding { display: block !important; padding-left: 25px !important; padding-right: 25px !important; }}</style>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/responsiveSmallButton.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Responsive Small Button</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557838005732_732_2352747">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-20" id="1557838005732_732_3662805"><i class="fa fa-copy" id="1557838005732_732_3598034"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557838005732_732_465012"><i class="fa fa-angle-double-down" id="1557838005733_733_1885325"></i></a>
                            <div class="preview" id="1557838005733_733_3955773">
                                <div class="row" id="1557838005733_733_5844277">
                                    <div class="col-md-8 gridInputColPadding" id="1557838005733_733_3414230">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557838005733_733_6240512">
                                        <p id="gridInputCountResp">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557838005733_733_6380514">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557838005733_733_5709639"><tbody id="1557838005733_733_3215424"><tr id="1557838005733_733_5160279"><td class="column mobile" valign="top" style="width: 220px;font-family:Arial, Helvetica, sans-serif;color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557838005733_733_2150118">&nbsp;</td><td class="column mobile" valign="top" style="width: 160px;font-family:Arial, Helvetica, sans-serif;color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557838005733_733_9470144">
                        <div class="lyrow firstGridRow ui-draggable" id="1557838014232_232_3917614">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-24" id="1557838014232_232_2770396"><i class="fa fa-copy" id="1557838014232_232_7491934"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557838014232_232_7045375"><i class="fa fa-angle-double-down" id="1557838014232_232_7638999"></i></a>
                            <div class="preview" id="1557838014232_232_2306467">
                                <div class="row" id="1557838014232_232_6558717">
                                    <div class="col-md-8 gridInputColPadding" id="1557838014232_232_7060108">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557838014232_232_172571">
                                        <p id="gridInputCountResp">= 92</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557838014232_232_6291768">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557838014232_232_2352992"><tbody id="1557838014232_232_9050990"><tr id="1557838014232_232_9724662"><td class="column" valign="top" style="width: 140px;font-family: Arial, Helvetica, sans-serif;font-size: 16px;line-height: 22px;padding: 15px 30px;text-align: center;background-color: rgb(88, 88, 88);color:#ffffff;border-radius: 50px;" data-color="#ffffff" data-ff="Arial, Helvetica, sans-serif" id="1557838014232_232_3860739" data-fs="16px" data-lh="22px" data-pt="15px" data-pl="30px" data-pr="30px" data-pb="15px" data-ta="center" bgcolor="#585858">Lorem ipsum</td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column mobile" valign="top" style="width: 220px;font-family:Arial, Helvetica, sans-serif;color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557838005733_733_1047371">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                        <style id="1557837813640_640_1357764">
                            @media screen and (max-width: 736px), print and (max-width: 320px){
                                .device_width {
                                    width: 100%!important;
                                }
                            }
                        </style>
                        <style id="1557838845790_790_6359217">@media screen and (max-width: 736px), print and (max-width: 320px){.fontSize { line-height: 16px !important; font-size: 12px !important; }}</style>
                        <style id="1557838862462_462_5313552">@media screen and (max-width: 736px), print and (max-width: 320px){.mobile { width: 100% !important; display: block !important; text-align: center !important; }}</style>
                        <style id="1557838930157_157_9988920">@media screen and (max-width: 736px), print and (max-width: 320px){.mobilePadding { display: block !important; padding-left: 25px !important; padding-right: 25px !important; }}</style>
                </div>
            </li>
            <?php
                }
            ?>
            <!-- responsive button ends here-->
            <!-- responsive footer starts here -->
            <?php
                if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
            ?>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/gardasil9RespFooter.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Gardasil9 Resp Footer</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557840644343_343_5498194">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-7" id="1557840644343_343_864379"><i class="fa fa-copy" id="1557840644343_343_7398884"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557840644343_343_4949007"><i class="fa fa-angle-double-down" id="1557840644343_343_1372472"></i></a>
                            <div class="preview" id="1557840644343_343_295201">
                                <div class="row" id="1557840644343_343_1195824">
                                    <div class="col-md-8 gridInputColPadding" id="1557840644343_343_4061253">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557840644343_343_539896">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557840644343_343_3518524">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557840644343_343_1274998">
                                    <tbody id="1557840644343_343_17054"><tr id="1557840644343_343_7516472">
                                        <td class="column mobilePadding footer" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 14px; padding-left: 30px; padding-right: 30px; padding-bottom: 10px;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557840644343_343_7992257" data-fs="11px" data-lh="14px" data-pl="30px" data-pr="30px" data-pb="10px">Note: This message was distributed from an email account used for sending messages only. Please do not reply to this message.</td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557840699214_214_1166136">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557840699214_214_5316120"><i class="fa fa-copy" id="1557840699214_214_7532353"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-14" id="1557840699214_214_4877224"><i class="fa fa-angle-double-down" id="1557840699214_214_1932188"></i></a>
                            <div class="preview" id="1557840699214_214_3236317">
                                <div class="row" id="1557840699214_214_7299967">
                                    <div class="col-md-8 gridInputColPadding" id="1557840699214_214_4828295">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557840699214_214_7036549">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557840699214_214_8935829">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557840699214_214_4316387">
                                    <tbody id="1557840699214_214_2724119"><tr id="1557840699214_214_1138384">
                                        <td class="column footer mobilePadding" style="font-family: Arial, Helvetica, sans-serif; color: rgb(85, 85, 85); font-size: 11px; line-height: 14px; padding-left: 30px; padding-right: 30px; padding-bottom: 10px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557840699214_214_9505595" data-fs="11px" data-lh="14px" data-pl="30px" data-pr="30px" data-pb="10px">This email communication is from Merck Sharp &amp;#00038; Dohme Corp. (&amp;#00034;Merck&amp;#00034;), a subsidiary of <strong id="1557841331079_79_6846114">Merck &amp;#00038; Co., Inc.</strong> Please manage your email preferences or unsubscribe anytime by clicking <a id="1557841340815_815_1484723" href="file:///C:/xampp/htdocs/NMC%20Templates/Snippet/footers/%%=Redirectto(@UnsubURL)=%%" alias="here" target="_blank" style="color: rgb(85, 85, 85); text-decoration: underline;">here</a>. If you have trouble accessing this link, please send an email to <a id="1557841431232_232_5660663" href="file:///C:/xampp/htdocs/NMC%20Templates/Snippet/footers/mailto:merck_privacy_office@merck.com?subject=Email Opt Out Request - %%EmailName_%%" alias="mailto" target="_blank" style="color: rgb(85, 85, 85); text-decoration: underline;">merck_privacy_office@merck.com</a> with a subject line of Email Opt&amp;#00045;Out Request &amp;#08211; %%EmailName_%%.</td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557840698779_779_9153267">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557840698779_779_3273682"><i class="fa fa-copy" id="1557840698779_779_2684670"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-14" id="1557840698779_779_6608210"><i class="fa fa-angle-double-down" id="1557840698779_779_6592092"></i></a>
                            <div class="preview" id="1557840698779_779_9827407">
                                <div class="row" id="1557840698779_779_2724634">
                                    <div class="col-md-8 gridInputColPadding" id="1557840698779_779_1139741">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557840698779_779_3299860">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557840698779_779_5968527">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557840698779_779_4870021">
                                    <tbody id="1557840698779_779_6374853"><tr id="1557840698779_779_3637488">
                                        <td class="column footer mobilePadding" style="font-family: Arial, Helvetica, sans-serif; color: rgb(85, 85, 85); font-size: 11px; line-height: 14px; padding-left: 30px; padding-right: 30px; padding-bottom: 10px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557840698779_779_4297560" data-fs="11px" data-lh="14px" data-pl="30px" data-pr="30px" data-pb="10px">Please read our <a id="1557841465649_649_4509539" href="http://www.merck.com/about/how-we-operate/privacy/internet-privacy-policy.html" alias="privacy policy" target="_blank" style="color: rgb(85, 85, 85); text-decoration: underline;">Privacy Policy</a> to learn more about how Merck protects personal information about you.
</td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557840698280_280_8828147">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557840698281_281_8520158"><i class="fa fa-copy" id="1557840698281_281_9329250"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-14" id="1557840698281_281_4806822"><i class="fa fa-angle-double-down" id="1557840698281_281_1584785"></i></a>
                            <div class="preview" id="1557840698281_281_433079">
                                <div class="row" id="1557840698281_281_8225570">
                                    <div class="col-md-8 gridInputColPadding" id="1557840698281_281_4314134">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557840698281_281_236801">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557840698281_281_1086894">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557840698281_281_2775104">
                                    <tbody id="1557840698281_281_6156966"><tr id="1557840698281_281_1040629">
                                        <td class="column footer mobilePadding" style="font-family: Arial, Helvetica, sans-serif; color: rgb(85, 85, 85); font-size: 11px; line-height: 14px; padding-left: 30px; padding-right: 30px; padding-bottom: 10px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557840698281_281_9907230" data-fs="11px" data-lh="14px" data-pl="30px" data-pr="30px" data-pb="10px">Merck Privacy Office, 351 N Sumneytown Pike, UG4B&amp;#00045;24, North Wales, PA 19454, USA
</td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557840697802_802_8108694">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557840697802_802_9073763"><i class="fa fa-copy" id="1557840697802_802_1750476"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-14" id="1557840697802_802_923707"><i class="fa fa-angle-double-down" id="1557840697802_802_4307531"></i></a>
                            <div class="preview" id="1557840697802_802_9683356">
                                <div class="row" id="1557840697803_803_483074">
                                    <div class="col-md-8 gridInputColPadding" id="1557840697803_803_6999666">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557840697803_803_547227">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557840697803_803_9791982">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557840697803_803_3032208">
                                    <tbody id="1557840697803_803_280095"><tr id="1557840697803_803_2423583">
                                        <td class="column footer mobilePadding" style="font-family: Arial, Helvetica, sans-serif; color: rgb(85, 85, 85); font-size: 11px; line-height: 14px; padding-left: 30px; padding-right: 30px; padding-bottom: 10px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557840697803_803_2115533" data-fs="11px" data-lh="14px" data-pl="30px" data-pr="30px" data-pb="10px">Copyright &amp;#00169; 2019 Merck Sharp &amp;#00038; Dohme Corp., a subsidiary of <strong id="1557841502914_914_9069348">Merck &amp;#00038; Co., Inc.</strong> All rights reserved.
</td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>

                        <div class="lyrow firstGridRow ui-draggable" id="1557840697278_278_4839698">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557840697278_278_3202281"><i class="fa fa-copy" id="1557840697278_278_859224"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-14" id="1557840697278_278_7379234"><i class="fa fa-angle-double-down" id="1557840697278_278_6906745"></i></a>
                            <div class="preview" id="1557840697278_278_885039">
                                <div class="row" id="1557840697278_278_7015534">
                                    <div class="col-md-8 gridInputColPadding" id="1557840697278_278_195625">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557840697278_278_6886786">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557840697278_278_9953608">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557840697278_278_9593264">
                                    <tbody id="1557840697278_278_755361"><tr id="1557840697278_278_2720647">
                                        <td class="column footer mobilePadding" style="font-family: Arial, Helvetica, sans-serif; color: rgb(85, 85, 85); font-size: 11px; line-height: 14px; padding-left: 30px; padding-right: 30px; padding-bottom: 10px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557840697278_278_3115879" data-fs="11px" data-lh="14px" data-pl="30px" data-pr="30px" data-pb="10px">US&amp;#00045;GSL&amp;#00045;00387 02/19
</td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557840683691_691_19179">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557840683691_691_7688660"><i class="fa fa-copy" id="1557840683691_691_9589742"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-13" id="1557840683691_691_4231564"><i class="fa fa-angle-double-down" id="1557840683691_691_5351558"></i></a>
                            <div class="preview" id="1557840683691_691_6940115">
                                <div class="row" id="1557840683691_691_58991">
                                    <div class="col-md-8 gridInputColPadding" id="1557840683691_691_5750782">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557840683691_691_6659312">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557840683691_691_3712694">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557840683691_691_2100406">
                                    <tbody id="1557840683691_691_378674"><tr id="1557840683691_691_72934">
                                        <td class="column" height="" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557840683691_691_4008273" align="right" width="120">
                <div class="box box-element previewImg" data-type="image" id="1557841612868_868_1128006">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557841612868_868_4688861"><i class="fa fa-remove" id="1557841612868_868_6556754"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557841612868_868_837127"><i class="fa fa-arrows-alt" id="1557841612868_868_9296986"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-71" id="1557841612868_868_6338911">
                    <i class="fa fa-copy" id="1557841612868_868_2616687"></i>
                    </a> 
                    <div class="preview" id="1557841612869_869_2606371">
                        <i class="fa fa-picture-o fa-2x" id="1557841612869_869_7410574"></i>
                        <div class="element-desc" id="1557841612869_869_7546141">Image</div>
                    </div>
                    <div class="view" id="1557841612869_869_3656352"> <img src="images/footer_logo.jpg" class="img-responsive images currentSelectedImage" alt="" width="120" height="" id="1557841612869_869_9172881"> </div>
                </div>
            </td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                        <style id="1557840813738_738_5818993">@media screen and (max-width: 736px), print and (max-width: 320px){.footer { line-height: 15px !important; font-size: 12px !important; }}</style>
                        <style id="1557840901102_102_4839791">@media screen and (max-width: 736px), print and (max-width: 320px){.mobilePadding { padding-left: 25px !important; padding-right: 25px !important; }}</style>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/sivextroRespFooter.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Sivextro Resp Footer</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557846763246_246_3910194">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-4" id="1557846763246_246_6004810"><i class="fa fa-copy" id="1557846763246_246_8823943"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557846763246_246_8971264"><i class="fa fa-angle-double-down" id="1557846763246_246_6179740"></i></a>
                            <div class="preview" id="1557846763246_246_4199070">
                                <div class="row" id="1557846763246_246_5309117">
                                    <div class="col-md-8 gridInputColPadding" id="1557846763246_246_820078">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557846763247_247_8858598">
                                        <p id="gridInputCountResp">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557846763247_247_8250702">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557846763247_247_4266842"><tbody id="1557846763247_247_52850"><tr id="1557846763247_247_9989376"><td class="column footer" valign="top" style="width:400px; font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846763247_247_4951868" width="NaN">
                        <div class="lyrow firstGridRow ui-draggable" id="1557846793015_15_7197870" style="">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-10" id="1557846793015_15_2318460"><i class="fa fa-copy" id="1557846793015_15_677807"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557846793015_15_5272033"><i class="fa fa-angle-double-down" id="1557846793015_15_1744158"></i></a>
                            <div class="preview" id="1557846793015_15_4379322">
                                <div class="row" id="1557846793015_15_3547675">
                                    <div class="col-md-8 gridInputColPadding" id="1557846793015_15_8048864">
                                        <input id="gridInputResp" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557846793015_15_8036918">
                                        <p id="gridInputCountResp">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557846793015_15_5439489">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557846793015_15_373748"><tbody id="1557846793015_15_9514892"><tr id="1557846793015_15_5528382"><td class="column footer" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px; padding-top: 20px; padding-bottom: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846793015_15_314886" data-fs="12px" data-lh="15px" data-pt="20px" data-pb="5px">Should you have any questions regarding the content of this message, please contact your Merck representative at the number listed above.
</td></tr></tbody></table>
                            </div>
                        </div><div class="lyrow firstGridRow ui-draggable" id="1557846804956_956_3115872" style="">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-10" id="1557846804956_956_2673731"><i class="fa fa-copy" id="1557846804956_956_9937860"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557846804956_956_6098961"><i class="fa fa-angle-double-down" id="1557846804956_956_4440714"></i></a>
                            <div class="preview" id="1557846804956_956_426954">
                                <div class="row" id="1557846804956_956_7583541">
                                    <div class="col-md-8 gridInputColPadding" id="1557846804956_956_936160">
                                        <input id="1557846804956_956_6583719" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557846804956_956_4580779">
                                        <p id="1557846804956_956_2045689">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557846804956_956_3670284">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557846804956_956_5052236"><tbody id="1557846804956_956_1021168"><tr id="1557846804956_956_3122813"><td class="column footer" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px; padding-bottom: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846804956_956_1766288" data-fs="12px" data-lh="15px" data-pb="5px">You received this e&amp;#00045;mail because you requested information from either your Merck representative, you previously signed up to receive e&amp;#00045;mail communications from <strong id="1557847181254_254_9961314">Merck &amp;#00038; Co., Inc.,</strong> or you had provided your e&amp;#00045;mail consent to one of our trusted 3rd party vendors. If you no longer wish to receive e&amp;#00045;mail communications from your representatives, please <a id="1557847198818_818_5028718" href="{{unsubscribe_product_link}}" alias="click here" target="_blank" style="color: rgb(88, 88, 88); text-decoration: underline;">click here</a> to submit your request to opt&amp;#00045;out.
</td></tr></tbody></table>
                            </div>
                        </div><div class="lyrow firstGridRow ui-draggable" id="1557846809282_282_9616023" style="">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-10" id="1557846809282_282_755697"><i class="fa fa-copy" id="1557846809282_282_4121976"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557846809282_282_1934420"><i class="fa fa-angle-double-down" id="1557846809282_282_2656856"></i></a>
                            <div class="preview" id="1557846809282_282_2350601">
                                <div class="row" id="1557846809282_282_7333054">
                                    <div class="col-md-8 gridInputColPadding" id="1557846809282_282_2991911">
                                        <input id="1557846809282_282_1616520" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557846809282_282_7018444">
                                        <p id="1557846809282_282_9997970">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557846809282_282_2770774">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557846809282_282_3258593"><tbody id="1557846809282_282_1328601"><tr id="1557846809282_282_5171700"><td class="column footer" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px; padding-bottom: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846809282_282_2471347" data-fs="12px" data-lh="15px" data-pb="5px">Copyright &amp;#00169; 2019 Merck Sharp &amp;#00038; Dohme Corp., a subsidiary of <strong id="1557847247088_88_7016660">Merck &amp;#00038; Co., Inc.</strong> All rights reserved.    </td></tr></tbody></table>
                            </div>
                        </div><div class="lyrow firstGridRow ui-draggable" id="1557846811513_513_1688479" style="">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-10" id="1557846811513_513_9729896"><i class="fa fa-copy" id="1557846811513_513_8659756"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557846811513_513_7815769"><i class="fa fa-angle-double-down" id="1557846811513_513_2098710"></i></a>
                            <div class="preview" id="1557846811513_513_50666">
                                <div class="row" id="1557846811513_513_9435973">
                                    <div class="col-md-8 gridInputColPadding" id="1557846811513_513_1975179">
                                        <input id="1557846811513_513_1484031" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557846811513_513_827193">
                                        <p id="1557846811513_513_8168805">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557846811513_513_5419880">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557846811513_513_5041756"><tbody id="1557846811513_513_9311891"><tr id="1557846811513_513_4699151"><td class="column footer" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px; padding-bottom: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846811513_513_7204756" data-fs="12px" data-lh="15px" data-pb="5px">Please read our <a id="1557847251762_762_6749753" href="http://www.merck.com/about/how-we-operate/privacy/internet-privacy-policy.html" alias="privacy policy" target="_blank" style="color: rgb(88, 88, 88); text-decoration: underline;">Privacy Policy</a> to learn more about how Merck protects personal information about you.
</td></tr></tbody></table>
                            </div>
                        </div><div class="lyrow firstGridRow ui-draggable" id="1557846813738_738_4879009" style="">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-10" id="1557846813738_738_5564313"><i class="fa fa-copy" id="1557846813738_738_940644"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557846813738_738_8561487"><i class="fa fa-angle-double-down" id="1557846813738_738_1697038"></i></a>
                            <div class="preview" id="1557846813738_738_3445773">
                                <div class="row" id="1557846813738_738_6714365">
                                    <div class="col-md-8 gridInputColPadding" id="1557846813738_738_976888">
                                        <input id="1557846813738_738_3500126" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557846813738_738_9076356">
                                        <p id="1557846813738_738_594906">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557846813738_738_6055733">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557846813738_738_3628347"><tbody id="1557846813738_738_791929"><tr id="1557846813738_738_2925313"><td class="column footer" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px; padding-bottom: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846813738_738_5566193" data-fs="12px" data-lh="15px" data-pb="5px">Merck Privacy Office, 351 N Sumneytown Pike, UG4B&amp;#00045;24, North Wales, PA 19454, USA
</td></tr></tbody></table>
                            </div>
                        </div><div class="lyrow firstGridRow ui-draggable" id="1557846816217_217_1527048">
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-10" id="1557846816217_217_3909489"><i class="fa fa-copy" id="1557846816217_217_1623757"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557846816217_217_4784315"><i class="fa fa-angle-double-down" id="1557846816217_217_4819089"></i></a>
                            <div class="preview" id="1557846816217_217_3774173">
                                <div class="row" id="1557846816217_217_9649643">
                                    <div class="col-md-8 gridInputColPadding" id="1557846816217_217_8634885">
                                        <input id="1557846816217_217_4168852" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557846816217_217_996859">
                                        <p id="1557846816217_217_163020">= 0</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557846816217_217_8724276">
                                <table width="100%" class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" id="1557846816217_217_1404791"><tbody id="1557846816217_217_4697486"><tr id="1557846816217_217_3949078"><td class="column footer" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px; padding-bottom: 5px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846816218_218_1825734" data-fs="12px" data-lh="15px" data-pb="5px">US&amp;#00045;SIV&amp;#00045;00103 05/18  </td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column footer" valign="bottom" style="width:200px; font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557846763247_247_6926696" width="130">
                <div class="box box-element previewImg" data-type="image" id="1557846972079_79_6366474">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557846972079_79_3122899"><i class="fa fa-remove" id="1557846972079_79_3304463"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557846972079_79_519440"><i class="fa fa-arrows-alt" id="1557846972079_79_133393"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-14" id="1557846972079_79_5023924">
                    <i class="fa fa-copy" id="1557846972079_79_5606767"></i>
                    </a> 
                    <div class="preview" id="1557846972079_79_5587083">
                        <i class="fa fa-picture-o fa-2x" id="1557846972079_79_8682381"></i>
                        <div class="element-desc" id="1557846972079_79_1045565">Image</div>
                    </div>
                    <div class="view" id="1557846972079_79_6595849"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="130" height="109" id="1557846972079_79_683432"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                        <style id="1557847646476_476_3836953">@media screen and (max-width: 736px), print and (max-width: 320px){.mobilePadding { display: block !important; padding-left: 25px !important; padding-right: 25px !important; }}</style>
                        <style id="1557847673778_778_9158086">@media screen and (max-width: 736px), print and (max-width: 320px){.footer { width: 100% !important; display: block !important; }}</style>
                </div>
            </li>
            <?php
                }
            ?>
            <!-- responsive footer ends here -->
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/prevmisFooter.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Prevmis Footer</div>
                    </div>
                </div>
                <div class="view">
                   <div class="lyrow firstGridRow ui-draggable" id="1557842446864_864_9674029">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842446864_864_7989031"><i class="fa-remove fa" id="1557842446864_864_3895230"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842446864_864_2796647"><i class="fa fa-arrows-alt" id="1557842446864_864_3749344"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-2" id="1557842446864_864_6353083"><i class="fa fa-copy" id="1557842446864_864_6842521"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842446864_864_9234702"><i class="fa fa-angle-double-down" id="1557842446864_864_6929838"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842446864_864_4432297"><i class="fa fa-plus" id="1557842446864_864_8905287"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842446864_864_6538068"><i class="fa fa-clone" id="1557842446864_864_7840798"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842446864_864_4756202"><i class="fa fa-database" id="1557842446864_864_5071362"></i></a>
                            <div class="preview" id="1557842446864_864_449354">
                                <div class="row" id="1557842446864_864_3533942">
                                    <div class="col-md-8 gridInputColPadding" id="1557842446864_864_4201339">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842446864_864_5714742">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842446864_864_7256614">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842446864_864_1034249"><tr id="1557842446864_864_1283171"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842446864_864_7227759">
                        <div class="lyrow firstGridRow ui-draggable" id="1557842464185_185_1137367">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842464185_185_8572714"><i class="fa-remove fa" id="1557842464185_185_5152893"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842464185_185_6409046"><i class="fa fa-arrows-alt" id="1557842464185_185_4918037"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-7" id="1557842464185_185_4819690"><i class="fa fa-copy" id="1557842464185_185_5415533"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842464186_186_2966933"><i class="fa fa-angle-double-down" id="1557842464186_186_3597460"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842464186_186_7918353"><i class="fa fa-plus" id="1557842464186_186_4111956"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842464186_186_1931741"><i class="fa fa-clone" id="1557842464186_186_4366519"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842464186_186_6680974"><i class="fa fa-database" id="1557842464186_186_2444130"></i></a>
                            <div class="preview" id="1557842464186_186_3573852">
                                <div class="row" id="1557842464186_186_9758197">
                                    <div class="col-md-8 gridInputColPadding" id="1557842464186_186_6137015">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842464186_186_5278576">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842464186_186_8152032">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842464186_186_7802716"><tr id="1557842464186_186_1992377"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842464186_186_2070385">
                        <div class="lyrow firstGridRow ui-draggable" id="1557842491612_612_8778601">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842491612_612_6399051"><i class="fa-remove fa" id="1557842491612_612_7831641"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842491612_612_1512812"><i class="fa fa-arrows-alt" id="1557842491612_612_330553"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-16" id="1557842491612_612_9060077"><i class="fa fa-copy" id="1557842491612_612_1246112"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842491612_612_8015415"><i class="fa fa-angle-double-down" id="1557842491612_612_9926663"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842491612_612_8337599"><i class="fa fa-plus" id="1557842491612_612_2481791"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842491612_612_9870617"><i class="fa fa-clone" id="1557842491612_612_6995336"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842491612_612_4308654"><i class="fa fa-database" id="1557842491612_612_3281289"></i></a>
                            <div class="preview" id="1557842491612_612_4811730">
                                <div class="row" id="1557842491612_612_5319638">
                                    <div class="col-md-8 gridInputColPadding" id="1557842491612_612_7320084">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842491612_612_223270">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842491612_612_1343383">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842491612_612_1576114"><tr id="1557842491612_612_6880719"><td class="column" width="600" valign="top" height="1" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); background-color: rgb(190, 195, 200); line-height: 1px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842491612_612_3784740" bgcolor="#BEC3C8" data-lh="1px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557842494719_719_73126">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842494719_719_4999708"><i class="fa-remove fa" id="1557842494719_719_7459779"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842494719_719_6616190"><i class="fa fa-arrows-alt" id="1557842494719_719_4860439"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557842494719_719_8908159"><i class="fa fa-copy" id="1557842494719_719_1642902"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-20" id="1557842494719_719_2809411"><i class="fa fa-angle-double-down" id="1557842494719_719_8548960"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842494719_719_6740021"><i class="fa fa-plus" id="1557842494719_719_3977692"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842494719_719_5497406"><i class="fa fa-clone" id="1557842494719_719_652636"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842494719_719_1425177"><i class="fa fa-database" id="1557842494719_719_9296677"></i></a>
                            <div class="preview" id="1557842494719_719_3363599">
                                <div class="row" id="1557842494719_719_7498305">
                                    <div class="col-md-8 gridInputColPadding" id="1557842494719_719_5092783">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842494719_719_3631352">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842494719_719_4296338">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842494719_719_1066800"><tr id="1557842494719_719_2735184"><td class="column" width="600" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557842494719_719_2749639">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557842494202_202_4102124">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842494202_202_4094077"><i class="fa-remove fa" id="1557842494202_202_3145084"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842494202_202_1670960"><i class="fa fa-arrows-alt" id="1557842494202_202_115834"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557842494202_202_4811306"><i class="fa fa-copy" id="1557842494202_202_6772372"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-20" id="1557842494202_202_2217596"><i class="fa fa-angle-double-down" id="1557842494202_202_9926052"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842494202_202_5461785"><i class="fa fa-plus" id="1557842494202_202_6552667"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842494202_202_6805892"><i class="fa fa-clone" id="1557842494202_202_9074448"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842494203_203_2369541"><i class="fa fa-database" id="1557842494203_203_1889264"></i></a>
                            <div class="preview" id="1557842494203_203_6918966">
                                <div class="row" id="1557842494203_203_8617947">
                                    <div class="col-md-8 gridInputColPadding" id="1557842494203_203_5238809">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842494203_203_1566403">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842494203_203_8287638">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842494203_203_6918212"><tr id="1557842494203_203_3184335"><td class="column" width="600" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 16px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842494203_203_419760" data-fs="12px" data-lh="16px">
                        <div class="lyrow firstGridRow ui-draggable" id="1557842610562_562_4416063">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842610562_562_4649370"><i class="fa-remove fa" id="1557842610562_562_9252317"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842610562_562_3639866"><i class="fa fa-arrows-alt" id="1557842610562_562_7475603"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-37" id="1557842610562_562_9053290"><i class="fa fa-copy" id="1557842610562_562_9832617"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842610562_562_7832908"><i class="fa fa-angle-double-down" id="1557842610562_562_1886640"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842610562_562_7005050"><i class="fa fa-plus" id="1557842610562_562_6169911"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842610562_562_1622705"><i class="fa fa-clone" id="1557842610562_562_6052087"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842610562_562_1661644"><i class="fa fa-database" id="1557842610562_562_2713308"></i></a>
                            <div class="preview" id="1557842610562_562_8625178">
                                <div class="row" id="1557842610562_562_2545070">
                                    <div class="col-md-8 gridInputColPadding" id="1557842610562_562_8139131">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842610562_562_1522600">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842610562_562_3510997">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842610562_562_8061075"><tr id="1557842610562_562_1612995"><td class="column" width="160" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842610562_562_4487755">{{userPhoto}}</td><td class="column" width="440" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842610562_562_4936054">
                        <div class="lyrow firstGridRow ui-draggable" id="1557842634693_693_9823257">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842634693_693_5782830"><i class="fa-remove fa" id="1557842634693_693_1908445"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842634693_693_8932006"><i class="fa fa-arrows-alt" id="1557842634693_693_7564053"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-38" id="1557842634693_693_6587948"><i class="fa fa-copy" id="1557842634693_693_4579942"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842634693_693_5105263"><i class="fa fa-angle-double-down" id="1557842634693_693_5015087"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842634693_693_124753"><i class="fa fa-plus" id="1557842634693_693_5065592"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842634693_693_8193196"><i class="fa fa-clone" id="1557842634694_694_3494425"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842634694_694_6650090"><i class="fa fa-database" id="1557842634694_694_4990301"></i></a>
                            <div class="preview" id="1557842634694_694_7154377">
                                <div class="row" id="1557842634694_694_2721080">
                                    <div class="col-md-8 gridInputColPadding" id="1557842634694_694_5258504">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842634694_694_1829490">
                                        <p id="gridInputCount">= 440</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842634694_694_4407001">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="440"><tbody id="1557842634694_694_2023785"><tr id="1557842634694_694_7252630"><td class="column" width="440" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; padding-left: 6px;color:#666666;" data-color="#666666" data-ff="Arial, Helvetica, sans-serif" id="1557842634694_694_8717262" data-fs="16px" data-pl="6px"><strong id="1557842650887_887_8026588">{{userName}}</strong></td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557842635051_51_6431934">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842635051_51_4673968"><i class="fa-remove fa" id="1557842635051_51_6257368"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842635051_51_4700406"><i class="fa fa-arrows-alt" id="1557842635051_51_7527848"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-38" id="1557842635051_51_2278750"><i class="fa fa-copy" id="1557842635051_51_4229445"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842635051_51_4792227"><i class="fa fa-angle-double-down" id="1557842635051_51_6613317"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842635051_51_3909381"><i class="fa fa-plus" id="1557842635051_51_4797009"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842635051_51_74690"><i class="fa fa-clone" id="1557842635051_51_9477140"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842635051_51_5353463"><i class="fa fa-database" id="1557842635051_51_2468410"></i></a>
                            <div class="preview" id="1557842635051_51_4060568">
                                <div class="row" id="1557842635051_51_8217686">
                                    <div class="col-md-8 gridInputColPadding" id="1557842635051_51_5422890">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842635051_51_1369841">
                                        <p id="gridInputCount">= 440</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842635051_51_3580772">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="440"><tbody id="1557842635051_51_9300387"><tr id="1557842635051_51_9473626"><td class="column" width="440" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 18px; color: rgb(102, 102, 102); padding-top: 4px; padding-left: 6px;" data-color="#666666" data-ff="Arial, Helvetica, sans-serif" id="1557842635051_51_8161121" data-fs="16px" data-lh="18px" data-pt="4px" data-pl="6px"><em id="1557842710461_461_7991952">{{customText[Merck Customer Representative | Representing Merck, employed by inVentiv | Publicis Touchpoint Solutions Representative, providing services on behalf of Merck | Merck Customer Team Leader | Merck Account Executive | Merck Key Account Manager | Merck Solutions Consultant | Nurse Educator, employed by Rx Crossroads]}}</em></td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557842635384_384_8734321">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842635384_384_1941253"><i class="fa-remove fa" id="1557842635384_384_4327226"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842635384_384_9550736"><i class="fa fa-arrows-alt" id="1557842635385_385_9603723"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-38" id="1557842635385_385_1827454"><i class="fa fa-copy" id="1557842635385_385_515900"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842635385_385_9012712"><i class="fa fa-angle-double-down" id="1557842635385_385_9566271"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842635385_385_7370629"><i class="fa fa-plus" id="1557842635385_385_3614116"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842635385_385_7396927"><i class="fa fa-clone" id="1557842635385_385_4686855"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842635385_385_7305977"><i class="fa fa-database" id="1557842635385_385_5439782"></i></a>
                            <div class="preview" id="1557842635385_385_5092322">
                                <div class="row" id="1557842635385_385_7219454">
                                    <div class="col-md-8 gridInputColPadding" id="1557842635385_385_4704331">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842635385_385_7575812">
                                        <p id="gridInputCount">= 440</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842635385_385_7914678">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="left" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="440"><tbody id="1557842635385_385_2195880"><tr id="1557842635385_385_698076"><td class="column" width="440" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); padding-left: 6px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842635385_385_4554919" data-pl="6px">
                <div class="box box-element previewImg" data-type="image" id="1557842787469_469_2928055">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557842787469_469_4186214"><i class="fa fa-remove" id="1557842787469_469_4982860"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557842787469_469_4433489"><i class="fa fa-arrows-alt" id="1557842787469_469_5319110"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-40" id="1557842787469_469_203746">
                    <i class="fa fa-copy" id="1557842787469_469_5995474"></i>
                    </a> 
                    <div class="preview" id="1557842787469_469_73998">
                        <i class="fa fa-picture-o fa-2x" id="1557842787469_469_8198574"></i>
                        <div class="element-desc" id="1557842787469_469_5849491">Image</div>
                    </div>
                    <div class="view" id="1557842787469_469_9056355"> <img src="http://placehold.it/50x50" class="img-responsive images" alt="" width="50" height="50" id="1557842787469_469_6221734"> </div>
                </div>
            
                <div class="box box-element previewImg" data-type="image" id="1557842788453_453_6091782">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557842788453_453_6640089"><i class="fa fa-remove" id="1557842788453_453_4168914"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557842788453_453_7542233"><i class="fa fa-arrows-alt" id="1557842788453_453_6552675"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-40" id="1557842788453_453_5110637">
                    <i class="fa fa-copy" id="1557842788453_453_8069878"></i>
                    </a> 
                    <div class="preview" id="1557842788453_453_246700">
                        <i class="fa fa-picture-o fa-2x" id="1557842788453_453_2354339"></i>
                        <div class="element-desc" id="1557842788453_453_544964">Image</div>
                    </div>
                    <div class="view" id="1557842788453_453_6303905"> <img src="http://placehold.it/50x50" class="img-responsive images" alt="" width="50" height="50" id="1557842788453_453_7374657"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557842493643_643_2295218">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842493643_643_7408396"><i class="fa-remove fa" id="1557842493643_643_8517307"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842493643_643_1290795"><i class="fa fa-arrows-alt" id="1557842493643_643_8987448"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557842493643_643_5281503"><i class="fa fa-copy" id="1557842493643_643_7048885"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-20" id="1557842493643_643_8886081"><i class="fa fa-angle-double-down" id="1557842493644_644_5269652"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842493644_644_4318484"><i class="fa fa-plus" id="1557842493644_644_7714581"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842493644_644_2508083"><i class="fa fa-clone" id="1557842493644_644_4268994"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842493644_644_9905727"><i class="fa fa-database" id="1557842493644_644_9181111"></i></a>
                            <div class="preview" id="1557842493644_644_6361377">
                                <div class="row" id="1557842493644_644_3948800">
                                    <div class="col-md-8 gridInputColPadding" id="1557842493644_644_8706153">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842493644_644_2258024">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842493644_644_5454243">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842493644_644_4069432"><tr id="1557842493644_644_7824718"><td class="column" width="600" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557842493644_644_2829059">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                    </td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557842465987_987_8317085">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842465987_987_8549759"><i class="fa-remove fa" id="1557842465987_987_3437895"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842465987_987_548100"><i class="fa fa-arrows-alt" id="1557842465987_987_4109956"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557842465987_987_4146417"><i class="fa fa-copy" id="1557842465987_987_3297127"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-11" id="1557842465987_987_107078"><i class="fa fa-angle-double-down" id="1557842465987_987_5739461"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842465987_987_454949"><i class="fa fa-plus" id="1557842465987_987_1609568"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842465987_987_5727757"><i class="fa fa-clone" id="1557842465987_987_8069384"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842465987_987_604493"><i class="fa fa-database" id="1557842465987_987_4718701"></i></a>
                            <div class="preview" id="1557842465987_987_5591132">
                                <div class="row" id="1557842465987_987_1345988">
                                    <div class="col-md-8 gridInputColPadding" id="1557842465987_987_5008790">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842465987_987_6382754">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842465987_987_3337281">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842465987_987_2382838"><tr id="1557842465987_987_6632254"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842465987_987_6433846">
                        
                        
                    
                        
                    
                        
                    
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557842947846_846_5500207">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842947846_846_8923977"><i class="fa-remove fa" id="1557842947846_846_6697833"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842947846_846_372188"><i class="fa fa-arrows-alt" id="1557842947846_846_1864732"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-49" id="1557842947846_846_2269489"><i class="fa fa-copy" id="1557842947846_846_9578210"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842947846_846_5754268"><i class="fa fa-angle-double-down" id="1557842947846_846_9856620"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842947846_846_988903"><i class="fa fa-plus" id="1557842947846_846_9788502"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842947846_846_5367584"><i class="fa fa-clone" id="1557842947846_846_5614980"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842947846_846_1763416"><i class="fa fa-database" id="1557842947846_846_150143"></i></a>
                            <div class="preview" id="1557842947846_846_7673364">
                                <div class="row" id="1557842947846_846_6363387">
                                    <div class="col-md-8 gridInputColPadding" id="1557842947847_847_6287521">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842947847_847_6819780">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842947847_847_7878347">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842947847_847_995269"><tr id="1557842947847_847_1763409"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842947847_847_8038341">
                        <div class="lyrow firstGridRow ui-draggable" id="1557842984848_848_4693794">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557842984848_848_162637"><i class="fa-remove fa" id="1557842984848_848_5852156"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557842984848_848_193850"><i class="fa fa-arrows-alt" id="1557842984848_848_1853787"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-53" id="1557842984848_848_8622761"><i class="fa fa-copy" id="1557842984848_848_325033"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557842984848_848_1916953"><i class="fa fa-angle-double-down" id="1557842984848_848_984411"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557842984848_848_396133"><i class="fa fa-plus" id="1557842984848_848_4302702"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557842984848_848_724901"><i class="fa fa-clone" id="1557842984848_848_8541579"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557842984848_848_8681445"><i class="fa fa-database" id="1557842984848_848_4230667"></i></a>
                            <div class="preview" id="1557842984848_848_1786016">
                                <div class="row" id="1557842984848_848_9147631">
                                    <div class="col-md-8 gridInputColPadding" id="1557842984848_848_9096853">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557842984848_848_4155466">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557842984848_848_2626235">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557842984848_848_8205137"><tr id="1557842984848_848_3020004"><td class="column" width="400" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842984848_848_573006">
                        <div class="lyrow firstGridRow ui-draggable" id="1557843009735_735_3975978">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843009735_735_8904213"><i class="fa-remove fa" id="1557843009735_735_3460826"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843009735_735_692473"><i class="fa fa-arrows-alt" id="1557843009735_735_1880424"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843009735_735_6920173"><i class="fa fa-copy" id="1557843009735_735_7028769"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843009735_735_1122285"><i class="fa fa-angle-double-down" id="1557843009735_735_3115768"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843009735_735_9018831"><i class="fa fa-plus" id="1557843009735_735_5084583"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843009735_735_2676862"><i class="fa fa-clone" id="1557843009736_736_7315577"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843009736_736_4503062"><i class="fa fa-database" id="1557843009736_736_1386472"></i></a>
                            <div class="preview" id="1557843009736_736_4673824">
                                <div class="row" id="1557843009736_736_1178386">
                                    <div class="col-md-8 gridInputColPadding" id="1557843009736_736_3742252">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843009736_736_8951887">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843009736_736_6462683">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843009736_736_2962230"><tr id="1557843009736_736_5920997"><td class="column" width="400" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557843009736_736_7512042" data-fs="12px" data-lh="15px">Should you have any questions regarding the content of this message, please contact your Merck representative at the number listed above.
</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843010103_103_2595431">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843010103_103_8523332"><i class="fa-remove fa" id="1557843010103_103_1219355"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843010103_103_6409139"><i class="fa fa-arrows-alt" id="1557843010103_103_6908293"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843010103_103_1495435"><i class="fa fa-copy" id="1557843010103_103_6576390"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843010103_103_8007658"><i class="fa fa-angle-double-down" id="1557843010103_103_6675064"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843010103_103_7131459"><i class="fa fa-plus" id="1557843010103_103_7816261"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843010103_103_4300392"><i class="fa fa-clone" id="1557843010103_103_9498284"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843010103_103_9338171"><i class="fa fa-database" id="1557843010103_103_3162886"></i></a>
                            <div class="preview" id="1557843010103_103_6947497">
                                <div class="row" id="1557843010103_103_5170512">
                                    <div class="col-md-8 gridInputColPadding" id="1557843010103_103_4237619">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843010103_103_2848898">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843010103_103_9025758">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843010103_103_4254635"><tr id="1557843010103_103_5745395"><td class="column" width="400" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557843010103_103_6310686">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843010503_503_1836944">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843010504_504_3649273"><i class="fa-remove fa" id="1557843010504_504_6707983"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843010504_504_9145712"><i class="fa fa-arrows-alt" id="1557843010504_504_2081205"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843010504_504_2940735"><i class="fa fa-copy" id="1557843010504_504_5123312"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843010504_504_6503051"><i class="fa fa-angle-double-down" id="1557843010504_504_5890504"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843010504_504_1868953"><i class="fa fa-plus" id="1557843010504_504_8211485"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843010504_504_4519322"><i class="fa fa-clone" id="1557843010504_504_6877444"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843010504_504_5366966"><i class="fa fa-database" id="1557843010504_504_3994630"></i></a>
                            <div class="preview" id="1557843010504_504_1353096">
                                <div class="row" id="1557843010504_504_3295953">
                                    <div class="col-md-8 gridInputColPadding" id="1557843010504_504_8076517">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843010504_504_5252571">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843010504_504_7312488">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843010504_504_4193710"><tr id="1557843010504_504_321682"><td class="column" width="400" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557843010504_504_7174485" data-fs="12px" data-lh="15px">You received this e&amp;#00045;mail because you requested information from either your Merck representative, you previously signed up to receive e&amp;#00045;mail communications from <strong id="1557843109122_122_1147436">Merck &amp;#00038; Co., Inc.,</strong> or you had provided your e&amp;#00045;mail consent to one of our trusted 3rd party vendors. If you no longer wish to receive e&amp;#00045;mail communications from your representatives, please <a id="1557843136365_365_3071957" href="{{unsubscribe_product_link}}" alias="click here" target="_blank" style="color: rgb(88, 88, 88); text-decoration: underline;">click here</a> to submit your request to opt&amp;#00045;out.
</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843010919_919_3963868">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843010919_919_8120380"><i class="fa-remove fa" id="1557843010919_919_8142717"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843010919_919_6839938"><i class="fa fa-arrows-alt" id="1557843010919_919_1506941"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843010919_919_6627656"><i class="fa fa-copy" id="1557843010919_919_4187731"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843010919_919_7139124"><i class="fa fa-angle-double-down" id="1557843010919_919_9568594"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843010919_919_917613"><i class="fa fa-plus" id="1557843010919_919_6367997"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843010919_919_7756569"><i class="fa fa-clone" id="1557843010919_919_3450375"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843010919_919_1798254"><i class="fa fa-database" id="1557843010919_919_1814617"></i></a>
                            <div class="preview" id="1557843010919_919_1450920">
                                <div class="row" id="1557843010919_919_6578462">
                                    <div class="col-md-8 gridInputColPadding" id="1557843010919_919_2410360">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843010919_919_1488032">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843010919_919_9116737">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843010919_919_8538420"><tr id="1557843010919_919_8975169"><td class="column" width="400" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557843010919_919_3521579">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843011335_335_2698747">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843011335_335_3739827"><i class="fa-remove fa" id="1557843011335_335_2110378"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843011335_335_3881831"><i class="fa fa-arrows-alt" id="1557843011335_335_4262200"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843011335_335_1244195"><i class="fa fa-copy" id="1557843011335_335_5322184"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843011335_335_8820969"><i class="fa fa-angle-double-down" id="1557843011335_335_7511162"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843011336_336_5260654"><i class="fa fa-plus" id="1557843011336_336_772326"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843011336_336_3970025"><i class="fa fa-clone" id="1557843011336_336_7627690"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843011336_336_6097345"><i class="fa fa-database" id="1557843011336_336_5343898"></i></a>
                            <div class="preview" id="1557843011336_336_1131186">
                                <div class="row" id="1557843011336_336_9873770">
                                    <div class="col-md-8 gridInputColPadding" id="1557843011336_336_9276699">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843011336_336_3208541">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843011336_336_2705662">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843011336_336_1106196"><tr id="1557843011336_336_4143414"><td class="column" width="400" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557843011336_336_1900431" data-fs="12px" data-lh="15px">Copyright &amp;#00169; 2019 Merck Sharp &amp;#00038; Dohme Corp., a subsidiary of <strong id="1557843186029_29_4801441">Merck &amp;#00038; Co., Inc.</strong> All rights reserved.   </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843011719_719_8094750">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843011719_719_9553826"><i class="fa-remove fa" id="1557843011719_719_2084953"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843011719_719_66172"><i class="fa fa-arrows-alt" id="1557843011719_719_7339843"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843011719_719_2709709"><i class="fa fa-copy" id="1557843011719_719_6931505"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843011719_719_4018742"><i class="fa fa-angle-double-down" id="1557843011719_719_5684315"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843011719_719_7860354"><i class="fa fa-plus" id="1557843011719_719_319614"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843011719_719_7297338"><i class="fa fa-clone" id="1557843011719_719_1376541"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843011719_719_2841357"><i class="fa fa-database" id="1557843011719_719_1606295"></i></a>
                            <div class="preview" id="1557843011719_719_5048619">
                                <div class="row" id="1557843011719_719_5549979">
                                    <div class="col-md-8 gridInputColPadding" id="1557843011719_719_5106415">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843011719_719_9321198">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843011719_719_3386362">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843011719_719_9683062"><tr id="1557843011719_719_588914"><td class="column" width="400" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557843011719_719_2376540">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843012129_129_2111928">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843012129_129_9546934"><i class="fa-remove fa" id="1557843012129_129_7930204"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843012129_129_1497942"><i class="fa fa-arrows-alt" id="1557843012129_129_9254444"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843012129_129_6110770"><i class="fa fa-copy" id="1557843012129_129_3706040"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843012129_129_1071633"><i class="fa fa-angle-double-down" id="1557843012129_129_4910982"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843012129_129_7429968"><i class="fa fa-plus" id="1557843012129_129_4811803"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843012129_129_6325525"><i class="fa fa-clone" id="1557843012129_129_880271"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843012129_129_8547182"><i class="fa fa-database" id="1557843012129_129_9193009"></i></a>
                            <div class="preview" id="1557843012129_129_2338628">
                                <div class="row" id="1557843012129_129_5687391">
                                    <div class="col-md-8 gridInputColPadding" id="1557843012129_129_503386">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843012129_129_9742679">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843012129_129_7643642">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843012129_129_6853678"><tr id="1557843012129_129_2080838"><td class="column" width="400" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557843012129_129_4333463" data-fs="12px" data-lh="15px">Please read our <a id="1557843214598_598_1417146" href="http://www.merck.com/about/how-we-operate/privacy/internet-privacy-policy.html" alias="privacy policy" target="_blank" style="color: rgb(88, 88, 88); text-decoration: underline;">Privacy Policy</a> to learn more about how Merck protects personal information about you.
</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843012510_510_5719710">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843012510_510_8748708"><i class="fa-remove fa" id="1557843012510_510_718744"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843012510_510_1965671"><i class="fa fa-arrows-alt" id="1557843012510_510_129160"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843012510_510_3214962"><i class="fa fa-copy" id="1557843012510_510_6372602"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843012510_510_2417439"><i class="fa fa-angle-double-down" id="1557843012510_510_4885071"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843012510_510_4030264"><i class="fa fa-plus" id="1557843012510_510_8320831"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843012510_510_2866396"><i class="fa fa-clone" id="1557843012510_510_6033097"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843012510_510_8821861"><i class="fa fa-database" id="1557843012510_510_8470002"></i></a>
                            <div class="preview" id="1557843012510_510_346381">
                                <div class="row" id="1557843012510_510_1472589">
                                    <div class="col-md-8 gridInputColPadding" id="1557843012510_510_8054934">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843012510_510_4069223">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843012510_510_1139280">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843012510_510_3762482"><tr id="1557843012510_510_8097845"><td class="column" width="400" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557843012510_510_2600508">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843012902_902_6906015">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843012902_902_2091873"><i class="fa-remove fa" id="1557843012902_902_3854224"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843012902_902_5573984"><i class="fa fa-arrows-alt" id="1557843012902_902_5584367"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843012902_902_4086587"><i class="fa fa-copy" id="1557843012902_902_245904"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843012902_902_2961173"><i class="fa fa-angle-double-down" id="1557843012902_902_6832204"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843012902_902_1483739"><i class="fa fa-plus" id="1557843012902_902_2756053"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843012902_902_9295720"><i class="fa fa-clone" id="1557843012902_902_2841833"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843012902_902_5516335"><i class="fa fa-database" id="1557843012903_903_3525567"></i></a>
                            <div class="preview" id="1557843012903_903_6661869">
                                <div class="row" id="1557843012903_903_9959360">
                                    <div class="col-md-8 gridInputColPadding" id="1557843012903_903_6153159">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843012903_903_4462625">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843012903_903_3611732">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843012903_903_418528"><tr id="1557843012903_903_5441668"><td class="column" width="400" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557843012903_903_3119694" data-fs="12px" data-lh="15px">Merck Privacy Office, 351 N Sumneytown Pike, UG4B&amp;#00045;24, North Wales, PA 19454, USA
</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843013271_271_4126953">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843013271_271_4586621"><i class="fa-remove fa" id="1557843013271_271_609191"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843013271_271_9397857"><i class="fa fa-arrows-alt" id="1557843013271_271_7220091"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843013271_271_1876581"><i class="fa fa-copy" id="1557843013271_271_178395"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843013271_271_3286729"><i class="fa fa-angle-double-down" id="1557843013271_271_4561821"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843013271_271_6433400"><i class="fa fa-plus" id="1557843013271_271_2100"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843013271_271_5304473"><i class="fa fa-clone" id="1557843013271_271_3901638"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843013271_271_6920960"><i class="fa fa-database" id="1557843013271_271_5236655"></i></a>
                            <div class="preview" id="1557843013271_271_2997039">
                                <div class="row" id="1557843013271_271_1272209">
                                    <div class="col-md-8 gridInputColPadding" id="1557843013271_271_4205266">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843013271_271_7813101">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843013271_271_2434732">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843013271_271_650810"><tr id="1557843013271_271_6521966"><td class="column" width="400" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557843013271_271_7126084">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557843014102_102_438492">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557843014102_102_3927609"><i class="fa-remove fa" id="1557843014102_102_4982514"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557843014102_102_2173340"><i class="fa fa-arrows-alt" id="1557843014102_102_2251848"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-57" id="1557843014102_102_1183433"><i class="fa fa-copy" id="1557843014102_102_7092415"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557843014102_102_333924"><i class="fa fa-angle-double-down" id="1557843014102_102_7053758"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557843014102_102_4383718"><i class="fa fa-plus" id="1557843014102_102_4476155"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557843014102_102_7722594"><i class="fa fa-clone" id="1557843014102_102_8862858"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557843014102_102_2178638"><i class="fa fa-database" id="1557843014102_102_1021776"></i></a>
                            <div class="preview" id="1557843014102_102_8196403">
                                <div class="row" id="1557843014102_102_4022020">
                                    <div class="col-md-8 gridInputColPadding" id="1557843014102_102_7643919">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557843014102_102_7991901">
                                        <p id="gridInputCount">= 400</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557843014102_102_9146960">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="400"><tbody id="1557843014102_102_4441246"><tr id="1557843014102_102_4732951"><td class="column" width="400" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 12px; line-height: 15px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557843014102_102_5030205" data-fs="12px" data-lh="15px">AINF&amp;#00045;1246132&amp;#00045;0007 02/19
</td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="470" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842984848_848_5185771">&nbsp;</td><td class="column" width="130" valign="bottom" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557842984848_848_237728">
                <div class="box box-element previewImg" data-type="image" id="1557843254161_161_9047924">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557843254161_161_6603720"><i class="fa fa-remove" id="1557843254161_161_2134871"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557843254161_161_2454883"><i class="fa fa-arrows-alt" id="1557843254161_161_4015451"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-59" id="1557843254161_161_957796">
                    <i class="fa fa-copy" id="1557843254161_161_3965315"></i>
                    </a> 
                    <div class="preview" id="1557843254161_161_6965957">
                        <i class="fa fa-picture-o fa-2x" id="1557843254161_161_1511621"></i>
                        <div class="element-desc" id="1557843254161_161_5142304">Image</div>
                    </div>
                    <div class="view" id="1557843254161_161_5892355"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="130" height="174" id="1557843254161_161_5644903"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                    </td></tr></tbody></table>
                            </div>
                        </div> 
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/vaqtaFooter.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Vaqta Footer</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557844149526_526_657587">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844149526_526_3816422"><i class="fa-remove fa" id="1557844149526_526_345932"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844149526_526_3504372"><i class="fa fa-arrows-alt" id="1557844149526_526_3417162"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-88" id="1557844149526_526_5447888"><i class="fa fa-copy" id="1557844149526_526_2576304"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844149526_526_9128547"><i class="fa fa-angle-double-down" id="1557844149526_526_8573390"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844149526_526_232987"><i class="fa fa-plus" id="1557844149526_526_5399140"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844149526_526_9557339"><i class="fa fa-clone" id="1557844149526_526_7948857"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844149526_526_7497423"><i class="fa fa-database" id="1557844149526_526_8803622"></i></a>
                            <div class="preview" id="1557844149526_526_1671080">
                                <div class="row" id="1557844149526_526_3288645">
                                    <div class="col-md-8 gridInputColPadding" id="1557844149526_526_898376">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844149526_526_5140186">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844149526_526_3903465">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557844149526_526_8373984"><tr id="1557844149527_527_4858920"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844149527_527_9619279">
                        <div class="lyrow firstGridRow ui-draggable" id="1557844182860_860_3583987">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844182860_860_1989965"><i class="fa-remove fa" id="1557844182860_860_743010"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844182860_860_1055581"><i class="fa fa-arrows-alt" id="1557844182860_860_8132456"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-94" id="1557844182860_860_993084"><i class="fa fa-copy" id="1557844182860_860_1856745"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844182860_860_2591827"><i class="fa fa-angle-double-down" id="1557844182860_860_9825940"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844182860_860_5563061"><i class="fa fa-plus" id="1557844182860_860_2530543"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844182860_860_548638"><i class="fa fa-clone" id="1557844182860_860_3981479"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844182860_860_5949864"><i class="fa fa-database" id="1557844182860_860_6517440"></i></a>
                            <div class="preview" id="1557844182861_861_6326641">
                                <div class="row" id="1557844182861_861_8426068">
                                    <div class="col-md-8 gridInputColPadding" id="1557844182861_861_6951585">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844182861_861_563677">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844182861_861_9315922">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557844182861_861_1278244"><tr id="1557844182861_861_5293244"><td class="column" width="12" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844182861_861_4836057">&nbsp;</td><td class="column" width="524" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844182861_861_8459036">
                        <div class="lyrow firstGridRow ui-draggable" id="1557844217750_750_9010317">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844217750_750_6936263"><i class="fa-remove fa" id="1557844217750_750_160331"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844217750_750_6528437"><i class="fa fa-arrows-alt" id="1557844217750_750_212523"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844217750_750_5325459"><i class="fa fa-copy" id="1557844217750_750_7373509"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844217750_750_9575744"><i class="fa fa-angle-double-down" id="1557844217750_750_1095323"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844217750_750_5939574"><i class="fa fa-plus" id="1557844217750_750_2258446"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844217750_750_1739716"><i class="fa fa-clone" id="1557844217750_750_3779598"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844217750_750_7407572"><i class="fa fa-database" id="1557844217750_750_7709373"></i></a>
                            <div class="preview" id="1557844217750_750_5438110">
                                <div class="row" id="1557844217750_750_7863922">
                                    <div class="col-md-8 gridInputColPadding" id="1557844217750_750_5789404">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844217750_750_8442700">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844217750_750_9891980">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844217750_750_612146"><tr id="1557844217750_750_9919601"><td class="column" width="524" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557844217750_750_5232413">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844218517_517_4902193">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844218517_517_4476633"><i class="fa-remove fa" id="1557844218517_517_142499"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844218517_517_4427027"><i class="fa fa-arrows-alt" id="1557844218517_517_5139603"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844218517_517_2601389"><i class="fa fa-copy" id="1557844218517_517_7810544"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844218517_517_3565870"><i class="fa fa-angle-double-down" id="1557844218517_517_4493133"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844218517_517_1567723"><i class="fa fa-plus" id="1557844218517_517_668831"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844218517_517_3673743"><i class="fa fa-clone" id="1557844218517_517_9086981"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844218517_517_7047587"><i class="fa fa-database" id="1557844218517_517_6523458"></i></a>
                            <div class="preview" id="1557844218517_517_9886561">
                                <div class="row" id="1557844218517_517_5258496">
                                    <div class="col-md-8 gridInputColPadding" id="1557844218517_517_9134163">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844218517_517_9949743">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844218517_517_6798839">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844218517_517_349039"><tr id="1557844218517_517_7074477"><td class="column" width="524" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844218517_517_2288443">
                        <div class="lyrow firstGridRow ui-draggable" id="1557844299620_620_9179655">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844299620_620_8541785"><i class="fa-remove fa" id="1557844299620_620_9693690"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844299620_620_3483777"><i class="fa fa-arrows-alt" id="1557844299620_620_3714871"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-108" id="1557844299620_620_7133721"><i class="fa fa-copy" id="1557844299620_620_7842103"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844299620_620_1577767"><i class="fa fa-angle-double-down" id="1557844299620_620_8556377"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844299620_620_1085894"><i class="fa fa-plus" id="1557844299620_620_3566682"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844299620_620_6559989"><i class="fa fa-clone" id="1557844299620_620_9577431"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844299620_620_5159918"><i class="fa fa-database" id="1557844299620_620_1662304"></i></a>
                            <div class="preview" id="1557844299620_620_5605785">
                                <div class="row" id="1557844299620_620_4300862">
                                    <div class="col-md-8 gridInputColPadding" id="1557844299620_620_50344">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844299620_620_385797">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844299620_620_8471163">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844299620_620_2568808"><tr id="1557844299620_620_4006225"><td class="column" width="504" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 11px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844299620_620_7505708" data-fs="11px" data-lh="14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua   </td><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844299620_620_709092">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844218871_871_6012319">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844218871_871_459911"><i class="fa-remove fa" id="1557844218871_871_364395"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844218871_871_7791754"><i class="fa fa-arrows-alt" id="1557844218871_871_2482990"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844218871_871_6489463"><i class="fa fa-copy" id="1557844218871_871_7327582"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844218871_871_5587142"><i class="fa fa-angle-double-down" id="1557844218871_871_6250559"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844218872_872_1513621"><i class="fa fa-plus" id="1557844218872_872_3823665"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844218872_872_1559828"><i class="fa fa-clone" id="1557844218872_872_136017"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844218872_872_4014040"><i class="fa fa-database" id="1557844218872_872_8838364"></i></a>
                            <div class="preview" id="1557844218872_872_1535975">
                                <div class="row" id="1557844218872_872_6571328">
                                    <div class="col-md-8 gridInputColPadding" id="1557844218872_872_2048472">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844218872_872_5062076">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844218872_872_8939187">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844218872_872_5025076"><tr id="1557844218872_872_9399459"><td class="column" width="524" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557844218872_872_9350473">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844219199_199_3153311">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844219199_199_6636866"><i class="fa-remove fa" id="1557844219199_199_2790114"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844219199_199_4786245"><i class="fa fa-arrows-alt" id="1557844219199_199_7491817"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844219199_199_5342039"><i class="fa fa-copy" id="1557844219200_200_6877717"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844219200_200_6465739"><i class="fa fa-angle-double-down" id="1557844219200_200_7389995"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844219200_200_5509256"><i class="fa fa-plus" id="1557844219200_200_3127212"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844219200_200_7648737"><i class="fa fa-clone" id="1557844219200_200_4156077"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844219200_200_9245442"><i class="fa fa-database" id="1557844219200_200_190997"></i></a>
                            <div class="preview" id="1557844219200_200_1503231">
                                <div class="row" id="1557844219200_200_309650">
                                    <div class="col-md-8 gridInputColPadding" id="1557844219200_200_9338475">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844219200_200_4424721">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844219200_200_6221358">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844219200_200_2856451"><tr id="1557844219200_200_245498"><td class="column" width="524" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844219200_200_9352132">
                        <div class="lyrow firstGridRow ui-draggable" id="1557844337868_868_5525996">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844337868_868_942869"><i class="fa-remove fa" id="1557844337868_868_2839930"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844337868_868_418144"><i class="fa fa-arrows-alt" id="1557844337868_868_4321196"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-112" id="1557844337868_868_3633629"><i class="fa fa-copy" id="1557844337868_868_350188"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844337868_868_5377790"><i class="fa fa-angle-double-down" id="1557844337868_868_554544"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844337868_868_5521776"><i class="fa fa-plus" id="1557844337868_868_8967272"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844337868_868_3430869"><i class="fa fa-clone" id="1557844337868_868_9642481"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844337869_869_5033260"><i class="fa fa-database" id="1557844337869_869_7577387"></i></a>
                            <div class="preview" id="1557844337869_869_9970474">
                                <div class="row" id="1557844337869_869_5033612">
                                    <div class="col-md-8 gridInputColPadding" id="1557844337869_869_6513021">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844337869_869_7680760">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844337869_869_4414383">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844337869_869_7994410"><tr id="1557844337869_869_2045765"><td class="column" width="494" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 11px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844337869_869_3335616" data-fs="11px" data-lh="14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua   </td><td class="column" width="30" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844337869_869_4007176">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844219527_527_4070973">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844219527_527_4982523"><i class="fa-remove fa" id="1557844219527_527_3338849"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844219527_527_2198697"><i class="fa fa-arrows-alt" id="1557844219527_527_4312051"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844219527_527_1743847"><i class="fa fa-copy" id="1557844219527_527_5806558"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844219527_527_7929218"><i class="fa fa-angle-double-down" id="1557844219527_527_9272684"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844219527_527_8599664"><i class="fa fa-plus" id="1557844219527_527_8122151"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844219527_527_4857324"><i class="fa fa-clone" id="1557844219527_527_120970"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844219527_527_4511760"><i class="fa fa-database" id="1557844219527_527_4131131"></i></a>
                            <div class="preview" id="1557844219527_527_3122372">
                                <div class="row" id="1557844219527_527_3811087">
                                    <div class="col-md-8 gridInputColPadding" id="1557844219527_527_9527399">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844219527_527_2435233">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844219527_527_1474688">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844219527_527_5565643"><tr id="1557844219528_528_6836111"><td class="column" width="524" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557844219528_528_9858585">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844219843_843_2477211">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844219843_843_5610237"><i class="fa-remove fa" id="1557844219843_843_958591"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844219843_843_9647892"><i class="fa fa-arrows-alt" id="1557844219844_844_2468968"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844219844_844_4548376"><i class="fa fa-copy" id="1557844219844_844_4761811"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844219844_844_4263232"><i class="fa fa-angle-double-down" id="1557844219844_844_9637291"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844219844_844_6282174"><i class="fa fa-plus" id="1557844219844_844_3755406"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844219844_844_2789067"><i class="fa fa-clone" id="1557844219844_844_3492850"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844219844_844_3921608"><i class="fa fa-database" id="1557844219844_844_9616263"></i></a>
                            <div class="preview" id="1557844219844_844_3834675">
                                <div class="row" id="1557844219844_844_9078373">
                                    <div class="col-md-8 gridInputColPadding" id="1557844219844_844_1629721">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844219844_844_7093172">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844219844_844_3264250">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844219844_844_3757609"><tr id="1557844219844_844_5448584"><td class="column" width="524" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 11px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844219844_844_6451384" data-fs="11px" data-lh="14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844220162_162_1901584">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844220162_162_7620412"><i class="fa-remove fa" id="1557844220162_162_9812538"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844220162_162_7407654"><i class="fa fa-arrows-alt" id="1557844220162_162_3914000"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844220162_162_5536614"><i class="fa fa-copy" id="1557844220162_162_2880646"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844220162_162_9842813"><i class="fa fa-angle-double-down" id="1557844220162_162_2448454"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844220162_162_7600893"><i class="fa fa-plus" id="1557844220162_162_709093"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844220162_162_1361899"><i class="fa fa-clone" id="1557844220162_162_2644045"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844220162_162_9325980"><i class="fa fa-database" id="1557844220162_162_9589424"></i></a>
                            <div class="preview" id="1557844220162_162_5405385">
                                <div class="row" id="1557844220162_162_6653368">
                                    <div class="col-md-8 gridInputColPadding" id="1557844220162_162_3689039">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844220162_162_726043">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844220162_162_3180291">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844220162_162_6249467"><tr id="1557844220162_162_2242878"><td class="column" width="524" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557844220162_162_5818175">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844220485_485_5797036">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844220485_485_3957144"><i class="fa-remove fa" id="1557844220485_485_2387055"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844220485_485_2564777"><i class="fa fa-arrows-alt" id="1557844220485_485_9503744"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844220485_485_7614008"><i class="fa fa-copy" id="1557844220485_485_9278515"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844220486_486_2653806"><i class="fa fa-angle-double-down" id="1557844220486_486_7606454"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844220486_486_5382310"><i class="fa fa-plus" id="1557844220486_486_7107981"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844220486_486_6398801"><i class="fa fa-clone" id="1557844220486_486_7726187"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844220486_486_7951419"><i class="fa fa-database" id="1557844220486_486_6127477"></i></a>
                            <div class="preview" id="1557844220486_486_8426174">
                                <div class="row" id="1557844220486_486_4760634">
                                    <div class="col-md-8 gridInputColPadding" id="1557844220486_486_2516488">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844220486_486_4347801">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844220486_486_7574214">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844220486_486_7442116"><tr id="1557844220486_486_7805045"><td class="column" width="524" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 11px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844220486_486_6032731" data-fs="11px" data-lh="14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844220799_799_6605609">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844220799_799_23084"><i class="fa-remove fa" id="1557844220799_799_7221408"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844220799_799_7370198"><i class="fa fa-arrows-alt" id="1557844220799_799_4455045"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844220799_799_2021465"><i class="fa fa-copy" id="1557844220799_799_3045332"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844220799_799_4067035"><i class="fa fa-angle-double-down" id="1557844220799_799_1082456"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844220799_799_3865995"><i class="fa fa-plus" id="1557844220799_799_3831589"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844220800_800_8695581"><i class="fa fa-clone" id="1557844220800_800_868187"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844220800_800_4935317"><i class="fa fa-database" id="1557844220800_800_3222965"></i></a>
                            <div class="preview" id="1557844220800_800_1878483">
                                <div class="row" id="1557844220800_800_1095153">
                                    <div class="col-md-8 gridInputColPadding" id="1557844220800_800_5982877">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844220800_800_360101">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844220800_800_8654604">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844220800_800_7470860"><tr id="1557844220801_801_9999598"><td class="column" width="524" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557844220801_801_3712426">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844221103_103_7689658">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844221103_103_9942732"><i class="fa-remove fa" id="1557844221103_103_9501609"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844221103_103_4997083"><i class="fa fa-arrows-alt" id="1557844221103_103_8099106"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844221103_103_6967218"><i class="fa fa-copy" id="1557844221103_103_7396566"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844221103_103_3194141"><i class="fa fa-angle-double-down" id="1557844221103_103_123250"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844221103_103_3781727"><i class="fa fa-plus" id="1557844221103_103_4749355"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844221103_103_2863650"><i class="fa fa-clone" id="1557844221103_103_2829380"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844221103_103_8549906"><i class="fa fa-database" id="1557844221103_103_2527434"></i></a>
                            <div class="preview" id="1557844221103_103_6517359">
                                <div class="row" id="1557844221103_103_2620138">
                                    <div class="col-md-8 gridInputColPadding" id="1557844221104_104_9178976">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844221104_104_4222874">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844221104_104_5805095">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844221104_104_592806"><tr id="1557844221104_104_9337047"><td class="column" width="524" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844221104_104_2852769">
                        <div class="lyrow firstGridRow ui-draggable" id="1557844402613_613_2244">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844402613_613_861163"><i class="fa-remove fa" id="1557844402613_613_339171"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844402613_613_8587394"><i class="fa fa-arrows-alt" id="1557844402613_613_8116393"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-116" id="1557844402613_613_6384906"><i class="fa fa-copy" id="1557844402613_613_5579837"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844402613_613_7889820"><i class="fa fa-angle-double-down" id="1557844402613_613_7473438"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844402613_613_7868277"><i class="fa fa-plus" id="1557844402613_613_3861706"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844402613_613_8524941"><i class="fa fa-clone" id="1557844402613_613_3189360"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844402613_613_7534644"><i class="fa fa-database" id="1557844402613_613_6380214"></i></a>
                            <div class="preview" id="1557844402613_613_7723323">
                                <div class="row" id="1557844402613_613_7490763">
                                    <div class="col-md-8 gridInputColPadding" id="1557844402613_613_3926535">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844402613_613_4171465">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844402613_613_6803006">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844402613_613_2199783"><tr id="1557844402613_613_6710109"><td class="column" width="457" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 11px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844402613_613_865205" data-fs="11px" data-lh="14px">MLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td><td class="column" width="67" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844402613_613_7588926">
                <div class="box box-element previewImg" data-type="image" id="1557844426415_415_2116748">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557844426415_415_4131252"><i class="fa fa-remove" id="1557844426415_415_3476228"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557844426415_415_29184"><i class="fa fa-arrows-alt" id="1557844426415_415_6988640"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-117" id="1557844426415_415_760998">
                    <i class="fa fa-copy" id="1557844426415_415_6772029"></i>
                    </a> 
                    <div class="preview" id="1557844426415_415_5290898">
                        <i class="fa fa-picture-o fa-2x" id="1557844426415_415_7613539"></i>
                        <div class="element-desc" id="1557844426416_416_1840681">Image</div>
                    </div>
                    <div class="view" id="1557844426416_416_2749769"> <img src="http://placehold.it/50x50" class="img-responsive images" alt="" width="67" height="20" id="1557844426416_416_9349915"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844221428_428_9059406">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844221428_428_5611879"><i class="fa-remove fa" id="1557844221428_428_964011"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844221429_429_3955300"><i class="fa fa-arrows-alt" id="1557844221429_429_5388347"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844221429_429_4429139"><i class="fa fa-copy" id="1557844221429_429_522978"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844221429_429_3815357"><i class="fa fa-angle-double-down" id="1557844221429_429_6878647"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844221429_429_1741772"><i class="fa fa-plus" id="1557844221429_429_1496056"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844221429_429_7392734"><i class="fa fa-clone" id="1557844221429_429_5443212"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844221429_429_6158756"><i class="fa fa-database" id="1557844221429_429_2342907"></i></a>
                            <div class="preview" id="1557844221429_429_9037671">
                                <div class="row" id="1557844221429_429_8046938">
                                    <div class="col-md-8 gridInputColPadding" id="1557844221429_429_8760706">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844221429_429_9637425">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844221429_429_793078">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844221429_429_4089369"><tr id="1557844221429_429_4067797"><td class="column" width="524" valign="top" height="4" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 4px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844221429_429_3478130" data-lh="4px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844221767_767_1318070">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844221767_767_2527661"><i class="fa-remove fa" id="1557844221767_767_7115614"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844221767_767_9827580"><i class="fa fa-arrows-alt" id="1557844221767_767_8541148"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-99" id="1557844221767_767_9545291"><i class="fa fa-copy" id="1557844221767_767_3490136"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844221767_767_8351631"><i class="fa fa-angle-double-down" id="1557844221767_767_4802520"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844221767_767_6212486"><i class="fa fa-plus" id="1557844221768_768_3965536"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844221768_768_9503344"><i class="fa fa-clone" id="1557844221768_768_4039339"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844221768_768_7528799"><i class="fa fa-database" id="1557844221768_768_3685016"></i></a>
                            <div class="preview" id="1557844221768_768_3747633">
                                <div class="row" id="1557844221768_768_1891150">
                                    <div class="col-md-8 gridInputColPadding" id="1557844221768_768_5038995">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844221768_768_8712827">
                                        <p id="gridInputCount">= 524</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844221768_768_7101332">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="524"><tbody id="1557844221768_768_4179924"><tr id="1557844221768_768_9107844"><td class="column" width="524" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 11px; line-height: 14px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844221768_768_5443270" data-fs="11px" data-lh="14px">US&amp;#00045;VAQ&amp;#00045;00029 03/19</td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="6" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844182861_861_3335770">&nbsp;</td><td class="column" width="46" valign="bottom" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844182861_861_4126435">
                        <div class="lyrow firstGridRow ui-draggable" id="1557844242728_728_7694248">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844242728_728_7092600"><i class="fa-remove fa" id="1557844242728_728_5834924"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844242728_728_8814728"><i class="fa fa-arrows-alt" id="1557844242728_728_9065394"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-103" id="1557844242728_728_5962770"><i class="fa fa-copy" id="1557844242728_728_6039980"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844242729_729_5258917"><i class="fa fa-angle-double-down" id="1557844242729_729_9217793"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844242729_729_1981753"><i class="fa fa-plus" id="1557844242729_729_7107618"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844242729_729_6634887"><i class="fa fa-clone" id="1557844242729_729_4082910"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844242729_729_326985"><i class="fa fa-database" id="1557844242729_729_2965849"></i></a>
                            <div class="preview" id="1557844242729_729_948738">
                                <div class="row" id="1557844242729_729_8493270">
                                    <div class="col-md-8 gridInputColPadding" id="1557844242729_729_751581">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844242729_729_1060140">
                                        <p id="gridInputCount">= 46</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844242729_729_1088962">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="46"><tbody id="1557844242729_729_3364685"><tr id="1557844242729_729_8534845"><td class="column" width="46" valign="top" height="54" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 54px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844242729_729_4366770" data-lh="54px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557844242880_880_8347604">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557844242881_881_5392663"><i class="fa-remove fa" id="1557844242881_881_6350363"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557844242881_881_5026167"><i class="fa fa-arrows-alt" id="1557844242881_881_7161752"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-103" id="1557844242881_881_8402137"><i class="fa fa-copy" id="1557844242881_881_5158497"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557844242881_881_8178823"><i class="fa fa-angle-double-down" id="1557844242881_881_9288607"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557844242881_881_2766594"><i class="fa fa-plus" id="1557844242881_881_1662820"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557844242881_881_6512144"><i class="fa fa-clone" id="1557844242881_881_4227951"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557844242881_881_1511156"><i class="fa fa-database" id="1557844242881_881_1269588"></i></a>
                            <div class="preview" id="1557844242881_881_2235903">
                                <div class="row" id="1557844242881_881_9222913">
                                    <div class="col-md-8 gridInputColPadding" id="1557844242881_881_4038385">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557844242881_881_7524881">
                                        <p id="gridInputCount">= 46</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557844242881_881_8949141">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="46"><tbody id="1557844242881_881_4517605"><tr id="1557844242881_881_1560575"><td class="column" width="46" valign="bottom" height="173" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557844242881_881_1704098">
                <div class="box box-element previewImg" data-type="image" id="1557844509982_982_5579574">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557844509982_982_7958750"><i class="fa fa-remove" id="1557844509982_982_5090300"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557844509982_982_2640515"><i class="fa fa-arrows-alt" id="1557844509982_982_8903676"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-128" id="1557844509982_982_3994972">
                    <i class="fa fa-copy" id="1557844509982_982_9521326"></i>
                    </a> 
                    <div class="preview" id="1557844509982_982_2216721">
                        <i class="fa fa-picture-o fa-2x" id="1557844509982_982_6413017"></i>
                        <div class="element-desc" id="1557844509982_982_3751544">Image</div>
                    </div>
                    <div class="view" id="1557844509982_982_4966725"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="46" height="173" id="1557844509982_982_5319670"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="12" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557844182861_861_7563874">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <!-- Fragments part -->
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/fragWithBgColor.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Fragment With BGColor</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557848174531_531_677949">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848174531_531_3217555"><i class="fa-remove fa" id="1557848174531_531_1248148"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848174531_531_9764230"><i class="fa fa-arrows-alt" id="1557848174531_531_4148172"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-162" id="1557848174531_531_3113344"><i class="fa fa-copy" id="1557848174531_531_5170885"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848174531_531_7513280"><i class="fa fa-angle-double-down" id="1557848174531_531_4039183"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848174531_531_3024801"><i class="fa fa-plus" id="1557848174531_531_187563"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848174531_531_7903337"><i class="fa fa-clone" id="1557848174531_531_5638038"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848174532_532_8130072"><i class="fa fa-database" id="1557848174532_532_2173140"></i></a>
                            <div class="preview" id="1557848174532_532_4747046">
                                <div class="row" id="1557848174532_532_802741">
                                    <div class="col-md-8 gridInputColPadding" id="1557848174532_532_647123">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848174532_532_8086192">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848174532_532_8430527">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only;background-color:#E3E3E2;" width="575" bgcolor="#E3E3E2"><tbody id="1557848174532_532_7867681"><tr id="1557848174532_532_6172119"><td class="column" width="575" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848174532_532_7382031">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848208315_315_963227">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848208315_315_8528161"><i class="fa-remove fa" id="1557848208315_315_4034132"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848208315_315_798931"><i class="fa fa-arrows-alt" id="1557848208315_315_9392407"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-165" id="1557848208315_315_5431627"><i class="fa fa-copy" id="1557848208315_315_6730228"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848208315_315_6035147"><i class="fa fa-angle-double-down" id="1557848208315_315_1152586"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848208315_315_2284293"><i class="fa fa-plus" id="1557848208315_315_8339935"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848208315_315_5319000"><i class="fa fa-clone" id="1557848208315_315_9029341"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848208315_315_6733507"><i class="fa fa-database" id="1557848208315_315_2628563"></i></a>
                            <div class="preview" id="1557848208315_315_2079829">
                                <div class="row" id="1557848208315_315_8891891">
                                    <div class="col-md-8 gridInputColPadding" id="1557848208315_315_4367072">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848208316_316_2085364">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848208316_316_3535551">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848208316_316_9649991"><tr id="1557848208316_316_8845123"><td class="column" width="575" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848208316_316_2023240">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848208867_867_2848200">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848208867_867_9010270"><i class="fa-remove fa" id="1557848208867_867_4243719"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848208867_867_9427644"><i class="fa fa-arrows-alt" id="1557848208867_867_8845905"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-165" id="1557848208867_867_4942785"><i class="fa fa-copy" id="1557848208867_867_5388125"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848208867_867_782"><i class="fa fa-angle-double-down" id="1557848208867_867_6845097"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848208867_867_7223317"><i class="fa fa-plus" id="1557848208867_867_1572188"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848208867_867_6618549"><i class="fa fa-clone" id="1557848208867_867_9606505"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848208867_867_9737407"><i class="fa fa-database" id="1557848208867_867_1864503"></i></a>
                            <div class="preview" id="1557848208867_867_7017704">
                                <div class="row" id="1557848208867_867_730083">
                                    <div class="col-md-8 gridInputColPadding" id="1557848208867_867_1569385">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848208867_867_9252233">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848208867_867_4787004">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848208867_867_6740822"><tr id="1557848208867_867_1088876"><td class="column" width="575" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848208867_867_6124439">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848241395_395_9751629">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848241395_395_740889"><i class="fa-remove fa" id="1557848241395_395_811279"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848241395_395_3670236"><i class="fa fa-arrows-alt" id="1557848241395_395_2646260"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-173" id="1557848241395_395_371075"><i class="fa fa-copy" id="1557848241395_395_8753992"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848241395_395_4942021"><i class="fa fa-angle-double-down" id="1557848241395_395_3004682"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848241396_396_5146104"><i class="fa fa-plus" id="1557848241396_396_7650414"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848241396_396_2442436"><i class="fa fa-clone" id="1557848241396_396_7794689"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848241396_396_5707319"><i class="fa fa-database" id="1557848241396_396_5927096"></i></a>
                            <div class="preview" id="1557848241396_396_9593219">
                                <div class="row" id="1557848241396_396_7971588">
                                    <div class="col-md-8 gridInputColPadding" id="1557848241396_396_3074053">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848241396_396_2372059">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848241396_396_2298766">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848241396_396_7964319"><tr id="1557848241396_396_4142510"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848241396_396_9288178">&nbsp;</td><td class="column" width="555" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(85, 85, 85); font-size: 24px; line-height: 27px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557848241396_396_5454368" data-fs="24px" data-lh="27px"><strong id="1557848255715_715_1956334">Lorem ipsum</strong></td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848209427_427_7328239">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848209427_427_8831836"><i class="fa-remove fa" id="1557848209427_427_6028577"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848209427_427_5501492"><i class="fa fa-arrows-alt" id="1557848209427_427_5341981"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-165" id="1557848209427_427_1635808"><i class="fa fa-copy" id="1557848209427_427_2636143"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848209427_427_9304379"><i class="fa fa-angle-double-down" id="1557848209427_427_7067075"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848209427_427_4076507"><i class="fa fa-plus" id="1557848209427_427_8254295"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848209427_427_3580382"><i class="fa fa-clone" id="1557848209428_428_784801"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848209428_428_5513072"><i class="fa fa-database" id="1557848209428_428_3314780"></i></a>
                            <div class="preview" id="1557848209428_428_290810">
                                <div class="row" id="1557848209428_428_1169314">
                                    <div class="col-md-8 gridInputColPadding" id="1557848209428_428_4056337">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848209428_428_9305226">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848209428_428_8045220">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848209428_428_8076573"><tr id="1557848209428_428_8435291"><td class="column" width="575" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848209428_428_6830901">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848314407_407_8961050">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848314407_407_4459536"><i class="fa-remove fa" id="1557848314407_407_9254494"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848314408_408_1715472"><i class="fa fa-arrows-alt" id="1557848314408_408_9840765"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-176" id="1557848314408_408_8978769"><i class="fa fa-copy" id="1557848314408_408_1468230"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848314408_408_7390221"><i class="fa fa-angle-double-down" id="1557848314408_408_8494120"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848314408_408_8654963"><i class="fa fa-plus" id="1557848314408_408_1939138"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848314408_408_7073657"><i class="fa fa-clone" id="1557848314408_408_9036773"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848314408_408_8846346"><i class="fa fa-database" id="1557848314408_408_7531123"></i></a>
                            <div class="preview" id="1557848314408_408_3946862">
                                <div class="row" id="1557848314408_408_3270060">
                                    <div class="col-md-8 gridInputColPadding" id="1557848314408_408_851865">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848314408_408_8738257">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848314408_408_371026">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848314408_408_9860082"><tr id="1557848314408_408_2258917"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848314408_408_8060754">&nbsp;</td><td class="column" width="535" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848314408_408_1362710" data-fs="17px" data-lh="20px">Duis autem vel eum iriure magnat inaspite consequat adis exped con remqui.</td><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848314408_408_2213821">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848315478_478_9216335">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848315478_478_1906001"><i class="fa-remove fa" id="1557848315478_478_3098267"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848315478_478_3091161"><i class="fa fa-arrows-alt" id="1557848315478_478_5771549"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-176" id="1557848315478_478_708778"><i class="fa fa-copy" id="1557848315478_478_8945424"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848315478_478_8669403"><i class="fa fa-angle-double-down" id="1557848315478_478_876003"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848315478_478_1637599"><i class="fa fa-plus" id="1557848315478_478_7124857"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848315478_478_2076408"><i class="fa fa-clone" id="1557848315478_478_6302124"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848315478_478_4540701"><i class="fa fa-database" id="1557848315478_478_7450864"></i></a>
                            <div class="preview" id="1557848315478_478_8225171">
                                <div class="row" id="1557848315478_478_7892631">
                                    <div class="col-md-8 gridInputColPadding" id="1557848315478_478_1468610">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848315478_478_6932294">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848315479_479_3895711">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848315479_479_1567401"><tr id="1557848315479_479_6781952"><td class="column" width="20" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848315479_479_6708506">&nbsp;</td><td class="column" width="535" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848315479_479_6425749">&nbsp;</td><td class="column" width="20" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848315479_479_2890441">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848368094_94_3179144">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848368094_94_2084592"><i class="fa-remove fa" id="1557848368094_94_9752396"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848368094_94_1509372"><i class="fa fa-arrows-alt" id="1557848368094_94_7269852"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-179" id="1557848368094_94_4941130"><i class="fa fa-copy" id="1557848368094_94_7618018"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848368094_94_1162446"><i class="fa fa-angle-double-down" id="1557848368094_94_19244"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848368094_94_3679567"><i class="fa fa-plus" id="1557848368094_94_2018727"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848368094_94_1597266"><i class="fa fa-clone" id="1557848368094_94_4236547"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848368094_94_3302574"><i class="fa fa-database" id="1557848368094_94_5872289"></i></a>
                            <div class="preview" id="1557848368095_95_8237600">
                                <div class="row" id="1557848368095_95_7380777">
                                    <div class="col-md-8 gridInputColPadding" id="1557848368095_95_8682641">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848368095_95_2807549">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848368095_95_3271812">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848368095_95_8012415"><tr id="1557848368095_95_7813718"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848368095_95_5169176">&nbsp;</td><td class="column" width="535" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848368095_95_5191314" data-fs="17px" data-lh="20px">Duis autem vel eum iriure magnat inaspite consequat adis exped con remqui.Duis autem vel eum iriure magnat inaspite consequat. Duis autem vel eum iriure magnat inaspite consequat adis exped con remqui.Duis autem vel eum iriure magnat inaspite consequat. Duis autem vel eum iriure magnat inaspite consequat adis exped con remqui.Duis autem vel eum iriure magnat inaspite consequat. </td><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848368095_95_7822187">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848214500_500_6689809">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848214500_500_9360439"><i class="fa-remove fa" id="1557848214500_500_674796"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848214500_500_1351736"><i class="fa fa-arrows-alt" id="1557848214500_500_8106945"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-167" id="1557848214500_500_1930572"><i class="fa fa-copy" id="1557848214500_500_5086921"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848214500_500_7431849"><i class="fa fa-angle-double-down" id="1557848214500_500_22527"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848214501_501_2539523"><i class="fa fa-plus" id="1557848214501_501_1308949"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848214501_501_6574331"><i class="fa fa-clone" id="1557848214501_501_559531"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848214501_501_697037"><i class="fa fa-database" id="1557848214501_501_3466235"></i></a>
                            <div class="preview" id="1557848214501_501_7082595">
                                <div class="row" id="1557848214501_501_5093247">
                                    <div class="col-md-8 gridInputColPadding" id="1557848214501_501_8445994">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848214501_501_4789235">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848214501_501_681354">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557848214501_501_732454"><tr id="1557848214501_501_6217772"><td class="column columnBorder" width="575" valign="top" height="50" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 50px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848214501_501_4015983" data-lh="50px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/fragmentTemplate.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Fragment Template</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557848725311_311_1616185">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848725311_311_7515634"><i class="fa-remove fa" id="1557848725312_312_4855976"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848725312_312_2578496"><i class="fa fa-arrows-alt" id="1557848725312_312_7705640"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-192" id="1557848725312_312_4605040"><i class="fa fa-copy" id="1557848725312_312_4786730"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848725312_312_5134302"><i class="fa fa-angle-double-down" id="1557848725312_312_1532758"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848725312_312_711264"><i class="fa fa-plus" id="1557848725312_312_4591727"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848725312_312_105634"><i class="fa fa-clone" id="1557848725312_312_1188152"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848725312_312_4486445"><i class="fa fa-database" id="1557848725312_312_1239877"></i></a>
                            <div class="preview" id="1557848725312_312_5284160">
                                <div class="row" id="1557848725313_313_1331113">
                                    <div class="col-md-8 gridInputColPadding" id="1557848725313_313_2884602">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848725313_313_1204010">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848725313_313_5169024">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848725313_313_1327652"><tr id="1557848725313_313_1471078"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848725313_313_183591">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848734716_716_371118">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848734716_716_2915941"><i class="fa-remove fa" id="1557848734716_716_3771238"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848734716_716_3915921"><i class="fa fa-arrows-alt" id="1557848734716_716_4168012"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-196" id="1557848734716_716_2002059"><i class="fa fa-copy" id="1557848734716_716_6882592"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848734716_716_5227358"><i class="fa fa-angle-double-down" id="1557848734716_716_5263778"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848734716_716_1458215"><i class="fa fa-plus" id="1557848734716_716_4576979"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848734716_716_7863952"><i class="fa fa-clone" id="1557848734716_716_2478216"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848734716_716_851727"><i class="fa fa-database" id="1557848734716_716_9940640"></i></a>
                            <div class="preview" id="1557848734716_716_5919005">
                                <div class="row" id="1557848734716_716_7590665">
                                    <div class="col-md-8 gridInputColPadding" id="1557848734716_716_3296569">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848734716_716_4151972">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848734716_716_3279632">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848734716_716_2656237"><tr id="1557848734716_716_2963825"><td class="column" width="600" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848734717_717_3345340">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848747262_262_4937186">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848747262_262_6068627"><i class="fa-remove fa" id="1557848747262_262_4526737"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848747262_262_6827470"><i class="fa fa-arrows-alt" id="1557848747262_262_9605410"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-197" id="1557848747262_262_7813790"><i class="fa fa-copy" id="1557848747262_262_205206"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848747262_262_8681603"><i class="fa fa-angle-double-down" id="1557848747262_262_8018464"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848747262_262_7246043"><i class="fa fa-plus" id="1557848747262_262_7052175"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848747262_262_4694325"><i class="fa fa-clone" id="1557848747262_262_180996"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848747262_262_7992557"><i class="fa fa-database" id="1557848747262_262_33876"></i></a>
                            <div class="preview" id="1557848747262_262_1613535">
                                <div class="row" id="1557848747262_262_1446660">
                                    <div class="col-md-8 gridInputColPadding" id="1557848747262_262_3569432">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848747263_263_8970190">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848747263_263_6192991">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848747263_263_6769218"><tr id="1557848747263_263_8852334"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848747263_263_2707178">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848777572_572_4612003">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848777572_572_5875703"><i class="fa-remove fa" id="1557848777572_572_9217777"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848777572_572_7830279"><i class="fa fa-arrows-alt" id="1557848777572_572_3280262"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-203" id="1557848777572_572_2668767"><i class="fa fa-copy" id="1557848777572_572_5870311"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848777572_572_9621999"><i class="fa fa-angle-double-down" id="1557848777572_572_8164629"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848777572_572_199459"><i class="fa fa-plus" id="1557848777572_572_5120121"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848777572_572_6169582"><i class="fa fa-clone" id="1557848777573_573_6700177"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848777573_573_3504044"><i class="fa fa-database" id="1557848777573_573_4981918"></i></a>
                            <div class="preview" id="1557848777573_573_5977183">
                                <div class="row" id="1557848777573_573_1498891">
                                    <div class="col-md-8 gridInputColPadding" id="1557848777573_573_9154641">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848777573_573_2284496">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848777573_573_2823968">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848777573_573_4280956"><tr id="1557848777573_573_5530008"><td class="column columnBorder" width="135" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848777573_573_3119794" height="135">
                <div class="box box-element previewImg" data-type="image" id="1557848830363_363_8418680">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557848830363_363_8923052"><i class="fa fa-remove" id="1557848830363_363_7438515"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557848830363_363_2045020"><i class="fa fa-arrows-alt" id="1557848830363_363_336747"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-209" id="1557848830363_363_4750617">
                    <i class="fa fa-copy" id="1557848830363_363_7714764"></i>
                    </a> 
                    <div class="preview" id="1557848830363_363_789285">
                        <i class="fa fa-picture-o fa-2x" id="1557848830363_363_6143896"></i>
                        <div class="element-desc" id="1557848830363_363_4167816">Image</div>
                    </div>
                    <div class="view" id="1557848830363_363_9550956"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="135" height="135" id="1557848830363_363_180624"> </div>
                </div>
            </td><td class="column" width="465" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848777573_573_2648756">&nbsp;</td><td class="column" width="445" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848777573_573_6967406">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848811339_339_1031474">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848811339_339_446632"><i class="fa-remove fa" id="1557848811339_339_542793"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848811339_339_2181880"><i class="fa fa-arrows-alt" id="1557848811339_339_2008898"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557848811339_339_2792400"><i class="fa fa-copy" id="1557848811339_339_216667"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848811339_339_2706651"><i class="fa fa-angle-double-down" id="1557848811339_339_9203438"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848811339_339_9284503"><i class="fa fa-plus" id="1557848811339_339_3904886"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848811339_339_5218839"><i class="fa fa-clone" id="1557848811340_340_5040777"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848811340_340_4755517"><i class="fa fa-database" id="1557848811340_340_5130404"></i></a>
                            <div class="preview" id="1557848811340_340_5482203">
                                <div class="row" id="1557848811340_340_1033255">
                                    <div class="col-md-8 gridInputColPadding" id="1557848811340_340_3150615">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848811340_340_1497109">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848811340_340_6137166">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848811340_340_6906438"><tr id="1557848811340_340_1848628"><td class="column" width="445" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 31px; line-height: 34px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848811340_340_9562406" data-fs="31px" data-lh="34px">Lorem Ipsum</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848811625_625_5082830">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848811625_625_4176130"><i class="fa-remove fa" id="1557848811625_625_3916161"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848811625_625_9937104"><i class="fa fa-arrows-alt" id="1557848811625_625_2935232"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557848811627_627_2370151"><i class="fa fa-copy" id="1557848811627_627_1012262"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848811628_628_6136494"><i class="fa fa-angle-double-down" id="1557848811628_628_1634745"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848811628_628_5964078"><i class="fa fa-plus" id="1557848811628_628_1538374"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848811628_628_7882876"><i class="fa fa-clone" id="1557848811628_628_1945292"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848811628_628_6958589"><i class="fa fa-database" id="1557848811628_628_2889523"></i></a>
                            <div class="preview" id="1557848811628_628_4972744">
                                <div class="row" id="1557848811628_628_3816504">
                                    <div class="col-md-8 gridInputColPadding" id="1557848811628_628_3348992">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848811628_628_6528651">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848811628_628_1187851">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848811628_628_1345483"><tr id="1557848811628_628_1202733"><td class="column" width="445" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848811628_628_8620335">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848811986_986_1837091">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848811986_986_6737289"><i class="fa-remove fa" id="1557848811986_986_1415213"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848811986_986_9306581"><i class="fa fa-arrows-alt" id="1557848811986_986_231408"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557848811986_986_436602"><i class="fa fa-copy" id="1557848811986_986_7630044"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848811986_986_7613086"><i class="fa fa-angle-double-down" id="1557848811986_986_8792051"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848811986_986_9088948"><i class="fa fa-plus" id="1557848811986_986_6788488"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848811986_986_8028419"><i class="fa fa-clone" id="1557848811986_986_446124"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848811986_986_4530366"><i class="fa fa-database" id="1557848811986_986_762312"></i></a>
                            <div class="preview" id="1557848811986_986_4981543">
                                <div class="row" id="1557848811986_986_4918472">
                                    <div class="col-md-8 gridInputColPadding" id="1557848811986_986_5482181">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848811986_986_7086897">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848811986_986_6598620">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848811986_986_4321624"><tr id="1557848811986_986_2613332"><td class="column" width="445" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 21px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848811987_987_8958477" data-fs="17px" data-lh="21px">swan carrots, enhanced undergraduate developer;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848813216_216_8230246">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848813216_216_6502678"><i class="fa-remove fa" id="1557848813216_216_9434535"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848813216_216_2361796"><i class="fa fa-arrows-alt" id="1557848813216_216_9957335"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557848813216_216_7639070"><i class="fa fa-copy" id="1557848813216_216_9372940"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848813216_216_5535972"><i class="fa fa-angle-double-down" id="1557848813216_216_2437485"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848813216_216_2609386"><i class="fa fa-plus" id="1557848813216_216_416027"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848813216_216_3967908"><i class="fa fa-clone" id="1557848813216_216_470595"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848813216_216_2128368"><i class="fa fa-database" id="1557848813216_216_1077069"></i></a>
                            <div class="preview" id="1557848813216_216_6846317">
                                <div class="row" id="1557848813216_216_6369120">
                                    <div class="col-md-8 gridInputColPadding" id="1557848813216_216_8903912">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848813216_216_442278">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848813216_216_8551051">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848813216_216_3382087"><tr id="1557848813216_216_3068515"><td class="column" width="445" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 21px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848813216_216_1889253" data-fs="17px" data-lh="21px"> labor and in pain, and vitality, so that long&amp;#00045;but some important things to do eiusmod.</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848813590_590_5191050">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848813590_590_3094503"><i class="fa-remove fa" id="1557848813590_590_3066124"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848813590_590_5047399"><i class="fa fa-arrows-alt" id="1557848813590_590_2159749"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557848813591_591_3499651"><i class="fa fa-copy" id="1557848813591_591_9130715"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848813591_591_8279193"><i class="fa fa-angle-double-down" id="1557848813591_591_2654385"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848813591_591_4496837"><i class="fa fa-plus" id="1557848813591_591_9231243"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848813591_591_3883238"><i class="fa fa-clone" id="1557848813591_591_3520259"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848813592_592_2512966"><i class="fa fa-database" id="1557848813592_592_2341662"></i></a>
                            <div class="preview" id="1557848813592_592_2828509">
                                <div class="row" id="1557848813592_592_7986169">
                                    <div class="col-md-8 gridInputColPadding" id="1557848813592_592_3965546">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848813592_592_9578036">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848813592_592_3112980">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848813592_592_6082273"><tr id="1557848813592_592_9320937"><td class="column" width="445" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 21px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848813592_592_9065024" data-fs="17px" data-lh="21px">cupidatat not excepteur, is soothing to the soul, that is, they are my toil, they deserted the general is to blame that services should be</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848813916_916_9383207">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848813916_916_689880"><i class="fa-remove fa" id="1557848813916_916_2840979"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848813916_916_5767447"><i class="fa fa-arrows-alt" id="1557848813917_917_4287186"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557848813917_917_9213714"><i class="fa fa-copy" id="1557848813917_917_7935762"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848813917_917_8310832"><i class="fa fa-angle-double-down" id="1557848813917_917_8897474"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848813917_917_758593"><i class="fa fa-plus" id="1557848813917_917_1363651"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848813917_917_7583843"><i class="fa fa-clone" id="1557848813917_917_3866893"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848813917_917_8266132"><i class="fa fa-database" id="1557848813917_917_9680670"></i></a>
                            <div class="preview" id="1557848813917_917_1502150">
                                <div class="row" id="1557848813917_917_5785154">
                                    <div class="col-md-8 gridInputColPadding" id="1557848813917_917_9719678">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848813917_917_1151526">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848813917_917_8981817">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848813917_917_4915360"><tr id="1557848813917_917_3737139"><td class="column" width="445" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848813917_917_5206997">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848814459_459_8585485">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848814459_459_323341"><i class="fa-remove fa" id="1557848814459_459_6966830"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848814460_460_3327175"><i class="fa fa-arrows-alt" id="1557848814460_460_8147116"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557848814460_460_1374569"><i class="fa fa-copy" id="1557848814460_460_3178881"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848814460_460_4037288"><i class="fa fa-angle-double-down" id="1557848814460_460_3981012"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848814460_460_9273638"><i class="fa fa-plus" id="1557848814460_460_6987458"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848814460_460_3593470"><i class="fa fa-clone" id="1557848814460_460_415092"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848814460_460_4167022"><i class="fa fa-database" id="1557848814460_460_7702265"></i></a>
                            <div class="preview" id="1557848814460_460_2934319">
                                <div class="row" id="1557848814460_460_1614696">
                                    <div class="col-md-8 gridInputColPadding" id="1557848814460_460_4375600">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848814460_460_3993044">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848814460_460_5141401">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848814460_460_8769106"><tr id="1557848814460_460_7398504"><td class="column" width="445" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848814460_460_4385001">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848961109_109_8357880">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848961110_110_7255734"><i class="fa-remove fa" id="1557848961110_110_8345939"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848961110_110_7418428"><i class="fa fa-arrows-alt" id="1557848961110_110_5669431"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-212" id="1557848961110_110_4734039"><i class="fa fa-copy" id="1557848961110_110_7324032"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848961110_110_946544"><i class="fa fa-angle-double-down" id="1557848961110_110_7099635"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848961110_110_6233643"><i class="fa fa-plus" id="1557848961110_110_1100344"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848961110_110_676517"><i class="fa fa-clone" id="1557848961110_110_9294855"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848961110_110_64022"><i class="fa fa-database" id="1557848961110_110_1475611"></i></a>
                            <div class="preview" id="1557848961110_110_8339588">
                                <div class="row" id="1557848961110_110_9693965">
                                    <div class="col-md-8 gridInputColPadding" id="1557848961110_110_2560873">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848961110_110_8515852">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848961110_110_9205350">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557848961110_110_3255290"><tr id="1557848961110_110_1425421"><td class="column" width="140" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848961110_110_9446518">
                        <div class="lyrow firstGridRow ui-draggable" id="1557848975911_911_7488076">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848975911_911_4586948"><i class="fa-remove fa" id="1557848975911_911_1350073"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848975911_911_2005713"><i class="fa fa-arrows-alt" id="1557848975911_911_4795782"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-214" id="1557848975911_911_2824538"><i class="fa fa-copy" id="1557848975911_911_75665"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848975911_911_1292252"><i class="fa fa-angle-double-down" id="1557848975911_911_376000"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848975911_911_6791930"><i class="fa fa-plus" id="1557848975911_911_5367784"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848975911_911_2443718"><i class="fa fa-clone" id="1557848975911_911_4569924"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848975911_911_4600882"><i class="fa fa-database" id="1557848975911_911_4499144"></i></a>
                            <div class="preview" id="1557848975911_911_5242630">
                                <div class="row" id="1557848975911_911_2925080">
                                    <div class="col-md-8 gridInputColPadding" id="1557848975911_911_6231981">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848975911_911_8756640">
                                        <p id="gridInputCount">= 140</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848975911_911_6569593">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only;" width="140"><tbody id="1557848975912_912_4925544"><tr id="1557848975912_912_3889554"><td class="column" width="140" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88);background-color:#000000;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848975912_912_5439175" bgcolor="#000000">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848976125_125_8741942">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848976125_125_3496029"><i class="fa-remove fa" id="1557848976125_125_6309854"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848976125_125_2083266"><i class="fa fa-arrows-alt" id="1557848976125_125_7520976"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-214" id="1557848976126_126_5600573"><i class="fa fa-copy" id="1557848976126_126_6789625"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848976126_126_6369114"><i class="fa fa-angle-double-down" id="1557848976126_126_5579004"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848976126_126_6255201"><i class="fa fa-plus" id="1557848976126_126_204145"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848976126_126_1050276"><i class="fa fa-clone" id="1557848976126_126_5489916"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848976126_126_1196110"><i class="fa fa-database" id="1557848976126_126_7367296"></i></a>
                            <div class="preview" id="1557848976126_126_8634533">
                                <div class="row" id="1557848976126_126_4052265">
                                    <div class="col-md-8 gridInputColPadding" id="1557848976126_126_8120782">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848976126_126_8198728">
                                        <p id="gridInputCount">= 140</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848976126_126_505862">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="140"><tbody id="1557848976126_126_6343007"><tr id="1557848976126_126_5794566"><td class="column" width="140" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; line-height: 17px; text-align: center; background-color: rgb(0, 0, 0);color:#ffffff;" data-color="#ffffff" data-ff="Arial, Helvetica, sans-serif" id="1557848976126_126_7494402" data-fs="15px" data-lh="17px" data-ta="center" bgcolor="#000000"><a id="1557849079020_20_7956647" href="#" alias="cta" target="_blank" style="color: rgb(255, 255, 255); text-decoration: none;">Lorem Ipsum</a></td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848976328_328_8614828">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848976328_328_3921878"><i class="fa-remove fa" id="1557848976328_328_2166016"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848976328_328_677092"><i class="fa fa-arrows-alt" id="1557848976328_328_5633619"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-214" id="1557848976328_328_1889365"><i class="fa fa-copy" id="1557848976328_328_3574374"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848976328_328_5859356"><i class="fa fa-angle-double-down" id="1557848976328_328_1555409"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848976328_328_3889892"><i class="fa fa-plus" id="1557848976329_329_7359478"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848976329_329_1565326"><i class="fa fa-clone" id="1557848976329_329_7226072"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848976329_329_683484"><i class="fa fa-database" id="1557848976329_329_6698952"></i></a>
                            <div class="preview" id="1557848976329_329_5086445">
                                <div class="row" id="1557848976329_329_9829480">
                                    <div class="col-md-8 gridInputColPadding" id="1557848976329_329_8168442">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848976329_329_7487940">
                                        <p id="gridInputCount">= 140</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848976329_329_5177263">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="140"><tbody id="1557848976329_329_5518049"><tr id="1557848976329_329_7938436"><td class="column" width="140" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88);background-color:#000000;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848976329_329_8552557" bgcolor="#000000">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="305" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848961110_110_4332">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848747787_787_8187984">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848747787_787_6436449"><i class="fa-remove fa" id="1557848747787_787_4691383"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848747787_787_5004936"><i class="fa fa-arrows-alt" id="1557848747787_787_5955002"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-197" id="1557848747787_787_7238029"><i class="fa fa-copy" id="1557848747787_787_3676153"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848747787_787_1237576"><i class="fa fa-angle-double-down" id="1557848747787_787_6566983"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848747787_787_4680578"><i class="fa fa-plus" id="1557848747787_787_578879"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848747787_787_7698235"><i class="fa fa-clone" id="1557848747787_787_7036736"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848747787_787_5103050"><i class="fa fa-database" id="1557848747787_787_9004592"></i></a>
                            <div class="preview" id="1557848747788_788_6798892">
                                <div class="row" id="1557848747788_788_3824722">
                                    <div class="col-md-8 gridInputColPadding" id="1557848747788_788_5905140">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848747788_788_3310225">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848747788_788_6968776">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848747788_788_3081372"><tr id="1557848747788_788_8024013"><td class="column" width="600" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557848747788_788_7695890">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848748172_172_4922793">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848748172_172_8630332"><i class="fa-remove fa" id="1557848748172_172_3631487"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848748172_172_1792276"><i class="fa fa-arrows-alt" id="1557848748172_172_3618979"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-197" id="1557848748172_172_4576436"><i class="fa fa-copy" id="1557848748172_172_5207012"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848748172_172_6122806"><i class="fa fa-angle-double-down" id="1557848748172_172_9439283"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848748172_172_3484048"><i class="fa fa-plus" id="1557848748172_172_5166223"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848748172_172_165316"><i class="fa fa-clone" id="1557848748173_173_2580376"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848748173_173_174934"><i class="fa fa-database" id="1557848748173_173_8981575"></i></a>
                            <div class="preview" id="1557848748173_173_4358113">
                                <div class="row" id="1557848748173_173_4853093">
                                    <div class="col-md-8 gridInputColPadding" id="1557848748173_173_4696840">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848748173_173_8154868">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848748173_173_9011652">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848748173_173_903452"><tr id="1557848748173_173_5438061"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848748173_173_7066794">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849160598_598_5484626">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849160598_598_5630178"><i class="fa-remove fa" id="1557849160598_598_7408848"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849160598_598_7918879"><i class="fa fa-arrows-alt" id="1557849160598_598_3869495"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-220" id="1557849160599_599_278754"><i class="fa fa-copy" id="1557849160599_599_3417682"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849160599_599_5471337"><i class="fa fa-angle-double-down" id="1557849160599_599_3309591"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849160599_599_2418368"><i class="fa fa-plus" id="1557849160599_599_716313"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849160599_599_7013481"><i class="fa fa-clone" id="1557849160599_599_6961188"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849160599_599_4871206"><i class="fa fa-database" id="1557849160599_599_8362780"></i></a>
                            <div class="preview" id="1557849160600_600_6464953">
                                <div class="row" id="1557849160600_600_3480478">
                                    <div class="col-md-8 gridInputColPadding" id="1557849160600_600_3140180">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849160600_600_7070960">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849160600_600_3664388">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849160600_600_9769109"><tr id="1557849160600_600_6465107"><td class="column" width="160" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849160600_600_1603989">&nbsp;</td><td class="column" width="440" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849160600_600_9984586">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849180101_101_7242957">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849180101_101_9002873"><i class="fa-remove fa" id="1557849180101_101_8274554"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849180102_102_4198719"><i class="fa fa-arrows-alt" id="1557849180102_102_624529"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-221" id="1557849180102_102_3868950"><i class="fa fa-copy" id="1557849180102_102_9766368"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849180102_102_1317293"><i class="fa fa-angle-double-down" id="1557849180102_102_1750776"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849180102_102_3543949"><i class="fa fa-plus" id="1557849180102_102_6502004"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849180102_102_8998221"><i class="fa fa-clone" id="1557849180102_102_164945"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849180102_102_527488"><i class="fa fa-database" id="1557849180102_102_4425672"></i></a>
                            <div class="preview" id="1557849180102_102_5562221">
                                <div class="row" id="1557849180102_102_2475025">
                                    <div class="col-md-8 gridInputColPadding" id="1557849180102_102_8712435">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849180102_102_1189459">
                                        <p id="gridInputCount">= 440</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849180102_102_6532569">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="440"><tbody id="1557849180102_102_3350938"><tr id="1557849180102_102_2700094"><td class="column" width="440" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849180102_102_796736" data-fs="17px" data-lh="20px">Want to be a pain in the cupidatat cillum has been criticized in the Duis et dolore magna flee produces no resultant pleasure. </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849180738_738_2653047">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849180738_738_3972413"><i class="fa-remove fa" id="1557849180738_738_6488138"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849180738_738_8156822"><i class="fa fa-arrows-alt" id="1557849180738_738_1385336"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-221" id="1557849180739_739_2851027"><i class="fa fa-copy" id="1557849180739_739_5780105"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849180739_739_4147544"><i class="fa fa-angle-double-down" id="1557849180739_739_1876644"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849180739_739_9217447"><i class="fa fa-plus" id="1557849180739_739_1567865"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849180739_739_6293182"><i class="fa fa-clone" id="1557849180739_739_7584124"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849180739_739_4723288"><i class="fa fa-database" id="1557849180739_739_7390628"></i></a>
                            <div class="preview" id="1557849180739_739_6559027">
                                <div class="row" id="1557849180739_739_1182444">
                                    <div class="col-md-8 gridInputColPadding" id="1557849180739_739_3159256">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849180739_739_2088011">
                                        <p id="gridInputCount">= 440</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849180739_739_170371">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="440"><tbody id="1557849180739_739_4101913"><tr id="1557849180739_739_8854686"><td class="column" width="440" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849180739_739_4875803" data-fs="17px" data-lh="20px">Excepteur cupidatat blacks are not excepteur, is soothing to the soul, that is, they are my toil, they deserted the general is to blame that services should be</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848748563_563_3100693">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848748563_563_1671686"><i class="fa-remove fa" id="1557848748563_563_4105250"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848748563_563_4175267"><i class="fa fa-arrows-alt" id="1557848748563_563_9773561"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-197" id="1557848748563_563_8043383"><i class="fa fa-copy" id="1557848748563_563_7403336"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848748563_563_9918072"><i class="fa fa-angle-double-down" id="1557848748563_563_9063358"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848748563_563_3010683"><i class="fa fa-plus" id="1557848748563_563_4985028"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848748563_563_453254"><i class="fa fa-clone" id="1557848748563_563_1383180"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848748563_563_5976293"><i class="fa fa-database" id="1557848748563_563_2308301"></i></a>
                            <div class="preview" id="1557848748563_563_6801835">
                                <div class="row" id="1557848748563_563_2722950">
                                    <div class="col-md-8 gridInputColPadding" id="1557848748563_563_461217">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848748563_563_4629437">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848748563_563_2106344">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848748563_563_5433570"><tr id="1557848748563_563_2153013"><td class="column" width="600" valign="top" height="17" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 17px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848748563_563_6343949" data-lh="17px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557848748932_932_6534354">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557848748932_932_2921083"><i class="fa-remove fa" id="1557848748932_932_6487879"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557848748932_932_9857693"><i class="fa fa-arrows-alt" id="1557848748932_932_1037001"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-197" id="1557848748932_932_4906371"><i class="fa fa-copy" id="1557848748932_932_7694784"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557848748932_932_9931328"><i class="fa fa-angle-double-down" id="1557848748932_932_1188311"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557848748932_932_7980831"><i class="fa fa-plus" id="1557848748932_932_7195561"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557848748933_933_2611123"><i class="fa fa-clone" id="1557848748933_933_4236864"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557848748933_933_9746844"><i class="fa fa-database" id="1557848748933_933_162628"></i></a>
                            <div class="preview" id="1557848748933_933_2839455">
                                <div class="row" id="1557848748933_933_8548163">
                                    <div class="col-md-8 gridInputColPadding" id="1557848748933_933_7343394">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557848748933_933_5747403">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557848748933_933_798584">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557848748933_933_9996649"><tr id="1557848748933_933_2488871"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557848748933_933_5047882">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849277059_59_7025921">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849277059_59_1603517"><i class="fa-remove fa" id="1557849277059_59_6634867"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849277059_59_5765359"><i class="fa fa-arrows-alt" id="1557849277059_59_7501629"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-228" id="1557849277059_59_8242530"><i class="fa fa-copy" id="1557849277059_59_454637"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849277059_59_1691668"><i class="fa fa-angle-double-down" id="1557849277059_59_4117989"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849277059_59_2901540"><i class="fa fa-plus" id="1557849277059_59_3898004"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849277059_59_4172022"><i class="fa fa-clone" id="1557849277059_59_2075432"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849277059_59_7338032"><i class="fa fa-database" id="1557849277059_59_8440093"></i></a>
                            <div class="preview" id="1557849277059_59_3779285">
                                <div class="row" id="1557849277059_59_8878078">
                                    <div class="col-md-8 gridInputColPadding" id="1557849277059_59_689461">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849277059_59_2793189">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849277059_59_5375015">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only;" width="600"><tbody id="1557849277059_59_8993427"><tr id="1557849277059_59_1204502"><td class="column" width="105" valign="top" height="2" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 2px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849277059_59_3625568" data-lh="2px">&nbsp;</td><td class="column" width="390" valign="top" height="2" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); background-color: rgb(145, 145, 145); line-height: 2px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849277059_59_1139445" bgcolor="#919191" data-lh="2px">&nbsp;</td><td class="column" width="105" valign="top" height="2" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 2px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849277060_60_9746862" data-lh="2px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/fragmentWithCitation.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Fragment With Citation</div>
                    </div>
                </div>
                <div class="view">
                   <div class="lyrow firstGridRow ui-draggable" id="1557849590399_399_8483667">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849590399_399_9782968"><i class="fa-remove fa" id="1557849590400_400_8056119"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849590400_400_3116931"><i class="fa fa-arrows-alt" id="1557849590400_400_6499294"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-20" id="1557849590400_400_287888"><i class="fa fa-copy" id="1557849590400_400_5131211"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849590400_400_2295397"><i class="fa fa-angle-double-down" id="1557849590400_400_2518646"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849590400_400_7193908"><i class="fa fa-plus" id="1557849590400_400_996424"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849590400_400_1628623"><i class="fa fa-clone" id="1557849590400_400_2026514"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849590400_400_7074660"><i class="fa fa-database" id="1557849590400_400_7521556"></i></a>
                            <div class="preview" id="1557849590400_400_256384">
                                <div class="row" id="1557849590400_400_6506419">
                                    <div class="col-md-8 gridInputColPadding" id="1557849590400_400_1620411">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849590400_400_999831">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849590400_400_9700954">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849590400_400_4668881"><tr id="1557849590400_400_1697873"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849590400_400_9095382">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849612651_651_1642812">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849612651_651_163284"><i class="fa-remove fa" id="1557849612651_651_1538883"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849612651_651_3489900"><i class="fa fa-arrows-alt" id="1557849612651_651_720676"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-26" id="1557849612651_651_8395415"><i class="fa fa-copy" id="1557849612651_651_7295102"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849612651_651_7132471"><i class="fa fa-angle-double-down" id="1557849612651_651_7185396"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849612651_651_6747526"><i class="fa fa-plus" id="1557849612651_651_9852549"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849612651_651_915435"><i class="fa fa-clone" id="1557849612651_651_1540125"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849612651_651_3873993"><i class="fa fa-database" id="1557849612651_651_9079771"></i></a>
                            <div class="preview" id="1557849612651_651_8873251">
                                <div class="row" id="1557849612651_651_8554788">
                                    <div class="col-md-8 gridInputColPadding" id="1557849612651_651_7930409">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849612651_651_9575551">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849612652_652_2626079">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849612652_652_3688696"><tr id="1557849612652_652_5273489"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849612652_652_2968831">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849657201_201_4697844">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849657201_201_9379252"><i class="fa-remove fa" id="1557849657201_201_4806054"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849657201_201_1083488"><i class="fa fa-arrows-alt" id="1557849657201_201_5383718"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-34" id="1557849657202_202_6074248"><i class="fa fa-copy" id="1557849657202_202_9855317"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849657202_202_3758774"><i class="fa fa-angle-double-down" id="1557849657202_202_7301797"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849657202_202_6779100"><i class="fa fa-plus" id="1557849657202_202_8590940"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849657202_202_9816658"><i class="fa fa-clone" id="1557849657202_202_612573"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849657202_202_6076393"><i class="fa fa-database" id="1557849657202_202_2673122"></i></a>
                            <div class="preview" id="1557849657202_202_732522">
                                <div class="row" id="1557849657202_202_7429867">
                                    <div class="col-md-8 gridInputColPadding" id="1557849657202_202_3356443">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849657202_202_5729090">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849657202_202_5585826">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849657202_202_9233836"><tr id="1557849657202_202_6705135"><td class="column" width="390" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849657202_202_5625630">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849816698_698_7117818">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849816698_698_7226016"><i class="fa-remove fa" id="1557849816698_698_8279125"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849816698_698_2733770"><i class="fa fa-arrows-alt" id="1557849816698_698_7607999"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-46" id="1557849816698_698_2028557"><i class="fa fa-copy" id="1557849816698_698_2215022"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849816698_698_637538"><i class="fa fa-angle-double-down" id="1557849816698_698_5565949"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849816698_698_6241169"><i class="fa fa-plus" id="1557849816698_698_4058090"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849816698_698_372990"><i class="fa fa-clone" id="1557849816698_698_6504083"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849816698_698_8551868"><i class="fa fa-database" id="1557849816698_698_6110697"></i></a>
                            <div class="preview" id="1557849816698_698_9189353">
                                <div class="row" id="1557849816698_698_3768525">
                                    <div class="col-md-8 gridInputColPadding" id="1557849816698_698_3420040">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849816698_698_1970769">
                                        <p id="gridInputCount">= 390</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849816698_698_4030389">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="390"><tbody id="1557849816698_698_4955613"><tr id="1557849816698_698_5958294"><td class="column" width="390" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(0, 0, 0); font-size: 17px; line-height: 20px;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557849816698_698_1202728" data-fs="17px" data-lh="20px"><strong id="1557849867523_523_2134475">Lorem Ipsum</strong>
</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849817098_98_8157543">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849817098_98_1663598"><i class="fa-remove fa" id="1557849817098_98_5088479"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849817098_98_3398337"><i class="fa fa-arrows-alt" id="1557849817098_98_7641549"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-46" id="1557849817098_98_9715851"><i class="fa fa-copy" id="1557849817098_98_2137746"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849817098_98_487237"><i class="fa fa-angle-double-down" id="1557849817098_98_1835588"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849817098_98_9487772"><i class="fa fa-plus" id="1557849817098_98_3745799"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849817098_98_3234370"><i class="fa fa-clone" id="1557849817098_98_6550214"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849817098_98_4825710"><i class="fa fa-database" id="1557849817098_98_157848"></i></a>
                            <div class="preview" id="1557849817098_98_4615627">
                                <div class="row" id="1557849817098_98_1041652">
                                    <div class="col-md-8 gridInputColPadding" id="1557849817098_98_1072159">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849817098_98_156681">
                                        <p id="gridInputCount">= 390</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849817098_98_4181435">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="390"><tbody id="1557849817098_98_8885810"><tr id="1557849817098_98_1402062"><td class="column" width="390" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557849817098_98_4703919">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849817480_480_2057073">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849817480_480_3333768"><i class="fa-remove fa" id="1557849817480_480_9914519"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849817480_480_1118901"><i class="fa fa-arrows-alt" id="1557849817480_480_3824314"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-46" id="1557849817480_480_6301377"><i class="fa fa-copy" id="1557849817480_480_5466962"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849817480_480_1998056"><i class="fa fa-angle-double-down" id="1557849817480_480_5501264"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849817480_480_4341672"><i class="fa fa-plus" id="1557849817480_480_7925773"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849817480_480_5083595"><i class="fa fa-clone" id="1557849817480_480_6192384"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849817480_480_1434724"><i class="fa fa-database" id="1557849817480_480_416094"></i></a>
                            <div class="preview" id="1557849817480_480_1350153">
                                <div class="row" id="1557849817480_480_9394266">
                                    <div class="col-md-8 gridInputColPadding" id="1557849817480_480_5111559">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849817480_480_6050926">
                                        <p id="gridInputCount">= 390</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849817480_480_2178977">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="390"><tbody id="1557849817481_481_5668977"><tr id="1557849817481_481_5782992"><td class="column" width="390" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(0, 0, 0); font-size: 20px; line-height: 24px;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557849817481_481_3943999" data-fs="20px" data-lh="24px"><strong id="1557849871668_668_1771539">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed tempor and vitality, so that the labor and sorrow, some important things to do eiusmod. </strong></td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="449" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849657202_202_9667282">&nbsp;</td><td class="column" width="151" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849657202_202_9312218">
                <div class="box box-element previewImg" data-type="image" id="1557849841233_233_3499943">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557849841233_233_2515367"><i class="fa fa-remove" id="1557849841233_233_8436440"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557849841234_234_8885455"><i class="fa fa-arrows-alt" id="1557849841234_234_1344240"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-48" id="1557849841234_234_2503596">
                    <i class="fa fa-copy" id="1557849841234_234_3512789"></i>
                    </a> 
                    <div class="preview" id="1557849841234_234_474997">
                        <i class="fa fa-picture-o fa-2x" id="1557849841234_234_2610943"></i>
                        <div class="element-desc" id="1557849841234_234_654884">Image</div>
                    </div>
                    <div class="view" id="1557849841234_234_2137491"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="151" height="108" id="1557849841234_234_2530392"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849613641_641_1530403">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849613642_642_7427283"><i class="fa-remove fa" id="1557849613642_642_862193"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849613642_642_1723272"><i class="fa fa-arrows-alt" id="1557849613642_642_7710861"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-26" id="1557849613642_642_3141948"><i class="fa fa-copy" id="1557849613642_642_8045591"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849613642_642_146483"><i class="fa fa-angle-double-down" id="1557849613642_642_2063528"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849613642_642_656998"><i class="fa fa-plus" id="1557849613642_642_101073"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849613642_642_5102279"><i class="fa fa-clone" id="1557849613642_642_4299529"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849613642_642_9944994"><i class="fa fa-database" id="1557849613642_642_8993784"></i></a>
                            <div class="preview" id="1557849613642_642_5388093">
                                <div class="row" id="1557849613642_642_9668936">
                                    <div class="col-md-8 gridInputColPadding" id="1557849613642_642_5697087">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849613642_642_1513741">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849613642_642_3582253">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849613642_642_4630714"><tr id="1557849613642_642_9250081"><td class="column" width="600" valign="top" height="25" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 25px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849613642_642_9813008" data-lh="25px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849614080_80_2460303">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849614080_80_9204692"><i class="fa-remove fa" id="1557849614080_80_255068"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849614080_80_4577227"><i class="fa fa-arrows-alt" id="1557849614080_80_4326910"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-26" id="1557849614080_80_1363173"><i class="fa fa-copy" id="1557849614080_80_5066184"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849614080_80_5392863"><i class="fa fa-angle-double-down" id="1557849614080_80_8519060"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849614080_80_656169"><i class="fa fa-plus" id="1557849614080_80_7289457"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849614080_80_9564960"><i class="fa fa-clone" id="1557849614080_80_9041361"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849614080_80_9344633"><i class="fa fa-database" id="1557849614080_80_8137667"></i></a>
                            <div class="preview" id="1557849614080_80_5061809">
                                <div class="row" id="1557849614080_80_3122466">
                                    <div class="col-md-8 gridInputColPadding" id="1557849614080_80_715570">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849614080_80_1464101">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849614080_80_8332119">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849614080_80_7377914"><tr id="1557849614080_80_8509421"><td class="column" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849614080_80_4668886">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849686176_176_3133778">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849686176_176_8284749"><i class="fa-remove fa" id="1557849686176_176_5779026"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849686176_176_5040089"><i class="fa fa-arrows-alt" id="1557849686176_176_7264392"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-37" id="1557849686176_176_9337691"><i class="fa fa-copy" id="1557849686176_176_6002232"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849686177_177_1133289"><i class="fa fa-angle-double-down" id="1557849686177_177_3697228"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849686177_177_1071219"><i class="fa fa-plus" id="1557849686177_177_3082265"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849686177_177_2849160"><i class="fa fa-clone" id="1557849686177_177_9156307"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849686177_177_5988628"><i class="fa fa-database" id="1557849686177_177_8784508"></i></a>
                            <div class="preview" id="1557849686177_177_7838582">
                                <div class="row" id="1557849686177_177_3726383">
                                    <div class="col-md-8 gridInputColPadding" id="1557849686177_177_6242278">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849686177_177_1014089">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849686177_177_7350151">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849686177_177_552843"><tr id="1557849686177_177_7273210"><td class="column" width="445" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849686177_177_2206618">
                        <div class="lyrow firstGridRow ui-draggable" id="1557849697706_706_8579866">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849697706_706_4441226"><i class="fa-remove fa" id="1557849697706_706_1445779"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849697706_706_5263455"><i class="fa fa-arrows-alt" id="1557849697706_706_2431623"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-41" id="1557849697706_706_1084976"><i class="fa fa-copy" id="1557849697707_707_5686168"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849697707_707_8514970"><i class="fa fa-angle-double-down" id="1557849697707_707_3536422"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849697707_707_2352511"><i class="fa fa-plus" id="1557849697707_707_1767919"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849697707_707_5376610"><i class="fa fa-clone" id="1557849697707_707_1339112"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849697707_707_8726116"><i class="fa fa-database" id="1557849697707_707_4269294"></i></a>
                            <div class="preview" id="1557849697707_707_1766011">
                                <div class="row" id="1557849697707_707_3333668">
                                    <div class="col-md-8 gridInputColPadding" id="1557849697707_707_4743763">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849697707_707_5641508">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849697707_707_8528242">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557849697707_707_2324824"><tr id="1557849697707_707_4884082"><td class="column" width="445" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 13px;color:#000000;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557849697707_707_8574146" data-fs="11px" data-lh="13px">Lorem Ipsum
</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849698265_265_9159020">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849698265_265_2484978"><i class="fa-remove fa" id="1557849698265_265_4350941"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849698265_265_4061448"><i class="fa fa-arrows-alt" id="1557849698265_265_8322512"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-41" id="1557849698265_265_8189665"><i class="fa fa-copy" id="1557849698265_265_9558809"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849698265_265_2538479"><i class="fa fa-angle-double-down" id="1557849698265_265_8160245"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849698265_265_952676"><i class="fa fa-plus" id="1557849698265_265_5060672"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849698265_265_4470616"><i class="fa fa-clone" id="1557849698265_265_3529329"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849698265_265_8019650"><i class="fa fa-database" id="1557849698265_265_4871606"></i></a>
                            <div class="preview" id="1557849698265_265_1828026">
                                <div class="row" id="1557849698265_265_5548103">
                                    <div class="col-md-8 gridInputColPadding" id="1557849698265_265_3014818">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849698265_265_6459482">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849698266_266_186176">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557849698266_266_4564535"><tr id="1557849698266_266_2182004"><td class="column" width="445" valign="top" height="2" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 2px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849698266_266_9424920" data-lh="2px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849698708_708_2974300">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849698708_708_4111198"><i class="fa-remove fa" id="1557849698708_708_3402313"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849698708_708_7698508"><i class="fa fa-arrows-alt" id="1557849698708_708_4926823"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-41" id="1557849698708_708_5344986"><i class="fa fa-copy" id="1557849698708_708_41012"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849698708_708_5587718"><i class="fa fa-angle-double-down" id="1557849698708_708_2463696"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849698708_708_7645616"><i class="fa fa-plus" id="1557849698708_708_7723202"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849698709_709_9626495"><i class="fa fa-clone" id="1557849698709_709_4010948"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849698709_709_5144295"><i class="fa fa-database" id="1557849698709_709_467910"></i></a>
                            <div class="preview" id="1557849698709_709_3023654">
                                <div class="row" id="1557849698709_709_3079560">
                                    <div class="col-md-8 gridInputColPadding" id="1557849698709_709_9883807">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849698709_709_5771359">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849698709_709_5677859">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557849698709_709_4545365"><tr id="1557849698709_709_1838740"><td class="column" width="445" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 13px;color:#000000;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557849698709_709_3517464" data-fs="11px" data-lh="13px">Lorem ipsum carrots, enhanced undergraduate developer, but they do </td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="155" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849686177_177_2201332">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849615007_7_282815">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849615007_7_6487237"><i class="fa-remove fa" id="1557849615007_7_3718052"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849615007_7_9531723"><i class="fa fa-arrows-alt" id="1557849615007_7_5811712"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-26" id="1557849615007_7_11672"><i class="fa fa-copy" id="1557849615007_7_1811278"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849615007_7_1947084"><i class="fa fa-angle-double-down" id="1557849615007_7_9538804"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849615007_7_4235007"><i class="fa fa-plus" id="1557849615007_7_5696602"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849615007_7_2430454"><i class="fa fa-clone" id="1557849615007_7_547795"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849615007_7_6582333"><i class="fa fa-database" id="1557849615007_7_6881239"></i></a>
                            <div class="preview" id="1557849615007_7_4517067">
                                <div class="row" id="1557849615007_7_5673515">
                                    <div class="col-md-8 gridInputColPadding" id="1557849615007_7_3131267">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849615007_7_2984747">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849615008_8_9770134">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849615008_8_2855316"><tr id="1557849615008_8_6070317"><td class="column" width="600" valign="top" height="20" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557849615008_8_3219763" data-lh="20px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557849615431_431_6419852">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557849615431_431_8069338"><i class="fa-remove fa" id="1557849615431_431_5993690"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557849615431_431_8392457"><i class="fa fa-arrows-alt" id="1557849615431_431_1679573"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-26" id="1557849615431_431_5410211"><i class="fa fa-copy" id="1557849615431_431_1944513"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557849615431_431_3533715"><i class="fa fa-angle-double-down" id="1557849615431_431_6233762"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557849615432_432_7228747"><i class="fa fa-plus" id="1557849615432_432_2127466"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557849615432_432_7835637"><i class="fa fa-clone" id="1557849615432_432_2952382"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557849615432_432_3171923"><i class="fa fa-database" id="1557849615432_432_3978324"></i></a>
                            <div class="preview" id="1557849615432_432_3242714">
                                <div class="row" id="1557849615432_432_9657040">
                                    <div class="col-md-8 gridInputColPadding" id="1557849615432_432_9990799">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557849615432_432_4524223">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557849615432_432_5019844">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557849615432_432_8320558"><tr id="1557849615432_432_120471"><td class="column" width="600" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 17px; line-height: 20px;color:#000000;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557849615432_432_1064507" data-fs="17px" data-lh="20px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed tempor and vitality, so that the labor and sorrow, some important things to do eiusmod. Over the years, I will come, who will nostrud aliquip out of her the advantage of exercise, so that stimulus efforts if the school district and longevity. Want to be a pain in the cupidatat cillum has been criticized in the Duis et dolore magna flee produces no resultant pleasure. Excepteur cupidatat blacks are not excepteur, is soothing to the soul, that is, they are my toil, they deserted the general is to blame that services should be
</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557850099523_523_8576557">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850099524_524_5344465"><i class="fa-remove fa" id="1557850099524_524_5235534"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850099524_524_6845824"><i class="fa fa-arrows-alt" id="1557850099524_524_8813125"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-62" id="1557850099524_524_9292505"><i class="fa fa-copy" id="1557850099524_524_7994807"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850099524_524_6046858"><i class="fa fa-angle-double-down" id="1557850099524_524_487234"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850099524_524_5692829"><i class="fa fa-plus" id="1557850099524_524_7045708"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850099524_524_1204304"><i class="fa fa-clone" id="1557850099524_524_9317839"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850099524_524_2577158"><i class="fa fa-database" id="1557850099524_524_2693557"></i></a>
                            <div class="preview" id="1557850099524_524_7084698">
                                <div class="row" id="1557850099524_524_655085">
                                    <div class="col-md-8 gridInputColPadding" id="1557850099524_524_692136">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850099524_524_430873">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850099524_524_227099">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557850099524_524_6971854"><tr id="1557850099524_524_8918268"><td class="column" width="600" valign="top" style="font-family: Arial, Helvetica, sans-serif;color:#000000;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557850099524_524_6557528">{{{{Lorem ipsum CitationStart}}}} CitationEnd</td></tr></tbody></table>
                            </div>
                        </div> 
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/learningObjective.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Learning Objective</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557850197187_187_9320093">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850197188_188_2841555"><i class="fa-remove fa" id="1557850197188_188_4137371"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850197188_188_5812955"><i class="fa fa-arrows-alt" id="1557850197188_188_1657157"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-4" id="1557850197188_188_9856140"><i class="fa fa-copy" id="1557850197188_188_8624737"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850197188_188_6977812"><i class="fa fa-angle-double-down" id="1557850197188_188_315664"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850197188_188_8443258"><i class="fa fa-plus" id="1557850197188_188_7931607"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850197188_188_4123808"><i class="fa fa-clone" id="1557850197188_188_7641260"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850197188_188_2936902"><i class="fa fa-database" id="1557850197188_188_9060124"></i></a>
                            <div class="preview" id="1557850197188_188_2461982">
                                <div class="row" id="1557850197188_188_1401660">
                                    <div class="col-md-8 gridInputColPadding" id="1557850197188_188_5082390">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850197188_188_6319130">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850197188_188_555452">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850197188_188_7030504"><tr id="1557850197188_188_4003425"><td class="column" width="575" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88);background-color:#E3E3E2;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850197188_188_8763426" bgcolor="#E3E3E2">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850228739_739_168776">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850228739_739_8390104"><i class="fa-remove fa" id="1557850228739_739_6750061"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850228739_739_4908020"><i class="fa fa-arrows-alt" id="1557850228739_739_4021174"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557850228739_739_8471467"><i class="fa fa-copy" id="1557850228739_739_8124848"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850228739_739_7104018"><i class="fa fa-angle-double-down" id="1557850228739_739_602376"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850228739_739_4405077"><i class="fa fa-plus" id="1557850228739_739_7069462"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850228739_739_3529164"><i class="fa fa-clone" id="1557850228739_739_6267433"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850228739_739_8231176"><i class="fa fa-database" id="1557850228739_739_325616"></i></a>
                            <div class="preview" id="1557850228739_739_7797299">
                                <div class="row" id="1557850228739_739_7513763">
                                    <div class="col-md-8 gridInputColPadding" id="1557850228739_739_1087765">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850228739_739_2256194">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850228739_739_6362402">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850228739_739_4294458"><tr id="1557850228739_739_3217014"><td class="column" width="575" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557850228739_739_2899147">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850229167_167_996068">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850229167_167_8501958"><i class="fa-remove fa" id="1557850229167_167_7978293"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850229167_167_6475160"><i class="fa fa-arrows-alt" id="1557850229167_167_2197624"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557850229167_167_9917764"><i class="fa fa-copy" id="1557850229167_167_8926855"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850229167_167_3038039"><i class="fa fa-angle-double-down" id="1557850229167_167_7631569"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850229167_167_7745477"><i class="fa fa-plus" id="1557850229167_167_766717"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850229167_167_8208725"><i class="fa fa-clone" id="1557850229168_168_3017210"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850229168_168_4353471"><i class="fa fa-database" id="1557850229168_168_3356900"></i></a>
                            <div class="preview" id="1557850229168_168_8184584">
                                <div class="row" id="1557850229168_168_7993182">
                                    <div class="col-md-8 gridInputColPadding" id="1557850229168_168_7726398">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850229168_168_7603158">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850229168_168_1021069">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850229168_168_2123026"><tr id="1557850229168_168_7183911"><td class="column" width="575" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850229168_168_5593612">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850277266_266_3011195">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850277266_266_7290418"><i class="fa-remove fa" id="1557850277266_266_4703213"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850277267_267_9943693"><i class="fa fa-arrows-alt" id="1557850277267_267_444850"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-18" id="1557850277267_267_64670"><i class="fa fa-copy" id="1557850277267_267_3016896"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850277267_267_2904403"><i class="fa fa-angle-double-down" id="1557850277267_267_1375348"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850277267_267_8204706"><i class="fa fa-plus" id="1557850277267_267_3408412"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850277267_267_9637885"><i class="fa fa-clone" id="1557850277267_267_2954911"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850277267_267_817263"><i class="fa fa-database" id="1557850277267_267_80639"></i></a>
                            <div class="preview" id="1557850277267_267_6072735">
                                <div class="row" id="1557850277267_267_8235412">
                                    <div class="col-md-8 gridInputColPadding" id="1557850277267_267_1440323">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850277267_267_8005492">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850277267_267_1891572">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850277267_267_2986843"><tr id="1557850277267_267_388795"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850277267_267_6680973">&nbsp;</td><td class="column" width="555" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(85, 85, 85); font-size: 24px; line-height: 24px;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850277267_267_2055703" data-fs="24px" data-lh="24px"><strong id="1557850288938_938_8849376">Program Overview:</strong></td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850229570_570_7711115">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850229570_570_2468649"><i class="fa-remove fa" id="1557850229570_570_6965665"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850229570_570_5392170"><i class="fa fa-arrows-alt" id="1557850229570_570_3617844"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557850229570_570_3543436"><i class="fa fa-copy" id="1557850229570_570_3953668"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850229570_570_5809640"><i class="fa fa-angle-double-down" id="1557850229570_570_3468838"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850229570_570_7436170"><i class="fa fa-plus" id="1557850229570_570_2111924"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850229570_570_795784"><i class="fa fa-clone" id="1557850229570_570_8775676"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850229570_570_3124472"><i class="fa fa-database" id="1557850229570_570_433092"></i></a>
                            <div class="preview" id="1557850229570_570_4572355">
                                <div class="row" id="1557850229571_571_1327117">
                                    <div class="col-md-8 gridInputColPadding" id="1557850229571_571_8245141">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850229571_571_5844928">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850229571_571_4969986">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850229571_571_3024107"><tr id="1557850229571_571_4948693"><td class="column" width="575" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557850229571_571_3399105">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850229986_986_7356334">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850229986_986_8093143"><i class="fa-remove fa" id="1557850229986_986_5171464"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850229986_986_7578498"><i class="fa fa-arrows-alt" id="1557850229986_986_1660507"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557850229986_986_7080166"><i class="fa fa-copy" id="1557850229986_986_6536003"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850229986_986_4159259"><i class="fa fa-angle-double-down" id="1557850229986_986_37230"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850229986_986_8627330"><i class="fa fa-plus" id="1557850229986_986_9441574"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850229986_986_6040940"><i class="fa fa-clone" id="1557850229986_986_7256418"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850229986_986_9138512"><i class="fa fa-database" id="1557850229986_986_7275758"></i></a>
                            <div class="preview" id="1557850229986_986_6027177">
                                <div class="row" id="1557850229986_986_4637451">
                                    <div class="col-md-8 gridInputColPadding" id="1557850229986_986_4746734">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850229986_986_2631607">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850229986_986_2246372">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850229986_986_4573080"><tr id="1557850229986_986_4347565"><td class="column" width="575" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850229986_986_8839431">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850319648_648_1775025">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850319648_648_7544120"><i class="fa-remove fa" id="1557850319648_648_6703728"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850319648_648_9001247"><i class="fa fa-arrows-alt" id="1557850319648_648_1125738"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-21" id="1557850319648_648_2661262"><i class="fa fa-copy" id="1557850319648_648_1036558"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850319648_648_7726512"><i class="fa fa-angle-double-down" id="1557850319648_648_8164925"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850319648_648_2682458"><i class="fa fa-plus" id="1557850319648_648_1176416"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850319648_648_140739"><i class="fa fa-clone" id="1557850319648_648_4915141"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850319648_648_7583379"><i class="fa fa-database" id="1557850319648_648_6092207"></i></a>
                            <div class="preview" id="1557850319648_648_2228391">
                                <div class="row" id="1557850319648_648_5449726">
                                    <div class="col-md-8 gridInputColPadding" id="1557850319648_648_9347040">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850319648_648_7233159">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850319648_648_6914237">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850319648_648_9686243"><tr id="1557850319649_649_4850431"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850319649_649_484885">&nbsp;</td><td class="column" width="555" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 17px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850319649_649_1657079" data-fs="17px" data-lh="17px">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850359714_714_4164279">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850359714_714_2336525"><i class="fa-remove fa" id="1557850359714_714_7359052"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850359714_714_4355778"><i class="fa fa-arrows-alt" id="1557850359714_714_1753690"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-27" id="1557850359715_715_3536196"><i class="fa fa-copy" id="1557850359715_715_5677785"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850359715_715_5209443"><i class="fa fa-angle-double-down" id="1557850359715_715_8166056"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850359715_715_4399441"><i class="fa fa-plus" id="1557850359715_715_692610"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850359715_715_4615473"><i class="fa fa-clone" id="1557850359715_715_575000"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850359715_715_7781413"><i class="fa fa-database" id="1557850359715_715_8063994"></i></a>
                            <div class="preview" id="1557850359715_715_5827308">
                                <div class="row" id="1557850359715_715_1261479">
                                    <div class="col-md-8 gridInputColPadding" id="1557850359715_715_4989757">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850359715_715_3841579">
                                        <p id="gridInputCount">= 555</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850359715_715_7110247">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="555"><tbody id="1557850359715_715_7402519"><tr id="1557850359715_715_5622783"><td class="column" width="5" valign="top" style="font-family: Arial, Helvetica, sans-serif;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850359715_715_4888100">&amp;#08226;</td><td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850359715_715_4326522">&nbsp;</td><td class="column" width="545" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; line-height: 21px;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850359715_715_9266693" data-fs="18px" data-lh="21px">Learning Objective 1</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850230386_386_7263764">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850230386_386_2366324"><i class="fa-remove fa" id="1557850230386_386_4419661"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850230386_386_7977831"><i class="fa fa-arrows-alt" id="1557850230386_386_7939604"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557850230386_386_7973109"><i class="fa fa-copy" id="1557850230386_386_7604660"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850230386_386_308215"><i class="fa fa-angle-double-down" id="1557850230386_386_593919"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850230386_386_371012"><i class="fa fa-plus" id="1557850230386_386_5691042"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850230386_386_115675"><i class="fa fa-clone" id="1557850230386_386_9389368"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850230386_386_9360350"><i class="fa fa-database" id="1557850230386_386_2907247"></i></a>
                            <div class="preview" id="1557850230386_386_6466264">
                                <div class="row" id="1557850230386_386_2829720">
                                    <div class="col-md-8 gridInputColPadding" id="1557850230386_386_6765911">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850230386_386_209651">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850230386_386_1609449">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850230386_386_1506970"><tr id="1557850230386_386_7553374"><td class="column" width="575" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850230386_386_1142111"><div class="lyrow firstGridRow ui-draggable" id="1557850438335_335_7558223">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850438335_335_159857"><i class="fa-remove fa" id="1557850438335_335_926876"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850438335_335_4438390"><i class="fa fa-arrows-alt" id="1557850438335_335_1717664"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-21" id="1557850438335_335_9363421"><i class="fa fa-copy" id="1557850438335_335_1837156"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850438335_335_9652649"><i class="fa fa-angle-double-down" id="1557850438335_335_5262130"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850438335_335_3836444"><i class="fa fa-plus" id="1557850438335_335_1949021"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850438335_335_2637829"><i class="fa fa-clone" id="1557850438335_335_6404323"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850438335_335_4786328"><i class="fa fa-database" id="1557850438335_335_5015694"></i></a>
                            <div class="preview" id="1557850438335_335_8901809">
                                <div class="row" id="1557850438335_335_9562325">
                                    <div class="col-md-8 gridInputColPadding" id="1557850438335_335_7736488">
                                        <input id="1557850438335_335_7907497" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850438335_335_6375142">
                                        <p id="1557850438335_335_7161153">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850438335_335_5273950">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="1557850438335_335_5620868" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850438335_335_5652192"><tr id="1557850438335_335_7110232"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850438335_335_1503796">&nbsp;</td><td class="column" width="555" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 17px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850438335_335_4854024" data-fs="17px" data-lh="17px">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850438335_335_7626514">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850438335_335_8861971"><i class="fa-remove fa" id="1557850438335_335_2610981"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850438335_335_5467674"><i class="fa fa-arrows-alt" id="1557850438336_336_6895409"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-27" id="1557850438336_336_9847021"><i class="fa fa-copy" id="1557850438336_336_3510645"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850438336_336_8815200"><i class="fa fa-angle-double-down" id="1557850438336_336_2400939"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850438336_336_7911246"><i class="fa fa-plus" id="1557850438336_336_4173204"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850438336_336_4023789"><i class="fa fa-clone" id="1557850438336_336_5152282"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850438336_336_6412576"><i class="fa fa-database" id="1557850438336_336_5257205"></i></a>
                            <div class="preview" id="1557850438336_336_2906583">
                                <div class="row" id="1557850438336_336_3078715">
                                    <div class="col-md-8 gridInputColPadding" id="1557850438336_336_3510537">
                                        <input id="1557850438336_336_4797329" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850438336_336_5933638">
                                        <p id="1557850438336_336_7978185">= 555</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850438336_336_1513752">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="1557850438336_336_94852" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="555"><tbody id="1557850438336_336_9321069"><tr id="1557850438336_336_6562277"><td class="column" width="5" valign="top" style="font-family: Arial, Helvetica, sans-serif;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850438336_336_2643546">&amp;#08226;</td><td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850438336_336_6210602">&nbsp;</td><td class="column" width="545" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; line-height: 21px;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850438336_336_2328669" data-fs="18px" data-lh="21px">Learning Objective 1</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div></td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850230793_793_5575137">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850230793_793_1849731"><i class="fa-remove fa" id="1557850230793_793_2156419"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850230793_793_7720193"><i class="fa fa-arrows-alt" id="1557850230793_793_6562618"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557850230793_793_2002840"><i class="fa fa-copy" id="1557850230793_793_4736727"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850230793_793_8289733"><i class="fa fa-angle-double-down" id="1557850230793_793_5074930"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850230793_793_6929024"><i class="fa fa-plus" id="1557850230793_793_2689409"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850230793_793_9770398"><i class="fa fa-clone" id="1557850230793_793_2016487"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850230793_793_3736359"><i class="fa fa-database" id="1557850230793_793_4415608"></i></a>
                            <div class="preview" id="1557850230793_793_9594618">
                                <div class="row" id="1557850230793_793_4166668">
                                    <div class="col-md-8 gridInputColPadding" id="1557850230793_793_4911026">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850230793_793_4277871">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850230793_793_8610804">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850230793_793_1589443"><tr id="1557850230793_793_4260396"><td class="column" width="575" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850230793_793_431870"><div class="lyrow firstGridRow ui-draggable" id="1557850440904_904_7628069">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850440904_904_3097254"><i class="fa-remove fa" id="1557850440904_904_7221491"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850440904_904_358640"><i class="fa fa-arrows-alt" id="1557850440904_904_6478156"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-21" id="1557850440904_904_7340047"><i class="fa fa-copy" id="1557850440904_904_2862782"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850440904_904_8320958"><i class="fa fa-angle-double-down" id="1557850440904_904_314710"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850440904_904_6842146"><i class="fa fa-plus" id="1557850440904_904_5826840"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850440904_904_5058826"><i class="fa fa-clone" id="1557850440904_904_2909595"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850440904_904_5415856"><i class="fa fa-database" id="1557850440904_904_8109121"></i></a>
                            <div class="preview" id="1557850440904_904_399938">
                                <div class="row" id="1557850440904_904_9278361">
                                    <div class="col-md-8 gridInputColPadding" id="1557850440904_904_5970421">
                                        <input id="1557850440904_904_3999453" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850440904_904_6748999">
                                        <p id="1557850440904_904_1212828">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850440904_904_9015956">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="1557850440904_904_2799814" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850440904_904_1120640"><tr id="1557850440904_904_6002254"><td class="column" width="20" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850440904_904_8866224">&nbsp;</td><td class="column" width="555" valign="top" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); font-size: 17px; line-height: 17px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850440904_904_9243903" data-fs="17px" data-lh="17px">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850440904_904_259786">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850440904_904_1593225"><i class="fa-remove fa" id="1557850440904_904_3571780"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850440905_905_2930183"><i class="fa fa-arrows-alt" id="1557850440905_905_9014879"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-27" id="1557850440905_905_2867957"><i class="fa fa-copy" id="1557850440905_905_2918622"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850440905_905_7931787"><i class="fa fa-angle-double-down" id="1557850440905_905_3979625"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850440905_905_7234373"><i class="fa fa-plus" id="1557850440905_905_8038760"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850440905_905_3512330"><i class="fa fa-clone" id="1557850440905_905_7574120"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850440905_905_3254928"><i class="fa fa-database" id="1557850440905_905_8892239"></i></a>
                            <div class="preview" id="1557850440905_905_9808969">
                                <div class="row" id="1557850440905_905_5251154">
                                    <div class="col-md-8 gridInputColPadding" id="1557850440905_905_5740574">
                                        <input id="1557850440905_905_2724447" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850440905_905_5697">
                                        <p id="1557850440905_905_9990065">= 555</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850440905_905_8325087">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="1557850440905_905_2452443" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="555"><tbody id="1557850440905_905_7568916"><tr id="1557850440905_905_439787"><td class="column" width="5" valign="top" style="font-family: Arial, Helvetica, sans-serif;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850440905_905_2183034">&amp;#08226;</td><td class="column" width="5" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850440905_905_9183119">&nbsp;</td><td class="column" width="545" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; line-height: 21px;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850440905_905_7262270" data-fs="18px" data-lh="21px">Learning Objective 1</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div></td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850231490_490_2610114">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850231490_490_2047591"><i class="fa-remove fa" id="1557850231490_490_9241530"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850231490_490_8455526"><i class="fa fa-arrows-alt" id="1557850231490_490_1477832"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-12" id="1557850231490_490_5481485"><i class="fa fa-copy" id="1557850231490_490_3372194"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850231490_490_8703700"><i class="fa fa-angle-double-down" id="1557850231490_490_8659221"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850231490_490_2622131"><i class="fa fa-plus" id="1557850231490_490_7453886"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850231490_490_8234134"><i class="fa fa-clone" id="1557850231490_490_6380912"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850231490_490_1685540"><i class="fa fa-database" id="1557850231490_490_3777199"></i></a>
                            <div class="preview" id="1557850231490_490_6231968">
                                <div class="row" id="1557850231490_490_6170671">
                                    <div class="col-md-8 gridInputColPadding" id="1557850231490_490_8740130">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850231490_490_6366812">
                                        <p id="gridInputCount">= 575</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850231490_490_8007363">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="575"><tbody id="1557850231490_490_2525253"><tr id="1557850231490_490_5244619"><td class="column columnBorder" width="575" valign="top" height="110" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 110px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850231490_490_4727979" data-lh="110px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/prevmisFragment.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Prevmis Fragment</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557850675765_765_6359021">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850675765_765_4383707"><i class="fa-remove fa" id="1557850675765_765_8336903"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850675765_765_7043281"><i class="fa fa-arrows-alt" id="1557850675765_765_7653384"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-24" id="1557850675765_765_6092650"><i class="fa fa-copy" id="1557850675765_765_9985867"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850675765_765_2432518"><i class="fa fa-angle-double-down" id="1557850675765_765_7450391"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850675765_765_1977043"><i class="fa fa-plus" id="1557850675765_765_2563620"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850675765_765_6909180"><i class="fa fa-clone" id="1557850675765_765_8273442"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850675765_765_9897188"><i class="fa fa-database" id="1557850675766_766_2664052"></i></a>
                            <div class="preview" id="1557850675766_766_697179">
                                <div class="row" id="1557850675766_766_3278451">
                                    <div class="col-md-8 gridInputColPadding" id="1557850675766_766_1379055">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850675766_766_2624421">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850675766_766_9763322">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557850675766_766_8633923"><tr id="1557850675766_766_1839767"><td class="column ui-sortable ui-droppable" width="600" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850675766_766_7378351">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850739980_980_7732903">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850739980_980_8024215"><i class="fa-remove fa" id="1557850739980_980_3174102"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850739980_980_9223902"><i class="fa fa-arrows-alt" id="1557850739980_980_5206458"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-31" id="1557850739980_980_9915655"><i class="fa fa-copy" id="1557850739980_980_7150877"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850739980_980_2198157"><i class="fa fa-angle-double-down" id="1557850739980_980_4858495"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850739980_980_795133"><i class="fa fa-plus" id="1557850739980_980_9401591"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850739980_980_1866106"><i class="fa fa-clone" id="1557850739981_981_2009695"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850739981_981_7985543"><i class="fa fa-database" id="1557850739981_981_8921217"></i></a>
                            <div class="preview" id="1557850739981_981_6876749">
                                <div class="row" id="1557850739981_981_9679912">
                                    <div class="col-md-8 gridInputColPadding" id="1557850739981_981_6263891">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850739981_981_8556030">
                                        <p id="gridInputCount">= 600</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850739981_981_2640236">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="600"><tbody id="1557850739981_981_5771061"><tr id="1557850739981_981_6474544"><td class="column" width="135" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850739981_981_1816115">
                <div class="box box-element previewImg" data-type="image" id="1557850929396_396_9198823">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557850929396_396_7357140"><i class="fa fa-remove" id="1557850929396_396_4186058"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557850929396_396_1655894"><i class="fa fa-arrows-alt" id="1557850929396_396_6874459"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-45" id="1557850929396_396_5573879">
                    <i class="fa fa-copy" id="1557850929396_396_8116677"></i>
                    </a> 
                    <div class="preview" id="1557850929396_396_4520986">
                        <i class="fa fa-picture-o fa-2x" id="1557850929396_396_8468342"></i>
                        <div class="element-desc" id="1557850929396_396_8585913">Image</div>
                    </div>
                    <div class="view" id="1557850929397_397_1113332"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="135" height="138" id="1557850929397_397_9081800"> </div>
                </div>
            </td><td class="column" width="465" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850739981_981_6107484">&nbsp;</td><td class="column" width="445" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850739981_981_5625698">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850759442_442_2202073">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850759442_442_7791327"><i class="fa-remove fa" id="1557850759442_442_5438089"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850759442_442_6005564"><i class="fa fa-arrows-alt" id="1557850759442_442_9371009"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-37" id="1557850759442_442_4281853"><i class="fa fa-copy" id="1557850759442_442_1498357"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850759442_442_8423051"><i class="fa fa-angle-double-down" id="1557850759442_442_4879483"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850759442_442_7225291"><i class="fa fa-plus" id="1557850759442_442_3314658"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850759442_442_934560"><i class="fa fa-clone" id="1557850759442_442_277241"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850759442_442_2719165"><i class="fa fa-database" id="1557850759442_442_9504511"></i></a>
                            <div class="preview" id="1557850759442_442_4315896">
                                <div class="row" id="1557850759442_442_7246948">
                                    <div class="col-md-8 gridInputColPadding" id="1557850759442_442_5130263">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850759442_442_7123680">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850759442_442_4167220">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557850759442_442_7187838"><tr id="1557850759442_442_7226202"><td class="column" width="445" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 20px; line-height: 24px;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557850759442_442_9615847" data-fs="20px" data-lh="24px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850759873_873_2060004">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850759873_873_5734254"><i class="fa-remove fa" id="1557850759873_873_1329702"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850759873_873_1516300"><i class="fa fa-arrows-alt" id="1557850759874_874_9791239"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-37" id="1557850759874_874_305751"><i class="fa fa-copy" id="1557850759874_874_8734756"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850759874_874_721473"><i class="fa fa-angle-double-down" id="1557850759874_874_257985"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850759874_874_5986360"><i class="fa fa-plus" id="1557850759874_874_3141226"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850759874_874_9285414"><i class="fa fa-clone" id="1557850759874_874_1022953"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850759874_874_5270104"><i class="fa fa-database" id="1557850759874_874_199056"></i></a>
                            <div class="preview" id="1557850759874_874_6907413">
                                <div class="row" id="1557850759874_874_3991202">
                                    <div class="col-md-8 gridInputColPadding" id="1557850759874_874_9297754">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850759874_874_60316">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850759874_874_5306541">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557850759874_874_8649050"><tr id="1557850759874_874_2893279"><td class="column" width="445" valign="top" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557850759874_874_8790727">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850760243_243_267929">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850760243_243_6694227"><i class="fa-remove fa" id="1557850760243_243_5223743"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850760243_243_2854682"><i class="fa fa-arrows-alt" id="1557850760244_244_8970857"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-37" id="1557850760244_244_1173867"><i class="fa fa-copy" id="1557850760244_244_4195089"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850760244_244_5254143"><i class="fa fa-angle-double-down" id="1557850760244_244_5666850"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850760244_244_7596773"><i class="fa fa-plus" id="1557850760244_244_4117324"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850760244_244_7054321"><i class="fa fa-clone" id="1557850760244_244_1201723"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850760244_244_4764405"><i class="fa fa-database" id="1557850760244_244_8500058"></i></a>
                            <div class="preview" id="1557850760244_244_2604374">
                                <div class="row" id="1557850760244_244_8681105">
                                    <div class="col-md-8 gridInputColPadding" id="1557850760244_244_6115451">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850760244_244_9203509">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850760244_244_4186718">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557850760244_244_1915276"><tr id="1557850760244_244_4491436"><td class="column" width="445" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850760244_244_1278528">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850806212_212_3103562">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850806212_212_8933705"><i class="fa-remove fa" id="1557850806212_212_4952622"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850806212_212_8451213"><i class="fa fa-arrows-alt" id="1557850806212_212_552805"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-41" id="1557850806212_212_1556344"><i class="fa fa-copy" id="1557850806212_212_1111172"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850806212_212_9486929"><i class="fa fa-angle-double-down" id="1557850806213_213_5947589"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850806213_213_6653400"><i class="fa fa-plus" id="1557850806213_213_3466806"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850806213_213_8797823"><i class="fa fa-clone" id="1557850806213_213_7489366"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850806213_213_6275682"><i class="fa fa-database" id="1557850806213_213_5860044"></i></a>
                            <div class="preview" id="1557850806213_213_6579889">
                                <div class="row" id="1557850806213_213_9144758">
                                    <div class="col-md-8 gridInputColPadding" id="1557850806213_213_6184861">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850806213_213_7224365">
                                        <p id="gridInputCount">= 445</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850806213_213_5394746">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="445"><tbody id="1557850806213_213_8207507"><tr id="1557850806213_213_6318896"><td class="column" width="217" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850806213_213_5053045">
                        <div class="lyrow firstGridRow ui-draggable" id="1557850813241_241_1445135">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850813241_241_6370876"><i class="fa-remove fa" id="1557850813241_241_9992986"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850813241_241_7696964"><i class="fa fa-arrows-alt" id="1557850813241_241_7487202"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-42" id="1557850813241_241_9170899"><i class="fa fa-copy" id="1557850813241_241_2313533"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850813241_241_6175989"><i class="fa fa-angle-double-down" id="1557850813242_242_7960260"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850813242_242_3607015"><i class="fa fa-plus" id="1557850813242_242_4783101"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850813242_242_5799796"><i class="fa fa-clone" id="1557850813242_242_9736999"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850813242_242_5056804"><i class="fa fa-database" id="1557850813242_242_6582436"></i></a>
                            <div class="preview" id="1557850813242_242_1126735">
                                <div class="row" id="1557850813242_242_5944604">
                                    <div class="col-md-8 gridInputColPadding" id="1557850813242_242_725660">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850813242_242_8308912">
                                        <p id="gridInputCount">= 217</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850813242_242_1585221">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="217"><tbody id="1557850813242_242_5930575"><tr id="1557850813242_242_8573452"><td class="column" width="217" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); background-color: rgb(85, 85, 85); line-height: 10px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850813242_242_6510404" bgcolor="#555555" data-lh="10px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850813554_554_9036903">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850813554_554_1954495"><i class="fa-remove fa" id="1557850813554_554_1930877"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850813554_554_4898455"><i class="fa fa-arrows-alt" id="1557850813554_554_4406906"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-42" id="1557850813554_554_4961077"><i class="fa fa-copy" id="1557850813554_554_6885802"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850813554_554_9994170"><i class="fa fa-angle-double-down" id="1557850813555_555_4283774"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850813555_555_4438026"><i class="fa fa-plus" id="1557850813555_555_7106758"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850813555_555_1318226"><i class="fa fa-clone" id="1557850813555_555_35793"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850813555_555_4756421"><i class="fa fa-database" id="1557850813555_555_8526707"></i></a>
                            <div class="preview" id="1557850813555_555_6040209">
                                <div class="row" id="1557850813555_555_9688374">
                                    <div class="col-md-8 gridInputColPadding" id="1557850813555_555_410098">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850813555_555_8744599">
                                        <p id="gridInputCount">= 217</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850813555_555_9235026">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="217"><tbody id="1557850813555_555_281267"><tr id="1557850813555_555_9798463"><td class="column" width="217" valign="top" style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(85, 85, 85); color: rgb(255, 255, 255); text-align: center; font-size: 15px; line-height: 17px;" data-color="#ffffff" data-ff="Arial, Helvetica, sans-serif" id="1557850813555_555_1959497" bgcolor="#555555" data-ta="center" data-fs="15px" data-lh="17px"><strong id="1557850901863_863_4883891">Lorem ipsum dolor sit amet</strong></td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557850813808_808_5974462">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557850813808_808_5505502"><i class="fa-remove fa" id="1557850813808_808_7369441"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557850813808_808_4572001"><i class="fa fa-arrows-alt" id="1557850813808_808_6712336"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-42" id="1557850813808_808_4199623"><i class="fa fa-copy" id="1557850813808_808_3974564"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557850813808_808_1361773"><i class="fa fa-angle-double-down" id="1557850813808_808_5282476"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557850813808_808_8560747"><i class="fa fa-plus" id="1557850813808_808_4162360"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557850813808_808_1802986"><i class="fa fa-clone" id="1557850813808_808_261973"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557850813808_808_9385028"><i class="fa fa-database" id="1557850813808_808_1928871"></i></a>
                            <div class="preview" id="1557850813808_808_6275403">
                                <div class="row" id="1557850813808_808_7615993">
                                    <div class="col-md-8 gridInputColPadding" id="1557850813808_808_5424662">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557850813808_808_1031655">
                                        <p id="gridInputCount">= 217</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557850813808_808_4310496">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="217"><tbody id="1557850813808_808_1281786"><tr id="1557850813809_809_1750083"><td class="column" width="217" valign="top" height="10" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); background-color: rgb(85, 85, 85); line-height: 10px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850813809_809_8642375" bgcolor="#555555" data-lh="10px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="228" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557850806213_213_9848203">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/vaqtaFragment.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Vaqta Fragment</div>
                    </div>
                </div>
                <div class="view">
                   <div class="lyrow firstGridRow ui-draggable" id="1557851443257_257_4859137">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851443258_258_4252005"><i class="fa-remove fa" id="1557851443258_258_5644609"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851443258_258_3340879"><i class="fa fa-arrows-alt" id="1557851443258_258_676791"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-149" id="1557851443258_258_6895487"><i class="fa fa-copy" id="1557851443258_258_1487399"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851443258_258_6491688"><i class="fa fa-angle-double-down" id="1557851443258_258_8948561"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851443258_258_5278577"><i class="fa fa-plus" id="1557851443258_258_2055342"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851443258_258_99341"><i class="fa fa-clone" id="1557851443258_258_9951788"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851443258_258_339683"><i class="fa fa-database" id="1557851443258_258_4085447"></i></a>
                            <div class="preview" id="1557851443258_258_1503433">
                                <div class="row" id="1557851443258_258_7543094">
                                    <div class="col-md-8 gridInputColPadding" id="1557851443258_258_5734508">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851443258_258_396050">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851443258_258_8620627">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557851443258_258_9740141"><tr id="1557851443258_258_5707916"><td class="column" width="502" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851443258_258_7159118">
                        <div class="lyrow firstGridRow ui-draggable" id="1557851450741_741_175377">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851450741_741_4249772"><i class="fa-remove fa" id="1557851450741_741_2272151"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851450741_741_8688197"><i class="fa fa-arrows-alt" id="1557851450741_741_25983"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-159" id="1557851450741_741_8790652"><i class="fa fa-copy" id="1557851450741_741_9777253"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851450741_741_3568152"><i class="fa fa-angle-double-down" id="1557851450741_741_49641"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851450741_741_8584709"><i class="fa fa-plus" id="1557851450741_741_2776059"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851450741_741_9699207"><i class="fa fa-clone" id="1557851450741_741_1104783"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851450741_741_4194689"><i class="fa fa-database" id="1557851450741_741_3171203"></i></a>
                            <div class="preview" id="1557851450741_741_1924459">
                                <div class="row" id="1557851450741_741_4111364">
                                    <div class="col-md-8 gridInputColPadding" id="1557851450741_741_595333">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851450741_741_1570204">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851450741_741_8459102">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557851450741_741_1901579"><tr id="1557851450741_741_2626535"><td class="column" width="502" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851450741_741_8177728">
                        <div class="lyrow firstGridRow ui-draggable" id="1557851501707_707_9737294">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851501708_708_4333364"><i class="fa-remove fa" id="1557851501708_708_182183"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851501708_708_8126235"><i class="fa fa-arrows-alt" id="1557851501708_708_3528669"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-175" id="1557851501708_708_1762328"><i class="fa fa-copy" id="1557851501708_708_9341022"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851501708_708_4231818"><i class="fa fa-angle-double-down" id="1557851501708_708_6109690"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851501708_708_6273836"><i class="fa fa-plus" id="1557851501708_708_7291864"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851501708_708_524009"><i class="fa fa-clone" id="1557851501708_708_1148872"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851501708_708_4277873"><i class="fa fa-database" id="1557851501708_708_9651642"></i></a>
                            <div class="preview" id="1557851501708_708_8309146">
                                <div class="row" id="1557851501708_708_5337165">
                                    <div class="col-md-8 gridInputColPadding" id="1557851501708_708_4977813">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851501708_708_3294517">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851501708_708_3871301">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557851501708_708_6518843"><tr id="1557851501708_708_581345"><td class="column" width="40" valign="top" height="3" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 3px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851501708_708_6563329" data-lh="3px">&nbsp;</td><td class="column" width="422" valign="top" height="3" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); background-color: rgb(195, 195, 195); line-height: 3px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851501708_708_7829540" bgcolor="#c3c3c3" data-lh="3px">&nbsp;</td><td class="column" width="40" valign="top" height="3" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 3px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851501708_708_7421719" data-lh="3px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557852005826_826_239161">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852005826_826_38001"><i class="fa-remove fa" id="1557852005826_826_1516084"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852005826_826_7588132"><i class="fa fa-arrows-alt" id="1557852005826_826_3779067"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557852005826_826_6768044"><i class="fa fa-copy" id="1557852005826_826_726495"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-208" id="1557852005826_826_294763"><i class="fa fa-angle-double-down" id="1557852005826_826_3627664"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852005826_826_3145167"><i class="fa fa-plus" id="1557852005826_826_941456"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852005826_826_1483882"><i class="fa fa-clone" id="1557852005826_826_3629615"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852005827_827_1556459"><i class="fa fa-database" id="1557852005827_827_5206919"></i></a>
                            <div class="preview" id="1557852005827_827_944247">
                                <div class="row" id="1557852005827_827_6406393">
                                    <div class="col-md-8 gridInputColPadding" id="1557852005827_827_3133592">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852005827_827_9975879">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852005827_827_2418578">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557852005827_827_5058381"><tr id="1557852005827_827_1393457"><td class="column" width="502" valign="top" height="20" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852005827_827_7256840">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557851451085_85_7674428">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851451085_85_7430830"><i class="fa-remove fa" id="1557851451085_85_3035540"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851451085_85_75170"><i class="fa fa-arrows-alt" id="1557851451085_85_6944014"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-159" id="1557851451085_85_4234816"><i class="fa fa-copy" id="1557851451085_85_1345391"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851451085_85_7150659"><i class="fa fa-angle-double-down" id="1557851451085_85_681435"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851451085_85_4718963"><i class="fa fa-plus" id="1557851451085_85_1634261"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851451085_85_1142019"><i class="fa fa-clone" id="1557851451085_85_9733738"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851451085_85_8039823"><i class="fa fa-database" id="1557851451085_85_7290481"></i></a>
                            <div class="preview" id="1557851451085_85_7143806">
                                <div class="row" id="1557851451085_85_5498023">
                                    <div class="col-md-8 gridInputColPadding" id="1557851451086_86_1916364">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851451086_86_4478020">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851451086_86_6151529">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557851451086_86_7055753"><tr id="1557851451086_86_7309695"><td class="column" width="502" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851451086_86_2765208">
                        <div class="lyrow firstGridRow ui-draggable" id="1557851476323_323_9005882">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851476323_323_8183145"><i class="fa-remove fa" id="1557851476324_324_3417108"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851476324_324_9613727"><i class="fa fa-arrows-alt" id="1557851476324_324_4759538"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-167" id="1557851476324_324_8684115"><i class="fa fa-copy" id="1557851476324_324_420873"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851476324_324_3956514"><i class="fa fa-angle-double-down" id="1557851476324_324_6505010"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851476324_324_3299488"><i class="fa fa-plus" id="1557851476324_324_4742687"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851476324_324_7689523"><i class="fa fa-clone" id="1557851476324_324_2528551"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851476324_324_3558566"><i class="fa fa-database" id="1557851476324_324_9459212"></i></a>
                            <div class="preview" id="1557851476324_324_6949263">
                                <div class="row" id="1557851476324_324_7370395">
                                    <div class="col-md-8 gridInputColPadding" id="1557851476324_324_4264132">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851476324_324_3433059">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851476325_325_172287">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557851476325_325_2052104"><tr id="1557851476325_325_4406430"><td class="column" width="113" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851476325_325_8296394">
                <div class="box box-element previewImg" data-type="image" id="1557851556741_741_2781478">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557851556741_741_5518214"><i class="fa fa-remove" id="1557851556741_741_8715908"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557851556741_741_8729277"><i class="fa fa-arrows-alt" id="1557851556741_741_2998334"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-187" id="1557851556741_741_7623641">
                    <i class="fa fa-copy" id="1557851556741_741_8193137"></i>
                    </a> 
                    <div class="preview" id="1557851556741_741_6815746">
                        <i class="fa fa-picture-o fa-2x" id="1557851556741_741_9345006"></i>
                        <div class="element-desc" id="1557851556741_741_1035640">Image</div>
                    </div>
                    <div class="view" id="1557851556741_741_7998079"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="113" height="113" id="1557851556741_741_1256373"> </div>
                </div>
            </td><td class="column" width="33" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851476325_325_4387378">&nbsp;</td><td class="column" width="213" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851476325_325_2129512">
                        <div class="lyrow firstGridRow ui-draggable" id="1557851570706_706_9849014">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851570706_706_8030649"><i class="fa-remove fa" id="1557851570706_706_5322536"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851570706_706_8940374"><i class="fa fa-arrows-alt" id="1557851570706_706_252583"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-189" id="1557851570706_706_7879633"><i class="fa fa-copy" id="1557851570706_706_2394504"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851570707_707_8966346"><i class="fa fa-angle-double-down" id="1557851570707_707_7438414"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851570707_707_9202169"><i class="fa fa-plus" id="1557851570707_707_1742653"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851570707_707_7337606"><i class="fa fa-clone" id="1557851570707_707_2635281"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851570707_707_1053037"><i class="fa fa-database" id="1557851570707_707_8528616"></i></a>
                            <div class="preview" id="1557851570707_707_6658847">
                                <div class="row" id="1557851570707_707_9507267">
                                    <div class="col-md-8 gridInputColPadding" id="1557851570707_707_2025939">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851570707_707_6518557">
                                        <p id="gridInputCount">= 213</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851570707_707_3348804">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="213"><tbody id="1557851570707_707_4658419"><tr id="1557851570707_707_557434"><td class="column" width="213" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 19px; line-height: 25px; text-align: center;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557851570707_707_5590200" data-fs="19px" data-lh="25px" data-ta="center">Lorem Ipsum</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557851571062_62_2357691">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851571062_62_5526698"><i class="fa-remove fa" id="1557851571062_62_279654"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851571062_62_5346787"><i class="fa fa-arrows-alt" id="1557851571062_62_282479"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-189" id="1557851571062_62_1942046"><i class="fa fa-copy" id="1557851571062_62_3997919"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851571062_62_53590"><i class="fa fa-angle-double-down" id="1557851571062_62_5373158"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851571062_62_2622103"><i class="fa fa-plus" id="1557851571062_62_9403582"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851571062_62_969939"><i class="fa fa-clone" id="1557851571062_62_3807952"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851571062_62_2687364"><i class="fa fa-database" id="1557851571062_62_2029279"></i></a>
                            <div class="preview" id="1557851571062_62_6991269">
                                <div class="row" id="1557851571062_62_6379821">
                                    <div class="col-md-8 gridInputColPadding" id="1557851571062_62_8756404">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851571062_62_6558458">
                                        <p id="gridInputCount">= 213</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851571062_62_5388955">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="213"><tbody id="1557851571062_62_4328023"><tr id="1557851571062_62_2308140"><td class="column" width="213" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 19px; line-height: 25px;color:#555555;" data-color="#555555" data-ff="Arial, Helvetica, sans-serif" id="1557851571063_63_3768813" data-fs="19px" data-lh="25px">cupidatat non proident, sunt in culpa</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557851571415_415_2077266">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851571415_415_8996078"><i class="fa-remove fa" id="1557851571415_415_2810400"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851571415_415_3326502"><i class="fa fa-arrows-alt" id="1557851571415_415_413230"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-189" id="1557851571415_415_7039918"><i class="fa fa-copy" id="1557851571415_415_2227476"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851571416_416_9825995"><i class="fa fa-angle-double-down" id="1557851571416_416_8317030"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851571416_416_8981630"><i class="fa fa-plus" id="1557851571416_416_6704394"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851571416_416_8263339"><i class="fa fa-clone" id="1557851571416_416_1101618"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851571416_416_554941"><i class="fa fa-database" id="1557851571416_416_2845801"></i></a>
                            <div class="preview" id="1557851571416_416_4383865">
                                <div class="row" id="1557851571416_416_174739">
                                    <div class="col-md-8 gridInputColPadding" id="1557851571416_416_1889486">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851571416_416_3026818">
                                        <p id="gridInputCount">= 213</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851571416_416_5070653">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="213"><tbody id="1557851571416_416_8506942"><tr id="1557851571416_416_1795239"><td class="column" width="213" valign="top" height="20" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 20px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851571416_416_7105137" data-lh="20px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557851571741_741_1761332">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851571741_741_4502467"><i class="fa-remove fa" id="1557851571741_741_5132857"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851571741_741_9757879"><i class="fa fa-arrows-alt" id="1557851571741_741_6487712"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-189" id="1557851571741_741_7568920"><i class="fa fa-copy" id="1557851571741_741_6723434"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851571742_742_2814971"><i class="fa fa-angle-double-down" id="1557851571742_742_3627005"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851571742_742_2051846"><i class="fa fa-plus" id="1557851571742_742_9274145"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851571742_742_9329315"><i class="fa fa-clone" id="1557851571742_742_1950691"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851571742_742_7829593"><i class="fa fa-database" id="1557851571742_742_2897869"></i></a>
                            <div class="preview" id="1557851571742_742_5024145">
                                <div class="row" id="1557851571742_742_6160992">
                                    <div class="col-md-8 gridInputColPadding" id="1557851571742_742_2991372">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851571742_742_5995291">
                                        <p id="gridInputCount">= 213</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851571742_742_3915424">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="213"><tbody id="1557851571742_742_3054618"><tr id="1557851571742_742_5646867"><td class="column" width="213" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851571742_742_7188868">
                        <div class="lyrow firstGridRow ui-draggable" id="1557851650932_932_82838">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851650932_932_2865169"><i class="fa-remove fa" id="1557851650932_932_5556544"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851650932_932_3790640"><i class="fa fa-arrows-alt" id="1557851650932_932_1904234"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-191" id="1557851650932_932_2659755"><i class="fa fa-copy" id="1557851650932_932_3578991"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851650932_932_5454932"><i class="fa fa-angle-double-down" id="1557851650932_932_8447830"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851650933_933_3703775"><i class="fa fa-plus" id="1557851650933_933_5964472"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851650933_933_6253569"><i class="fa fa-clone" id="1557851650933_933_4591181"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851650933_933_8053284"><i class="fa fa-database" id="1557851650933_933_6879345"></i></a>
                            <div class="preview" id="1557851650933_933_4039326">
                                <div class="row" id="1557851650933_933_3772877">
                                    <div class="col-md-8 gridInputColPadding" id="1557851650933_933_3687790">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851650933_933_917521">
                                        <p id="gridInputCount">= 213</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851650933_933_1398420">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="213"><tbody id="1557851650933_933_9781302"><tr id="1557851650933_933_8024679"><td class="column" width="206" valign="top" style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(85, 85, 85); border-radius: 30px; color: rgb(255, 255, 255); text-align: center; padding-top: 12px; padding-bottom: 12px;" data-color="#ffffff" data-ff="Arial, Helvetica, sans-serif" id="1557851650933_933_7257854" bgcolor="#555555" data-ta="center" data-pt="12px" data-pb="12px"><strong id="1557851950370_370_2958652">
                        
                    
                        
                    
                        
                    Lorem Ipsum</strong></td><td class="column" width="7" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851650933_933_9957902">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="143" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851476325_325_1661492">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                        <div class="lyrow firstGridRow ui-draggable" id="1557852014748_748_2250986">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852014748_748_5923381"><i class="fa-remove fa" id="1557852014748_748_6171159"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852014748_748_5406341"><i class="fa fa-arrows-alt" id="1557852014748_748_9343628"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="Append in Selected element" id="1557852014748_748_5066939"><i class="fa fa-copy" id="1557852014748_748_302491"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-210" id="1557852014748_748_2171382"><i class="fa fa-angle-double-down" id="1557852014748_748_3718729"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852014748_748_4460947"><i class="fa fa-plus" id="1557852014748_748_6214776"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852014748_748_4991508"><i class="fa fa-clone" id="1557852014748_748_7013969"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852014748_748_3150369"><i class="fa fa-database" id="1557852014748_748_610649"></i></a>
                            <div class="preview" id="1557852014748_748_3358045">
                                <div class="row" id="1557852014748_748_6386477">
                                    <div class="col-md-8 gridInputColPadding" id="1557852014748_748_4330502">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852014748_748_4217550">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852014748_748_5607825">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557852014748_748_7081090"><tr id="1557852014748_748_1202760"><td class="column" width="502" valign="top" height="20" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852014748_748_8884886">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557851451484_484_1737794">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851451484_484_7105834"><i class="fa-remove fa" id="1557851451484_484_6919287"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851451484_484_4558953"><i class="fa fa-arrows-alt" id="1557851451484_484_1411966"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-159" id="1557851451484_484_5762670"><i class="fa fa-copy" id="1557851451484_484_4525750"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851451484_484_2127117"><i class="fa fa-angle-double-down" id="1557851451484_484_4160267"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851451484_484_8163558"><i class="fa fa-plus" id="1557851451484_484_766239"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851451484_484_9425609"><i class="fa fa-clone" id="1557851451484_484_1645437"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851451484_484_686763"><i class="fa fa-database" id="1557851451484_484_2641364"></i></a>
                            <div class="preview" id="1557851451484_484_1239950">
                                <div class="row" id="1557851451484_484_2138972">
                                    <div class="col-md-8 gridInputColPadding" id="1557851451484_484_5158494">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851451484_484_3186762">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851451484_484_953255">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557851451484_484_8704138"><tr id="1557851451484_484_9512708"><td class="column" width="502" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851451484_484_2075961">
                        <div class="lyrow firstGridRow ui-draggable" id="1557851503795_795_6616503">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557851503795_795_9517472"><i class="fa-remove fa" id="1557851503795_795_739119"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557851503795_795_5575619"><i class="fa fa-arrows-alt" id="1557851503795_795_8842432"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-181" id="1557851503795_795_7985272"><i class="fa fa-copy" id="1557851503795_795_91955"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557851503795_795_3579986"><i class="fa fa-angle-double-down" id="1557851503795_795_5112708"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557851503795_795_6683117"><i class="fa fa-plus" id="1557851503795_795_2921903"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557851503795_795_3722966"><i class="fa fa-clone" id="1557851503795_795_3355288"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557851503795_795_7160281"><i class="fa fa-database" id="1557851503795_795_2116605"></i></a>
                            <div class="preview" id="1557851503795_795_966347">
                                <div class="row" id="1557851503795_795_5942711">
                                    <div class="col-md-8 gridInputColPadding" id="1557851503795_795_8247804">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557851503795_795_2381888">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557851503795_795_896229">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557851503795_795_6047310"><tr id="1557851503795_795_3386108"><td class="column" width="40" valign="top" height="3" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 3px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851503795_795_6917608" data-lh="3px">&nbsp;</td><td class="column" width="422" valign="top" height="3" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); background-color: rgb(195, 195, 195); line-height: 3px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851503795_795_4186277" bgcolor="#c3c3c3" data-lh="3px">&nbsp;</td><td class="column" width="40" valign="top" height="3" style="font-family: Arial, Helvetica, sans-serif; color: rgb(88, 88, 88); line-height: 3px;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557851503796_796_9122023" data-lh="3px">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div> 
                </div>
            </li>

            <li class="col-md-12" id="estRows">
                <div class="lyrow ui-draggable snippetsMarginTop">
                <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy to Canvas">
                <i class="fa fa-copy"></i>
                </a>
                <div class="preview">
                    <div id="opening-sal-image">
                        <img src="img/vaqtaMonroeFrag.png"  class="img-responsive images SnippetsImg" border="none" />
                        <div class="element-desc snippetsMarginTop">Vaqta Monroe Fragment</div>
                    </div>
                </div>
                <div class="view">
                    <div class="lyrow firstGridRow ui-draggable" id="1557852215502_502_3721290">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852215503_503_4112326"><i class="fa-remove fa" id="1557852215503_503_4921226"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852215503_503_3764295"><i class="fa fa-arrows-alt" id="1557852215503_503_5387465"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-259" id="1557852215503_503_6916706"><i class="fa fa-copy" id="1557852215503_503_5417249"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557852215503_503_6957226"><i class="fa fa-angle-double-down" id="1557852215503_503_8224711"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852215503_503_4305266"><i class="fa fa-plus" id="1557852215503_503_9064752"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852215503_503_7759277"><i class="fa fa-clone" id="1557852215503_503_3570793"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852215503_503_303729"><i class="fa fa-database" id="1557852215503_503_5687456"></i></a>
                            <div class="preview" id="1557852215503_503_8453729">
                                <div class="row" id="1557852215503_503_6299819">
                                    <div class="col-md-8 gridInputColPadding" id="1557852215503_503_6507336">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852215504_504_5882996">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852215504_504_1234238">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557852215504_504_608907"><tr id="1557852215504_504_1221177"><td class="column" width="502" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852215504_504_167076">
                        <div class="lyrow firstGridRow ui-draggable" id="1557852274684_684_4050803">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852274684_684_9578805"><i class="fa-remove fa" id="1557852274684_684_3881059"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852274684_684_7432787"><i class="fa fa-arrows-alt" id="1557852274684_684_3237826"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-263" id="1557852274684_684_492303"><i class="fa fa-copy" id="1557852274684_684_3339545"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557852274684_684_8670714"><i class="fa fa-angle-double-down" id="1557852274684_684_6307976"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852274684_684_371456"><i class="fa fa-plus" id="1557852274684_684_7247418"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852274685_685_9059164"><i class="fa fa-clone" id="1557852274685_685_3268524"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852274685_685_8979170"><i class="fa fa-database" id="1557852274685_685_7116094"></i></a>
                            <div class="preview" id="1557852274685_685_4720338">
                                <div class="row" id="1557852274685_685_9393835">
                                    <div class="col-md-8 gridInputColPadding" id="1557852274685_685_3134710">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852274685_685_3381215">
                                        <p id="gridInputCount">= 502</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852274685_685_6667007">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="502"><tbody id="1557852274685_685_990050"><tr id="1557852274685_685_3763538"><td class="column" width="210" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852274686_686_271805">
                        <div class="lyrow firstGridRow ui-draggable" id="1557852298802_802_2154321">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852298802_802_7732922"><i class="fa-remove fa" id="1557852298802_802_2032124"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852298802_802_1731217"><i class="fa fa-arrows-alt" id="1557852298802_802_9117934"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-266" id="1557852298803_803_7211578"><i class="fa fa-copy" id="1557852298803_803_4072951"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557852298803_803_4337566"><i class="fa fa-angle-double-down" id="1557852298803_803_9799471"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852298803_803_770711"><i class="fa fa-plus" id="1557852298803_803_230830"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852298803_803_115903"><i class="fa fa-clone" id="1557852298803_803_7069148"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852298803_803_7273822"><i class="fa fa-database" id="1557852298803_803_8678320"></i></a>
                            <div class="preview" id="1557852298803_803_8389496">
                                <div class="row" id="1557852298803_803_4079263">
                                    <div class="col-md-8 gridInputColPadding" id="1557852298803_803_4267534">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852298803_803_7269209">
                                        <p id="gridInputCount">= 210</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852298803_803_2991039">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="210"><tbody id="1557852298803_803_4411699"><tr id="1557852298803_803_6069948"><td class="column" width="210" valign="top" height="20" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852298803_803_265953">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557852299185_185_3808395">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852299185_185_4876227"><i class="fa-remove fa" id="1557852299185_185_5720613"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852299185_185_2840029"><i class="fa fa-arrows-alt" id="1557852299185_185_214918"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-266" id="1557852299185_185_2463088"><i class="fa fa-copy" id="1557852299185_185_835982"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557852299185_185_8682961"><i class="fa fa-angle-double-down" id="1557852299185_185_4330669"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852299186_186_4721228"><i class="fa fa-plus" id="1557852299186_186_8659269"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852299186_186_4680121"><i class="fa fa-clone" id="1557852299186_186_4497859"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852299186_186_6863340"><i class="fa fa-database" id="1557852299186_186_6204092"></i></a>
                            <div class="preview" id="1557852299186_186_5817485">
                                <div class="row" id="1557852299186_186_7005871">
                                    <div class="col-md-8 gridInputColPadding" id="1557852299186_186_3723972">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852299186_186_5268765">
                                        <p id="gridInputCount">= 210</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852299186_186_4595614">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="210"><tbody id="1557852299186_186_1274089"><tr id="1557852299186_186_7760465"><td class="column" width="210" valign="top" height="71" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" data-height="10" id="1557852299186_186_7463709">
                <div class="box box-element previewImg" data-type="image" id="1557852340721_721_62627">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557852340721_721_8131434"><i class="fa fa-remove" id="1557852340721_721_3708591"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557852340721_721_5773984"><i class="fa fa-arrows-alt" id="1557852340721_721_1481450"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-283" id="1557852340721_721_2624830">
                    <i class="fa fa-copy" id="1557852340721_721_7171947"></i>
                    </a> 
                    <div class="preview" id="1557852340721_721_1543147">
                        <i class="fa fa-picture-o fa-2x" id="1557852340721_721_6348977"></i>
                        <div class="element-desc" id="1557852340721_721_2956088">Image</div>
                    </div>
                    <div class="view" id="1557852340721_721_1662669"> <img src="http://placehold.it/50x50" class="img-responsive images currentSelectedImage" alt="" width="210" height="71" id="1557852340721_721_6111986"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557852299665_665_6887750">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852299665_665_8634439"><i class="fa-remove fa" id="1557852299665_665_1824153"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852299665_665_8005583"><i class="fa fa-arrows-alt" id="1557852299665_665_729162"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-266" id="1557852299665_665_1127374"><i class="fa fa-copy" id="1557852299665_665_5791456"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557852299665_665_2216187"><i class="fa fa-angle-double-down" id="1557852299665_665_4664939"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852299666_666_8503398"><i class="fa fa-plus" id="1557852299666_666_8460263"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852299666_666_5501736"><i class="fa fa-clone" id="1557852299666_666_5545967"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852299666_666_9649829"><i class="fa fa-database" id="1557852299666_666_6245817"></i></a>
                            <div class="preview" id="1557852299666_666_4679369">
                                <div class="row" id="1557852299666_666_9364249">
                                    <div class="col-md-8 gridInputColPadding" id="1557852299666_666_6079575">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852299666_666_2546191">
                                        <p id="gridInputCount">= 210</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852299666_666_4493399">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="210"><tbody id="1557852299666_666_9245684"><tr id="1557852299666_666_89473"><td class="column" width="210" valign="top" height="30" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852299666_666_4903547">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    
                        <div class="lyrow firstGridRow ui-draggable" id="1557852300105_105_4988471">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852300105_105_5447835"><i class="fa-remove fa" id="1557852300105_105_8617345"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852300105_105_4351145"><i class="fa fa-arrows-alt" id="1557852300105_105_9601992"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-266" id="1557852300105_105_5100124"><i class="fa fa-copy" id="1557852300105_105_2072389"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557852300105_105_2559057"><i class="fa fa-angle-double-down" id="1557852300105_105_9631226"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852300105_105_457251"><i class="fa fa-plus" id="1557852300105_105_9931161"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852300105_105_4333192"><i class="fa fa-clone" id="1557852300105_105_3105806"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852300105_105_9722528"><i class="fa fa-database" id="1557852300105_105_710906"></i></a>
                            <div class="preview" id="1557852300105_105_4912328">
                                <div class="row" id="1557852300105_105_9085270">
                                    <div class="col-md-8 gridInputColPadding" id="1557852300105_105_1733587">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852300105_105_1329712">
                                        <p id="gridInputCount">= 210</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852300105_105_2531371">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="210"><tbody id="1557852300105_105_1734726"><tr id="1557852300105_105_5365514"><td class="column" width="210" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852300105_105_7478612">
                        <div class="lyrow firstGridRow ui-draggable" id="1557852385434_434_8700212">
                            <a href="#close" class="remove btn btn-danger btn-xs" id="1557852385435_435_1470090"><i class="fa-remove fa" id="1557852385435_435_7788992"></i></a>
                            <a class="drag btn btn-default btn-xs" data-toggle="tooltip" title="Drag" id="1557852385435_435_8600469"><i class="fa fa-arrows-alt" id="1557852385435_435_6902466"></i></a>
                            <a class="copy copyDiv btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-290" id="1557852385435_435_6742945"><i class="fa fa-copy" id="1557852385435_435_8464403"></i></a>
                            <a class="insertAfter btn btn-default btn-xs" data-toggle="tooltip" title="Insert After" id="1557852385435_435_2535710"><i class="fa fa-angle-double-down" id="1557852385435_435_1880493"></i></a>
                            <a class="plusCurrentRow btn btn-default btn-xs" data-toggle="tooltip" title="Add Layout" id="1557852385435_435_4727886"><i class="fa fa-plus" id="1557852385435_435_6054578"></i></a>
                            <a href="#" class="btn btn-info btn-xs clone" id="1557852385435_435_652308"><i class="fa fa-clone" id="1557852385435_435_9182272"></i></a>
                            <a href="#" class="btn btn-info btn-xs addSnippet" id="1557852385435_435_6243095"><i class="fa fa-database" id="1557852385435_435_9939718"></i></a>
                            <div class="preview" id="1557852385435_435_5123853">
                                <div class="row" id="1557852385435_435_7192970">
                                    <div class="col-md-8 gridInputColPadding" id="1557852385435_435_6038020">
                                        <input id="gridInput" type="text" value="" class="form-control">
                                    </div>
                                    <div class="col-md-4 gridInputColPadding" id="1557852385435_435_5378761">
                                        <p id="gridInputCount">= 210</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view" id="1557852385435_435_9491924">
                                <table class="row clearfix" border="0" cellspacing="0" cellpadding="0" align="center" id="mainTable" style="-webkit-user-modify: read-only; -moz-user-modify: read-only;" width="210"><tbody id="1557852385435_435_263410"><tr id="1557852385435_435_9002880"><td class="column" width="200" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 22px;color:#000000;" data-color="#000000" data-ff="Arial, Helvetica, sans-serif" id="1557852385435_435_738531" data-fs="16px" data-lh="22px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</td><td class="column" width="10" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852385435_435_8889285">&nbsp;</td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                    </td><td class="column" width="222" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852274686_686_1962232">&nbsp;</td><td class="column" width="280" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif" id="1557852274686_686_1878739">
                <div class="box box-element previewImg" data-type="image" id="1557852315252_252_6748667">
                    <a href="#close" class="remove btn btn-danger btn-xs" id="1557852315252_252_7356851"><i class="fa fa-remove" id="1557852315252_252_1911469"></i></a> 
                    <a class="drag btn btn-default btn-xs" id="1557852315252_252_923727"><i class="fa fa-arrows-alt" id="1557852315252_252_1659632"></i></a> 
                    <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="" aria-describedby="ui-tooltip-273" id="1557852315252_252_7875298">
                    <i class="fa fa-copy" id="1557852315252_252_3312465"></i>
                    </a> 
                    <div class="preview" id="1557852315252_252_1298570">
                        <i class="fa fa-picture-o fa-2x" id="1557852315252_252_1581682"></i>
                        <div class="element-desc" id="1557852315252_252_4895379">Image</div>
                    </div>
                    <div class="view" id="1557852315252_252_365990"> <img src="http://placehold.it/50x50" class="img-responsive images" alt="" width="280" height="280" id="1557852315252_252_9699063"> </div>
                </div>
            </td></tr></tbody></table>
                            </div>
                        </div>
                    </td></tr></tbody></table>
                            </div>
                        </div>
                </div>
            </li>
        </ul>
        </div>
        <!-- added iframe instead of internal div to avoid stying issues -->
        <!-- <div class="htmlpage" id="htmlpage" style="overflow:  auto;">
            </div> -->
        <iframe src="./htmlpage.php?_projectId=<?php echo $projectId ?>" id="htmlpage_iframe" class="htmlpage_iframe" data-project-id="<?php echo $projectId ?>" data-project-type="<?php echo $projectType ?>">
        <!-- empty -->
        </iframe>
        <!-- added iframe instead of internal div to avoid stying issues -->
        <div class="sidebar-nav-2" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
        <div class="jtabs ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-vertical ui-helper-clearfix">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
        <li class="ui-state-default ui-corner-left ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="true"><a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">CSS</a></li>
        <?php
            if($projectType == "veeva_responsive" || $projectType == "et_responsive"){
        ?>
        <li class="ui-state-default ui-corner-left" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-4" aria-selected="false"><a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-4">Mobile CSS</a></li>
        <?php
            }
        ?>
        </ul>
        <div id="tabs-3" aria-labelledby="ui-id-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="false" aria-hidden="false" style="display: block;">
        <div id="myTabContent" class="tab-content">
        <a id="savedURL" style="display: none;" download="index.html" class="btn btn-warning float-right"><i class="fa fa-save"></i>&nbsp;download</a>
        <!-- <label class="header cssHeader" data-header="content_header" for="header_content_header">
            <i class="fa fa-file-pdf-o"></i> &nbsp;<span>PDf Content </span>
            </label>
            <input class="header_check" type="checkbox" checked="true" id="header_content_header">
            <div class="section" data-section="content_header">
            <div class="form-group col-sm-12 d-inline-block" id="" data-key="font-family">
            <textarea id="contentFromPDF" readonly="" style="width:100%;max-width: 100%;min-width: 100%;"></textarea>
            </div>
            </div> -->
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
        <input name="fontFamily" type="text" value="" class="form-control autocomplete input_field_j" id="font_family" placeholder="Seperate font name by comma(,)">
        </div>
        </div>
        </div>
        </div>
        <div class="form-group  col-md-6 col-sm-6 d-inline-block ml5" data-key="color">
        <label class=" control-label" for="input-model">Text Color</label>
        <div class=" input">
        <div class="minicolors minicolors-theme-default minicolors-position-bottom minicolors-position-left">
        <input name="color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control autocompleteColors colorPicker input_field_j allInputs_j minicolors-input ui-autocomplete-input" id="text_color" placeholder="Ex: #ffffff" size="7" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span><span class="minicolors-swatch minicolors-sprite minicolors-input-swatch"><span class="minicolors-swatch-color"></span></span>
        <div class="minicolors-panel minicolors-slider-hue">
        <div class="minicolors-slider minicolors-sprite">
        <div class="minicolors-picker" style="top: 0px;"></div>
        </div>
        <div class="minicolors-opacity-slider minicolors-sprite">
        <div class="minicolors-picker"></div>
        </div>
        <div class="minicolors-grid minicolors-sprite" style="background-color: rgb(255, 0, 0);">
        <div class="minicolors-grid-inner"></div>
        <div class="minicolors-picker" style="top: 150px; left: 0px;">
        <div></div>
        </div>
        </div>
        </div>
        <!-- <div style="display: none; color: red;" id="colorError"><p>Invalid Hex Code</p></div> -->
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
        <div class="section" data-section="cssTD_header" id="cssTDHeaderStyle">
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
        <div class="col-md-6" style="float: left;">
        <div class=" input">
        <div class="input-group" id="cssunit-padding-left">
        <input name="number" type="number" value="" id="p_left" class="form-control input_field_j allInputs_j text-center" placeholder="Left">
        </div>
        </div>
        </div>
        <div class="col-md-6" style="float: right;">
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
        <div class="form-group  col-md-6 col-sm-6 d-inline-block ml5" data-key="td-bg-color">
        <label class=" control-label" for="input-model">TD BG Color</label>
        <div class=" input">
        <div>
        <input name="td-bg-color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j colorPicker" id="td_bg_color" placeholder="Ex: #007bff">
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
        <input name="border-color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j colorPicker" id="border_color" placeholder="Ex: #007bff">
        <div style="display: none; color: red;" id="BorderColorError"><p>Please input valid Hex Code</p></div>
        </div>
        </div>
        </div>
        <div class="form-group  col-md-6 d-inline-block mr5" data-key="td-valgin">
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
        <input name="bg-color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j colorPicker" id="table_bg_color" placeholder="Ex: #007bff">
        <div style="display: none; color: red;" id="tableBGColorError"><p>Please input valid Hex Code</p></div>
        </div>
        </div>
        </div>
        <div class="form-group  col-md-6  d-inline-block" data-key="table-align">
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
        <div class="form-group  col-md-6  d-inline-block" data-key="table-width">
        <label class=" control-label" for="input-model">Table Width</label>
        <div class="input">
        <div>
        <input name="parent_table_width" type="text" class="form-control input_field_j allInputs_j" id="parent_table_width" placeholder="Ex: 600">
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div id="tabs-4" aria-labelledby="ui-id-4" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;">
            <div class="form-group col-sm-12 d-inline-block " data-key="font-family">
                <label class=" control-label" for="input-model">Classes</label>
                <div class="input">
                    <div id="gjs-clm-tags-field" class="gjs-field">
                        <div id="gjs-clm-tags-c"></div>
                        <input id="gjs-clm-new" style="display: none;">
                        <span id="gjs-clm-add-tag" class="fa fa-plus" style=""></span>
                    </div>
                </div>
            </div>
            <div id="responsiveStyling">
                <div id="dimension" class="gjs-sm-sector gjs-sm-sector__dimension no-select" style="display: block;">
                    <div class="gjs-sm-title" id="dimensionTitle" data-sector-title="">
                        <i id="gjs-sm-caret" class="fa fa-caret-right"></i>
                        Dimension
                    </div>
                    <div class="gjs-sm-properties displayNone">
                        <div id="respWidth" class="gjs-sm-property gjs-sm-integer gjs-sm-property__width" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Width</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="auto" class="fieldsInput" id="respWidthInput">
                                <select id="respWidthOptions">
                                    <option value="px" selected="">px</option>
                                    <option value="%">%</option>
                                    <option value="vw">vw</option>
                                </select>
                            </div>
                        </div>
                        <div id="respHeight" class="gjs-sm-property gjs-sm-integer gjs-sm-property__height" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Height</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="auto" class="fieldsInput" id="respHeightInput">
                                <select id="respHeightOptions">
                                    <option value="px" selected="">px</option>
                                    <option value="%">%</option>
                                    <option value="vw">vw</option>
                                </select>
                            </div>
                        </div>
                        <div id="respMaxWidth" class="gjs-sm-property gjs-sm-integer gjs-sm-property__maxwidth" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Max-Width</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="auto" class="fieldsInput" id="respMaxWidthInput">
                                <select id="respMaxWidthOptions">
                                    <option value="px" selected="">px</option>
                                    <option value="%">%</option>
                                    <option value="vw">vw</option>
                                </select>
                            </div>
                        </div>
                        <div id="respMinHeight" class="gjs-sm-property gjs-sm-integer gjs-sm-property__minheight" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Min-Height</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="auto" class="fieldsInput" id="respMinHeightInput">
                                <select id="respMinHeightOptions">
                                    <option value="px" selected="">px</option>
                                    <option value="%">%</option>
                                    <option value="vw">vw</option>
                                </select>
                            </div>
                        </div>
                        <div id="respMargin" class="gjs-sm-property gjs-sm-integer gjs-sm-property__minheight" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Margin</span>
                            </div>
                            <div class="gjs-fields">
                                <div class="gjs-sm-field gjs-sm-composite">
                                    <div class="gjs-sm-properties">
                                        <div id="respMarginTop" class="gjs-sm-property gjs-sm-integer gjs-sm-property__margintop" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Top</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respMarginTopInput">
                                                <select id="respMarginTopOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="respMarginLeft" class="gjs-sm-property gjs-sm-integer gjs-sm-property__marginleft" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Left</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respMarginLeftInput">
                                                <select id="respMarginLeftOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="respMarginRight" class="gjs-sm-property gjs-sm-integer gjs-sm-property__marginright" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Right</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respMarginRightInput">
                                                <select id="respMarginRightOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="respMarginBottom" class="gjs-sm-property gjs-sm-integer gjs-sm-property__marginright" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Bottom</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respMarginBottomInput">
                                                <select id="respMarginBottomOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <input type="text" placeholder="auto" class="fieldsInput" id="respMarginInput">
                                <select>
                                    <option value="px" selected="">px</option>
                                    <option value="%">%</option>
                                    <option value="vw">vw</option>
                                </select> -->
                            </div>
                        </div>
                        <div id="respPadding" class="gjs-sm-property gjs-sm-integer gjs-sm-property__minpadding" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Padding</span>
                            </div>
                            <div class="gjs-fields">
                                <div class="gjs-sm-field gjs-sm-composite">
                                    <div class="gjs-sm-properties">
                                        <div id="respPaddingTop" class="gjs-sm-property gjs-sm-integer gjs-sm-property__margintop" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Top</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respPaddingTopInput">
                                                <select id="respPaddingTopOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="respPaddingLeft" class="gjs-sm-property gjs-sm-integer gjs-sm-property__marginleft" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Left</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respPaddingLeftInput">
                                                <select id="respPaddingLeftOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="respPaddingRight" class="gjs-sm-property gjs-sm-integer gjs-sm-property__marginright" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Right</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respPaddingRightInput">
                                                <select id="respPaddingRightOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="respPaddingBottom" class="gjs-sm-property gjs-sm-integer gjs-sm-property__marginright" style="display: block;">
                                            <div class="gjs-sm-label gjs-four-color">
                                                <span class="gjs-sm-icon">Bottom</span>
                                            </div>
                                            <div class="gjs-fields">
                                                <input type="text" placeholder="auto" class="fieldsInput" id="respPaddingBottomInput">
                                                <select id="respPaddingBottomOptions">
                                                    <option value="px" selected="">px</option>
                                                    <option value="%">%</option>
                                                    <option value="vw">vw</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="typography" class="gjs-sm-sector gjs-sm-sector__typography no-select" style="display: block;">
                    <div class="gjs-sm-title" data-sector-title="">
                        <i id="gjs-sm-caret" class="fa fa-caret-right"></i>
                        Typography
                    </div>
                    <div class="gjs-sm-properties displayNone">
                        <div id="respFontFamily" class="gjs-sm-property gjs-sm-integer gjs-sm-property__width" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Font family</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="Seperate font name by comma(,)" data-toggle="tooltip" title="Seperate font name by comma(,)" class="fieldsInput" id="respFontFamilyInput">
                            </div>
                        </div>
                        <div id="respFontSize" class="gjs-sm-property gjs-sm-integer gjs-sm-property__width" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Font size</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="auto" class="fieldsInput" id="respFontSizeInput">
                                <select id="respFontSizeOptions">
                                    <option value="px" selected="">px</option>
                                    <option value="%">%</option>
                                    <option value="em">em</option>
                                    <option value="rem">rem</option>
                                </select>
                            </div>
                        </div>
                        <div id="respLineHeight" class="gjs-sm-property gjs-sm-integer gjs-sm-property__width" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Line height</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="auto" class="fieldsInput" id="respLineHeightInput">
                                <select id="respLineHeightOptions">
                                    <option value="px" selected="">px</option>
                                    <option value="%">%</option>
                                    <option value="em">em</option>
                                    <option value="rem">rem</option>
                                </select>
                            </div>
                        </div>
                        <div id="respFontColor" class="gjs-sm-property gjs-sm-integer gjs-sm-property__width" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Font color</span>
                            </div>
                            <div class="gjs-fields">
                                <input type="text" placeholder="#000000" class="fieldsInput" id="respFontColorInput">
                            </div>
                        </div>
                        <div id="respTextAlign" class="gjs-sm-property gjs-sm-integer gjs-sm-property__width" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Text align</span>
                            </div>
                            <div class="gjs-fields">
                                <select id="respTextAlignOptions">
                                    <option value="none" selected="">None</option>
                                    <option value="center">Center</option>
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                    <option value="justify">Justify</option>
                                </select>
                                <!-- <div class="gjs-field gjs-field-radio">
                                    <div class="gjs-radio-items">

                                        <div class="gjs-radio-item">
                                            <input type="radio" class="gjs-sm-radio" id="text-align-left" name="text-align" value="left">
                                            <label class="fa fa-align-left gjs-sm-icon gjs-radio-item-label" for="text-align-left"></label>
                                        </div>
                  
                                        <div class="gjs-radio-item">
                                          <input type="radio" class="gjs-sm-radio" id="text-align-center" name="text-align" value="center">
                                          <label class="fa fa-align-center gjs-sm-icon gjs-radio-item-label" for="text-align-center"></label>
                                        </div>
                              
                                        <div class="gjs-radio-item">
                                          <input type="radio" class="gjs-sm-radio" id="text-align-right" name="text-align" value="right">
                                          <label class="fa fa-align-right gjs-sm-icon gjs-radio-item-label" for="text-align-right"></label>
                                        </div>
                              
                                        <div class="gjs-radio-item">
                                          <input type="radio" class="gjs-sm-radio" id="text-align-justify" name="text-align" value="justify">
                                          <label class="fa fa-align-justify gjs-sm-icon gjs-radio-item-label" for="text-align-justify"></label>
                                        </div>

                                    </div>
                                </div> -->
                            </div>
                        </div>

                    </div>
                </div>
                <div id="decorations" class="gjs-sm-sector gjs-sm-sector__decorations no-select" style="display: block;">
                    <div class="gjs-sm-title" data-sector-title="">
                        <i id="gjs-sm-caret" class="fa fa-caret-right"></i>
                        Decorations
                    </div>
                    <div class="gjs-sm-properties displayNone">
                        <div id="respBorderCollapse" class="gjs-sm-property gjs-sm-integer gjs-sm-property__width" style="display: block;">
                            <div class="gjs-sm-label gjs-four-color">
                                <span class="gjs-sm-icon">Border collapse</span>
                            </div>
                            <div class="gjs-fields">
                                <div class="gjs-field gjs-field-radio">
                                    <div class="gjs-radio-items">

                                        <div class="gjs-radio-item">
                                            <input type="radio" class="gjs-sm-radio" id="border-collapse-separate" name="border-collapse" value="separate">
                                            <label class="gjs-radio-item-label" for="border-collapse-separate">No</label>
                                        </div>
                  
                                        <div class="gjs-radio-item">
                                          <input type="radio" class="gjs-sm-radio" id="border-collapse-collapse" name="border-collapse" value="collapse">
                                          <label class="gjs-radio-item-label" for="border-collapse-collapse">Yes</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <?php require_once($root."components/modals.php") ?>
        <?php require_once($root."components/contextMenu.html") ?>
        <pre id="asciiReplace" class="hidden"></pre>
        <!-- dont delete this used for internal processing -->
        <div id="cloneResolver" class="hidden"></div>
        <!-- dont delete this used for internal processing -->
    </body>
</html>