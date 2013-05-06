<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

class Tool extends Taobao_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function cost_calculator()
	{
		$this->_cost_calculator_post();
	}
	
	public function _cost_calculator_post()
	{
		$this->_set_title('Cost Calculator');
		include (DILICMS_SHARE_PATH . 'settings/taobao/country.php');
		$data['country'] = $geo_country;
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="colorA10">', '</span>');
		$this->form_validation->set_rules('fee', 'Puchase Fee', 'trim|required|numeric');
		$this->form_validation->set_rules('weight', 'Package Weight', 'trim|required|numeric');
		$this->form_validation->set_rules('country', 'Country', 'trim|required');
		$this->form_validation->set_rules('express', 'Express', 'trim|required');
		$data['error'] = '';
		if ($this->form_validation->run() == FALSE)
		{
			//do nothing 
		}
		else
		{
			$data['form_ok'] = true;
			$fee = $this->input->post('fee', TRUE);
			$weight = $this->input->post('weight', TRUE);
			$country = $this->input->post('country', TRUE);
			$express = $this->input->post('express', TRUE);
			//获取所选择国家和物流公司对应的快递信息
			$this->load->model('taobao/taobao_express_mdl');
			$express_data = $this->taobao_express_mdl->get_express($country, $express);
			if ( ! $express_data OR ($express_data['fee'] == 0 AND $express_data['extra'] == 0))
			{
				$data['error'] = 'This express vendor you selected is out of service or can’t reach, please try another!';
			}
			else
			{
				//如果超重则拆分重量
				$data['overweight'] = ($weight > $express_data['max'] ? 1 : 0);
				$data['detail'] = array();
				$data['detail_money'] = 0;
				if ($data['overweight'])
				{
					$_cut_num = floor($weight / $express_data['max']);
					for ($i = 1; $i <= $_cut_num; $i++)
					{
						$data['detail'][] = $express_data['max'];
						$data['detail_money'] += express_calculator($express_data['max'], $express_data);
					}
					if ($weight > $express_data['max'] * $_cut_num)
					{
						$_w = ($weight - $express_data['max'] * $_cut_num);
						$data['detail'][] = $_w;
						$data['detail_money'] += express_calculator($_w, $express_data);
					}
				}
				else
				{
					$data['detail_money'] = express_calculator($weight, $express_data);	
				}
				$data['express_data'] = $express_data;	
				$data['fee'] = $fee;
				$data['weight'] = $weight;
			}
		}
		$this->_template('tools/express', $data);	
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */