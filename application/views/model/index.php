<script src="js/global.js"></script>
<script src="js/model.js"></script>
<script src="js/item.js"></script>

<div style="height: 50%; width: 100%; border-bottom: 4px #ddd inset" class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">List Model</h3>
    </div>
    <div class="panel-body" id="menu_content_model">
        <table width="100%" border="0">
            <tr>
                <td>
                    <div align="left" class="form-inline" style="padding-top: 2px;">
                        <?php
                        if (in_array('add', $accessmenu)) {
                            echo '<div class="col-sm-12" style="padding-bottom:10px;">';
                            echo "<button class='btn btn-labeled fa fa-plus btn-success' style='margin-right:5px;' onclick = 'model_create()'>Create New Model</button>";
                            echo '</div>';
                        }
                        ?>
                        <div class="col-sm-12">
                            <input type="hidden" id="modelid" value="0" /> <span class="labelelement">Find :</span> 
                            <input class="form-control" type="text" name="code_s" placeholder="Code" id="code_s" size="10" onkeypress="if (event.keyCode == 13) {
                                                                    model_search(0);
                                                                }" /> 
                            <input class="form-control" type="text" name="custcode_s" placeholder="Customer Code" id="custcode_s" size="15" onkeypress="if (event.keyCode == 13) {
                                                                    model_search(0) }" /> 
                            <input class="form-control" type="text" placeholder="Description" name="description_s" id="description_s" size="15" onkeypress="if (event.keyCode == 13) {
                                                                    model_search(0)
                                                                }" /> 
                            <select class="form-control" id="modeltypeid_s" onchange="model_search(0)" style="width: 80px">
                                <option value="0">Type</option>
                                <?php
                                foreach ($modeltype as $modeltype) {
                                    echo "<option value='" . $modeltype->id . "'>" .
                                    $modeltype->name . "</option>";
                                }
                                ?>
                            </select>
                            <button class="btn btn-default" onclick="model_search(0)">Search</button>
                        </div>	
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="modeldata" align="center" style="overflow-x: hidden">                    
                        <?php
                        $data['offset'] = $offset;
                        $this->load->view('model/search', $data);
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div style="height: 50%; width: 100%;" id="modeldetail" >
    <div id="modeldetail" style="min-height: 560px;overflow-y: auto;max-height:560px; ">
        <br/>
        <div id="model-tabs" class="tab-base">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#model_master_56y">Detail</a></li>
                <li><a data-toggle="tab" href="#model_harware_56y">Hardware</a></li>
                <li><a data-toggle="tab" href="#model_upholstry_56y">Upholstry</a></li>
                <li><a data-toggle="tab" href="#glass_mirror">Glass/Mirro</a></li>
                <li><a data-toggle="tab" href="#model_marble_u6y">Marble</a></li>
                <li><a data-toggle="tab" href="#model_frame_in_lay_56y">Frame/Inlay</a></li>
                <li><a data-toggle="tab" href="#model_packing_material_56y">Packing Material</a></li>
                <li><a data-toggle="tab" href="#model_veneer">Veneer</a></li>
                <li><a data-toggle="tab" href="#model_solidwood">Solid Wood</a></li>
            </ul>
            <div class="tab-content">
                <div id="model_master_56y" class="tab-pane fade active in">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="model_harware_56y" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="model_upholstry_56y" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="glass_mirror" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="model_marble_u6y" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="model_frame_in_lay_56y" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="model_packing_material_56y" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="model_veneer" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
                <div id="model_solidwood" class="tab-pane fade">
                    <center>Please select 1 model first...</center>
                </div>
            </div>
        </div>
    </div>
</div>