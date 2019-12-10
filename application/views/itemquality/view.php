<h4>Item Inspection</h4>
<div style="margin-left: 3px"> 
    <center>
        <br/>
        <div id="itempo" style="width: 80%;overflow: hidden;padding: 2px;min-height: 250px;" class="panel">
            <h4>List Outstanding</h4>    
            <div style="float: left;width: 100%">
                <form id="gr_item_pending_inspection_form">
                    <table align="left">
                        <tr>
                            <td><strong>PO</strong></td>
                            <td><input type="tex" name="po_no" style="width: 150px" onkeyup="if(event.keyCode === 13){gr_search_pending_inspection()}"/></td>
                            <td><strong>Item Code/Description</strong></td>
                            <td><input type="tex" name="item_code_desc"  onkeyup="if(event.keyCode === 13){gr_search_pending_inspection()}"/></td>
                            <td><button type="button" onclick="gr_search_pending_inspection()">Search</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div id="gr_item_pending_inspection" style="float: left;width: 100%;min-height: 200px;">
                <?php
                $data['item'] = $item;
                $this->load->view('gr/pending_inspection', $data);
                ?>
            </div>
        </div>
    </center>
    <br/>
    <div class="panel" style="width: 99.5%;margin-left: 2px;min-height: 400px;">
        <h4>Received</h4>

        <div style="margin-left: 5px;padding-top: 3px;padding-bottom: 3px;">            
            <label class="labelelement">PO :</label>
            <input type="text" id="ponumber" size="9" onkeypress="if(event.keyCode==13){itemquality_search(0)}"/>&nbsp;
            <label class="labelelement">Date From :</label>
            <script type="text/javascript" >
                $(function() {
                    $("#date_from").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function() {
                        $("#date_from").datepicker("show");
                    });
                    $("#date_to").datepicker({
                        dateFormat: "yy-mm-dd"
                    }).focus(function() {
                        $("#date_to").datepicker("show");
                    });
                });
            </script>
            <input type="text" id="date_from" value="" size="9" style="text-align: center" onkeypress="if(event.keyCode==13){itemquality_search(0)}"/>
            <label class="labelelement">To :</label>
            <input type="text" id="date_to" value="" size="9" style="text-align: center" onkeypress="if(event.keyCode==13){itemquality_search(0)}"/>
            <label class="labelelement">Item Code :</label>
            <input type="text" id="code_s" size="10" onkeypress="if(event.keyCode==13){itemquality_search(0)}"/>&nbsp;
            <label class="labelelement">Item Desc :</label>
            <input type="text" id="description_s" size="9" onkeypress="if(event.keyCode==13){itemquality_search(0)}"/>&nbsp;
            <button onclick="itemquality_search(0)">Search</button>
        </div>
        <center>
            <div id="inspectiondata" style="overflow-x: hidden">
                <?php $this->load->view('itemquality/search'); ?>
            </div>
        </center>
    </div>
</div>
