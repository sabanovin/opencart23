<?php

class ControllerNewSmsSetting extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('new/sms_setting');
																 
	    $this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('sms', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
		
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'));
			
		}
			$data['text_form'] = !isset($this->request->get['customer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');		
		$data['heading_title'] = $this->language->get('heading_title');
        $data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_number'] = $this->language->get('text_number');
		$data['text_username'] = $this->language->get('text_username');
		
		$data['text_password'] = $this->language->get('text_password');
		$data['text_moshtari'] = $this->language->get('text_moshtari');
		$data['text_tozih_kar'] = $this->language->get('text_tozih_kar');
		$data['text_shop'] = $this->language->get('text_shop');
		
		   $data['text_url'] = $this->language->get('text_url');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_pass'] = $this->language->get('text_pass');
		$data['text_orderid'] = $this->language->get('text_orderid');
		$data['text_ip'] = $this->language->get('text_ip');
		$data['text_status_order'] = $this->language->get('text_status_order');
		$data['text_name'] = $this->language->get('text_name');
		$data['text_send_ok'] = $this->language->get('text_send_ok');
		
		$data['text_copy'] = $this->language->get('text_copy');
		$data['text_sample_reg'] = $this->language->get('text_sample_reg');
		$data['text_login_ok'] = $this->language->get('text_login_ok');
		$data['text_wellcom'] = $this->language->get('text_wellcom');
		
		  $data['text_logout_ok'] = $this->language->get('text_logout_ok');
		$data['text_sample_logout'] = $this->language->get('text_sample_logout');
		$data['text_sample_order'] = $this->language->get('text_sample_order');
		$data['text_order_complate'] = $this->language->get('text_order_complate');
		$data['text_sample_sms_smsproccessed'] = $this->language->get('text_sample_sms_smsproccessed');
		$data['text_admin_sms'] = $this->language->get('text_admin_sms');
		
		$data['text_user_reg'] = $this->language->get('text_user_reg');
		$data['text_sample_user_reg'] = $this->language->get('text_sample_user_reg');
		$data['text_user_order'] = $this->language->get('text_user_order');
		$data['text_sample_user_order'] = $this->language->get('text_sample_user_order');
		
		$data['text_user_fish'] = $this->language->get('text_user_fish');
		$data['text_sample_user_fish'] = $this->language->get('text_sample_user_fish');
		   $data['text_admin_login'] = $this->language->get('text_admin_login');
		$data['text_sample_admin_login'] = $this->language->get('text_sample_admin_login');
		$data['text_oder_setting'] = $this->language->get('text_oder_setting');
		$data['text_admin_num'] = $this->language->get('text_admin_num');
		$data['text_admin_pul'] = $this->language->get('text_admin_pul');
		$data['text_send'] = $this->language->get('text_send');
	    $data['text_samane_saba'] = $this->language->get('text_samane_saba');
		 $data['text_samane_Novin'] = $this->language->get('text_samane_Novin');
		  $data['text_samane_saba'] = $this->language->get('text_samane_saba');
		    $data['text_samane_Lksms'] = $this->language->get('text_samane_Lksms');
			  $data['text_samane_PayamResan'] = $this->language->get('text_samane_PayamResan');
			    $data['text_samane_Lksms'] = $this->language->get('text_samane_Lksms');
				  $data['text_samane_irantc'] = $this->language->get('text_samane_irantc');
				  $data['text_samane_Saba'] = $this->language->get('text_samane_Saba');
		  $data['text_samane_mihansms'] = $this->language->get('text_samane_mihansms');
		$data['entry_samane_sms'] = $this->language->get('entry_samane_sms');
	
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		
        
		$data['token'] = $this->session->data['token'];


 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
 		if (isset($this->error['sms_number'])) {
			$data['sms_number'] = $this->error['sms_number'];
		} else {
			$data['sms_number'] = '';
		}
		
	
  		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('new/sms_setting', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('new/sms_setting', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');

		

		if (isset($this->request->post['sms_from'])) {
			$data['sms_from'] = $this->request->post['sms_from'];
		} else {
			$data['sms_from'] = $this->config->get('sms_from');
		}
		if (isset($this->request->post['sms_sample'])) {
			$data['sms_sample'] = $this->request->post['sms_sample'];
		} else {
			$data['sms_sample'] = $this->config->get('sms_sample');
		}
	   
	   if (isset($this->request->post['sms_api'])) {
			$data['sms_api'] = $this->request->post['sms_api'];
		
		} else {
			
			$data['sms_api'] = $this->config->get('sms_api');
		}
		
		if (isset($this->request->post['sms_pass'])) {
			$data['sms_pass'] = $this->request->post['sms_pass'];
		
		} else {
			
			$data['sms_pass'] = $this->config->get('sms_pass');
		}
		
		if (isset($this->request->post['sms_smssignup'])) {
			$data['sms_smssignup'] = $this->request->post['sms_smssignup'];
		
		} else {
			
			$data['sms_smssignup'] = $this->config->get('sms_smssignup');
		}
		if (isset($this->request->post['sms_smssignup_txt'])) {
			$data['sms_smssignup_txt'] = $this->request->post['sms_smssignup_txt'];
		
		} else {
			
			$data['sms_smssignup_txt'] = $this->config->get('sms_smssignup_txt');
		}
		if (isset($this->request->post['sms_smslogin'])) {
			$data['sms_smslogin'] = $this->request->post['sms_smslogin'];
		
		} else {
			
			$data['sms_smslogin'] = $this->config->get('sms_smslogin');
		}
		if (isset($this->request->post['sms_smslogin_txt'])) {
			$data['sms_smslogin_txt'] = $this->request->post['sms_smslogin_txt'];
		
		} else {
			
			$data['sms_smslogin_txt'] = $this->config->get('sms_smslogin_txt');
		}
		if (isset($this->request->post['sms_smslogout'])) {
			$data['sms_smslogout'] = $this->request->post['sms_smslogout'];
		
		} else {
			
			$data['sms_smslogout'] = $this->config->get('sms_smslogout');
		}
		if (isset($this->request->post['sms_smslogout_txt'])) {
			$data['sms_smslogout_txt'] = $this->request->post['sms_smslogout_txt'];
		
		} else {
			
			$data['sms_smslogout_txt'] = $this->config->get('sms_smslogout_txt');
		}
		
		if (isset($this->request->post['sms_smsplaced'])) {
			$data['sms_smsplaced'] = $this->request->post['sms_smsplaced'];
		
		} else {
			
			$data['sms_smsplaced'] = $this->config->get('sms_smsplaced');
		}
		if (isset($this->request->post['sms_smsplaced_txt'])) {
			$data['sms_smsplaced_txt'] = $this->request->post['sms_smsplaced_txt'];
		
		} else {
			
			$data['sms_smsplaced_txt'] = $this->config->get('sms_smsplaced_txt');
		}
		if (isset($this->request->post['sms_smsproccessed'])) {
			$data['sms_smsproccessed'] = $this->request->post['sms_smsproccessed'];
		
		} else {
			
			$data['sms_smsproccessed'] = $this->config->get('sms_smsproccessed');
		}
		if (isset($this->request->post['sms_smsproccessed_txt'])) {
			$data['sms_smsproccessed_txt'] = $this->request->post['sms_smsproccessed_txt'];
		
		} else {
			
			$data['sms_smsproccessed_txt'] = $this->config->get('sms_smsproccessed_txt');
		}
		if (isset($this->request->post['sms_smsplaced_txt'])) {
			$data['sms_smsplaced_txt'] = $this->request->post['sms_smsplaced_txt'];
		
		} else {
			
			$data['sms_smsplaced_txt'] = $this->config->get('sms_smsplaced_txt');
		}
		
		if (isset($this->request->post['sms_smsnewsignup'])) {
			$data['sms_smsnewsignup'] = $this->request->post['sms_smsnewsignup'];
		
		} else {
			
			$data['sms_smsnewsignup'] = $this->config->get('sms_smsnewsignup');
		}
		
		if (isset($this->request->post['sms_smsnewsignup_txt'])) {
			$data['sms_smsnewsignup_txt'] = $this->request->post['sms_smsnewsignup_txt'];
		
		} else {
			
			$data['sms_smsnewsignup_txt'] = $this->config->get('sms_smsnewsignup_txt');
		}
		
		if (isset($this->request->post['sms_smsneworder'])) {
			$data['sms_smsneworder'] = $this->request->post['sms_smsneworder'];
		
		} else {
			
			$data['sms_smsneworder'] = $this->config->get('sms_smsneworder');
		}
		
		if (isset($this->request->post['sms_smsneworder_txt'])) {
			$data['sms_smsneworder_txt'] = $this->request->post['sms_smsneworder_txt'];
		
		} else {
			
			$data['sms_smsneworder_txt'] = $this->config->get('sms_smsneworder_txt');
		}
		
			
		if (isset($this->request->post['sms_smsnewfish'])) {
			$data['sms_smsnewfish'] = $this->request->post['sms_smsnewfish'];
		
		} else {
			
			$data['sms_smsnewfish'] = $this->config->get('sms_smsnewfish');
		}
		
		if (isset($this->request->post['sms_smsnewfish_txt'])) {
			$data['sms_smsnewfish_txt'] = $this->request->post['sms_smsnewfish_txt'];
		
		} else {
			
			$data['sms_smsnewfish_txt'] = $this->config->get('sms_smsnewfish_txt');
		}
		
		if (isset($this->request->post['sms_smsadminlogin'])) {
			$data['sms_smsadminlogin'] = $this->request->post['sms_smsadminlogin'];
		
		} else {
			
			$data['sms_smsadminlogin'] = $this->config->get('sms_smsadminlogin');
		}
		
		if (isset($this->request->post['sms_smsadminlogin_txt'])) {
			$data['sms_smsadminlogin_txt'] = $this->request->post['sms_smsadminlogin_txt'];
		
		} else {
			
			$data['sms_smsadminlogin_txt'] = $this->config->get('sms_smsadminlogin_txt');
		}
		
		//////////////////////////////////////////////////pay_dasti////////////////////////
		
		if (isset($this->request->post['sms_smspayprice_txt'])) {
			$data['sms_smspayprice_txt'] = $this->request->post['sms_smspayprice_txt'];
		
		} else {
			
			$data['sms_smspayprice_txt'] = $this->config->get('sms_smspayprice_txt');
		}
		
		
		if (isset($this->request->post['sms_smspayprice_admin_txt'])) {
			$data['sms_smspayprice_admin_txt'] = $this->request->post['sms_smspayprice_admin_txt'];
		
		} else {
			
			$data['sms_smspayprice_admin_txt'] = $this->config->get('sms_smspayprice_admin_txt');
		}
		
		
		if (isset($this->request->post['sms_smspayprice'])) {
			$data['sms_smspayprice'] = $this->request->post['sms_smspayprice'];
		
		} else {
			
			$data['sms_smspayprice'] = $this->config->get('sms_smspayprice');
		}
		
		
		if (isset($this->request->post['sms_smspayprice_admin'])) {
			$data['sms_smspayprice_admin'] = $this->request->post['sms_smspayprice_admin'];
		
		} else {
			
			$data['sms_smspayprice_admin'] = $this->config->get('sms_smspayprice_admin');
		}
		
		
		
		
		
		if (isset($this->request->post['sms_shopnum'])) {
			$data['sms_shopnum'] = $this->request->post['sms_shopnum'];
		} else {
			$data['sms_shopnum'] = $this->config->get('sms_shopnum');
		}
		
	 if (isset($this->request->post['sms_status'])) {
			$data['sms_status'] = $this->request->post['sms_status'];
		} else {
			$data['sms_status'] = $this->config->get('sms_status');
		}
     if (isset($this->request->post['sms_samane_sms'])) {
			$data['sms_samane_sms'] = $this->request->post['sms_samane_sms'];
		} else {
			$data['sms_samane_sms'] = $this->config->get('sms_samane_sms');
		}
		$credit=1;
		
			$data['sms_credit'] = $credit;
		
			
		
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
	
		$this->response->setOutput($this->load->view('new/sms_setting.tpl', $data));
       
	}
	
  
    

    
	private function validate() {
		if (!$this->user->hasPermission('modify', 'new/sms_setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	public function testsms(){
	$json = array();
	
	$tel=$this->request->post['teltest'];
	$message=$this->request->post['message'];
		$this->sms = new Sms();
		
		str_replace("&gt;",">",$this->config->get('sms_sample'));
		echo html_entity_decode($this->config->get('sms_sample'));
				$result=$this->sms->send_sms($tel,$message,$this->config->get('sms_api'),$this->config->get('sms_samane_sms'),$this->config->get('sms_from'),$this->config->get('sms_sample'));
	
	$json['alert']=$result;
	$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	

}
?>