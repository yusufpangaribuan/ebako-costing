
<table width="100%" cellpadding="0" cellspacing="0" border="0" height="100%" style="padding: 0px 1px 1px 1px"> 
    <tr valign="top">
        <td width="60%" height="560" align="center">
            <h4>Model</h4> 
            <?php
            if ($numberrequest > 0 && $this->session->userdata('department') == 4) {
                ?>
                <div style="font-size: 12px;margin: 5px;">
                    <a href="javascript:void(0)" style="color: #fa0202;" onclick="model_viewrequest()"><?php echo $numberrequest ?> Request for New Model</a>
                </div>
            <?php } ?>
            <div style="width: 99.5%;float:center;margin-top: 2px;">
                <div align="left" style="padding-top: 2px;padding-bottom: 5px;">
                    <input type="hidden" id="modelid" value="0" />
                    <span class="labelelement">Code :</span>
                    <input type="text" name="code_s" id="model_code_s" size="8" onkeypress="if (event.keyCode == 13) {
                                model_search(0);
                            }"/>
                    <span class="labelelement">Cust. Code :</span>
                    <input type="text" name="custcode_s" id="model_custcode_s" size="8" onkeypress="if (event.keyCode == 13) {
                                model_search(0);
                            }"/>
                    <span class="labelelement">Desc :</span>
                    <input type="text" name="description_s" id="model_description_s" size="8" onkeypress="if (event.keyCode == 13) {
                                model_search(0);
                            }"/>
                    <select id="modeltypeid" onchange="model_search(0)">
                        <option value="0">Type</option>
                        <?php
                        foreach ($modeltype as $modeltype) {
                            echo "<option value='" . $modeltype->id . "'>" . $modeltype->name . "</option>";
                        }
                        ?>
                    </select>
                    <button onclick="model_search(0)">Search</button>
                    <?php
                    if ($this->session->userdata('department') == 4) {
                        if (in_array('add', $accessmenu)) {
                            echo "<button onclick = 'model_create()'>Add</button>";
                        }
                        if (in_array('copy', $accessmenu)) {
                            echo "<button onclick = 'model_copy()'>Copy</button>";
                        }
                        if (in_array('view_cdss', $accessmenu)) {
                            echo "<button onclick = 'model_cdsprint()'>Cdss</button>";
                        }
                        if (in_array('view_cutting_list', $accessmenu)) {
                            echo "<button onclick = 'model_bom()'>Cutting List</button>";
                        }
                    }
                    ?>
                </div>
                <div id="modeldata">                    
                    <?php $this->load->view('model/search'); ?>
                </div>
            </div>
        </td>
        <td width="40%" >
            <div id="modeldetail" style="min-height: 560px;overflow-y: auto;max-height:560px; ">

            </div>
        </td>
    </tr>    
</table>
<div id="model_dialog_88" style="display: none"></div>


