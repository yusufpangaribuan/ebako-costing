<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_item
 *
 * @author admin
 */
class model_item extends CI_Model {

    public function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function selectAll() {
        $query = "select * from item";
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        return $this->db->query("select * from item where id=$id")->row();
    }
    
    function getItemsByGroup( $groupid, $key_search ='' ){
    	$query = " select id, groupsid, partnumber, descriptions, price, curr, costing_price, curr_costing_price from item where true ";
    	if( !empty($key_search) ){
    		$query .= " and ( partnumber ilike '%$key_search%' or descriptions ilike '%$key_search%' ) ";
    	}
    	$query .= " and groupsid=$groupid limit 100 ";
    	
    	return $this->db->query( $query )->result();
    }
    
    function getItemsByGroupForSelection( $groupid, $key_search ){
    	$query = " select id, concat(partnumber,' - ', descriptions) as text from item where true ";
    	if( !empty($key_search) ){
    		$query .= " and ( partnumber ilike '%$key_search%' or descriptions ilike '%$key_search%' )";
    	}
    	$query .= " and groupsid=$groupid limit 100 ";
    	 
    	return $this->db->query( $query )->result();
    }
    
    function selectWood() {
        return $this->db->query("select id,partnumber,descriptions from item where groupsid=3 and id!=58")->result();
    }

    function getNumRows($code, $descriptions, $group, $isstock, $rack) {
        $query = "select i.id,i.groupsid,g.codes,g.names groupname,i.partnumber,i.names,i.descriptions,
                  i.isstock,i.rack,i.images from 
		item i join groups g on i.groupsid=g.id
                 ";

        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " join stock on i.id=stock.itemid ";
            }
        }

        $query .= " where true ";

        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " and stock.warehouseid=" . $this->session->userdata('optiongroup');
            }
        }

        if ($code != "") {
            $query .= " and i.partnumber ilike '%$code%'";
        }if ($descriptions != "") {
            $query .= " and i.descriptions ilike '%$descriptions%'";
        }if ($group != 0) {
            $query .= " and i.groupsid=$group";
        }if ($isstock != "") {
            $query .= " and i.isstock=$isstock";
        }if ($rack != "") {
            $query .= " and i.rack ilike '%$isstock%'";
        }
//        echo "<pre>".$query."</pre><br/>";
        return $this->db->query($query)->num_rows();
    }

    function search($code, $descriptions, $group, $isstock, $rack, $limit, $offset) {
        $query = "select distinct(i.id),i.groupsid,g.codes,g.names groupname,i.partnumber,
                    i.names,i.descriptions,i.isstock,i.rack,i.images,i.price,i.curr,i.moq,
                    i.lt,i.expdate,i.yield,i.qccheck,i.costing_price,i.curr_costing_price,
                    it_last.trans_time last_transaction_date,((now()::date - it_last.trans_time::date)) doi
                    from item i join groups g on i.groupsid=g.id
                    left join v_last_transaction it_last on i.id=it_last.itemid
                    ";

        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " join stock on i.id=stock.itemid ";
            }
        }

        $query .= " where true ";

        if ($this->session->userdata('department') == 10) {
            if ($this->session->userdata('optiongroup') != 0) {
                $query .= " and stock.warehouseid=" . $this->session->userdata('optiongroup');
            }
        }

        if ($code != "") {
            $query .= " and (i.partnumber ilike '%$code%' or i.descriptions ilike '%$code%')";
        }if ($descriptions != "") {
            $query .= " and i.descriptions ilike '%$descriptions%'";
        }if ($group != 0) {
            $query .= " and i.groupsid=$group";
        }if ($isstock != "") {
            $query .= " and i.isstock=$isstock";
        }if ($rack != "") {
            $query .= " and i.rack ilike '%$rack%'";
        }

        $query .= " order by i.id desc limit $limit offset $offset";
        //echo "rack ".$rack;
