<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>.bold,b,strong{font-weight:700}body{background-repeat:no-repeat;background-position:center center;text-align:center;margin:0;font-family: Verdana, monospace}  .tabla_borde{border:1px solid #666;border-radius:10px}  tr.border_bottom td{border-bottom:1px solid #000}  tr.border_top td{border-top:1px solid #666}td.border_right{border-right:1px solid #666}.table-valores-totales tbody>tr>td{border:0}  .table-valores-totales>tbody>tr>td:first-child{text-align:right}  .table-valores-totales>tbody>tr>td:last-child{border-bottom:1px solid #666;text-align:right;width:30%}  hr,img{border:0}  table td{font-size:12px}  html{font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:transparent}  a{background-color:transparent}  a:active,a:hover{outline:0}  img{vertical-align:middle}  hr{height:0;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;margin-top:20px;margin-bottom:20px;border-top:1px solid #eee}  table{border-spacing:0;border-collapse:collapse}@media print{blockquote,img,tr{page-break-inside:avoid}*,:after,:before{color:#000!important;text-shadow:none!important;background:0 0!important;-webkit-box-shadow:none!important;box-shadow:none!important}a,a:visited{text-decoration:underline}a[href]:after{content:" (" attr(href) ")"}blockquote{border:1px solid #999}img{max-width:100%!important}p{orphans:3;widows:3}.table{border-collapse:collapse!important}.table td{background-color:#fff!important}}  a,a:focus,a:hover{text-decoration:none}  *,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}  a{color:#428bca;cursor:pointer}  a:focus,a:hover{color:#2a6496}  a:focus{outline:dotted thin;outline:-webkit-focus-ring-color auto 5px;outline-offset:-2px}  h6{font-family:inherit;line-height:1.1;color:inherit;margin-top:10px;margin-bottom:10px}  p{margin:0 0 10px}  blockquote{padding:10px 20px;margin:0 0 20px;border-left:5px solid #eee}  table{background-color:transparent}  .table{width:100%;max-width:100%;margin-bottom:20px}  h6{font-weight:100;font-size:10px}  body{line-height:1.42857143;font-family:"open sans","Helvetica Neue",Helvetica,Arial,sans-serif;background-color:#2f4050;font-size:13px;color:#676a6c;overflow-x:hidden}  .table>tbody>tr>td{vertical-align:top;border-top:1px solid #e7eaec;line-height:1.42857;padding:8px}  .white-bg{background-color:#fff} .grey-bg{background-color:#eeeeee;border-radius:10px}  td{padding:6}  .table-valores-totales tbody>tr>td{border-top:0 none!important}</style>
</head>
<body class="white-bg">
    <table width="100%" style="table-layout:fixed;">
        <tbody>
            <tr>
                <td>
                    <table width="100%" height="100px" border="0" aling="center" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="15%" height="100" align="center" style="vertical-align: middle">
                                    <span>
                                        <img src="/ss.jpg"  height="100" style="text-align:center" border="0">
                                    </span>
                                </td>
                                <td  width="45%"  height="100" align="center">
                                    <table width="100%" height="100%" border="0" border-radius="">
                                        <tbody>
                                            <tr>
                                                <td align="center">
                                                    <strong>
                                                        <span style="font-size:20px">Distribuciones Y Servicios Generales LAL</span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">

                                                    <strong>Chiclayo - Chiclayo - Lambayeque - Perú </strong> 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="40%">
                                    <div class="grey-bg" style="border:2px solid black;border-radius: 20px;">
                                        <table width="100%" border="0" height="170" cellpadding="6" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td align="center">
                                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:16px;color:black" text-align="center">RUC N° --</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:19px;color:black" text-align="center"><strong>COTIZACIÓN</strong></span>
                                                        <br>
                                                        <span style="font-size:24px;color:black" text-align="center"><strong><?=$cotizacion[0]['CodSolicitud']?></strong></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="tabla_borde">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td align="right"> <span style="font-size:15px" text-align="center"><strong>Fecha.: </strong><?=$cotizacion[0]['Emision']?></span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
        <div class="tabla_borde">
            <table width="100%" border="0" cellpadding="5" cellspacing="0" style="table-layout:fixed;">
                <tbody>
                    <tr>

                        <td align="center" width="10%" class="bold">N°</td>
                        <td align="center" width="55%" class="bold">DESCRIPCIÓN</td>
                        <td align="center" width="10%" class="bold">UNIDAD</td>
                        <td align="center" width="10%" class="bold">CANTIDAD</td>
                    </tr>
                    <?php foreach ($cotizacion as $key => $value):?>
                        <tr class="border_top">
                            <td align="center" width="10%">
                                <span> <?=$key + 1?></span>
                                <br>
                            </td>
                            <td align="left" width="500px">
                                <span> <?=$value['Producto']?> </span>
                                <br>
                            </td>
                            <td align="center" width="300px">
                                <span> <?=$value['Unidad']?></span>
                                <br>
                            </td>
                            <td align="center" width="200px">
                                <span> <?=$value['Cantidad']?></span>
                                <br>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </body>
</html>
