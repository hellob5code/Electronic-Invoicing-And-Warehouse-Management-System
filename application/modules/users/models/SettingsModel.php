<?php

class SettingsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getMyFirmsDefaultCurrency()
    {
        $this->db->select('firms_users.id, default_currency, name');
        $this->db->where('for_user', USER_ID);
        $this->db->where('is_deleted', 0);
        $this->db->where('firms_translations.is_default', 1);
        $this->db->join('firms_translations', 'firms_translations.for_firm = firms_users.id');
        $result = $this->db->get('firms_users');
        return $result->result_array();
    }

    public function setNewDefaultCurrency($post)
    {
        $this->db->where('id', $post['forId']);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('firms_users', array('default_currency' => $post['newDefault']))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function deleteDefaultCurrency($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->update('firms_users', array('default_currency' => ''))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function setNewCurrency($post)
    {
        if (!$this->db->insert('users_currencies', array('for_user' => USER_ID, 'name' => $post['currencyName'], 'value' => $post['currencyValue']))) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyCurrencies()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('users_currencies');
        return $result->result_array();
    }

    public function deleteMyCurrency($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('users_currencies')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyQuantityTypes()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('users_quantity_types');
        return $result->result_array();
    }

    public function deleteCustomQuantityType($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('users_quantity_types')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyPaymentMethods()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('users_payment_methods');
        return $result->result_array();
    }

    public function deleteCustomPaymentMethod($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('users_payment_methods')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getMyNoVatReasons()
    {
        $this->db->where('for_user', USER_ID);
        $result = $this->db->get('user_no_vat_reasons');
        return $result->result_array();
    }

    public function deleteMyNoVatReason($id)
    {
        $this->db->where('id', $id);
        $this->db->where('for_user', USER_ID);
        if (!$this->db->delete('user_no_vat_reasons')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        } 
    }

}