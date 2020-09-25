<?php

class error_404 extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {   
        show_404();
    }
}