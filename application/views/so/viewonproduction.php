<div style="width: 500px">    
    <table class="tablesorter" width="100%">
        <thead>
            <tr>
                <th width="30%">SO No#</th>            
                <th width="50%">Customer</th>            
                <th width="10%">Date</th>
                <th width="10%">Action</th>
            </tr>
            <tr>
                <th style="background: none;padding: 0;"><input type="text" id="sonumber_s" style="width: 100%" onkeypress="if(event.keyCode==13){so_searchOnProduction()}"/></th>            
                <th style="background: none;padding: 0;">
                    <select id="customerid_s" STYle="width: 100%" onchange="so_searchOnProduction()">
                        <option value="0">--</option>
                        <?php
                        foreach ($customer as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->name . "</option>";
                        }
                        ?>
                    </select>
                </th>            
                <th style="background: none;padding: 0;">
                    <input type="text" id="date_s" onkeypress="if(event.keyCode==13){so_searchOnProduction()}" style="width: 100%" />
                    <script type="text/javascript" >
                        $(function() {
                            $("#date_s").datepicker({
                                dateFormat: "yy-mm-dd"
                            }).focus(function() {
                                $("#date_s").datepicker("show");
                            });
                        });
                    </script>
                </th>
                <th style="background: none;padding: 0;"><button onclick="so_searchOnProduction()" style="font-size: 11px;">Search</button></th>
            </tr>
        </thead>
        <tbody id="listsearch">

        </tbody>
    </table>
</div>