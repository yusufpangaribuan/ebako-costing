<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_model
 *
 * @author admin
 */
class model_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectById($id) {
        $query = "select *,
        			(select name as checkedby_name from employee where employee.id=model.checkedby), 
					(select name as approvedby_name from employee where employee.id=model.approvedby)
        		from model where id=" . $id;
        //echo $query."<br/>";
        return $this->db->query($query)->row();
    }

    function selectAll() {
        $this->db->order_by('id', 'desc');
        return $this->db->get('model')->result();
    }

    function selectAllAvailabel() {
        $query = "select 
                model.*,
                (select model_getfinish_overview(model.id)) finishoverviewname,
                (select model_getconstruction_overview(model.id)) constructionoverviewname
                from model where ishavebom=true order by id desc";
        return $this->db->query($query)->result();
    }

    function selectAllFromCostingByCustomer($billto) {
        $query = "select 
                  costing.modelid,
                  model.*,
                  (select model_getfinish_overview(model.id)) finishoverviewname,
                  (select model_getconstruction_overview(model.id)) constructionoverviewname
                  from costing join 
                  model on costing.modelid=model.id and costing.customerid=$billto";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function getNumRows($code, $description, $modeltypeid, $custcode) {
        $query = "select model.*,modeltype.name modeltypename from model join
                  modeltype on model.modeltypeid=modeltype.id";
        if ($code != "") {
            $query .= " and model.no ilike '%" . $code . "%'";
        }if ($description != "") {
            $query .= " and model.description ilike '%" . $description . "%'";
        }if ($modeltypeid != 0) {
            $query .= " and model.modeltypeid =$modeltypeid";
        }if ($custcode != "") {
            $query .= " and model.custcode ilike '%$custcode%'";
        }
        return $this->db->query($query)->num_rows();
    }

    function search($code, $description, $modeltypeid, $custcode, $limit, $offset) {
        $query = "select model.*,modeltype.name modeltypename ,
					(select name as checkedby_name from employee where employee.id=model.checkedby), 
					(select name as approvedby_name from employee where employee.id=model.approvedby)  
        		  from model join
                  modeltype on model.modeltypeid=modeltype.id ";
        if ($code != "") {
            $query .= " and model.no ilike '%" . $code . "%'";
        }if ($description != "") {
            $query .= " and model.description ilike '%" . $description . "%'";
        }if ($modeltypeid != 0) {
            $query .= " and model.modeltypeid =" . $modeltypeid;
        }if ($custcode != "") {
            $query .= " and model.custcode ilike '%$custcode%'";
        }
        $query .= " order by model.id desc limit $limit offset $offset";
        return $this->db->query($query)->result();
    }

    function searchAvailabel($code, $description, $modeltypeid, $custcode, $limit, $offset) {
        $query = "select model.*,modeltype.name modeltypename from model join
                  modeltype on model.modeltypeid=modeltype.id";
        // if ($code != "") {
        //     $query .= " and model.no ilike '%" . $code . "%'";
        // }if ($description != "") {
        //     $query .= " and model.description ilike '%" . $description . "%'";
        // }if ($modeltypeid != 0) {
        //     $query .= " and model.modeltypeid =" . $modeltypeid;
        // }if ($custcode != "") {
        //     $query .= " and model.custcode ilike '%$custcode%'";
        // }
        //$query .= " and model.ishavebom=true order by model.id desc limit $limit offset $offset";\
        // $query .= " and model.ishavebom=true and model.checkedstatus='1' and model.approvedstatus='1' order by model.id desc limit $limit offset $offset";
        //echo $query . "<br/>";
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('model', $data);
    }

    function update($data, $where) {
        return $this->db->update('model', $data, $where);
    }

    function getFileNameById($id) {
        $this->db->select('filename');
        $this->db->where('id', $id);
        $dt = $this->db->get('model')->row();
        return $dt->filename;
    }

    function savefinishing($modelid, $finishingid) {
        $this->db->insert('modelfinishing', array(
            "modelid" => $modelid,
            "finishingid" => $finishingid
        ));
    }

    function selectfinishingByModelId($modelid) {
        $query = "select modelfinishing.*,modelfinishinglist.name,modelfinishinglist.description from modelfinishing 
                  join modelfinishinglist on modelfinishing.finishingid=modelfinishinglist.id 
                  where modelfinishing.modelid=$modelid";
        return $this->db->query($query)->result();
    }

    function deletefinishing($id) {
        return $this->db->query('modelfinishing', array('id' => $id));
    }

    function savemarble($data) {
        return $this->db->insert('modelmarble', $data);
    }

    function savepacking($modelid, $itemid, $unitid, $width, $depth, $height, $qty, $location, $type, $specifications) {
        return $this->db->insert('modelpacking', array(
                    "modelid" => $modelid,
                    "itemid" => $itemid,
                    "unitid" => $unitid,
                    "depth" => $depth,
                    "height" => $height,
                    "width" => $width,
                    "qty" => $qty,
                    "location" => $location,
                    "type" => $type,
                    "specifications" => $specifications
        ));
    }

    function deletepacking($id) {
        return $this->db->delete('modelpacking', array('id' => $id));
    }

    function selectmarbleByModelId($modelid) {
        $query = "select 
                modelmarble.*,
                item.partnumber,
                item.descriptions,
                unit.codes
                from modelmarble 
                join item on modelmarble.itemid=item.id
                join unit on modelmarble.unitid=unit.id
                where modelmarble.modelid=$modelid";
        return $this->db->query($query)->result();
    }

    function selectMarbleById($id) {
        $query = "select 
                modelmarble.*,
                item.partnumber,
                item.descriptions,
                unit.codes
                from modelmarble 
                join item on modelmarble.itemid=item.id
                join unit on modelmarble.unitid=unit.id
                where modelmarble.id=$id";
        return $this->db->query($query)->row();
    }

    function deletemarble($id) {
        return $this->db->delete('modelmarble', array('id' => $id));
    }

    function savelatherinlay($data) {
        return $this->db->insert('modellatherinlay', $data);
    }

    function selectlatherinlayByModelId($modelid) {
        $query = "select 
                modellatherinlay.*,
                item.partnumber,
                item.descriptions,
                unit.codes
                from modellatherinlay 
                join item on modellatherinlay.itemid=item.id
                join unit on modellatherinlay.unitid=unit.id
                where modellatherinlay.modelid=$modelid";
        return $this->db->query($query)->result();
    }

    function selectlatherinlayById($id) {
        $query = "select 
                modellatherinlay.*,
                item.partnumber,
                item.descriptions,
                unit.codes
                from modellatherinlay 
                join item on modellatherinlay.itemid=item.id
                join unit on modellatherinlay.unitid=unit.id
                where modellatherinlay.id=$id";
        return $this->db->query($query)->row();
    }

    function deletelatherinlay($id) {
        return $this->db->delete('modellatherinlay', array('id' => $id));
    }

    function saveglass($data) {
        return $this->db->insert('modelglass', $data);
    }

    function selectGlassByModelId($modelid) {
        $query = "select 
                modelglass.*,
                item.partnumber,
                item.descriptions,
                unit.codes
                from modelglass 
                join item on modelglass.itemid=item.id
                join unit on modelglass.unitid=unit.id
                where modelglass.modelid=$modelid";
        return $this->db->query($query)->result();
    }

    function selectGlassById($id) {
        $query = "select 
                modelglass.*,
                item.partnumber,
                item.descriptions,
                unit.codes
                from modelglass 
                join item on modelglass.itemid=item.id
                join unit on modelglass.unitid=unit.id
                where modelglass.id=$id";
        return $this->db->query($query)->row();
    }

    function deleteglass($id) {
        return $this->db->delete('modelglass', array('id' => $id));
    }

    function selectpackingByModelId($modelid) {
        $query = "select 
                modelpacking.*,
                item.partnumber,
                item.descriptions,
                unit.codes unitcode
                from modelpacking 
                join item on modelpacking.itemid=item.id
                join unit on modelpacking.unitid=unit.id
                where modelpacking.modelid=$modelid";
        return $this->db->query($query)->result();
    }

    function selectpackingById($id) {
        $query = "select 
                modelpacking.*,
                item.partnumber,
                item.descriptions,
                unit.codes unitcode
                from modelpacking 
                join item on modelpacking.itemid=item.id
                join unit on modelpacking.unitid=unit.id
                where modelpacking.id=$id";
        return $this->db->query($query)->row();
    }

    function inserthardware($modelid, $hardwaretypeid, $class, $itemid, $qty, $unitid, $location, $supplier, $notes, $is_picklist = true) {
        return $this->db->insert('modelhardware', array(
                    "itemid" => $itemid,
                    "hardwaretypeid" => $hardwaretypeid,
                    "class" => $class,
                    "modelid" => $modelid,
                    "qty" => $qty,
                    "unitid" => $unitid,
                    "location" => $location,
                    "supplier" => $supplier,
                    "notes" => $notes,
                    "is_picklist" => $is_picklist,
        ));
    }

    function selectItemHarwareByModelId($modelid, $hardwaretypeid) {
        $query = "select 
                    modelhardware.*,
                    item.partnumber,
                    item.descriptions description,
                    unit.codes unitcode
                    from modelhardware 
                    join item on modelhardware.itemid=item.id 
                    join unit on modelhardware.unitid=unit.id
                    where modelhardware.modelid=$modelid
                    and modelhardware.hardwaretypeid=$hardwaretypeid
                    order by modelhardware.id desc
                ";
        return $this->db->query($query)->result();
    }

    function saveBomItem($modelid, $componentid, $qty, $location) {
        $this->db->insert('bom', array(
            "modelid" => $modelid,
            "componentid" => $componentid,
            "qty" => $qty,
            "location" => $location));
    }

    function selectBomItemByModelId($modelid) {
        $query = "select bom.*,
            component.partnumber,
            component.description,
            component.turn,
            component.lam,
            component.carv,
            component.mall,
            component.ft,
            component.fw,
            component.fl,
            component.rt,
            component.rw,
            component.rl,
            component.mhmd,
            component.sq_ven_a,
            component.sq_ven_dgb,
            component.ven_itemid,
            item.groupsid,
            component.itemid woodid,
            (select names from groups where id=(select groupsid from item where id=component.itemid)) groupsname,
            (select case when item.groupsid=3 then (select item.descriptions) when groupsid = 7 then (select ' '::character varying) else (select names from groups where id=item.groupsid) end) woodname,
            component.ven_type,
            component.ven_s1s,
            component.ven_dgb,
            component.ven_s2s from bom 
            join component on bom.componentid=component.id left join item on component.itemid=item.id
            where bom.modelid=$modelid order by bom.id asc";

        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectBomItemByModelId_updated($modelid) {
        $query = "
                select bom.*,            
                item.groupsid,
                bom.itemid woodid,
                (select names from groups where id=(select groupsid from item where id=bom.itemid)) groupsname,
                (select case when item.groupsid=3 then (select item.descriptions) when groupsid = 7 then (select ' '::character varying) else (select names from groups where id=item.groupsid) end) woodname
                from bom             
                left join item on bom.itemid=item.id
                where bom.modelid=$modelid order by bom.id asc
            ";

        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectWoodBom($modelid) {
        $query = "select distinct wood,wood.name woodname from bom 
                join wood on bom.wood::int=wood.id and modelid=$modelid";
        return $this->db->query($query)->result();
    }

    function getVolumePerCategory($modelid, $woodid, $category) {
        $query = "select sum(\"$category\"::double precision) ct from bom where \"$category\" !='' and modelid=$modelid and wood::integer=$woodid";
        $dt = $this->db->query($query)->row();
        return $dt->ct;
    }

    function bomdeleteitemid($bomitemid) {
        return $this->db->query("delete from bom where id=$bomitemid");
    }

    function delete($id) {
        return $this->db->query("select model_delete($id)");
    }

    function getFileNameModelById($id) {
        $query = "select filename from model where id=$id";
        $dt = $this->db->query($query)->row();
        return $dt->filename;
    }

    function selectTypeHardwareFormModelByModelId($modelid) {
        $query = "select distinct modelhardware.hardwaretypeid,hardwaretype.name
                from modelhardware join hardwaretype 
                on modelhardware.hardwaretypeid=hardwaretype.id
                and hardwaretype.id != 3
                order by modelhardware.hardwaretypeid asc";

        return $this->db->query($query)->result();
    }

    function selectUpholstryModelByModelId($modelid) {
        $query = "select distinct modelhardware.hardwaretypeid,hardwaretype.name
                from modelhardware 
                join hardwaretype on modelhardware.hardwaretypeid=hardwaretype.id 
                where modelhardware.modelid=$modelid
                and hardwaretype.id = 3
                order by modelhardware.hardwaretypeid asc";

        return $this->db->query($query)->result();
    }

    function deleteHardware($hardwareid) {
        return $this->db->delete('modelhardware', array('id' => $hardwareid));
    }

    function selectHardwareById($hardwareid) {

        $query = "
            select 
            modelhardware.*,
            item.partnumber,
            item.descriptions description,
            unit.codes unitcode
            from modelhardware 
            join item on modelhardware.itemid=item.id 
            join unit on modelhardware.unitid=unit.id
            where modelhardware.id=$hardwareid
            ";
        //echo $query;
        return $this->db->query($query)->row();
    }

    function isExistCode($code) {
        $dt = $this->db->query("select count(*) as ct from model where no='$code'")->row();
        return $dt->ct;
    }

    function docopy($modelid, $modelno) {
        return $this->db->query("select model_docopy($modelid,'$modelno')");
    }

    function insertMaterial($modelid, $itemid, $qty) {
        return $this->db->insert("modelmaterial", array(
                    "modelid" => $modelid,
                    "itemid" => $itemid,
                    "qty" => $qty));
    }

    function deleteAllMaterial($modelid) {
        return $this->db->delete("modelmaterial", array("modelid" => $modelid));
    }

    function updateMaterial($modelid, $itemid, $qty) {
        return $this->db->update("modelmaterial", array("qty" => $qty), array("modelid" => $modelid, "itemid" => $itemid));
    }

    function isMaterialExist($modelid, $itemid) {
        return (($this->db->query("select count(*) ct from modelmaterial where modelid=$modelid and itemid=$itemid")->row()->ct) > 0);
    }

    function selectFinishOverview() {
        return $this->db->get("finishoverview")->result();
    }

    function selectConstructionOverview() {
        return $this->db->get("constructionoverview")->result();
    }

    function createbom($modelid) {
        return $this->db->query("select bom_createformodel($modelid)");
    }

    function selectAllWoodByModelId($modelid) {
        $query = "with t as (
                select
                item.id,
                item.descriptions
                from bom join component on bom.componentid=component.id 
                join item on component.itemid=item.id and bom.modelid=$modelid and item.groupsid=3
                ) select distinct id,descriptions as woodname from t order by id asc";
        return $this->db->query($query)->result();
    }

    function selectAllWoodByModelId_updated($modelid) {
        $query = "with t as (
                select
                item.id,
                item.descriptions
                from bom  
                join item on bom.itemid=item.id and bom.modelid=$modelid and item.groupsid=3
                ) select distinct id,descriptions as woodname from t order by id asc";
        return $this->db->query($query)->result();
    }

    function selectAllItemByModelId($modelid) {
        $query = "with t as (
                select
                item.id,
                item.descriptions
                from bom join component on bom.componentid=component.id 
                join item on component.itemid=item.id and bom.modelid=$modelid and item.groupsid != 7
                ) select distinct id,descriptions as woodname from t order by id asc";
        return $this->db->query($query)->result();
    }

    function selectAllItemByModelId_updated($modelid) {
        $query = "with t as (
                select
                item.id,
                item.descriptions
                from bom  
                join item on bom.itemid=item.id and bom.modelid=$modelid and item.groupsid != 7
                ) select distinct id,descriptions as woodname from t order by id asc";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectMaterialSpecificationByGroup($modelid, $groupitemid) {
        $query = "select modelbom.*,item.partnumber,item.yield,item.descriptions from modelbom 
                  join item on modelbom.itemid=item.id and modelbom.modelid=$modelid and item.groupsid in ($groupitemid)";
        return $this->db->query($query)->result();
    }

    function getAdditionalNotes($modelid) {
        $query = "select additionalnotes from model where id=$modelid limit 1";
        $dt = $this->db->query($query)->row();
        return $dt->additionalnotes;
    }

    function updateadditionalnotes($data, $condition) {
        return $this->db->update("model", $data, $condition);
    }

    function selectLayout($modelid) {
        return $this->db->query("select * from modellayout where modelid=$modelid")->result();
    }

    function uploadlayout($data) {
        return $this->db->insert("modellayout", $data);
    }

    function deletelayout($id) {
        return $this->db->delete('modellayout', array("id" => $id));
    }

    function selectreviewnotesandhistorybyid($id) {
        return $this->db->query("select * from modelreviewnotes where id=$id order by id desc")->row();
    }

    function selectreviewnotesandhistorybymodel($modelid) {
        return $this->db->query("select * from modelreviewnotes where modelid=$modelid order by id desc")->result();
    }

    function savereviewnotesandhistory($data) {
        return $this->db->insert('modelreviewnotes', $data);
    }

    function updatereviewnotesandhistory($data, $condition) {
        return $this->db->update('modelreviewnotes', $data, $condition);
    }

    function deletereviewnotesandhistory($id) {
        return $this->db->delete('modelreviewnotes', array("id" => $id));
    }

    function selectPackingMaterialByModelId($modelid) {
        $query = "select 
                    modelpacking.*,
                    item.partnumber,
                    item.descriptions description,
                    unit.codes unitcode
                    from modelpacking 
                    join item on modelpacking.itemid=item.id 
                    join unit on modelpacking.unitid=unit.id
                    where modelpacking.modelid=$modelid";
        return $this->db->query($query)->result();
    }

    function selectVeenerIdByModelId($modelid) {
        $query = "select distinct(component.ven_itemid) itemid,item.descriptions itemname
                from component join bom 
                on bom.componentid=component.id and bom.modelid=$modelid 
                join item on component.ven_itemid=item.id where component.ven_itemid != 0";
        return $this->db->query($query)->result();
    }

    function selectVeenerIdByModelId_updated($modelid) {
        $query = "select distinct(bom.ven_itemid) itemid,item.descriptions itemname from bom 
                  join item on bom.ven_itemid=item.id where bom.modelid=$modelid and bom.ven_itemid != 0";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function getfinish_overview($modelid) {
        $query = "select model_getfinish_overview($modelid) as ct";
        return nl2br($this->db->query($query)->row()->ct);
    }

    function select_model_bom($modelid) {
        $query = "with t as(
                select 
                modelbom.*,
                item.partnumber itemcode,
                (select item_get_id_smallest_unit(modelbom.itemid))::integer unitid,
                item.descriptions description 
                from modelbom join item on modelbom.itemid=item.id and modelbom.modelid=$modelid order by modelbom.itemid asc
                ) select t.*,unit.codes unitcode from t join unit on t.unitid=unit.id order by t.itemid asc";
        return $this->db->query($query)->result();
    }

    function selectExpose() {
        return $this->db->get('expose')->result();
    }

    function selectInternal() {
        return $this->db->get('internal')->result();
    }

    function selectPanel() {
        return $this->db->get('panel')->result();
    }

    function selectVeneer() {
        return $this->db->get('veneer')->result();
    }

    function selectOthers() {
        return $this->db->get('others')->result();
    }

    function getLastModelNumber() {
        $query = "select 
        modeltype.*,
        (select no from model where modeltypeid=modeltype.id order by id desc limit 1)  last_model_code
        from modeltype";
        return $this->db->query($query)->result();
    }

    function insert_other_material_overview($data) {
        return $this->db->insert('model_other_material_overview', $data);
    }

    function update_other_material_overview($data, $where) {
        return $this->db->update('model_other_material_overview', $data, $where);
    }

    function selectOtherMaterialOverviewByTypeanModelId($modelid, $typeid) {
        $this->db->where("modelid", $modelid);
        $this->db->where("typeid", $typeid);
        return $this->db->get("model_other_material_overview")->result();
    }

    function selectOtherMaterialOverviewById($id) {
        $this->db->where("id", $id);
        return $this->db->get("model_other_material_overview")->row();
    }

    function delete_other_material_overview($id) {
        return $this->db->delete("model_other_material_overview", array("id" => $id));
    }
    
    function saveveneer($data) {
    	return $this->db->insert('modelveneer', $data);
    }
    
    function selectVeneerByModelId($modelid) {
    	$query = "select
    	modelveneer.*,
    	item.partnumber,
    	item.descriptions,
    	unit.codes
    	from modelveneer
    	join item on modelveneer.itemid=item.id
    	join unit on modelveneer.unitid=unit.id
    	where modelveneer.modelid=" . $modelid;
    	
    	return $this->db->query($query)->result();
    }
    
    function selectVeneerById($id) {
    	$query = "select
    	modelveneer.*,
    	item.partnumber,
    	item.descriptions,
    	unit.codes
    	from modelveneer
    	join item on modelveneer.itemid=item.id
    	join unit on modelveneer.unitid=unit.id
    	where modelveneer.id=" . $id;
    	return $this->db->query($query)->row();
    }
    
    function deleteveneer($id) {
    	return $this->db->delete('modelveneer', array('id' => $id));
    }
    
    function savesolidwood($data) {
    	return $this->db->insert('modelsolidwood', $data);
    }
    
    function selectSolidwoodByModelId($modelid) {
    	$query = "select
    	modelsolidwood.*,
    	item.partnumber,
    	item.descriptions,
    	unit.codes
    	from modelsolidwood
    	join item on modelsolidwood.itemid=item.id
    	join unit on modelsolidwood.unitid=unit.id
    	where modelsolidwood.modelid=" . $modelid;
    	return $this->db->query($query)->result();
    }
    
    function selectSolidwoodById($id) {
    	$query = "select
    	modelsolidwood.*,
    	item.partnumber,
    	item.descriptions,
    	unit.codes
    	from modelsolidwood
    	join item on modelsolidwood.itemid=item.id
    	join unit on modelsolidwood.unitid=unit.id
    	where modelsolidwood.id=" . $id;
    	return $this->db->query($query)->row();
    }
    
    function deletesolidwood($id) {
    	return $this->db->delete('modelsolidwood', array('id' => $id));
    }
    
    
    //set plywood
    
    function saveplywood($data) {
    	return $this->db->insert('modelplywood', $data);
    }
    
    function selectPlywoodByModelId($modelid) {
    	$query = "select
    	modelplywood.*,
    	item.partnumber,
    	item.descriptions,
    	unit.codes
    	from modelplywood
    	join item on modelplywood.itemid=item.id
    	join unit on modelplywood.unitid=unit.id
    	where modelplywood.modelid=" . $modelid;
    	return $this->db->query($query)->result();
    }
    
    function selectPlywoodById($id) {
    	$query = "select
    	modelplywood.*,
    	item.partnumber,
    	item.descriptions,
    	unit.codes
    	from modelplywood
    	join item on modelplywood.itemid=item.id
    	join unit on modelplywood.unitid=unit.id
    	where modelplywood.id=" . $id;
    	return $this->db->query($query)->row();
    }
    
    function deleteplywood($id) {
    	return $this->db->delete('modelplywood', array('id' => $id));
    }

    
    
    /*
     *  Special Requirement here
     */
    
    function selectSpecialRequirement() {
    	return $this->db->get("specialrequirement")->result();
    }
    
    function selectPackingType() {
    	return $this->db->get("packingtype")->result();
    }
    
    function selectFinishOnBodyFrameByModelId( $modelid ) {
    	$query = "select finish_on_body_frame, finish_on_metal_hardware from model where id=" . $modelid;
    	return $this->db->query($query)->row();
    }
    
    function selectOtherSpecialRequirementByModelIdAndType( $modelid, $typeid ) {
    	$this->db->where("modelid", $modelid);
    	$this->db->where("typeid", $typeid);
    	return $this->db->get("model_other_material_overview")->result();
    }
    
    function selectOtherPackingTypeByModelIdAndType( $modelid, $typeid ) {
    	$this->db->where("modelid", $modelid);
    	$this->db->where("typeid", $typeid);
    	return $this->db->get("model_other_material_overview")->result();
    }

    function insert_other_special_requirement($data) {
    	return $this->db->insert('model_other_material_overview', $data);
    }
    
    function update_other_special_requirement($data, $where) {
    	return $this->db->update('model_other_material_overview', $data, $where);
    }
    
    function selectOtherSpecialRequirementById($id) {
    	$this->db->where("id", $id);
    	return $this->db->get("model_other_material_overview")->row();
    }
    
    function delete_other_special_requirement($id) {
    	return $this->db->delete("model_other_material_overview", array("id" => $id));
    }
    
}

?>
