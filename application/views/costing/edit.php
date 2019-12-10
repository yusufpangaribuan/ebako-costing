<div class="row">
    <table class="" align="center" border="0">
            <tr>
                <td align="right"><label class="labelelement">Customer :</label></td>
                <td>
                    <input type="hidden" id="id" value="<?php echo $costing->id ?>" />
                    <select id="customerid" class="form-control-sm">
                        <option value="0"></option>
                        <?php
                        foreach ($customer as $result) {
                            if ($result->id == $costing->customerid) {
                                echo "<option value='" . $result->id . "' selected>" . $result->name . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Model :</label></td>  
                <td>
                    <input type="hidden" id="modelid0" value="<?php echo $costing->modelid ?>" />
                    <input type="text" id="modelcode0" value="<?php echo $costing->code ?>" class="form-control-sm"/>
                    <img src="images/list.png" class="miniaction" onclick="costing_model_choose('model',0)"/>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Rate</label></td>
                <td>
                    <select id="rate" style="width: 120px">
                        <option value="0"></option>
                        <?php
                        foreach ($rate as $rate) {
                            if ($rate->id == $costing->rateid) {
                                echo "<option value='" . $rate->id . "-" . $rate->value . "' selected>" . $rate->currency_from . "->" . $rate->currency_to . "  " . $rate->value . "</option>";
                            } else {
                                echo "<option value='" . $rate->id . "-" . $rate->value . "'>" . $rate->currency_from . "->" . $rate->currency_to . "  " . $rate->value . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="checkbox" id="newrate" style="vertical-align: middle"/><span style="color: green;font-size: 10px;"><i>Check to Use Current value</i></span>
                </td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Costing rate value :</label></td>
                <td><input type="text" size="10" name="ratevalue" id="ratevalue" value="<?php echo $costing->ratevalue ?>" style="text-align: left"/></td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Fixed Cost :</label></td>
                <td><input type="text" size="3" name="fixed_cost" id="fixed_cost" value="<?php echo $costing->fixed_cost ?>" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Variable Cost :</label></td>
                <td><input type="text" size="3" name="variable_cost" id="variable_cost" value="<?php echo $costing->variable_cost ?>" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Profit Percentage :</label></td>
                <td><input type="text" size="3" name="profit_percentage" id="profit_percentage" value="<?php echo $costing->profit_percentage ?>" style="text-align: center"/></td>
            </tr>            
            <tr>
                <td align="right"><label class="labelelement">Port origin cost :</label></td>
                <td><input type="text" size="3" name="port_origin_cost" id="port_origin_cost" value="<?php echo $costing->port_origin_cost ?>" style="text-align: center"/>%</td>
            </tr>
            <tr>
                <td align="right"><label class="labelelement">Date :</label></td>
                <td>
                    <input type="date" name="date" id="date" value="<?php echo $costing->date ?>" style="text-align: center"/>
                </td>
            </tr>
            
            <tr valign="top">
	        	<td colspan="2" style="height: 30px;"></td>
	        </tr>
	        			<tr valign="top">
                            <td style="vertical-align: middle" align="right"><span class="labelelement">Prepared By :</span></td>
                            <td colspan="2">
                                <select id="name-apprvove1" name="preparedby" style="width: 200px;">
                                	<option selected="selected" value="<?php echo @$costing->preparedby?>"> <?php echo @$costing->preparedby?> </option>
                                </select>
                                <script>
                                    $(function () {
                                    	function formatEmployee(employee){
                                    		return $('<span>' + employee.text + '</span>' );
                                        };
                                    	$("#name-apprvove1").select2({
                                    		  ajax: {
                                    			    url: url + 'employee/search_autocomplete_prepared_by',
                                    			    delay: 250,
                                    			    dataType: 'json',
                                    			    data: function (params) {
                                    			      var query = {
                                    			        term: params.term,
                                    			      }
                                    			      return query;
                                    			    },
                                    			    processResults: function (data) {
                                          		      return {
                                          		        results: data
                                          		      };
                                          		    },
                                    		  },
                                    		  minimumInputLength: 1,
                                    		  templateResult: formatEmployee,
                                    	});
                                    });
                                </script>
                                <button onclick="App.resetSelect2('#name-apprvove1')">Clear</button>
                            </td>
                        </tr>    
                            
                        <tr valign="top">
                            <td style="vertical-align: middle" align="right"><span class="labelelement">Checked By :</span></td>
                            <td colspan="2">
                                <select id="name-apprvove2" name="checkedby" style="width: 200px;">
                                	<option selected="selected" value="<?php echo @$costing->checkedby?>"> <?php echo @$costing->checkedby_name?> </option> 
                                </select>
                                <script>
                                    $(function () {
                                    	function formatEmployee(employee){
                                    		return $('<span>' + employee.text + '</span>' );
                                        };
                                    	$("#name-apprvove2").select2({
                                    		  ajax: {
                                    			    url: url + 'employee/search_autocomplete2',
                                    			    delay: 250,
                                    			    dataType: 'json',
                                    			    data: function (params) {
                                    			      var query = {
                                    			        term: params.term,
                                    			      }
                                    			      return query;
                                    			    },
                                    			    processResults: function (data) {
                                          		      return {
                                          		        results: data
                                          		      };
                                          		    },
                                    		  },
                                    		  minimumInputLength: 1,
                                    		  templateResult: formatEmployee,
                                    	});
                                    });
                                </script>
                                <button onclick="App.resetSelect2('#name-apprvove2')">Clear</button>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="vertical-align: middle" align="right"><span class="labelelement">Approved By :</span></td>
                            <td colspan="2">
                                <select id="name-apprvove3" name="approvedby" style="width: 200px;">
                                	<option selected="selected" value="<?php echo @$costing->approvedby?>"> <?php echo @$costing->approvedby_name?> </option>
                                </select>
                                <script>
                                    $(function () {
                                    	function formatEmployee(employee){
                                    		return $('<span>' + employee.text + '</span>' );
                                        };
                                    	$("#name-apprvove3").select2({
                                    		  ajax: {
                                    			    url: url + 'employee/search_autocomplete2',
                                    			    delay: 250,
                                    			    dataType: 'json',
                                    			    data: function (params) {
                                    			      var query = {
                                    			        term: params.term,
                                    			      }
                                    			      return query;
                                    			    },
                                    			    processResults: function (data) {
                                          		      return {
                                          		        results: data
                                          		      };
                                          		    },
                                    		  },
                                    		  minimumInputLength: 1,
                                    		  templateResult: formatEmployee,
                                    	});
                                    });
                                </script>
                                <button onclick="App.resetSelect2('#name-apprvove3')">Clear</button>
                            </td>
                        </tr>
            
            
            <tr>   
                <td>&nbsp;</td>
                <td>
                    <br/>
                    <button type="button" class="btn btn-md btn-success" onclick="costing_update()">Update</button>
                    <button type="button" class="btn btn-md btn-secondary" onclick="App.bootbox.close('costing_update');" >Cancel</button>
                </td> 
            </tr>
</table>
</div>
