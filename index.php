<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ООО Альфа Синтез");
?>
<div id="content" class="container">
	<div class="row">
	<?
		// Структура разделов
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"tree",                // [.default, tree]
			array(
				// region Основные параметры
				"IBLOCK_TYPE"          =>  "catalog",                          // Тип инфоблока : array ( 'catalog' => '[catalog] Каталоги', 'news' => '[news] Новости', 'offers' => '[offers] Торговые предложения', 'services' => '[services] Сервисы', 'references' => '[references] Справочники', )
				"IBLOCK_ID"            =>  "2",                          // Инфоблок : array ( 1 => '[1] Новости', 2 => '[2] Одежда', 3 => '[3] Одежда (предложения)', )
				"SECTION_ID"           =>  "",  // ID раздела
				"SECTION_CODE"         =>  "",                          // Код раздела
				// endregion
				// region Источник данных
				"COUNT_ELEMENTS"       =>  "Y",                         // Показывать количество элементов в разделе
				"TOP_DEPTH"            =>  "2",                         // Максимальная отображаемая глубина разделов
				"SECTION_FIELDS"       =>  array(''),                   // Поля разделов : array ( 'ID' => 'ID', 'CODE' => 'Символьный код', 'XML_ID' => 'Внешний код', 'NAME' => 'Название', 'SORT' => 'Сортировка', 'DESCRIPTION' => 'Описание', 'PICTURE' => 'Изображение', 'DETAIL_PICTURE' => 'Детальная картинка', 'IBLOCK_TYPE_ID' => 'Тип информационного блока', 'IBLOCK_ID' => 'ID информационного блока', 'IBLOCK_CODE' => 'Символьный код информационного блока', 'IBLOCK_EXTERNAL_ID' => 'Внешний код информационного блока', 'DATE_CREATE' => 'Дата создания', 'CREATED_BY' => 'Кем создан (ID)', 'TIMESTAMP_X' => 'Дата изменения', 'MODIFIED_BY' => 'Кем изменен (ID)', )
				"SECTION_USER_FIELDS"  =>  array(''),                   // Свойства разделов
				// endregion
				// region Шаблоны ссылок
				"SECTION_URL"          =>  "",                          // URL, ведущий на страницу с содержимым раздела
				// endregion
				// region Настройки кеширования
				"CACHE_TYPE"           =>  "A",                         // Тип кеширования : array ( 'A' => 'Авто + Управляемое', 'Y' => 'Кешировать', 'N' => 'Не кешировать', )
				"CACHE_TIME"           =>  "36000000",                  // Время кеширования (сек.)
				"CACHE_NOTES"          =>  "",                          //
				"CACHE_GROUPS"         =>  "Y",                         // Учитывать права доступа
				// endregion
				// region Дополнительные настройки
				"ADD_SECTIONS_CHAIN"   =>  "Y",                         // Включать раздел в цепочку навигации
				// endregion
			)
		);
	?>
	</div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>