<form id="form_add__costing_default_material">
        <table style="width: 100%">
        	 <tr>
            	<td width="150" align="right"><span class="labelelement">Costing Category :</span></td>
            	<td>
            		<select name="categoryid" id="form_add__categoryid" style="width: 100%">
		                <option value=""></option>
		                <?php
			                foreach ($listCostingCategory as $category) {
			                    echo "<option value='" . $category->id . "'>" . $category->name . "</option>";
			                }
		                ?>
		            </select>
            	</td>
            </tr>
            
            <tr id="tr_materialcode" style="display: none;">
                <td align="right"><span class="labelelement">Material Code :</span></td>
                <td><input type="text" name="materialcode" id="materialcode" style="width: 250px"/></td>
            </tr> 
            <tr id="tr_materialdescription" style="display: none;">
                <td align="right"><span class="labelelement">Material Description :</span></td>
                <td><textarea name="materialdescription" id="materialdescription" cols="32" rows="3"/></td>
            </tr> 
            
            <tr id="tr_groups">
                <td width="100" align="right"><span class="labelelement">Item Group :</span></td>
                <td>
                    <select id="form_add__groups" name="groups" style="width: 100%">
                        <option value=""></option>
                        <?php
	                        foreach ($groups as $result) {
	                            echo "<option value='" . $result->id . "'>" .  $result->codes . " - " . $result->names . "</option>";
	                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr id="tr_item">
	            <td width="100" align="right"><span class="labelelement">Item/Material :</span></td>
	            <td>
	                <select id="form_add__itemid" name="itemid" style="width: 300px">
	                    <option value="" style="font-style: italic;"> -- </option>
	                </select>
	            </td>
            </tr>
            <tr>
	            <td width="100" align="right"><span class="labelelement">UOM :</span></td>
	            <td>
	                <select id="form_add__uom" name="uom" style="width: 100%">
	                    <option value="">--</option>
	                    <?php
			                foreach ($uoms as $uom) {
			                    echo "<option value='" . $uom->codes . "'>" . $uom->codes . " - " . $uom->names . "</option>";
			                }
		                ?>
	                </select>
	            </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Qty :</span></td>
                <td><input type="text" name="qty" id="qty" onchange="calculateReqQty()" style="width: 70px"/></td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Yield :</span></td>
                <td><input type="text" name="yield" id="yield" onchange="calculateReqQty()" style="width: 70px"/></td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Allowance :</span></td>
                <td><input type="text" name="allowance" id="allowance" onchange="calculateReqQty()" style="width: 70px"/></td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">Req. Qty. :</span></td>
                <td><input type="text" name="req_qty" id="req_qty" readonly="readonly" style="width: 70px;background-color: #c9eaa6;border: 1px solid #a5a5a5;"/></td>
            </tr>    
            
            <tr id="tr_unitprice" style="display: none;">
                <td align="right"><span class="labelelement">Item Price :</span></td>
                <td> &nbsp;&nbsp;
                	<input type="radio" name="curr" value="USD"> USD
                	<input type="radio" name="curr" value="Rp" checked="checked"> Rp &nbsp;&nbsp;	
                	<input type="text" name="price" id="price" style="width: 130px"/>
                </td>
            </tr>
                    
        </table>
</form>

<script>
	function calculateReqQty(){
	   	var qty = parseFloat( $("#form_add__costing_default_material #qty").val() || 0 ) ;
	   	var yield = parseFloat( $("#form_add__costing_default_material #yield").val() || 0 ) ;
	   	var allowance = parseFloat( $("#form_add__costing_default_material #allowance").val() || 0 ) ;
	   	
	   	var req_qty = 0 ;
	   	if( qty > 0 ){
			if( allowance > 0 ){
				req_qty = qty + ( allowance * qty );
			}else if( yield > 0 ){
				req_qty = qty * yield;
			}
	    }
	    
	   $("#form_add__costing_default_material #req_qty").val( req_qty );
	}
	
	$(function () {
		$("#form_add__categoryid").select2();
		$("#form_add__groups").select2();
		$("#form_add__uom").select2();
		$("#form_add__itemid").select2();

		$('#form_add__categoryid').on('select2:select', function (e) {
			var cat = $('#form_add__categoryid').val();
			if( cat == '9' ){
				$("#tr_materialcode").show();
				$("#tr_materialdescription").show();
				$("#tr_groups").hide();
				$("#tr_item").hide();

				$("#tr_unitprice").hide();
				
			}else{
				$("#tr_materialcode").hide();
				$("#tr_materialdescription").hide();
				$("#tr_groups").show();
				$("#tr_item").show();

				if( cat == '6' ){
					$("#tr_unitprice").show();
				}else{
					$("#tr_unitprice").hide();
				}
			}
		});
		
		$('#form_add__groups').on('select2:select', function (e) {
			loadItemsByGroup();
		});

		function loadItemsByGroup(){
			var groupid = $("#form_add__groups").val();
			if( undefined == groupid || groupid == "" ){
				$("#form_add__itemid").select2( 'data', [] );
			}else{
				$.getJSON( url + 'item/listByGroupForSelection/' + groupid)
				.done(function (data) {
					var listData = [{ id:'', text:'--', disabled: false }];
  			    	listData = $.merge( listData, data.items);
  			    	
					$("#form_add__itemid").select2('destroy').empty();
					$("#form_add__itemid").select2({
							ajax: {
				  			    url: url + 'item/listByGroupForSelection/' + $("#form_add__groups").val(),
				  			    delay: 250,
				  			    dataType: 'json',
				  			    data: function (params) {
				  			      var query = {
				  			        term: params.term,
				  			      }
				  			      return query;
				  			    },
				  			    processResults: function (data) {
					  			      var listData = [{ id:'', text:'--', disabled: false }];
					  			    	listData = $.merge( listData, data.items);
				        		      return {
				        		        results: listData
				        		      };
				        		},
				  		  },
				  		  data : listData,
				  	}).trigger('change');

				}).fail(function (data) {
					Client.message.error({'data': data});
				});
			}
	   };
		
	});
</script>        