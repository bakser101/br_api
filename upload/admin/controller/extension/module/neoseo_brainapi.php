<?php /* --== O_o ==-- */

require_once( DIR_SYSTEM . '/engine/neoseo_controller.php');
require_once( DIR_SYSTEM . '/engine/neoseo_view.php' );

class ControllerExtensionModuleNeoseoBrainApi extends NeoseoController
{

	private $error = array();

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_brainapi";
		/* Remove _module_code */
		$this->_modulePostfix = ""; // Постфикс для разных типов модуля, поэтому переходим на испольлзование $this->_moduleSysName()
		$this->_logFile = $this->_moduleSysName() . ".log";

		$this->debug = $this->config->get($this->_moduleSysName() . "_debug") == 1;
	}

	public function index()
	{
		$this->upgrade();

		$this->load->model('tool/' . $this->_moduleSysName());

		$this->document->addStyle('view/javascript/bootstrap3-editable/css/bootstrap-editable.css');
		$this->document->addScript('view/javascript/bootstrap3-editable/js/bootstrap-editable.js');

		$data = $this->load->language('extension/' . $this->_route . '/' . $this->_moduleSysName());

		$this->document->setTitle($this->language->get('heading_title_raw'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$post_data = $this->request->post;
			if (isset($post_data[$this->_moduleSysName() . '_categories'])) {
				$this->{'model_tool_' . $this->_moduleSysName()}->updateCategoryLinks($post_data[$this->_moduleSysName() . '_categories']);
				unset($post_data[$this->_moduleSysName() . '_categories']);
			}

			$this->model_setting_setting->editSetting($this->_moduleSysName(), $post_data);

			if (isset($this->request->post['remove_categories']) && !empty($this->request->post['remove_categories'])) {
				$this->{'model_tool_' . $this->_moduleSysName()}->deleteCategories($this->request->post['remove_categories']);
			}

			//Это нужно чтобы при нажатии кнопки "сохранить и закрыть" был правильный статус
			$this->model_extension_module_neoseo_brainapi->setModuleStatus($this->request->post[$this->_moduleSysName() . "_status"]);

			$this->session->data['success'] = $this->language->get('text_success');

			if ($this->request->post['action'] == "save") {
				$this->response->redirect($this->url->link('extension/' . $this->_route . '/' . $this->_moduleSysName(), 'user_token=' . $this->session->data['user_token'], true));
			} else {
				$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'], true));
			}
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}

		$data = $this->initBreadcrumbs(array(
			array('marketplace/extension', 'text_module'),
			array('extension/' . $this->_route . '/' . $this->_moduleSysName(), "heading_title_raw")
				), $data);

		$data = $this->initButtons($data);

		$this->load->model("extension/" . $this->_route . "/" . $this->_moduleSysName());
		$data = $this->initParamsListEx($this->{"model_extension_" . $this->_route . "_" . $this->_moduleSysName()}->getParams(), $data);

		$data[$this->_moduleSysName() . "_cron"] = "php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		$data[$this->_moduleSysName() . "_cron_price"] = "php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php") . " priceOnly";
		$data[$this->_moduleSysName() . "_cron_product_image"] = "php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php") . " syncProductImages";
		if (PHP_VERSION_ID < 50300) {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php52/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		} else if (PHP_VERSION_ID < 50400) {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php53/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		} else if (PHP_VERSION_ID < 50500) {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php54/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		} else if (PHP_VERSION_ID < 50600) {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php55/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		} else if (PHP_VERSION_ID < 50700) {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php56/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		} else if (PHP_VERSION_ID < 70100) {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php70/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		} else if (PHP_VERSION_ID < 70200) {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php71/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		} else {
			$data[$this->_moduleSysName() . "_cron_cpanel"] = "/opt/cpanel/ea-php72/root/usr/bin/php " . realpath(DIR_SYSTEM . "../cron/" . $this->_moduleSysName() . ".php");
		}

		$data[$this->_moduleSysName() . "_sync_link"] = ((!empty($this->request->server['HTTPS']) ? 'https://' : 'http://') . $this->request->server['SERVER_NAME'] . '/') . "cron/" . $this->_moduleSysName() . ".php";

		$data[$this->_moduleSysName() . '_categories'] = $this->{'model_tool_' . $this->_moduleSysName()}->getCategoryLinks();
		$data['delete_products'] = $this->url->link('tool/' . $this->_moduleSysName() . '/delete_products', 'user_token=' . $this->session->data['user_token'], 'SSL');
		$filter_data = array(
			'sort' => 'name',
			'order' => 'ASC'
		);

		$this->load->model('catalog/category');
		$categories = array();
		foreach ($this->model_catalog_category->getCategories($filter_data) as $category) {
			$categories[$category['category_id']] = $category['name'];
		}

		$neoseo_menu = array();
		$neoseo_menu[0] = $this->language->get('text_disabled');
		if ($this->config->get('neoseo_menu_status')) {
			$this->load->model('tool/neoseo_menu');
			$neoseo_menu_raw = $this->model_tool_neoseo_menu->getMenus();
			if (count($neoseo_menu_raw)) {
				$neoseo_menu[0] = $this->language->get('text_disabled');
				foreach ($neoseo_menu_raw as $item) {
					$neoseo_menu[$item['menu_id']] = $item['title'];
				}
			}
		}
		$data['neoseo_menu'] = $neoseo_menu;

		$data['categories'] = $categories;

		$this->load->model('localisation/stock_status');

		$stock_statuses = $this->model_localisation_stock_status->getStockStatuses();

		$data['stock_statuses'] = array();

		foreach ($stock_statuses as $stock_status) {
			$data['stock_statuses'][$stock_status['stock_status_id']] = $stock_status['name'];
		}

		$data['brainapi_categories'] = $this->{'model_tool_' . $this->_moduleSysName()}->getCategories();
		$brainapi_categories = $data['brainapi_categories'];

		$data['brainapi_stocks'] = $this->{'model_tool_' . $this->_moduleSysName()}->getStocks();


		/* Формирует список брейн категорий */
		$neoseo_brainapi_categories_load = $this->config->get($this->_moduleSysName() . "_categories_load");
		if (!$neoseo_brainapi_categories_load) {
			$neoseo_brainapi_categories_load = array();
		}

		$neoseo_brainapi_categories = $this->{'model_tool_' . $this->_moduleSysName()}->getCategoryLinks();
		if (!$neoseo_brainapi_categories) {
			$neoseo_brainapi_categories = array();
		}

		$categories_table = '';
		$root_load = array();
		if ($brainapi_categories) {
			foreach ($brainapi_categories as $brain_category_id => $brainapi_category) {
				$root = $brainapi_category['parent'];
				while ($root > 0) {
					$parent_category_id = $root;
					if ($brainapi_categories[$parent_category_id]['parent'] == 0) {
						break;
					}
					$root = $brainapi_categories[$parent_category_id]['parent'];
				}

				$is_root = ($root == 0);
				$is_load = in_array($brain_category_id, $neoseo_brainapi_categories_load);
				if ($is_root) {
					$root_load[$brain_category_id] = $is_load;
				}
				$category_id = 0;
				if (isset($neoseo_brainapi_categories[$brain_category_id]) &&
						isset($categories[$neoseo_brainapi_categories[$brain_category_id]])
				) {
					$category_id = $neoseo_brainapi_categories[$brain_category_id];
				}

				$categories_table .= '<tr ';
				if (!$is_root) {
					$categories_table .= ' class="category-' . $root . '"';
				}
				if (!$is_root && !$root_load[$root]) {
					$categories_table .= 'style="display:none"';
				}
				$categories_table .= ' >';
				$categories_table .= '<td>';

				$categories_table .= '<input type="checkbox" ';
				if ($is_load) {
					$categories_table .= ' checked ';
				}
				$categories_table .= ' name="neoseo_brainapi_categories_load[]"';
				$categories_table .= ' value="' . $brain_category_id . '" class="toggle" 
							   data-toggle="' . $brain_category_id . '" >';

				if (!$is_root) {
					$categories_table .= '</td>
					<td style="padding-left: 20px;" >';
				}else{
					$categories_table .= '</td>
					<td>';
				}
				$categories_table .= $brainapi_category['name'];
				$categories_table .= '</td>
				<td>';
				if ($category_id) {
					$categories_table .= '<input type="hidden" 
							   name="neoseo_brainapi_categories[' . $brain_category_id . ']"
							   id="category-' . $brain_category_id . '"
							   value="' . $category_id . '">';
					$categories_table .= '<a href="#" class="category-selector" data-type="select"
						   data-value="' . $category_id . '"
						   data-target="category-' . $brain_category_id . '">' . $categories[$category_id] . '</a>';
				} else {
					$categories_table .= '<input type="hidden" disabled="disabled"
							   name="neoseo_brainapi_categories[' . $brain_category_id . ']"
							   id="category-' . $brain_category_id . '">
						<a href="#" class="category-selector" data-type="select" data-value="0"
						   data-target="category-' . $brain_category_id . '">Автоматическое
							соответствие</a>';
				}
				$categories_table .= '</td>
			</tr>';
			}
		}
		$data['categories_table'] = $categories_table;
		/* Формирует список брейн категорий Конец */

		$categories = $this->model_catalog_category->getAllCategoriesBrain();
		$data['doomed_categories'] = $this->getAllCategories($categories);

		$data['module_status'] = $this->config->get($this->_moduleSysName() . '_status');

		$data["user_token"] = $this->session->data['user_token'];
		$data['config_language_id'] = $this->config->get('config_language_id');
		$data['params'] = $data;
		$data["logs"] = $this->getLogs();

$data['old_module'] = true; 		$widgets = new NeoSeoWidgets($this->_moduleSysName() . '_', $data);
		$widgets->text_select_all = $this->language->get('text_select_all');
		$widgets->text_unselect_all = $this->language->get('text_unselect_all');
		$data['widgets'] = $widgets;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');


		$this->response->setOutput($this->load->view('extension/' . $this->_route . '/' . $this->_moduleSysName(), $data));
	}

	public function unbind_category($category_id)
	{
		$this->load->model('module/' . $this->_moduleSysName());
		$this->{'model_module_' . $this->_moduleSysName()}->unbindCategory($category_id);
	}

	public function unbind_product($product_id)
	{
		$this->load->model('module/' . $this->_moduleSysName());
		$this->{'model_module_' . $this->_moduleSysName()}->unbindProduct($product_id);
	}

	public function unbind_manufacturer($manufacturer_id)
	{
		$this->load->model('module/' . $this->_moduleSysName());
		$this->{'model_module_' . $this->_moduleSysName()}->unbindManufacturer($manufacturer_id);
	}

	protected function validate()
	{
		if (!$this->user->hasPermission('modify', 'extension/' . $this->_route . '/' . $this->_moduleSysName())) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function sortByName($a, $b)
	{
		return strcmp($a['name'], $b['name']);
	}

	private function getAllCategories($categories, $parent_id = 0, $parent_name = '')
	{
		$output = array();

		if (array_key_exists($parent_id, $categories)) {
			if ($parent_name != '') {
				$parent_name .= ' &gt; ';
			}

			foreach ($categories[$parent_id] as $category) {
				$output[$category['category_id']] = array(
					'category_id' => $category['category_id'],
					'name' => $parent_name . $category['name']
				);

				$output += $this->getAllCategories($categories, $category['category_id'], $parent_name . $category['name']);
			}
		}

		uasort($output, array($this, 'sortByName'));

		return $output;
	}

}
