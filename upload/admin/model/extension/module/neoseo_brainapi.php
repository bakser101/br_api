<?php /* --== O_o ==-- */

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelExtensionModuleNeoseoBrainApi extends NeoseoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_brainapi";
		/* Remove _module_code */
		$this->_modulePostfix = ""; // Постфикс для разных типов модуля, поэтому переходим на испольлзование $this->_moduleSysName()()
		$this->_logFile = $this->_moduleSysName() . '.log';
		$this->debug = $this->config->get($this->_moduleSysName() . '_debug') == 1;

		/* ZzZzzz... */

		$this->params = array(
			'status' => 1,
			'module_key' => '',
			'debug' => 0,
			'username' => "",
			'password' => "",
			'root_categories' => array(),
			'categories' => array(),
			'categories_load' => array(),
			'category_main_menu' => 0,
			'brainapi_stocks' => array(),
			'product_code' => 'upc',
			'category_main_menu' => 0,
			'category_neoseo_menu' => 0,
			'stocks_expected' => 0,
			'autocreate_category' => 1,
			'product_initial_status' => 1,
			'product_initial_stock_status' => 5,
			'product_initial_subtract' => 0,
			'product_add_parent_categories' => 0,
			'product_update_description' => 1,
			'product_update_image' => 1,
			'product_update_attribute' => 1,
			'product_update_filter' => 1,
			'product_update_manufacturer' => 1,
			'connect_timeout' => 5,
			'lookup_product_image_code' => 'sku',
			'add_product_images' => 0,
			'update_product_images' => 0,
			'separate_product_image_folders' => 0,
			'skip_update_isset_product_image' => 1,
			'name_product_image' => 'name',
			'subdir_product_image' => 'product',
		);

		$this->options_levels = array(
			'module_key' => 0,
			'status' => 0,
			'debug' => 0,
			'username' => 1,
			'password' => 1,
			'root_categories' => 1,
			'categories' => 1,
			'categories_load' => 1,
			'category_main_menu' => 1,
			'brainapi_stocks' => 1,
			'product_code' => 1,
			'category_neoseo_menu' => 1,
			'stocks_expected' => 1,
			'autocreate_category' => 1,
			'product_initial_status' => 1,
			'product_initial_stock_status' => 1,
			'product_initial_subtract' => 1,
			'product_add_parent_categories' => 1,
			'product_update_description' => 1,
			'product_update_image' => 1,
			'product_update_attribute' => 1,
			'product_update_filter' => 1,
			'product_update_manufacturer' => 1,
			'connect_timeout' => 1,
			'lookup_product_image_code' => 1,
			'add_product_images' => 1,
			'update_product_images' => 1,
			'separate_product_image_folders' => 1,
			'skip_update_isset_product_image' => 1,
			'name_product_image' => 1,
			'subdir_product_image' => 1,
			'cron' => 1,
			'cron_price' => 1,
			'cron_product_image' => 1,
			'cron_cpanel' => 1,
		);
	}

	// Install/Uninstall
	public function install()
	{
		if (! true /* RePlaced */) {
			return "";
		}

		// Значения параметров по умолчанию
		$this->initParams($this->params);

		// Создаем новые и недостающие таблицы в актуальной структуре
		$this->installTables();

		// Добавляем права на нестандартные контроллеры, если они используются
		$this->addPermission($this->user->getGroupId(), 'access', 'tool/' . $this->_moduleSysName());
		$this->addPermission($this->user->getGroupId(), 'modify', 'tool/' . $this->_moduleSysName());

		// Добавляем обработчики событий, если они у нас есть
		$this->load->model('setting/event');
		$this->model_setting_event->addEvent($this->_moduleSysName(), 'post.admin.category.delete', 'module/neoseo_brainapi/unbind_category');
		$this->model_setting_event->addEvent($this->_moduleSysName(), 'post.admin.product.delete', 'module/neoseo_brainapi/unbind_product');
		$this->model_setting_event->addEvent($this->_moduleSysName(), 'post.admin.manufacturer.delete', 'module/neoseo_brainapi/unbind_manufacturer');

		return TRUE;
	}

	public function uninstall()
	{
		if (! true /* RePlaced */) {
			return "";
		}

		//Уадаляем параметры из сеттингов
		$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = '" . $this->_moduleSysName() . "'");

		$this->db->query("DROP TABLE " . DB_PREFIX . "category_to_brain_category");
		$this->db->query("DROP TABLE " . DB_PREFIX . "product_to_brain_product");
		$this->db->query("DROP TABLE " . DB_PREFIX . "ocfilter_to_brain_filter");
		$this->db->query("DROP TABLE " . DB_PREFIX . "manufacturer_to_brain_vendor");

		$this->load->model('setting/event');
		$this->model_setting_event->deleteEvent($this->_moduleSysName());

		return TRUE;
	}

	public function upgrade()
	{
		if (! true /* RePlaced */) {
			return "";
		}

		// Добавляем недостающие новые параметры
		$this->initParams($this->params);

		// Создаем недостающие таблицы в актуальной структуре
		$this->installTables();

		return TRUE;
	}

	public function unbindCategory($category_id)
	{
		if (! true /* RePlaced */) {
			return "";
		}
		$sql = "DELETE FROM " . DB_PREFIX . "category_to_brain_category WHERE category_id = '" . (int) $category_id . "'";
		$this->db->query($sql);
	}

	public function unbindProduct($product_id)
	{
		if (! true /* RePlaced */) {
			return "";
		}

		$sql = "DELETE FROM " . DB_PREFIX . "product_to_brain_product WHERE product_id = '" . (int) $product_id . "'";
		$this->db->query($sql);
	}

	public function unbindFilter($filter_id)
	{
		if (! true /* RePlaced */) {
			return "";
		}

		$sql = "DELETE FROM " . DB_PREFIX . "filter_to_brain_filter WHERE filter_id = '" . (int) $filter_id . "'";
		$this->db->query($sql);
	}

	public function unbindManufacturer($manufacturer_id)
	{
		if (! true /* RePlaced */) {
			return "";
		}

		$sql = "DELETE FROM " . DB_PREFIX . "manufacturer_to_brain_vendor WHERE manufacturer_id = '" . (int) $manufacturer_id . "'";
		$this->db->query($sql);
	}

	public function installTables()
	{
		if (! true /* RePlaced */) {
			return "";
		}

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "category_to_brain_category` (
			`category_id` int(11) NOT NULL,
			`brain_category_id` int(11) NOT NULL,
			PRIMARY KEY (`category_id`,`brain_category_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_to_brain_product` (
			`product_id` int(11) NOT NULL,
			`brain_product_id` int(11) NOT NULL,
			`warranty` int(4) NOT NULL,
			`last_available` date NOT NULL,
			PRIMARY KEY (`product_id`,`brain_product_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "ocfilter_to_brain_filter` (
			`filter_id` int(11) NOT NULL,
			`brain_filter_id` varchar(255) NOT NULL,
			PRIMARY KEY (`filter_id`,`brain_filter_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "manufacturer_to_brain_vendor` (
			`manufacturer_id` int(11) NOT NULL,
			`brain_vendor_id` int(11) NOT NULL,
			PRIMARY KEY (`manufacturer_id`,`brain_vendor_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
	}

	private function addAccessLevels()
	{
		/* Remove set Access Levels */
	}

}
