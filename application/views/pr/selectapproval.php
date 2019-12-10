<div style="width: 450px;">
    <label class="labelelement">ID :</label>
    <input type="text" id="employeeid_s" style="width: 100px" onkeypress="if(event.keyCode==13){pr_searchEmployee(<?php echo $rid; ?>)}"/>
    <label class="labelelement">Name :</label>
    <input type="text" id="employeename_s" style="width: 100px" onkeypress="if(event.keyCode==13){pr_searchEmployee(<?php echo $rid; ?>)}"/>
    <button onclick="pr_searchEmployee(<?php echo $rid; ?>)" style="font-size: 11px;">Search</button>
    <br/>
    <table class="tablesorter" width="99%">
        <thead>            
            <tr>
                <th width="20%">ID</th>
                <th width="35%">Name</th>
                <th width="35%">Position</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody id="bodyprsearchemployee">

        </tbody>
    </table>
</div>
