<div class="row">
    <table class="" align="center" border="0">
        <tr>
            <td align="right"><span class="labelelement"><span style="color: red;">*&nbsp;</span>Customer :</span></td>
            <td>
                <select id="customerid" class="form-control-sm">
                    <option value="0"></option>
                    <?php
                    foreach ($customer as $result) {
                        echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement"><span style="color: red;">*&nbsp;</span>Model :</label></td>  
            <td>
                <input type="hidden" id="modelid0" value="0" />
                <input type="text" id="modelcode0" value="" readonly="readonly" 
                	style="width: 305px;background-color: #fbfbfb;border: 1px solid #aeb5c5;"  class="form-control-sm"/>
                <img style="cursor: pointer;" src="images/list.png" class="miniaction" onclick="costing_model_choose()"/>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement"><span style="color: red;">*&nbsp;</span>Rate :</label></td>
            <td>                    
                <select id="rate" style="width: 120px"  class="form-control-sm">
                    <option value="0"></option>
                    <?php
                    foreach ($rate as $rate) {
                        echo "<option value='" . $rate->id . "-" . $rate->value . "'>" . $rate->currency_from . "->" . $rate->currency_to . "  " . $rate->value . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement"><span style="color: red;">*&nbsp;</span>Fixed Cost :</label></td>
            <td><input type="text" size="3" name="fixed_cost" id="fixed_cost" value="9" style="text-align: center"/>%</td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement"><span style="color: red;">*&nbsp;</span>Variable Cost :</label></td>
            <td><input type="text" size="3" name="variable_cost" id="variable_cost" value="9" style="text-align: center"/>%</td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement"><span style="color: red;">*&nbsp;</span>Profit Percentage :</label></td>
            <td><input type="text" size="3" name="profit_percentage" id="profit_percentage" value="20" style="text-align: center"/></td>
        </tr>            
        <tr>
            <td align="right"><label class="labelelement"><span style="color: red;">*&nbsp;</span>Port origin cost :</label></td>
            <td><input type="text" size="3" name="port_origin_cost" id="port_origin_cost" value="1.45" style="text-align: center"/>%</td>
        </tr>
        <tr>
            <td align="right"><label class="labelelement"><span style="color: red;">*&nbsp;</span>Date :</label></td>
            <td>
                <script type="text/javascript" >
//                     $(function() {
//                         $("#date").datepicker({
//                             dateFormat: "yy-mm-dd",
//                             changeMonth: true,
//                             changeYear:true
//                         }).focus(function() {
//                             $("#date").datepicker("show");
//                         }); 
//                     });
                </script>
                <input type="date" size="10" name="date" id="date" value=""/>
            </td>
        </tr>
        
        <tr valign="top">
        	<td colspan="2" style="height: 30px;"></td>
        </tr>
        				<tr valign="top">
        				
                            <td style="vertical-align: middle" align="right"><span class="labelelement">Prepared By :</span></td>
                            <td colspan="2">
                                <select id="name-apprvove1" name="preparedby" style="width: 200px;"></select>
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
                                <select id="name-apprvove2" name="checkedby" style="width: 200px;"></select>
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
                                <select id="name-apprvove3" name="approvedby" style="width: 200px;"></select>
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
            <td colspan="2" align="center"><br/>
                <button type="button" class="btn btn-md btn-success" onclick="costing_savenew()">Save</button>
                <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
            </td> 
        </tr>
    </table>
</div>
