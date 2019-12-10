<div style="min-height:600px;">    
    <h4>Goods Receive</h4>    
    <?php
    if ($this->session->userdata('department') == 10 && ($this->session->userdata('optiongroup') != "0")) {
        ?>
        <center>
            <div class="panel" style="height:230px;width: 99.5%;overflow: hidden;margin-top: 1px;">    
                <h4>Pending</h4>
                <div style="float: left">
                    <form id="po_pending_receive_search_form">
                        <table>
                            <tr>
                                <td><strong>PO :</strong></td>
                                <td>
                                    <input type="tex" 
                                           name="po_no" 
                                           style="width: 100px" 
                                           onkeyup="if (event.keyCode === 13) {
                                                           gr_search_pending_receive()
                                                       }"
                                           />
                                </td>
                                <td><strong>Vendor/Supplier :</strong></td>
                                <td>
                                    <input type="tex" 
                                           name="vendor"  
                                           onkeyup="if (event.keyCode === 13) {
                                                           gr_search_pending_receive()
                                                       }"
                                           />
                                </td>
                                <td><strong>Item Code/Description :</strong></td>
                                <td>
                                    <input type="tex" 
                                           name="item_code_description"  
                                           onkeyup="if (event.keyCode === 13) {
                                                           gr_search_pending_receive()
                                                       }"
                                           />
                                </td>
                                <td><button type="button" onclick="gr_search_pending_receive()">Search</button></td>
                            </tr>
                        </table>
                    </form>
                </div><br/><br/>
                <div id="po_pending_receive">
                    <?php
                    $data['po'] = $po;
                    $this->load->view('gr/search_pending_receive', $data);
                    ?>
                </div>
            </div>
        </center>
        <div class="panel" style="width: 99.5%;margin-top: 2px;margin-left: 2px;">
            <h4>Received</h4>
        <?php } ?> 
        <div style="padding-top: 3px;padding-bottom: 3px;">
            <form id="gr_form_search" onsubmit="return false;">
                <span style="display: inline-block;padding-top: 3px;">
                    <label class="labelelement">Search :</label>
                    <input type="text" 
                           name="grnumber" 
                           size="9" 
                           placeholder="GR NO"
                           onkeypress="if (event.keyCode === 13) {
                                       gr_search(0);
                                   }"
                           />&nbsp;
                    <script type="text/javascript" >
                        $(function () {
                            $("#date_start").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#date_start").datepicker("show");
                            });
                            $("#date_end").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function () {
                                $("#date_end").datepicker("show");
                            });
                        });
                    </script>
                </span>
                <span style="display: inline-block;padding-top: 3px;">
                    <input type="text" id="date_start" name="date_start" placeholder="Date Start" size="9" onchange="gr_search(0)"/>
                    <label class="labelelement">-</label>
                    <input type="text" id="date_end" name="date_end" placeholder="Date End" size="9" onchange="gr_search(0)"/>&nbsp;
                </span>
                <span style="display: inline-block;padding-top: 3px;">
                    <input type="text" name="ponumber" placeholder="PO NO" size="9" onkeypress="if (event.keyCode === 13) {
                                gr_search(0)
                            }"/>&nbsp;
                </span>
                <span style="display: inline-block;padding-top: 3px;">
                    <select name="vendorid" style="width: 100px;font-style: italic" onchange="gr_search(0)">
                        <option value="0">--Vendor--</option>
                        <?php
                        foreach ($vendor as $vendor) {
                            echo "<option value='" . $vendor->id . "'>" . $vendor->name . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <!--            <label class="labelelement">Letter Number :</label>-->
                <input type="hidden" id="letternumber_s" size="9" onkeypress="if (event.keyCode == 13) {
                            gr_search(0)
                        }"/>&nbsp;
                <span style="display: inline-block;padding-top: 3px;">
                    <input type="text" name="receiveby" placeholder="Receive By" size="9" onkeypress="if (event.keyCode == 13) {
                                gr_search(0)
                            }"/>
                </span>
                <span style="display: inline-block;padding-top: 3px;">
                    <input type="text" 
                           style="width: 120px" 
                           name="item_code_description"
                           placeholder="Item Code / Description"
                           onkeypress="if (event.keyCode === 13) {
                                       gr_search(0);
                                   }"
                           />
                </span>
                <span style="display: inline-block;padding-top: 3px;padding-left: 5px;">
                    <button type="button"  onclick="gr_search(0)">Search</button>&nbsp;
                    <?php
                    if ($this->session->userdata('department') == 10) {
                        echo "<button type=button  onclick=gr_print(0)>Print</button>";
                        if ($this->session->userdata('optiongroup') != "0") {
                            ?>
                            <button type="button" onclick="gr_print_receipt()">Print Receipt</button>
                            <?php
                        }
                    }
                    ?>
                    <button type="button" onclick="gr_report_form()">Report</button>
                </span>
            </form>
        </div>
        <div id="grdata" style="overflow-x: hidden;padding: 2px;">
            <?php $this->load->view('gr/search'); ?>
        </div>
    </div>
    <?php
    if ($this->session->userdata('department') == 10 && ($this->session->userdata('optiongroup') != "")) {
        ?>
    </div>    
<?php } ?>    
</div>

