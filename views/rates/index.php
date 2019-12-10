<script src="<?php echo base_url() ?>js/rates.js"></script>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Rates</h3>
    </div>

    <div class="panel-body" id="menu_content_rate">
        <div class="pad-btm form-inline">
            <div class="row">
                <div class="col-sm-12 table-toolbar-left">
                    <div id="rate_search_form" onsubmit="return ;">
			            <span class="labelelement">Search</span>
			            <input type="text" name="evidence_number" placeholder="ID" style="width: 120px"
			                   onkeypress="if (event.keyCode === 13)(rates_search(0))"/>
			            <input type="date" name="start_date" placeholder="Date Start" size="8" onchange="rates_search(0)"/>
			            -
			            <input type="date" name="end_date" placeholder="Date End" size="8" onchange="rates_search(0)"/>
			            <select name="currency" style="width: 100px" onchange="rates_search(0)">
			                <option value="">Currency</option>
			                <?php
			                foreach ($currency as $result) {
			                    echo "<option value='" . $result->curr . "'>" . $result->curr . " = " . $result->desc . "</option>";
			                }
			                ?>
			            </select>
			            <button type="button" onclick="rates_search(0)">Find</button>
			            <?php
			            if (in_array('add', $accessmenu)) {
			                echo "<button class='btn btn-success' type='button' onclick = 'rates_add()'>Add</button>";
			            }
			            ?>
			        </div>
	            </div>
	        </div>
        	<div id="ratesdata" class="row">
				<?php $rates->search(0) ?>
	    </div>
    </div>
</div>

