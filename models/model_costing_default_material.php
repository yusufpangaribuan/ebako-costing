<?php

class model_costing_default_material extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function selectAll() {
        $query = 'select def.*,cat."name" as category_name,cat.isdirectmaterial from costing_default_material def 
					join costingcategory cat on cat.id = def.categoryid order by categoryid asc, materialcode asc';
        return $this->db->query($query)->result();
    }

    function selectById($id) {
        $query = 'select def.*,cat."name" as category_name,cat.isdirectmaterial from costing_default_material def 
					join costingcategory cat on cat.id = def.categoryid
    			  where def.id=' . $id . ' limit 1';
        
        return $this->db->query($query)->row();
    }

    function getNumRows( $categoryid, $materialcode, $materialdescription ) {
    	$query = 'select def.*,cat."name" as category_name,cat.isdirectmaterial from costing_default_material def 
					join costingcategory cat on cat.id = def.categoryid where true ';
    	if (!empty($categoryid)) {
    		$query .= " and (categoryid = $categoryid)  ";
    	}
    	if (!empty($materialcode)) {
    		$query .= " and (materialcode  ilike '%$materialcode%' )  ";
    	}
    	if (!empty($materialdescription)) {
    		$query .= " and (materialdescription  ilike '%$materialdescription%' )  ";
    	}
    	return $this->db->query($query)->num_rows();
    }
    
    function search($categoryid, $materialcode, $materialdescription, $limit, $offset) {
    	$query = 'select def.*,cat."name" as category_name,cat.isdirectmaterial from costing_default_material def 
					join costingcategory cat on cat.id = def.categoryid where true ';
    	if (!empty($categoryid)) {
    		$query .= " and (categoryid = $categoryid)  ";
    	}
    	if (!empty($materialcode)) {
    		$query .= " and (materialcode  ilike '%$materialcode%' )  ";
    	}
    	if (!empty($materialdescription)) {
    		$query .= " and (materialdescription  ilike '%$materialdescription%' )  ";
    	}
    	//$query .= " order by id desc limit $limit offset $offset ";
    	$query .= " order by id desc ";
    	return $this->db->query($query)->result();
    }

    function insert($inserted_data) {
        $this->db->insert('costing_default_material', $inserted_data);
    }

    function update($id, $updated_data) {
        $this->db->where('id', $id);
        return $this->db->update('costing_default_material', $updated_data);
    }

    function delete($id) {
        return $this->db->delete('costing_default_material', array("id" => $id));
    }

}

?>
