<div style="width: 500px;">
    <div style="padding-bottom: 5px;">
        <span class="labelelement">CODE</span><input type="text" id="code_s" size="10" onkeypress="if(event.keyCode==13){component_findcomponentlist(<?php echo "'" . $elid . "'," . $id ?>)}"/>
        <span class="labelelement">Name</span><input type="text" id="name_s" size="10" onkeypress="if(event.keyCode==13){component_findcomponentlist(<?php echo "'" . $elid . "'," . $id ?>)}"/>
        <button onclick="component_findcomponentlist(<?php echo "'" . $elid . "'," . $id ?>)" style="font-size: 10px;font-weight: bold;">Search</button>
    </div>
    <table class="tablesorter" width="99%">
        <thead>
            <tr>
                <th>CODE</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="listsearch">

        </tbody>
    </table>
</div>
