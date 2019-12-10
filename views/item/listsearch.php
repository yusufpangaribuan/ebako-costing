<div style="width: 100%">
    <div style="margin: 2px 0 2px 0;">
        <span class="labelelement">Code : </span>
        <input type="text" id="partnumber_s" style="width: 80px;" onkeypress="if(event.keyCode==13){item_searchList('<?php echo $elid ?>')}"/>
        <span class="labelelement">Description :</span>
        <input type="text" id="description_s_item" style="width: 80px;" onkeypress="if(event.keyCode==13){item_searchList('<?php echo $elid ?>')}" />
        <span class="labelelement">Class :</span>
        <select id="isstock_s" style="width: 80px;" onchange="item_searchList('<?php echo $elid ?>')">
            <option value="0">--All--</option>
            <option value="true">Stock</option>
            <option value="false">Non Stock</option>
        </select>
        <span class="labelelement">Group :</span>
        <select id="groupid_s" style="width: 200px;" onchange="item_searchList('<?php echo $elid ?>')">
            <option value="0">--All--</option>
            <?php
            foreach ($group as $result) {
                echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
            }
            ?>
        </select>
        <script>
         	$(function () {
            	$("#groupid_s").select2();
            });
        </script>        
        <button onclick="item_searchList('<?php echo $elid ?>')">Search</button>
    </div>
    <table id="item_listsearch" class="table table-striped table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th width="20%">Code#</th> 
                <th width="30%">Item Description</th>
                <th width="10%">Class</th>                
                <th width="10%">Group</th>
                <th width="5%">MOQ</th>
                <th width="8%">R-O Point</th>
                <th width="13%">Image</th>
                <th width="4%">Action</th>
            </tr>            
        </thead>
        <tbody id="listsearch">

        </tbody>
    </table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#item_listsearch').DataTable( {
	        scrollY: "500px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: true,
	    } );
	} );
</script>