<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stockcard
 *
 * @author operational
 */
class stockcard extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    function index() {
        $data['stockcard'] = $this;
        $this->load->model('model_warehouse');
        $this->load->model('model_groups');
        $data['warehouse'] = $this->model_warehouse->selectAll();
        $data['itemgroup'] = $this->model_groups->selectAll();
        $this->load->view('stockcard/index', $data);
    }

    function search() {
        $flag = $this->input->post('flag');
        $this->load->model('model_stock');
        if (!empty($flag)) {
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $itemid = $this->input->post('itemid');
            $warehouseid = $this->input->post('warehouseid');


            $query = "
            select
            *
            from
            v_stock_transaction
            where itemid=$itemid and date between '$start_date' and '$end_date'
            and warehouseid=$warehouseid
            order by transactionid asc
        ";
            $data['last_balance'] = $this->model_stock->get_last_balance_before_param_date($itemid, $warehouseid, $start_date);
            $data['item'] = $this->db->query($query)->result();
        } else {
            $data['item'] = null;
        }

        $this->load->view('stockcard/search', $data);
    }

    function generate($flag) {
        $this->load->model('model_user');
        $data['accessmenu'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "stockcard"));
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $itemid = $this->input->post('itemid');
        $warehouseid = $this->input->post('warehouseid');

        $groupid = $this->input->post('groupid');

        $type = $this->input->post('type');

        $this->load->model('model_stock');
        $this->load->model('model_item');

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['warehouseid'] = $warehouseid;
        $data['flag'] = $flag;

        if ($flag == "excel") {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=file.xls");
        }
        if ($type == 1) {
            if (!empty($itemid)) {
                $start_date_to_time = strtotime($start_date);
                $begining_balance_create = strtotime('2016-01-01');
                if ($start_date_to_time >= $begining_balance_create) {
                    $query = "select bg.* from begining_balance bg where bg.itemid=$itemid and bg.warehouseid=$warehouseid";
                    $bg_rst = $this->db->query($query)->row();
                    $bg = empty($bg_rst) ? 0 : $bg_rst->stock;

                    $query = "select coalesce(sum(vst.qty_in_small_unit),0) total
                    from v_stock_transaction_time vst
                    where vst.trans_time between '2016-01-01' and '$start_date'
                    and  vst.itemid=$itemid
                    and vst.warehouseid=$warehouseid
                    and vst.status=1
                    and vst.qty_in_small_unit is not null";

                    $total_in = $this->db->query($query)->row()->total;

                    $query = "select coalesce(sum(vst.qty_in_small_unit),0) total
                    from v_stock_transaction_time vst
                    where vst.trans_time between '2016-01-01' and '$start_date'
                    and  vst.itemid=$itemid
                    and vst.warehouseid=$warehouseid
                    and vst.status=0
                    and vst.qty_in_small_unit is not null";

                    $total_out = $this->db->query($query)->row()->total;

                    $last_balance = ($bg + $total_in) - $total_out;

                    //Ambil Transaksi
                    $query = " select vst.*,i.price_in_base_unit from
                    v_stock_transaction_time vst
                    join item i on vst.itemid=i.id
                    where vst.itemid=$itemid and vst.trans_time between '$start_date' and '$end_date 23:59:59'
                    and vst.warehouseid=$warehouseid
                    order by vst.trans_time asc";
//                    echo "<pre>".$query."</pre>";exit;
                    $data['last_balance'] = $last_balance;
                    $data['item'] = $this->db->query($query)->result();
                } else {
                    $query = "select * from stock_get_stock_opname_item_warehouse_trans_date('$start_date',$itemid,$warehouseid)";

                    $last_son = $this->db->query($query)->row();
                    if (!empty($last_son)) {
                        /* total transaksi yang setelah transaksi stockopname */
                        //Total transaksi in
                        $query = "select coalesce(sum(vst.qty_in_small_unit),0) total
                                    from v_stock_transaction_time vst
                                    where vst.transactionid > " . $last_son->transactionid_ . " and vst.trans_time < '$start_date'
                                    and  vst.itemid=$itemid
                                    and vst.warehouseid=$warehouseid
                                    and vst.status=1
                                    and vst.qty_in_small_unit is not null";
                        $total1 = $this->db->query($query)->row()->total;

//                    echo $query."<br/>";
                        //Total transaksi out
                        $query = "select coalesce(sum(vst.qty_in_small_unit),0) total
                                from v_stock_transaction_time vst
                                where vst.transactionid > " . $last_son->transactionid_ . " and vst.trans_time < '$start_date'
                                and  vst.itemid=$itemid
                                and vst.warehouseid=$warehouseid
                                and vst.status=0
                                and vst.qty_in_small_unit is not null";
                        $total2 = $this->db->query($query)->row()->total;
//                    echo $query."<br/>";
                        //Hitung balance terakhir
                        $last_balance = $last_son->stock_ + $total1 - $total2;

                        //Ambil Transaksi
                        $query = " select * from
                                v_stock_transaction_time vst
                                where vst.itemid=$itemid and vst.trans_time between '$start_date' and '$end_date'
                                and vst.warehouseid=$warehouseid and vst.transactionid > $last_son->transactionid_
                                order by vst.transactionid asc,vst.trans_time asc";

                        $data['last_balance'] = $last_balance;
                        $data['item'] = $this->db->query($query)->result();
                    }
                }
                $data['item_detail'] = $this->model_item->selectById($itemid);
                $this->load->view('stockcard/print', $data);
            } else {
                $extend_query = "";
                if ($groupid != -1) {
                    $extend_query = " and i.groupsid=$groupid ";
                }
                $query = "select distinct(i.id),i.partnumber item_code,i.descriptions item_description,i.isstock,i.price_in_base_unit
                    from item i join stock on i.id=stock.itemid
                    where stock.warehouseid=$warehouseid $extend_query order by i.partnumber asc";

                $data['item'] = $this->db->query($query)->result();
                if ($flag == "excel") {
                    header("Content-type: application/vnd-ms-excel");
                    header("Content-Disposition: attachment; filename=file.xls");
                }
                $this->load->view('stockcard/print_group', $data);
            }
        } else {

            $extend_query = "";
            if (!empty($groupid)) {
                if ($groupid != -1) {
                    $extend_query = "and i.groupsid=$groupid";
                }
            } else {
                $extend_query = " and i.id=$itemid";
            }

            $query = "
                with t2 as (
                    select
                        t.*,(t.beginning_stock + t.total_in_before - t.total_out_before) last_stock,
                        (select coalesce(sum(qty_in_small_unit),0) from v_stock_transaction_time where itemid=t.id and warehouseid=$warehouseid and trans_time between '$start_date' and '$end_date 23:59:59' and status=1) st_in,
                        (select coalesce(sum(qty_in_small_unit),0) from v_stock_transaction_time where itemid=t.id and warehouseid=$warehouseid and trans_time between '$start_date' and '$end_date 23:59:59' and status=0) st_out
                    from (
                        select distinct(i.id),
                        i.partnumber item_code,
                        i.descriptions item_description,
                        i.price_in_base_unit,
                        (select coalesce(bg.stock,0) from begining_balance bg where bg.itemid=i.id and bg.warehouseid=$warehouseid) beginning_stock,
                        (select coalesce(sum(vst.qty_in_small_unit),0) from v_stock_transaction_time vst where vst.trans_time >= '2016-01-01' and vst.trans_time < '$start_date' and  vst.itemid=i.id and vst.warehouseid=$warehouseid and vst.status=1 and vst.qty_in_small_unit is not null) total_in_before,
                        (select coalesce(sum(vst.qty_in_small_unit),0) from v_stock_transaction_time vst where vst.trans_time >= '2016-01-01' and vst.trans_time < '$start_date' and  vst.itemid=i.id and vst.warehouseid=$warehouseid and vst.status=0 and vst.qty_in_small_unit is not null) total_out_before
                        from item i join stock on i.id=stock.itemid
                        where stock.warehouseid=$warehouseid $extend_query
                    ) t
                ) select t2.*,(t2.last_stock + t2.st_in - t2.st_out) balance from t2 where true
            ";
//
//            $query = "
//            with t2 as (
//                select t.*,
//                (select coalesce(stock_,0) from stock_get_stock_opname_item_warehouse_trans_date('$start_date',t.id,$warehouseid)) last_stock,
//                (select coalesce(sum(qty_in_small_unit),0) from v_stock_transaction_time where itemid=t.id and warehouseid=$warehouseid and trans_time between '$start_date' and '$end_date' and status=1 and transactionid > t.transactionid) st_in,
//                (select coalesce(sum(qty_in_small_unit),0) from v_stock_transaction_time where itemid=t.id and warehouseid=$warehouseid and trans_time between '$start_date' and '$end_date' and status=0 and transactionid > t.transactionid) st_out
//                from (
//                        select distinct(i.id),
//                        i.partnumber item_code,
//                        i.descriptions item_description,
//                        (select transactionid_ from stock_get_stock_opname_item_warehouse_trans_date('$start_date',i.id,$warehouseid)) transactionid
//                        from item i join stock on i.id=stock.itemid
//                        where stock.warehouseid=$warehouseid $extend_query
//                ) t where true
//            )select t2.*,(t2.last_stock + t2.st_in - t2.st_out) balance from t2 where true
//            ";

            if (!empty($itemid)) {
                $query .= " and t2.id=$itemid";
            }

//            echo "<PRE>".$query."</PRE>";
//            exit;
            $data['item'] = $this->db->query($query)->result();
            if ($flag == "excel") {
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=file.xls");
            }
            $this->load->view('stockcard/print_summarize', $data);
        }
    }

}
