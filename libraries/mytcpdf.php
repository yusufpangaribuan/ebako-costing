<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pdf
 *
 * @author hp
 */
//require_once dirname(__FILE__) . '/tcpdf/examples/tcpdf_include.php';
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Mytcpdf extends TCPDF {

    //put your code here
    function __construct() {
        parent::__construct();
    }

}

?>
