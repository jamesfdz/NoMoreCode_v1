<?php

    $html_code = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-type" content="text/html; charset=windows-1252"/>
            <title>
            </title>
        </head>
        <body bgcolor="#ffffff">
            <table border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td valign="top" width="5" style="font-family:Arial, Helvetica, sans-serif; color:#585858;">
                    </td>
                    <td valign="top" width="590" style="font-family:Arial, Helvetica, sans-serif;  color:#585858;">
                        vaibhav ZZZZ&#00038; more
                    </td>
                    <td valign="top" width="5" style="font-family:Arial, Helvetica, sans-serif; color:#585858;">
                    </td>
                </tr>
            </table>
        </body>
    </html>';

    $html_code = str_replace("ZZZZ","", $html_code);
    echo $html_code;

?>