<div class="col-sm-12">
		<div style="padding-bottom: 5px;padding-top: 5px">        
	        <label class="labelelement">Code :</label>
	        <input id="id_s" value="<?php echo $id?>" type="hidden" />
	        <input type="text" id="modelcode_s" size="8" onkeypress="if(event.keyCode==13){costing_searchcopycosting()}"/>
	        <label class="labelelement">Cust Code :</label>
	        <input type="text" id="custcode_s" size="8" onkeypress="if(event.keyCode==13){costing_searchcopycosting()}"/>
	        <label class="labelelement">Desc :</label>
	        <input type="text" id="modeldescription_s" size="10" onkeypress="if(event.keyCode==13){costing_searchcopycosting()}"/>
	        <label class="labelelement">Customer</label>
	        <select id="customerid_s" style="width: 150px" onclick="costing_searchcopycosting()">
	            <option value="0"></option>
	            <?php
	            foreach ($customer as $result) {
	                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
	            }
	            ?>
	        </select>
	        <button style="font-size: 11px;" onclick="costing_searchcopycosting()">Search</button>
	    </div>
    
		<table class="table table-responsive-sm table-bordered table-striped table-hover table-outline mb-0">
		    <thead class="thead-light" style="background: #f9f9f9 !important;">
		        <tr style="border-top: 4px solid #ec9821;">
		            <th width="2%">No</th>
	                <th width="10%">Code</th>
	                <th width="10%">Cust. Code</th>
	                <th width="25%">Description</th>
	                <th width="25%">Customer</th>
	                <th width="10%">Date</th>
	                <th width="15%">Image</th>
	                <th width="3%">Action</th>
		        </tr>
			</thead>
			<tbody>
	            <?php
	            $no = 1;
	            foreach ($costing as $result) {
	                if ($result->id != $id) {
	                    ?>
	                    <tr>
	                        <td><?php echo $no++ ?></td>
	                        <td><?php echo $result->code ?></td>
	                        <td><?php echo $result->custcode ?></td>
	                        <td><?php echo $result->description ?></td>
	                        <td><?php echo $result->customername ?></td>
	                        <td><?php echo date('d/m/Y', strtotime($result->date)); ?></td>                        
	                        <td><img src="files/<?php echo $result->filename ?>" style="max-height: 70px;max-widtd: 70px"/></td>                        
	                        <td align="center"><img src="images/check.png" style="cursor: pointer" onclick="costing_docopypart(<?php echo $id . "," . $result->id.",".$category ?>)"/></td>
	                    </tr>
	                    <?php
	                }
	            }
	            ?>
        </tbody>
    </table>
</div>