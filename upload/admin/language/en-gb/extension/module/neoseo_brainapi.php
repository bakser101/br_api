<?php

// Heading
$_['heading_title'] = '<img width="24" height="24" src="view/image/neoseo.png" style="float: left;"><p style="margin:0;line-height: 24px;">NeoSeo Интеграция по Brain API</p>';
$_['heading_title_raw'] = 'NeoSeo Интеграция по Brain API';

// Tab
$_['tab_general'] = 'Параметры';
$_['tab_category'] = 'Категории';
$_['tab_product'] = 'Товары';
$_['tab_product_image'] = 'Изображения товаров';
$_['tab_logs'] = 'Логи';
$_['tab_support'] = 'Поддержка';
$_['tab_license'] = 'Лицензия';
$_['tab_usefull'] = 'Usefull links';

// Text
$_['text_module_version'] = '';
$_['text_module'] = 'Модули';
$_['text_success'] = 'Настройки модуля обновлены!';
$_['text_success_clear'] = 'Лог файл успешно очищен!';
$_['text_clear_log'] = 'Очистить лог';
$_['text_delete_category'] = 'Удалить категорию';
$_['text_delete_subcategories'] = 'Удалить подкатегории';
$_['text_delete_category_products'] = 'Также товары категории';
$_['text_delete_subcategories_products'] = 'Также товары подкатегорий';
$_['text_remove_category'] = 'Удаление категорий';
$_['text_categories_subcategories'] = 'Категории и подкатегории';

//Buttons
$_['button_save'] = 'Сохранить';
$_['button_save_and_close'] = 'Сохранить и Закрыть';
$_['button_close'] = 'Закрыть';
$_['button_recheck'] = 'Проверить еще раз';
$_['button_clear_log'] = 'Очистить лог';
$_['button_delete_products'] = 'Удалить товары';

// Entry
$_['entry_status'] = 'Статус';
$_['entry_username'] = 'Логин';
$_['entry_password'] = 'Пароль';
$_['entry_root_categories'] = 'Корневые категории';
$_['entry_categories'] = 'Категории';
$_['entry_autocreate_category'] = 'Автоматически создавать недостающие категории';
$_['entry_product_initial_status'] = 'Начальный статус новых товаров';
$_['entry_product_initial_status_desc'] = 'Если нужна дополнительная обработка товаров, то выключите';
$_['entry_product_initial_stock_status'] = 'Начальный статус наличия новых товаров';
$_['entry_product_initial_stock_status_desc'] = 'Укажите статус наличия, который нужно выставлять созданным продуктам';
$_['entry_product_initial_subtract'] = 'Начальное значение Вычитать со склада';
$_['entry_product_add_parent_categories'] = 'Заполнять родительские категории';
$_['entry_product_add_parent_categories_desc'] = 'Если включено, то товару будут назначены все категории от текущей, до корневой. Иначе будет установлена только категория самого нижнего уровня';
$_['entry_product_update_description'] = 'Обновлять описание';
$_['entry_product_update_image'] = 'Обновлять изображения';
$_['entry_product_update_attribute'] = 'Обновлять аттрибуты';
$_['entry_product_update_filter'] = 'Обновлять фильтр';
$_['entry_product_update_filter_desc'] = 'Поддерживаются Neoseo Filter, Ocfilter';
$_['entry_product_update_manufacturer'] = 'Обновлять производителей';
$_['entry_debug'] = 'Отладочный режим:<br /><span class="help">В логи модуля будет писаться различная информация для разработчика модуля.</span>';
$_['entry_sync_link'] = 'Ссылка для запуска обмена';
$_['entry_cron'] = 'Команда для cron';
$_['entry_cron_price'] = 'Команда для cron Только цена и остаток';
$_['entry_cron_product_image'] = 'Команда для cron Только изображения товаров';
$_['entry_cron_cpanel'] = 'Команда для cron в cpanel';
$_['entry_category_main_menu'] = 'Выводить новые категориив главное меню';
$_['entry_category_neoseo_menu'] = 'Выгружать новые категории NeoSeo Меню';
$_['entry_category_neoseo_menu_desc'] = 'Для работы данной функции необходим установленный модуль NeoSeo Меню';
$_['entry_brainapi_stocks'] = 'Выберите склады с которых необходимо брать остаток и наличие';
$_['entry_brainapi_stocks_desc'] = 'Если ничего не выбрать, все доступные остатки будут суммироваться';
$_['entry_product_code'] = 'Поле для внутреннего кода Брейн Product_code ';
$_['entry_product_code_desc'] = 'Куда писать поле Product_code. Варианты - mpn, upc, ean и т.д. Если не хотите записывать, оставьте поле пустым';
$_['entry_stocks_expected'] = 'Считать как "В наличии" товары под заказ';
$_['entry_stocks_expected_desc'] = 'В брейне существуют помимо наличия на складе, так же возможность получения товара на следующий день. Данная опция позволяет оставить положительный остаток товара есть он доступен в ближайшие дни. Данные будут добавлены по складам выбранным из списка складов';