//        echo "<pre>".$query."</pre><br/>";
        return $this->db->query($query)->result();
    }

    function save($isstock, $partnumber, $groupid, $description, $rack, $reorderpoint, $images, $moq, $lt, $expdate, $qccheck, $woodid) {
        return $this->db->insert('item', array(
                    "partnumber" => addslashes($partnumber),
                    "groupsid" => $groupid,
                    "descriptions" => addslashes($description),
                    "isstock" => $isstock,
                    "rack" => $rack,
                    "reorderpoint" => $reorderpoint,
                    "images" => $images,
                    "moq" => $moq,
                    "lt" => $lt,
                    "expdate" => empty($expdate) ? NULL : $expdate,
                    "qccheck" => $qccheck,
                    "woodid" => $woodid
        ));
    }

    function get_last_id() {
        $query = "select id from item order by id desc limit 1";
        $dt = $this->db->query($query)->row();
        return $dt->id;
    }

    function update($data, $where) {
        return $this->db->update("item", $data, $where);
    }

    function delete($id) {
        return $this->db->query("select item_delete($id)");
    }

    function searchList($partnumber, $description, $soid) {
        $groupid = $this->input->post('groupid');
        $isstock = $this->input->post('isstock');
        $requesttype = $this->input->post('requesttype');
        if ($soid == 0) {
            $query = "select 
                item.*,                
                groups.names groupname 
                from item 
                join groups on item.groupsid=groups.id 
                where true ";
            if ($partnumber != "") {
                $query .= " and item.partnumber ilike '%$partnumber%'";
            }if ($description != "") {
                $query .= " and item.descriptions ilike '%" . $description . "%'";
            }if ($groupid != 0) {
                $query .= " and item.groupsid=$groupid ";
            }if ($isstock != '0') {
                $query .= " and item.isstock=$isstock ";
            }
//            if ($requesttype == 0) {
//                $query .= " and (item.id in)";
//            }
//            if ($this->session->userdata('department') == 8) {
//                if ($this->session->userdata('optiongroup') != 0) {
//                    $dt = $this->db->query("select itemgroup from purchasinggroup where id=" . $this->session->userdata('optiongroup'))->row();
//                    $groupitem = str_replace(array("{", "}"), "", $dt->itemgroup);
//                    $query .= " and groupsid in ($groupitem) ";
//                }
//            }
            $query .= " order by item.partnumber asc limit 100";
            //echo $query;
        } else {
            $query = "select 
            item.*,            
            mrp.soid,
            groups.names groupname
            from item join mrp on item.id=mrp.itemid 
            join groups on item.groupsid=groups.id 
            where mrp.soid=$soid ";
            if ($partnumber != "") {
                $query .= " and item.partnumber ilike '%$partnumber%'";
            }if ($description != "") {
                $query .= " and item.descriptions ilike '%" . $description . "%'";
            }if ($groupid != 0) {
                $query .= " and item.groupsid=$groupid ";
            }if ($isstock != 0) {
                $query .= " and item.isstock=$isstock ";
            }
            $query .= " order by item.partnumber asc limit 100";
        }
        //echo $isstock."sa";
        return $this->db->query($query)->result();
    }

    function getLastId() {
        $query = "select item_get_last_id() as lastid";
        $dt = $this->db->query($query)->result();
        return $dt[0]->lastid;
    }

    function getAllUnit($itemid) {
//        $group = $this->session->userdata('department');
//        if ($group == 8) {
//            $query = "select item_get_all_unit($itemid) as itemunit";
//        } else {
//            $query = "select item_get_all_unit2($itemid) as itemunit";
        $query = "select item_get_all_unit_3($itemid) as itemunit";
//        }
        $dt = $this->db->query($query)->result();
        return $dt[0]->itemunit;
    }

    function getUnitSelected($itemid, $unitid) {
        $query = "select item_get_all_unit_selected($itemid,$unitid) as itemunit";
        //echo $query . "<br/>";
        $dt = $this->db->query($query)->result();
        return $dt[0]->itemunit;
    }

    function getDescriptionsById($id) {
        $query = "select descriptions from item where id=$id";
        $dt = $this->db->query($query)->row();
        return ($dt->descriptions != "") ? $dt->descriptions : "";
    }

    function selectSmallestUnit($itemid) {
        $query = "select unit.codes,unit.names,stock.stock from stock join unit 
                  on stock.unitfrom=unit.id and itemid=$itemid and unitto=0";
        return $this->db->query($query)->row();
    }

    function get_small_unit($itemid) {
        $query = "select unit.codes,unit.names,stock.stock from stock join unit 
on stock.unitfrom=unit.id where itemid=$itemid and stock.unitfrom=stock.unitto
limit 1";
        $dt = $this->db->query($query)->row();
        return $dt->codes;
    }

    function selectAlternateUnit($itemid) {
        $query = "select unit.codes,unit.names,stock.stock from stock join unit 
                  on stock.unitfrom=unit.id and itemid=$itemid and unitto!=0";
        return $this->db->query($query)->result();
    }

    function selectAllUnit($itemid) {
        $query = "select 
                unit.codes,
                unit.names,
                stock.id,
                stock.unitfrom,
                stock.unitto,
                stock.stock,
                stock.conversionvalue 
                from stock join unit 
                on stock.unitfrom=unit.id and itemid=$itemid order by stock.id desc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectAllUnitByWareHouse($itemid) {
        $query = "select 
                unit.codes,
                unit.names,
                stock.id,
                stock.unitfrom,
                stock.unitto,
                stock.stock,
                stock.conversionvalue 
                from stock join unit 
                on stock.unitfrom=unit.id and itemid=$itemid and warehouseid=" . $this->session->userdata('optiongroup') . " order by stock.id desc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectAllUnit2($itemid) {
        $query = "select
            stock.itemid,
            unit.codes,
            unit.names,
            stock.unitfrom,
            stock.unitto,
            stock.conversionvalue 
            from stock join unit 
            on stock.unitfrom=unit.id and itemid=$itemid and warehouseid=(select warehouseid from stock where itemid=$itemid limit 1) order by stock.id desc";

        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectAllUnitAsc($itemid) {
        $query = "select 
            unit.codes,
            unit.names,
            stock.id,
            stock.unitfrom,
            (select codes from unit where id=unitfrom) unitfromname,
            stock.unitto,
            (select codes from unit where id=unitto) unittoname,
            stock.stock,
            stock.conversionvalue from stock join unit on stock.unitfrom=unit.id and itemid=$itemid order by stock.id asc";
        //echo $query."<br/>";
        return $this->db->query($query)->result();
    }

    function select_all_unit_distinc($itemid) {
        $query = "
            with t as (
                select itemid,unitfrom from stock where itemid=$itemid group by itemid,unitfrom
            ) select t.*,unit.codes unitfromname from t join unit on t.unitfrom=unit.id  
        ";
        return $this->db->query($query)->result();
    }

    function saveFirstStock($id, $qty) {
        $this->db->where('id', $id);
        $this->db->update('stock', array(
            "stock" => $qty
        ));
    }

    function getNameById($id) {
        $query = "select descriptions from item where id=$id";
        $dt = $this->db->query($query)->row();
        return $dt->descriptions;
    }

    function getLastDatePurchase($itemid) {
        $dt = $this->db->query("select item_get_last_date_purchase($itemid) as ct")->row();
        return $dt->ct;
    }

    function getLastPoPurchase($itemid) {
        $dt = $this->db->query("select item_getlastponumber($itemid) as ct")->row();
        return $dt->ct;
    }

    function getLastPricePurchase($itemid) {
        $dt = $this->db->query("select item_get_last_price_purchase($itemid) as ct")->row();
        return $dt->ct;
    }

    function getLastCurrencyPurchase($itemid) {
        $dt = $this->db->query("select item_get_last_currency_purchase($itemid) as ct")->row();
        return $dt->ct;
    }

    function getAveragePrice($itemid, $currency) {
        $dt = $this->db->query("select item_get_average_price($itemid,'$currency') as ct")->row();
        return $dt->ct;
    }

    function selectDistinctCurrencyUsed() {
        $query = "select distinct currency from pritem where currency is not null";
        return $this->db->query($query)->result();
    }

    function setprice($itemid, $price, $curr) {
        $this->db->where("id", $itemid);
        $this->db->update('item', array(
            "price" => $price,
            "curr" => $curr
        ));
    }

    function selectStockNeedToReorder() {
        $query = "with t as (
                select  
                item.*,
                groups.names groupname,
                item_get_smallest_unit(item.id) unitcode,
                item_get_stock_smallest_unit(item.id) totalstock 
                from item join groups on item.groupsid=groups.id
                ) select * from t where totalstock <= reorderpoint order by id desc";
        return $this->db->query($query)->result();
    }

    function searchStockNeedToReorder($query) {
        return $this->db->query($query)->result();
    }

    function getStockByUnit($itemid, $unitid) {
        $dt = $this->db->query("select item_get_stock_by_unit($itemid,$unitid) as ct")->row();
        return $dt->ct;
    }

    function item_get_stock_by_unit_and_warehouse($itemid, $unitid, $warehouseid) {
        $dt = $this->db->query("select item_get_stock_by_unit_and_warehouse($itemid,$unitid,$warehouseid) as ct")->row();
        return $dt->ct;
    }

    function selectHistory($itemid) {
        $this->db->where("itemid", $itemid);
        $this->db->order_by("id", "desc");
        return $this->db->get("historypriceitem")->result();
    }

    function getStockInSmallestUnit($itemid) {
        $dt = $this->db->query("select item_get_stock_smallest_unit($itemid) as ct")->row();
        return $dt->ct;
    }

    function getOutStanding($itemid) {
        $query = "select sum(outstanding) ct from pritem where itemid=$itemid";
        $dt = $this->db->query($query)->row();
        return empty($dt->ct) ? 0 : $dt->ct;
    }

    function savenewunit($itemid, $newunitfrom, $newunitto, $valueconversion) {
        return $this->db->query("select item_savenewunit($itemid, $newunitfrom, $newunitto, $valueconversion)");
    }

    function selectWarehouseItem($itemid) {
        $query = "with t as (
select distinct(stock.warehouseid) from stock where stock.itemid=$itemid
) select t.warehouseid,warehouse.name warehouse_name from t join warehouse on t.warehouseid=warehouse.id";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function getwarehouse($itemid) {
        return $this->db->query("select item_get_warehouse($itemid) ct")->row()->ct;
    }

    function getindexwarehouse($itemid) {
        return $this->db->query("select item_get_index_warehouse($itemid) ct")->row()->ct;
    }

    function deleteunit($itemid, $unitid) {
        return $this->db->delete("stock", array("itemid" => $itemid, "unitfrom" => $unitid));
    }

    function doshare($itemid, $whsid) {
        return $this->db->query("select item_doshare($itemid,$whsid)");
    }

    function selectAvailableWarehouse($itemid, $warehouseidfrom) {
        $query = "with t as(
                select distinct(warehouseid) from stock where itemid=$itemid
                )select t.warehouseid id,warehouse.name from t 
                join warehouse on t.warehouseid=warehouse.id and t.warehouseid != $warehouseidfrom";
        return $this->db->query($query)->result();
    }

    function dotransfer($itemid, $warehousefromid, $warehoustoid) {
        $this->db->insert('transferitem', array(
            "itemid" => $itemid,
            "warehousefromid" => $warehousefromid,
            "warehousetoid" => $warehoustoid
        ));
        $dt = $this->db->query("select id from transferitem order by id desc limit 1")->row();
        return $dt->id;
    }

    function dotransferunit($transferid, $unitid, $qty) {
        return $this->db->insert("transferitemdetail", array(
                    "transferitemid" => $transferid,
                    "unitid" => $unitid,
                    "qty" => $qty
        ));
    }

    function selectTransferedFrom($itemid, $warehousefromid, $status) {
        $query = "select transferitem.*,item.partnumber,item.descriptions,warehouse.name warehousename
                  from transferitem join item on transferitem.itemid=item.id join 
                  warehouse on transferitem.warehousetoid=warehouse.id and transferitem.itemid=$itemid and 
                  transferitem.warehousefromid=$warehousefromid and status=$status";
        return $this->db->query($query)->result();
    }

    function selectTransferedTo($itemid, $warehoustoid, $status) {
        $query = "select transferitem.*,item.partnumber,item.descriptions,warehouse.name warehousename
                  from transferitem join item on transferitem.itemid=item.id join 
                  warehouse on transferitem.warehousefromid=warehouse.id and transferitem.itemid=$itemid and 
                  transferitem.warehousetoid=$warehoustoid and status=$status";
        return $this->db->query($query)->result();
    }

    function selectTransferItemDetail($transferitemid) {
        $query = "select transferitemdetail.*,unit.codes from transferitemdetail
                  join unit on transferitemdetail.unitid=unit.id and transferitemdetail.transferitemid=$transferitemid";
        return $this->db->query($query)->result();
    }

    function approvetransfer($transferid) {
        return $this->db->query("select item_approvetransfer($transferid)");
    }

    function getPrice($itemid) {
        $query = "select costing_price as price,curr_costing_price curr from item where id=$itemid limit 1;";
        //echo $query."<br/>";
        return $this->db->query($query)->row();
    }

    function isAvailableToDeleteWarehouse($itemid, $warehouseid) {
        $query = "select sum(stock) qty from stock where itemid=$itemid and warehouseid=$warehouseid";
        $dt = $this->db->query($query)->row();
        return ($dt->qty == 0);
    }

    function removeWarehouse($itemid, $warehouseid) {
        $query = "delete from stock where itemid=$itemid and warehouseid=$warehouseid";
        return $this->db->query($query);
    }

    function getByPartNumber($id) {
        $query = "select * from item i where i.id=$id";
        return $this->db->query($query)->row();
    }

}

?>
