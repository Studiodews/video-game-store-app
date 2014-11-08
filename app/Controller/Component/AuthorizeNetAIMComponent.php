<?php

class AuthorizeNetAIMComponent extends Component { 
    protected $api_login;
    protected $transaction_key;
    protected $sandbox = true;
    protected $post_string;
    public $VERIFY_PEER = true;
    
    /**
     * Holds all the x_* name/values that will be posted in the request. 
     * Default values are provided for best practice fields.
     */
    private $_x_post_fields = array(
        "x_version" => "3.1", 
        "x_delim_char" => ",",
        "x_delim_data" => "TRUE",
        "x_relay_response" => "FALSE",
        "x_encap_char" => "|",
    );
    
    private $additional_line_items = array();
    private $custom_fields = array();
    
    private $_all_aim_fields = array(
        "x_login","x_tran_key", "x_type", "x_version", "x_trans_id",
        
        "x_amount","x_description","x_tax","x_tax_exempt", "x_freight",
        
        "x_first_name", "x_last_name", "x_address","x_city","x_state","x_zip","x_country","x_company","x_phone",
            "email","email_customer",
        "x_ship_to_first_name","x_ship_to_last_name","x_ship_to_address","x_ship_to_city","x_ship_to_state","x_ship_to_zip",
            "x_ship_to_country", "x_ship_to_company",
        
        "x_card_code","x_card_num","x_exp_date","x_cardholder_authentication_value",
        /*"x_bank_aba_code","x_bank_acct_name", "x_bank_acct_num","x_bank_acct_type",
            "x_bank_check_number","x_c_bank_name",
        
        "x_allow_partial_auth",
        "x_auth_code","x_authentication_indicator", */
        "x_method","x_relay_response","x_delim_char","x_delim_data","x_encap_char",
        
        "x_cust_id",
        /*"x_customer_ip",
        "x_duplicate_window","x_duty","x_echeck_type",
        "x_fax","x_footer_email_receipt",
        "x_header_email_receipt","x_invoice_num","x_line_item",
        "x_po_num","x_recurring_billing",
        
        "x_split_tender_id","x_test_request"*/
        
        );
    
    const LIVE_URL = 'https://secure.authorize.net/gateway/transact.dll';
    const SANDBOX_URL = 'https://test.authorize.net/gateway/transact.dll';
    public function useSandbox($bool) {
        $this->sandbox = $bool;
    }

    /*
    sets the api login, transaction key and other fields required to make a transaction
    */
    public function set_credentials($api_login, $transaction_key) {
        $this->api_login = $api_login;
        $this->transaction_key = $transaction_key;
        $this->_all_aim_fields["x_login"] = urlencode($api_login);
        $this->_all_aim_fields['x_tran_key'] = urlencode($transaction_key);
        foreach ($this->_x_post_fields as $key=>$value) {
            $this->_all_aim_fields[$key] = $value;
        }
    }
    
    /*sets fields for shipping, billing and credit card information*/
    public function set_fields($data) {
        foreach($data as $key=>$value) {
            $this->_all_aim_fields[$key] = urlencode($value);
        }
    }
    
    public function authorizeAndCapture($amount, $shipping="0.00", $tax='0.00')
    {
        $this->_all_aim_fields['x_tax'] = $tax;
        $this->_all_aim_fields['x_freight'] = $shipping;
        $this->_all_aim_fields['x_amount'] = $amount;
        $this->_all_aim_fields['x_type'] = "AUTH_CAPTURE";
        return $this->_sendRequest();
        
    }
    
    public function get_post_string() {
        $query_post = "";
        foreach($this->_all_aim_fields as $key=>$value) {
            $query_post .= $key."=".$value."&";
        }
        return $query_post;
    }
    
    public function _sendRequest() {
        $url = self::LIVE_URL;
        if($this->sandbox) {
            $url = self::SANDBOX_URL;
        }
        $curl_request = curl_init($url);
        curl_setopt($curl_request, CURLOPT_POSTFIELDS, $this->get_post_string());
        curl_setopt($curl_request, CURLOPT_HEADER, 0);
        curl_setopt($curl_request, CURLOPT_TIMEOUT, 45);
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($curl_request, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($curl_request);
        curl_close($curl_request);
        $response_array = explode($this->_x_post_fields['x_delim_char'], $response);
        return $response_array;
    }
}