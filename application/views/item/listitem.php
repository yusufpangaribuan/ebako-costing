<span class="title">List Material</span>
<br/>
<br/>
<table>
    <tr>
        <td><span class="labelelement">Part Number</span></td>
        <td><span class="labelelement">Name</span></td>
        <td><span class="labelelement">Desc</span></td>
    </tr>
    <tr>
        <td><input type="text" id="partnumber_s" /></td>        
        <td><input type="text" id="names_s" /></td>        
        <td><input type="text" id="description_s" /></td>
        <td><button onclick="item_findlist('<?php echo $receiver ?>')">Search</button></td>
    </tr>
</table>
<table class="tablesorter2" width="100%">
    <thead>
        <tr>
            <th>Part Number</th>
            <th>Name</th>
            <th>Item Description</th>
            <th>Unit</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="listsearch">

    </tbody>
</table>
