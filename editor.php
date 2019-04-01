<?php $root = $_SERVER['DOCUMENT_ROOT']."/"; ?>
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

<body class="edit" ng-app="">
    
    <div class="navbar navbar-inverse navbar-fixed-top navbar-htmleditor" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>
        <div class="navbar-header">
            <button data-target="navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="glyphicon-bar"></span> <span class="glyphicon-bar"></span> <span class="glyphicon-bar"></span> </button> <a class="navbar-brand" href="javascript:;"><i class="fa fa-chevron-right "></i> <span class="c1">N</span><span class="c2">M</span><span class="c3">C</span></a> 
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav" id="menu-htmleditor">
                <li>Zoom
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
                        <button type="button" data-toggle="tooltip" title="Image Manager" class="btn upperIcon imageManagerBtn">
                            <i class="fa fa-image "></i> <!-- undo -->
                        </button>
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
                        <button type="button" data-toggle="modal" data-target="#pdfToPng" class="btn upperIcon" >
                            <i class="fa fa-file" data-toggle="tooltip" title="Pdf Upload For Mopix"></i>
                        </button>
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
                    <!-- <li><a href="#tabs-2">SFMC</a></li> -->
                  </ul>
                  <div id="tabs-1">
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
                                    <td class="column" valign="top" width="50" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                    <td class="column" valign="top" width="500" height="10" style="font-family:Arial, Helvetica, sans-serif;  color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                    <td class="column" valign="top" width="50" height="10" style="font-family:Arial, Helvetica, sans-serif; color:#585858;" data-color="#585858" data-ff="Arial, Helvetica, sans-serif"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </li>
                  </div>
                  <!-- <div id="tabs-2" class="text-center">
                        Under Developement
                  </div> -->
                </div>
            
            </ul>

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

            <ul class="nav nav-list">
                <li class="nav-header"><i class="fa fa-html5"></i>&nbsp; Snippets </li>
                <li class="col-md-12" id="estRows">
                    <div class="lyrow ui-draggable snippetsMarginTop">
                        <a class="copy2 copyImage btn btn-default btn-xs" data-toggle="tooltip" title="Copy Greetings to Canvas">
                            <i class="glyphicon glyphicon-copy"></i>
                        </a>
                        <div class="preview">
                            <div id="opening-sal-image"><img src="img/greetingsSalutation.PNG"  class="img-responsive images SnippetsImg" border="none" />
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
                            <i class="glyphicon glyphicon-copy"></i>
                        </a>
                        <div class="preview">
                            <div id="opening-sal-image"><img src="img/closingSalutation.PNG"  class="img-responsive images SnippetsImg" border="none" />
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
                            <i class="glyphicon glyphicon-copy"></i>
                        </a>
                        <div class="preview">
                            <div id="opening-sal-image"><img src="img/nameNumberSalutation.PNG"  class="img-responsive images SnippetsImg" border="none" />
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
                            <i class="glyphicon glyphicon-copy"></i>
                        </a>
                        <div class="preview">
                            <div id="opening-sal-image"><img src="img/imageWithButton.PNG"  class="img-responsive images SnippetsImg" border="none" />
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
                            <i class="glyphicon glyphicon-copy"></i>
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
            </ul>



        </div>

        <!-- added iframe instead of internal div to avoid stying issues -->
        <!-- <div class="htmlpage" id="htmlpage" style="overflow:  auto;">
        </div> -->
        <iframe src="./htmlpage.html" id="htmlpage_iframe" class="htmlpage_iframe">
            <!-- empty -->
        </iframe>
        <!-- added iframe instead of internal div to avoid stying issues -->

        <div class="sidebar-nav-2" style='-webkit-user-modify: read-only; -moz-user-modify: read-only;'>

            <div class="jtabs ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-vertical ui-helper-clearfix">
              <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
                <li class="ui-state-default ui-corner-left ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-3" aria-labelledby="ui-id-3" aria-selected="true"><a href="#tabs-3" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-3">CSS</a></li>
                <!-- <li class="ui-state-default ui-corner-left" role="tab" tabindex="-1" aria-controls="tabs-4" aria-labelledby="ui-id-4" aria-selected="false"><a href="#tabs-4" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-4">Options</a></li> -->
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
                                <input name="bg-color" type="text" value="" pattern="#[a-f0-9]{6}" class="form-control input_field_j allInputs_j colorPicker" id="table_bg_color" placeholder="Ex: #007bff">
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
              <div id="tabs-4" aria-labelledby="ui-id-4" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-expanded="false" aria-hidden="true" style="display: none;">
               nothing here
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

    <?php require_once($root."components/modals.html") ?>
    <?php require_once($root."components/contextMenu.html") ?>


    <pre id="asciiReplace" class="hidden"></pre>

    <!-- dont delete this used for internal processing -->
    <div id="cloneResolver" class="hidden"></div>
    <!-- dont delete this used for internal processing -->
</body>

</html>