$_['entry_connect_timeout'] = 'Таймаут между обращениями к API';
$_['entry_connect_timeout_desc'] = 'При проявлении ошибок импорта необходимо увеличить на 1-2 секунды.';

$_['entry_lookup_product_image_code'] = 'Синхронизировать изображения товаров по коду товара из поля';
$_['entry_lookup_product_image_code_desc'] = 'ВНИМАНИЕ - это не код товара в брейн, а id товара - внутри системы брейн. Укажите название поля из таблицы product, по которому необходимо выполнить синхронизацию. По умолчанию, если поле не заполнено, sku';
$_['entry_add_product_images'] = 'Добавить изображения, если они отсутствуют у товара';
$_['entry_update_product_images'] = 'Обновлять существующие изображения товара';
$_['entry_update_product_images_desc'] = 'Существующие изображения товара будут заменены';
$_['entry_separate_product_image_folders'] = 'Отдельные каталоги для изображений товаров';
$_['entry_skip_update_isset_product_image'] = 'Пропустить скачивание изображения, если изображение с таким именем есть на сервере';
$_['entry_skip_update_isset_product_image_desc'] = 'Ускоряет обмен. Но, если на сервисе Brain изменится изображение у товара, то модуль его не скачает еще раз. Изображение сохраняются под именем товара на сайте';
$_['entry_name_product_image'] = 'Называть изображения товаров согласно значению';
$_['entry_subdir_product_image'] = 'Название каталога, куда сохранять изображения товаров.';
$_['entry_subdir_product_image_desc'] = 'Укажите название каталога в image/catalog/,в который будут сохранены изображения товаров. Если поле не заполнено, тогда изображения будут сохранены в image/catalog/';
$_['entry_instruction'] = 'Read the module instruction:';
$_['entry_history'] = 'Changes history:';
$_['entry_faq'] = 'Frequency Asked Questions:';


//Params
$_['params_name_product_image'] = array(
	'name' => 'Имени товара',
	'sku' => 'Артикула товара',
	'model' => 'Модели товара',
	'product_id' => 'ID товара',
);

// Error
$_['error_permission'] = 'У Вас нет прав для управления этим модулем!';
$_['error_download_logs'] = 'Файл логов пустой или отсутствует!';
$_['error_status_module'] = 'Необходимо включить модуль для доступа к этой функции модуля!';
$_['error_ioncube_missing'] = '';
$_['error_license_missing'] = '';
$_['mail_support'] = '';
$_['module_licence'] = '';

//links
$_['instruction_link'] = '<a target="_blank" href="https://neoseo.com.ua/en/index.php?route=blog/soforp_article&article_id=361">https://neoseo.com.ua/en/nastroyka-modulya-brain-api</a>';
$_['history_link'] = '<a target="_blank" href="https://neoseo.com.ua/en/index.php?route=product/product&product_id=289#module_history">https://neoseo.com.ua/en/integraciya-s-brain-api-opencart-v-3-0#module_history</a>';
$_['faq_link'] = '<a target="_blank" href="https://neoseo.com.ua/en/index.php?route=product/product&product_id=289#faqBox">https://neoseo.com.ua/en/integraciya-s-brain-api-opencart-v-3-0#faqBox</a>';
$_['text_module_version']='22';
$_['error_license_missing']='<h3 style = "color: red"> Missing file with key! </h3>

<p> To obtain a file with a key, contact NeoSeo by email <a href="mailto:license@neoseo.com.ua"> license@neoseo.com.ua </a>, with the following: </p>

<ul>
	<li> the name of the site where you purchased the module, for example, https://neoseo.com.ua </li>
	<li> the name of the module that you purchased, for example: NeoSeo Sharing with 1C: Enterprise </li>
	<li> your username (nickname) on this site, for example, NeoSeo</li>
	<li> order number on this site, e.g. 355446</li>
	<li> the main domain of the site for which the key file will be activated, for example, https://neoseo.ua</li>
</ul>

<p>Put the resulting key file at the root of the site, that is, next to the robots.txt file and click the "Check again" button.</p>';
$_['error_ioncube_missing']='<h3 style="color: red">No IonCube Loader! </h3>

<p>To use our module, you need to install the IonCube Loader.</p>

<p>For installation please contact your hosting TS</p>

