<?php
class ControllerNewSmsSend extends Controller { 
private $error = array();
	public function index() {  
		$this->load->language('new/sms_send');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('customer/customer');

				$this->load->model('customer/customer_group');

				$this->load->model('marketing/affiliate');

				$this->load->model('sale/order');
		
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			}
						
		
   			$data['breadcrumbs'] = array();

   			$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => false
   		);

   			$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('new/sms_send', 'token=' . $this->session->data['token'] , 'SSL'),
      		'separator' => ' :: '
   		);
		
	
			$data['heading_title'] = $this->language->get('heading_title');
			$data['text_form'] = !isset($this->request->get['customer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			$data['button_save'] = $this->language->get('button_save');
			$data['button_cancel'] = $this->language->get('button_cancel');

			$data['tab_setting'] = $this->language->get('tab_general');
			$data['tab_send'] = $this->language->get('tab_send');
			$data['tab_inbox'] = $this->language->get('tab_inbox');
			$data['tab_resid'] = $this->language->get('tab_resid');
			$data['text_default'] = $this->language->get('text_default');
			$data['text_newsletter'] = $this->language->get('text_newsletter');
			$data['text_customer_all'] = $this->language->get('text_customer_all');	
			$data['text_customer'] = $this->language->get('text_customer');	
			$data['text_customer_group'] = $this->language->get('text_customer_group');
			$data['text_affiliate_all'] = $this->language->get('text_affiliate_all');	
			$data['text_affiliate'] = $this->language->get('text_affiliate');	
			$data['text_product'] = $this->language->get('text_product');	
	$data['text_loading'] = $this->language->get('text_loading');
	
			$data['entry_store'] = $this->language->get('entry_store');
			$data['entry_to'] = $this->language->get('entry_to');
			$data['entry_customer_group'] = $this->language->get('entry_customer_group');
			$data['entry_customer'] = $this->language->get('entry_customer');
			$data['entry_affiliate'] = $this->language->get('entry_affiliate');
			$data['entry_product'] = $this->language->get('entry_product');
			$data['entry_subject'] = $this->language->get('entry_subject');
			$data['entry_message'] = $this->language->get('entry_message');
		$data['button_send'] = $this->language->get('button_send');
			$data['button_cancel'] = $this->language->get('button_cancel');
		
		
		
		
			$data['token'] = $this->session->data['token'];
			
 		if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
		} else {
				$data['error_warning'] = '';
		}
		
 	
	 	
		if (isset($this->error['message'])) {
				$data['error_message'] = $this->error['message'];
		} else {
				$data['error_message'] = '';
		}if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
				$data['success'] = '';
		}
		
		
				if (isset($this->request->post['store_id'])) {
				$data['store_id'] = $this->request->post['store_id'];
		} else {
				$data['store_id'] = '';
		}
		
		$this->load->model('setting/store');
		
			$data['stores'] = $this->model_setting_store->getStores();
		
		if (isset($this->request->post['to'])) {
				$data['to'] = $this->request->post['to'];
		} else {
				$data['to'] = '';
		}
				
		if (isset($this->request->post['customer_group_id'])) {
				$data['customer_group_id'] = $this->request->post['customer_group_id'];
		} else {
				$data['customer_group_id'] = '';
		}
				
			$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups(0);
				
			$data['customers'] = array();
		
		if (isset($this->request->post['customer'])) {					
			foreach ($this->request->post['customer'] as $customer_id) {
				$customer_info = $this->model_customer_customer->getCustomer($customer_id);
					
				if ($customer_info) {
						$data['customers'][] = array(
						'customer_id' => $customer_info['customer_id'],
						'name'        => $customer_info['firstname'] . ' ' . $customer_info['lastname'].' '.$customer_info['telephone'] 
					);
				}
			}
		}

			$data['affiliates'] = array();
		
		if (isset($this->request->post['affiliate'])) {					
			foreach ($this->request->post['affiliate'] as $affiliate_id) {
				$affiliate_info = $this->model_sale_affiliate->getAffiliate($affiliate_id);
					
				if ($affiliate_info) {
						$data['affiliates'][] = array(
						'affiliate_id' => $affiliate_info['affiliate_id'],
						'name'         => $affiliate_info['firstname'] . ' ' . $affiliate_info['lastname'] .' ' .$affiliate_info['telephone'] 
					);
				}
			}
		}
		
		$this->load->model('catalog/product');

			$data['products'] = array();
		
		if (isset($this->request->post['product'])) {					
			foreach ($this->request->post['product'] as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);
					
				if ($product_info) {
						$data['products'][] = array(
						'product_id' => $product_info['product_id'],
						'name'       => $product_info['name']
					);
				}
			}
		}
			
		
			$data['action'] = $this->url->link('new/sms_send', 'token=' . $this->session->data['token'], 'SSL');
		
			$data['cancel'] = $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL');
	
		     	if (isset($this->request->post['config_sms_send_to'])) {
				$data['config_sms_send_to'] = $this->request->post['config_sms_send_to'];
		} else {
				$data['config_sms_send_to'] = "";
		}
		     	if (isset($this->request->post['config_sms_send_message'])) {
				$data['config_sms_send_message'] = $this->request->post['config_sms_send_message'];
		} else {
				$data['config_sms_send_message'] = "";
		}

    	if (isset($this->request->post['config_sms_reply_msg'])) {
				$data['config_sms_send_message'] = $this->request->post['config_sms_reply_msg'];
		} else {
				$data['config_sms_reply_msg'] = "";
		}

    	if (isset($this->request->post['config_sms_send_to_group'])) {
				$data['config_sms_send_to_group'] = $this->request->post['config_sms_send_to_group'];
		} else {
				$data['config_sms_send_to_group'] = "";
		}

    	if (isset($this->request->post['config_sms_send_message'])) {
				$data['config_sms_send_message'] = $this->request->post['config_sms_send_message'];
		} else {
				$data['config_sms_send_message'] = "";
		}
		
		
			$this->load->model('catalog/product');

			$data['products'] = array();
		
		if (isset($this->request->post['product'])) {					
			foreach ($this->request->post['product'] as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);
					
				if ($product_info) {
						$data['products'][] = array(
						'product_id' => $product_info['product_id'],
						'name'       => $product_info['name']
					);
				}
			}
		}
			if (isset($this->request->post['message'])) {
				$data['message'] = $this->request->post['message'];
		} else {
				$data['message'] = '';
		}	 
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('new/sms_send.tpl', $data));
	}
		private function validate() {
		if (!$this->user->hasPermission('modify', 'new/sms_send')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
				
	

		if (!$this->request->post['message']) {
			$this->error['message'] = $this->language->get('error_message');
		}
						
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	public function send(){
	$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!$this->user->hasPermission('modify', 'marketing/contact')) {
				$json['error']['warning'] = $this->language->get('error_permission');
			}

			

			if (!$this->request->post['message']) {
				$json['error']['message'] = $this->language->get('error_message');
			}

			if (!$json) {
		$this->load->model('setting/store');
		
			$store_info = $this->model_setting_store->getStore($this->request->post['store_id']);			
			
			if ($store_info) {
				$store_name = $store_info['name'];
			} else {
				$store_name = $this->config->get('config_name');
			}
	$telephones = array();
			if (isset($this->request->get['page'])) {
					$page = $this->request->get['page'];
				} else {
					$page = 1;
				}
				$this->load->model('customer/customer');

				$this->load->model('customer/customer_group');

				$this->load->model('marketing/affiliate');

				$this->load->model('sale/order');
			switch ($this->request->post['to']) {
					case 'newsletter':
						$customer_data = array(
							'filter_newsletter' => 1,
							'start'             => ($page - 1) * 10,
							'limit'             => 10
						);

						$telephone_total = $this->model_customer_customer->getTotalCustomers($customer_data);

						$results = $this->model_customer_customer->getCustomers($customer_data);

						foreach ($results as $result) {
							$telephones[] = $result['telephone'];
						}
						break;
					case 'customer_all':
						$customer_data = array(
							'start'  => ($page - 1) * 10,
							'limit'  => 10
						);

						$telephone_total = $this->model_customer_customer->getTotalCustomers($customer_data);

						$results = $this->model_customer_customer->getCustomers($customer_data);

						foreach ($results as $result) {
							$telephones[] = $result['telephone'];
						}
						break;
					case 'customer_group':
						$customer_data = array(
							'filter_customer_group_id' => $this->request->post['customer_group_id'],
							'start'                    => ($page - 1) * 10,
							'limit'                    => 10
						);

						$telephone_total = $this->model_customer_customer->getTotalCustomers($customer_data);

						$results = $this->model_customer_customer->getCustomers($customer_data);

						foreach ($results as $result) {
							$telephones[$result['customer_id']] = $result['telephone'];
						}
						break;
					case 'customer':
						if (!empty($this->request->post['customer'])) {
							foreach ($this->request->post['customer'] as $customer_id) {
								$customer_info = $this->model_customer_customer->getCustomer($customer_id);

								if ($customer_info) {
									$telephones[] = $customer_info['telephone'];
								}
							}
						}
						break;
					case 'affiliate_all':
						$affiliate_data = array(
							'start'  => ($page - 1) * 10,
							'limit'  => 10
						);

						$telephone_total = $this->model_marketing_affiliate->getTotalAffiliates($affiliate_data);

						$results = $this->model_marketing_affiliate->getAffiliates($affiliate_data);

						foreach ($results as $result) {
							$telephones[] = $result['telephone'];
						}
						break;
					case 'affiliate':
						if (!empty($this->request->post['affiliate'])) {
							foreach ($this->request->post['affiliate'] as $affiliate_id) {
								$affiliate_info = $this->model_marketing_affiliate->getAffiliate($affiliate_id);

								if ($affiliate_info) {
									$telephones[] = $affiliate_info['telephone'];
								}
							}
						}
						break;
					case 'product':
						if (isset($this->request->post['product'])) {
							$telephone_total = $this->model_sale_order->getTotalTelsByProductsOrdered($this->request->post['product']);

							$results = $this->model_sale_order->getTelsByProductsOrdered($this->request->post['product'], ($page - 1) * 10, 10);

							foreach ($results as $result) {
								$telephones[] = $result['telephone'];
							}
						}
						break;
				}
			$telephones = array_unique($telephones);
				if ($telephones) {
				
				$message =$this->request->post['message'];
					foreach ($telephones as $telephones) {
					 $this->config->get('config_sms_user');
						$this->sms = new Sms();
					$this->sms->send_sms($telephones,$message,$this->config->get('sms_api'),$this->config->get('sms_samane_sms'),$this->config->get('sms_from'),$this->config->get('sms_sample'));
					
				}
				}
				$json['success'] = $this->language->get('text_success');
			$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
			
		
	}	
	}
	}
	public function inbox(){
	}
	public function setting(){
	}
	
}
?>