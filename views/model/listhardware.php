<div style="margin-bottom: 5px;margin-top: 5px">
    <span class="labelelement">CODE</span><input type="text" id="partnumber_s" size="10" onkeypress="if(event.keyCode==13){item_searchList('<?php echo $element ?>')}"/><input type="hidden" id="names_s" onkeypress="if(event.keyCode==13){item_searchList('<?php echo $element ?>')}"/>
    <span class="labelelement">Desciption</span><input type="text" id="description_s" size="10" onkeypress="if(event.keyCode==13){item_searchList('<?php echo $element ?>')}"/>
    <button onclick="item_searchList('<?php echo $element ?>')">Search</button>
</div>
<table class="tablesorter" width="100%">
    <thead>
        <tr>
            <th>Part Number</th>
            <th>Item Description</th>            
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="listsearch">

    </tbody>
</table>
