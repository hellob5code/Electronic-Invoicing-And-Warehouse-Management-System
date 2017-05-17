<?php

/*
 * @Author:    Kiril Kirkov
 *  Github:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Newinvoice extends USER_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('NewInvoiceModel');
    }

    public function index()
    {
        $data = array();
        $head = array();
        $this->postChecker();
        $head['title'] = 'Administration - Home';
        $data['currencies'] = $this->NewInvoiceModel->getCurrencies();
        $data['myDefaultFirmCurrency'] = $this->NewInvoiceModel->getFirmDefaultCurrency();
        $data['quantityTypes'] = $this->NewInvoiceModel->getAllQuantityTypes();
        $data['paymentMethods'] = $this->NewInvoiceModel->getPaymentMethods();
        $data['invoiceLanguages'] = $this->NewInvoiceModel->getMyInvoiceLanguages();
        $this->render('newinvoice/index', $head, $data);
        $this->saveHistory('Go to new invoice page');
    }

    private function postChecker()
    {
        if (isset($_POST['addNewInvoiceLanguage'])) {
            $this->addNewInvoiceLanguage();
        }
    }

    private function addNewInvoiceLanguage()
    {
        $this->NewInvoiceModel->setNewInvoiceLanguage($_POST);
        $this->saveHistory('Add invoice translation - ' . $_POST['language_name']);
        redirect(lang_url('user/new/invoice'));
    }

    public function addnewquantitytype()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        if (isset($_POST['newVal'])) {
            $this->NewInvoiceModel->setNewCustomQuantityType($_POST['newVal']);
        }
    }

    public function addnewpaymentmethod()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        if (isset($_POST['newVal'])) {
            $this->NewInvoiceModel->setNewCustomPaymentMethod($_POST['newVal']);
        }
    }

}