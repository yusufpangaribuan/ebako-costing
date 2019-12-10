<center>
    <table style="width: 100%;">
        <tr valign="top">
            <td style="width: 70%;">
            	<form id="form_create_model" data-parsley-validate="" onsubmit="return false">
                    <table class="table table-form" style="text-align: left;width: 100%;" id="create_model">
                    	<tbody>
                        <tr valign="top">
                            <td align="right" width="25%"><span class="labelelement"><span class="required">* </span>Code : </span></td>
                            <td><input type="text" id="modelno" name="modelno" style="width: 90%" required="required" /></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement"><span class="required">* </span>Customer Code : </span></td>
                            <td><input type="text" id="custcode" name="custcode" style="width: 90%" required="required"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Type : </span></td>
                            <td>
                                <select id="modeltypeid" name="modeltypeid" style="width: 30%">
                                    <option value="0"></option>
                                    <?php
                                    foreach ($modeltype as $modeltype) {
                                        echo "<option value='" . $modeltype->id . "'>" . $modeltype->name . " - " . $modeltype->description . "</option>";
                                    }
                                    ?>
                                </select>
                                <script>
                                    $(function () {
                                    	$("#modeltypeid").select2();
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Description :</span></td>
                            <td><input type="text" id="description" name="description"  style="width: 90%"/></td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Dimension :</span></td>
                            <td>
                                <span class="required">* </span>W (mm) : <input type="text" id="w" name="w" onchange="calculateCW()" size="4" style="text-align: center;" required="required" /> &nbsp;&nbsp;
                                <span class="required">* </span>D (mm) : <input type="text" id="d"  name="d" onchange="calculateCD()" size="4" style="text-align: center;" required="required" /> &nbsp;&nbsp;
                                <span class="required">* </span>HT (mm) : <input type="text" id="ht"  name="ht" onchange="calculateCH()" size="4" style="text-align: center;" required="required" /> &nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Carton Box :</span></td>
                            <td>
                                W (mm) : <input type="text" id="cw" name="cw" onchange="calculateBoxSize()" size="4" style="text-align: center;"/> &nbsp;&nbsp;
                                D (mm) : <input type="text" id="cd" name="cd" onchange="calculateBoxSize()" size="4" style="text-align: center;"/> &nbsp;&nbsp;
                                HT (mm) : <input type="text" id="ch" name="ch" onchange="calculateBoxSize()" size="4" style="text-align: center;"/> &nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Color Finish :</span></td>
                            <td>
                                <input type="hidden" id="yield" value="0" name="yield" size="6" style="text-align: center;"/>
                                <input type="text" id="color" name="color" size="10"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Volume (Package) :</span></td>
                            <td>
                                <input type="text" id="volume_package" name="volume_package" size="7"/>
                                <span class="labelelement">M3</span>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Weight :</span></td>
                            <td>
                                GW (kg) : <input type="text" id="nw" name="nw" size="4" style="text-align: center;" /> &nbsp;&nbsp;
                                NW (kg) : <input type="text" id="gw" name="gw" size="4" style="text-align: center;" /> &nbsp;&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Finish Overview :</span></td>
                            <td>
                                <?php
                                foreach ($finishoverview as $result) {
                                    echo "<input type='checkbox' value='" . $result->id . "' name='finishoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"><span class="labelelement">Construction Overview :</span></td>
                            <td colspan="2">
                                <?php
                                foreach ($constructionoverview as $result) {
                                    echo "<input type='checkbox' value='" . $result->id . "' name='constructionoverview[]'>&nbsp;&nbsp;<span style='font-size:11px;vertical-align:middle;'>" . $result->name . "</span>&nbsp;&nbsp;";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
							<td colspan="3" style="height: 10px;"></td>
						</tr>
                        <tr>
                            <td align="right" height="30"><span class="required">* </span><span class="labelelement">Image :</span></td>
                            <td colspan="2">
                                <input type="file" id="fileupload" name="fileupload" required="required" style="float: left;padding-right: 100px;"/>
                                <span class="labelelement"></span>
                            	Temporary &nbsp; <input type="radio" name="is_temporary_photo" id="is_temporary_photo__temporary" class="is_temporary_photo" value="true">
                            	&nbsp;&nbsp;Final &nbsp;<input type="radio" name="is_temporary_photo" id="is_temporary_photo__final" class="is_temporary_photo" value="false" checked="checked">
                            </td>
                        </tr>
						<tr>
							<td colspan="3" style="height: 10px;"></td>
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
                        </tbody>
                    </table>
                 </form>
            </td>
            <td style="width: 30%;" >
                <div style="height:450px; overflow: auto;">
                    <h4>Last Model Number</h4>
                    <br/>
                    <table class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th width="30%">Type</th>
                                <th width="70%">Last Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($last_number as $result) {
                                ?>
                                <tr>
                                    <td><?php echo $result->name ?></td>
                                    <td><?php echo $result->last_model_code ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <center>
    
    <script type="text/javascript">
                                function calculateCW(){
									var w = parseFloat( $("#w").val() || 0 );
									var cw = parseFloat( w * 1.1 || 0 ).toFixed(3);
									$("#cw").val(cw);
									calculateBoxSize();
	                            }
                                function calculateCD(){
									var d = parseFloat( $("#d").val() || 0 );
									var cd = parseFloat( d * 1.1 || 0 ).toFixed(3);
									$("#cd").val(cd);
									calculateBoxSize();
	                            }
                                function calculateCH(){
									var ht = parseFloat( $("#ht").val() || 0 );
									var ch = parseFloat( ht * 1.1 || 0 ).toFixed(3);
									$("#ch").val(ch);
									calculateBoxSize();
	                            }
                                function calculateBoxSize(){
                                	var cw = parseFloat( $("#cw").val() || 0 ) ;
                                	var cd = parseFloat( $("#cd").val() || 0 );
                                	var ch = parseFloat( $("#ch").val() || 0 );

                                    var volume_package = parseFloat( cw * cd * ch || 0);
                                    volume_package = parseFloat( volume_package / 1000000000 || 0);//.toFixed(3);
                                	$("#volume_package").val( volume_package );
	                            }
</script>

