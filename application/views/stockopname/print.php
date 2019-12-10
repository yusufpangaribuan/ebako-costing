<?php
if ($type === 'p') {
    ?>
    <html>
        <head>
            <title>Stock Opname</title>
            <link type="text/css" rel="stylesheet" href="<?php echo base_url('css/print.css') ?>">
        </head>
        <body>
            <?php
        }
        ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="border-bottom: 1px #000000 double;">
                    <?php
                    echo $company->name . "<br/>" . nl2br($company->address);
                    ?>
                </td>
            </tr>
            <tr>
                <td align='center' style="font-size: 18px;font-weight: bold;">
                    STOCK OPNAME
                </td>
            </tr>
            <tr>
                <td width="100%">
                    <table width="50%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td width="35%"><strong>ID</strong></td>
                            <td width="2%">:</td>
                            <td width="63%"><?php echo $stockopname->stockopname_no ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>:</td>
                            <td><?php echo date('d/m/Y', strtotime($stockopname->date)) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Description</strong></td>
                            <td>:</td>
                            <td><?php echo $stockopname->description ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br/>
        <table width="100%" class="print tablesorter2">
            <thead>
                <tr>
                    <th width="2%" style="border: 1px #666666 solid;">No</th>
                    <th width="15%" style="border-width:1px 1px 1px 0;border-color: #666666;border-style:solid;">Group</th>
                    <th width="10%" style="border-width:1px 1px 1px 0;border-color: #666666;border-style:solid;">Item Code</th>
                    <th style="border-width:1px 1px 1px 0;border-color: #666666;border-style:solid;">Item Description</th>
                    <th width="5%" style="border-width:1px 1px 1px 0;border-color: #666666;border-style:solid;">UoM</th>
                    <th width="8%" style="border-width:1px 1px 1px 0;border-color: #666666;border-style:solid;">Stock</th>
                    <th width="8%" style="border-width:1px 1px 1px 0;border-color: #666666;border-style:solid;">Real Stock</th>
                    <th width="8%" style="border-width:1px 1px 1px 0;border-color: #666666;border-style:solid;">Difference</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($detail as $result) {
                    ?>
                    <tr>
                        <td align="right" style="border-width:0 1px 1px 1px;border-color: #666666;border-style:solid;"><?php echo $counter++ ?>&nbsp;</td>
                        <td style="border-width:0 1px 1px 0;border-color: #666666;border-style:solid;"><?php echo $result->group_code ?>&nbsp;</td>
                        <td style="border-width:0 1px 1px 0;border-color: #666666;border-style:solid;"><?php echo $result->item_code ?>&nbsp;</td>
                        <td style="border-width:0 1px 1px 0;border-color: #666666;border-style:solid;"><?php echo $result->item_description ?>&nbsp;</td>
                        <td style="border-width:0 1px 1px 0;border-color: #666666;border-style:solid;" align="right"><?php echo $result->unit_code ?>&nbsp;</td>
                        <td style="border-width:0 1px 1px 0;border-color: #666666;border-style:solid;" align="right"><?php echo $result->stock ?>&nbsp;</td>
                        <td style="border-width:0 1px 1px 0;border-color: #666666;border-style:solid;" align="right"><?php echo $result->real_stock ?>&nbsp;</td>
                        <td style="border-width:0 1px 1px 0;border-color: #666666;border-style:solid;" align="right"><?php echo $result->difference ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        if ($type === 'p') {
            ?>
        </body>
        <script>
            window.onload = function () {
                window.print();
                setTimeout(function () {
                    window.close();
                }, 1);
            };
        </script>
    </html>
    <?php
}
?>