<div style="width: 300px">
    <table width="100%">
        <tr>
            <td width="30%"><label class="labelelement">MR No.</label></td>
            <td width="70%"><input type="text" id="mrvnumber_s" style="width: 100%"/></td>
            <td width="20%"><button onclick="mr_searchfordialog('<?php echo $temp ?>')">search</button></td>
        </tr>
    </table>
    <table class="tablesorter" width="99%">
        <thead>
            <tr>
                <th width="30%">No</th>
                <th width="70%">MR No</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody id="mrvdata">

        </tbody>
    </table>
</div>