<p>If you can not install IonCube Loader yourself, you can also ask for help from our specialists at <a href="mailto:info@neoseo.com.ua"> info@neoseo.com.ua </a> </p>';
$_['module_licence']='<h2>NeoSeo Software License Terms</h2>
<p>Thank you for purchasing our web studio software.</p>
<p>Below are the legal terms that apply to anyone who visits our site and uses our software products or services. These Terms and Conditions are intended to protect your interests and interests of LLC NEOSEO and its affiliated entities and individuals (hereinafter referred to as "we", "NeoSeo") acting in the agreements on its behalf.</p>
<p><strong>1. Introduction</strong></p>
<p>These Terms of Use of NeoSeo (the "Terms of Use"), along with additional terms that apply to a number of specific services or software products developed and presented on the NeoSeo website (s), contain terms and conditions that apply to each and every one of them. the visitor or user ("User", "You" or "Buyer") of the NeoSeo website, applications, add-ons and components offered by us along with the provision of services and the website, unless otherwise noted (all services and software, software Modules offered through the NeoSeo website or auxiliary servers Isa, web services, etc. Applications on behalf NeoSeo collectively referred to as - "NeoSeo Service" or "Services").</p>
<p>NeoSeo Terms are a binding contract between NeoSeo and you - so please carefully read them.</p>
<p>You may visit and/or use the NeoSeo Services only if you fully agree to the NeoSeo Terms: By using and/or signing up to any of the NeoSeo Services, you express and agree to these Terms of Use and other NeoSeo terms, for example, provide programming services in the context of typical and non-typical tasks that are outlined here: <a href = "https://neoseo.com.ua/vse-chto-nujno-znat-klienty "target ="_blank" class ="external"> https://neoseo.com.ua/vse-chto-nujno-znat-klienty </a>, (hereinafter the NeoSeo Terms).</p>
<p>If you are unable to read or agree to the NeoSeo Terms, you must immediately leave the NeoSeo Website and not use the NeoSeo Services.</p>
<p>By using our Software products, Services, and Services, you acknowledge that you have read our Privacy Policy at <a href = "https://neoseo.com.ua/policy-konfidencialnosti "target ="_blank " class ="external"> https://neoseo.com.ua/politika-konfidencialnosti </a> (" Privacy Policy ")</p>
<p>This document is a license agreement between you and NeoSeo.</p>
<p>By agreeing to this agreement or using the software, you agree to all these terms.</p>
<p>This agreement applies to the NeoSeo software, any fonts, icons, images or sound files provided as part of the software, as well as to all NeoSeo software updates, add-ons or services, if not applicable to them. miscellaneous. This also applies to NeoSeo apps and add-ons for the SEO-Store, which extend its functionality.</p>
<p>Prior to your use of some of the application features, additional NeoSeo and third party terms may apply. For the correct operation of some applications, additional agreements are required with separate terms and conditions of privacy, for example, with services that provide SMS-notification services.</p>
<p>Software is not sold, but licensed.</p>
<p>NeoSeo retains all rights (for example, the rights provided by intellectual property laws) that are not explicitly granted under this agreement. For example, this license does not entitle you to:</p>
<li> <span> </span> <span> </span> separately use or virtualize software components; </li>
<li> publish or duplicate (with the exception of a permitted backup) software, provide software for rental, lease or temporary use; </li>
<li> transfer the software (except as provided in this agreement); </li>
<li> Try to circumvent the technical limitations of the software; </li>
<li> study technology, decompile or disassemble the software, and make appropriate attempts, other than those to the extent and in cases where (a) it provides for the right; (b) authorized by the terms of the license to use the components of the open source code that may be part of this software; (c) necessary to make changes to any libraries licensed under the small GNU General Public License, which are part of the software and related; </li>
<p> You have the right to use this software only if you have the appropriate license and the software was properly activated using the genuine product key or in another permissible manner.
</p>
<p> The cost of the SEO-Shop license does not include installation services, settings, and more of its stylization, as well as other paid/free add-ons. These services are optional, the cost depends on the number of hours required for the implementation of the hours, here: <a href = "https://neoseo. com.ua/vse-chto-nujno-znat-klienty "target =" _ blank "class =" external "> https://neoseo.com.ua/vse-chto-nujno-znat-klienty </a>
</p>
<p> The complete version of the document can be found here:
</p>
<p> <a href="https://neoseo.com.ua/usloviya-licenzionnogo-soglasheniya" target="_blank" class="external"> https://neoseo.com.ua/usloviya-licenzionnogo-soglasheniya </a>
</p>';
$_['mail_support']='<p> We are always happy to help, </p>
<p> Customer Support Department, web studio NeoSeo. </p>
<p> We remind you that NeoSeo web studio offers informational support for free on the forum <a href="https://opencartmasters.com/"> OpenCartMasters.com </a>
    (usually answers are provided within 24 hours during a working day). </p>
<p>
    If you have an urgent issue and need to be resolved already, please order paid support, which is provided on the same day using Skype and TeamViewer.
</p>
<p>
    For general questions, write to the telegram chat <a href="https://t.me/WebStudioNeoSeo1"> https://t.me/WebStudioNeoSeo1 </a>
</p>
<p>
    Have a nice day and great mood :) <br>
    NeoSeo team. </p>';
