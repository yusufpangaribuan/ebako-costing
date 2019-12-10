<div style="width: 500px;">
    <div style="padding-bottom: 5px;">
        <span class="labelelement">CODE</span><input type="text" id="partnumber_s" size="10" onkeypress="if(event.keyCode==13){component_findlist('<?php echo $elid ?>')}"/>
        <span class="labelelement">DESCRIPTION</span><input type="text" id="description_s" size="10" onkeypress="if(event.keyCode==13){component_findlist('<?php echo $elid ?>')}"/>
        <button onclick="component_findlist('<?php echo $elid ?>')" style="font-size: 10px;font-weight: bold;">Search</button>
    </div>
    <table class="tablesorter" width="98%">
        <thead>
            <tr>
                <th width="20%">CODE</th>
                <th width="70%">Item Description</th>            
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody id="listsearch">
        </tbody>
    </table>
</div> 
