<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ООО Альфа Синтез");
?>

	<div id="main-slider">
		<?// Top элементов каталога
		$APPLICATION->IncludeComponent(
				"bitrix:catalog.top",
				"slider",                       // [.default, slider]
				array(
					// region Основные параметры
						"IBLOCK_TYPE"                 =>  "catalog",                      // Тип инфоблока : array ( 'catalog' => '[catalog] Каталоги', 'news' => '[news] Новости', 'offers' => '[offers] Торговые предложения', 'services' => '[services] Сервисы', 'references' => '[references] Справочники', )
						"IBLOCK_ID"                   =>  "2",                      // Инфоблок : array ( 1 => '[1] Новости', 2 => '[2] Одежда', 3 => '[3] Одежда (предложения)', )
					// endregion
					// region Источник данных
						"ELEMENT_SORT_FIELD"          =>  "sort",                  // По какому полю сортируем элементы : array ( 'shows' => 'количество просмотров в среднем', 'sort' => 'индекс сортировки', 'timestamp_x' => 'дата изменения', 'name' => 'название', 'id' => 'ID', 'active_from' => 'дата активности (с)', 'active_to' => 'дата активности (по)', 'CATALOG_AVAILABLE' => 'доступность на складах', )
						"ELEMENT_SORT_ORDER"          =>  "asc",                   // Порядок сортировки элементов : array ( 'asc' => 'по возрастанию', 'desc' => 'по убыванию', )
						"ELEMENT_SORT_FIELD2"         =>  "id",                    // Поле для второй сортировки элементов : array ( 'shows' => 'количество просмотров в среднем', 'sort' => 'индекс сортировки', 'timestamp_x' => 'дата изменения', 'name' => 'название', 'id' => 'ID', 'active_from' => 'дата активности (с)', 'active_to' => 'дата активности (по)', 'CATALOG_AVAILABLE' => 'доступность на складах', )
						"ELEMENT_SORT_ORDER2"         =>  "desc",                  // Порядок второй сортировки элементов : array ( 'asc' => 'по возрастанию', 'desc' => 'по убыванию', )
						"FILTER_NAME"                 =>  "",                      // Имя массива со значениями фильтра для фильтрации элементов
						"HIDE_NOT_AVAILABLE"          =>  "N",                     // Не отображать товары, которых нет на складах
					// endregion
					// region Внешний вид
						"ELEMENT_COUNT"               =>  "9",                     // Количество выводимых элементов
						"LINE_ELEMENT_COUNT"          =>  "3",                     // Количество элементов выводимых в одной строке таблицы
						"PROPERTY_CODE"               =>  array(''),               // Свойства
						"OFFERS_LIMIT"                =>  "5",                     // Максимальное количество предложений для показа (0 - все)
					// endregion
					// region Шаблоны ссылок
						"SECTION_URL"                 =>  "",                      // URL, ведущий на страницу с содержимым раздела
						"DETAIL_URL"                  =>  "",                      // URL, ведущий на страницу с содержимым элемента раздела
						"SECTION_ID_VARIABLE"         =>  "SECTION_ID",            // Название переменной, в которой передается код группы
						"PRODUCT_QUANTITY_VARIABLE"   =>  "quantity",              // Название переменной, в которой передается количество товара
					// endregion
					// region Настройки кеширования
						"CACHE_TYPE"                  =>  "A",                     // Тип кеширования : array ( 'A' => 'Авто + Управляемое', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )
						"CACHE_TIME"                  =>  "36000000",              // Время кеширования (сек.)
						"CACHE_NOTES"                 =>  "",                      //
						"CACHE_GROUPS"                =>  "Y",                     // Учитывать права доступа
					// endregion
					// region Дополнительные настройки
						"CACHE_FILTER"                =>  "N",                     // Кешировать при установленном фильтре
					// endregion
					// region Настройки действий
						"ACTION_VARIABLE"             =>  "action",                // Название переменной, в которой передается действие
						"PRODUCT_ID_VARIABLE"         =>  "id",                    // Название переменной, в которой передается код товара для покупки
					// endregion
					// region Цены
						"PRICE_CODE"                  =>  array('BASE' => '[BASE] Розничная цена',),               // Тип цены : array ( 'BASE' => '[BASE] Розничная цена', )
						"USE_PRICE_COUNT"             =>  "N",                     // Использовать вывод цен с диапазонами
						"SHOW_PRICE_COUNT"            =>  "1",                     // Выводить цены для количества
						"PRICE_VAT_INCLUDE"           =>  "Y",                     // Включать НДС в цену
						"CONVERT_CURRENCY"            =>  "N",                     // Показывать цены в одной валюте
					// endregion
					// region Добавление в корзину
						"BASKET_URL"                  =>  "/personal/basket.php",  // URL, ведущий на страницу с корзиной покупателя
						"USE_PRODUCT_QUANTITY"        =>  "N",                     // Разрешить указание количества товара
						"ADD_PROPERTIES_TO_BASKET"    =>  "Y",                     // Добавлять в корзину свойства товаров и предложений
						"PRODUCT_PROPS_VARIABLE"      =>  "prop",                  // Название переменной, в которой передаются характеристики товара
						"PARTIAL_PRODUCT_PROPERTIES"  =>  "N",                     // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
						"PRODUCT_PROPERTIES"          =>  array(''),               // Характеристики товара
					// endregion
					// region Сравнение товаров
						"DISPLAY_COMPARE"             =>  "N",                     // Разрешить сравнение товаров
					// endregion
				)
		);?>
	</div>

<div class="row">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"tree",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "2",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(''),
		"SECTION_USER_FIELDS" => array(''),
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y"
	)
);?>
</div>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>