<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Федеральные проекты<br> национального<br> проекта &laquo;Образование&raquo;");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Федеральные проекты<br> национального<br> проекта &laquo;Образование&raquo;");
?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "nac",
    array(
        "IBLOCK_TYPE" => "articles",
        "IBLOCK_ID" => "5",
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FILTER_NAME" => "",
        "FIELD_CODE" => array(
            0 => "DETAIL_PICTURE",
            1 => "",
            2 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_URL" => "/content/news/#ELEMENT_CODE#/",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "N",
        "PREVIEW_TRUNCATE_LEN" => "0",
        "ACTIVE_DATE_FORMAT" => "j/m/Y",
        "DISPLAY_PANEL" => "N",
        "SET_TITLE" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Статьи",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "COMPONENT_TEMPLATE" => "nac",
        "CHECK_DATES" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "CACHE_GROUPS" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "STRICT_SECTION_CHECK" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => ""
    ),
    false
);
?>


<div class="info-box">
    <!-- red circle -->
    <div class="absolute right-0 top-0 -mt-6" style="margin-right: 526px">
        <svg width="47" height="46" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M23.105 37.919c8.24 0 14.92-6.68 14.92-14.919 0-8.24-6.68-14.919-14.92-14.919S8.186 14.761 8.186 23c0 8.24 6.68 14.919 14.92 14.919zm0 8.081c12.703 0 23-10.297 23-23s-10.297-23-23-23c-12.702 0-23 10.297-23 23s10.298 23 23 23z"
                  fill="#ECBDC7" fill-opacity=".5"/>
        </svg>
    </div>
    <!-- red circle end -->

    <div class="info-box-text" style="">
        <span class="font-bold">Национальный проект «Образование»</span> – это инициатива, направленная на достижение
        двух ключевых задач. Первая – обеспечение глобальной конкурентоспособности российского
        образования и вхождение Российской Федерации в число 10 ведущих стран мира по качеству
        общего образования. Вторая – воспитание гармонично развитой и социально ответственной
        личности на основе духовно-нравственных ценностей народов Российской Федерации,
        исторических и национально-культурных традиций.
    </div>

</div>

<!-- NATIONAL EDUCATION PROJECT END -->

<?
$APPLICATION->IncludeComponent("bitrix:news.list", "news", Array(
        "IBLOCK_TYPE"	=>	"articles",
        "IBLOCK_ID"	=>	"3",
        "NEWS_COUNT"	=>	"6",
        "SORT_BY1"	=>	"ACTIVE_FROM",
        "SORT_ORDER1"	=>	"DESC",
        "SORT_BY2"	=>	"SORT",
        "SORT_ORDER2"	=>	"ASC",
        "FILTER_NAME"	=>	"",
        "FIELD_CODE"	=>	array(
            0 => 'DETAIL_PICTURE'
        ),
        "PROPERTY_CODE"	=>	array(
        ),
        "DETAIL_URL"	=>	"/content/news/#ELEMENT_CODE#/",
        "CACHE_TYPE"	=>	"A",
        "CACHE_TIME"	=>	"3600",
        "CACHE_FILTER"	=>	"N",
        "PREVIEW_TRUNCATE_LEN"	=>	"0",
        "ACTIVE_DATE_FORMAT"	=>	"j/m/Y",
        "DISPLAY_PANEL"	=>	"N",
        "SET_TITLE"	=>	"N",
        "INCLUDE_IBLOCK_INTO_CHAIN"	=>	"Y",
        "ADD_SECTIONS_CHAIN"	=>	"Y",
        "HIDE_LINK_WHEN_NO_DETAIL"	=>	"N",
        "PARENT_SECTION"	=>	"",
        "DISPLAY_TOP_PAGER"	=>	"N",
        "DISPLAY_BOTTOM_PAGER"	=>	"N",
        "PAGER_TITLE"	=>	"Статьи",
        "PAGER_SHOW_ALWAYS"	=>	"N",
        "PAGER_TEMPLATE"	=>	"",
        "PAGER_DESC_NUMBERING"	=>	"N",
        "PAGER_DESC_NUMBERING_CACHE_TIME"	=>	"36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE"	=>	"Y",
        "DISPLAY_NAME"	=>	"Y",
        "DISPLAY_PICTURE"	=>	"Y",
        "DISPLAY_PREVIEW_TEXT"	=>	"Y"
    )
);

?>

<!-- MAP -->

<div>
    <h2 class="my-12">Интерактивная карта</h2>
</div>
<div class="pb-12 xline">

        <img src="<?=SITE_TEMPLATE_PATH?>/images/map.png" width="1048" height="613" alt="map">

        <!--map icons-->

        <div class="map_icons pt-12">
            <ul>
                <li><span style="background-color: #64A6D4;"></span>Современная школа</li>
                <li><span style="background-color: #F8D548;"></span>Успех каждого ребенка</li>
                <li><span style="background-color: #5D4686;"></span>Поддержка семей, имеющих детей</li>
                <li><span style="background-color: #DD9234;"></span>Цифровая образовательная среда</li>
            </ul>

            <ul class="pl-10">
                <li><span style="background-color: #BC2964;"></span>Учитель будущего</li>
                <li><span style="background-color: #81B259;"></span>Молодые профессионалы</li>
                <li><span style="background-color: #7DACAF;"></span>Новые возможности</li>
                <li><span style="background-color: #7DACAF;"></span>Социальная активность</li>
            </ul>

            <ul class="pl-12">
                <li><span style="background-color: #7DACAF;"></span>Экспорт образования</li>
                <li><span style="background-color: #7D8DA1;"></span>Социальные лифты для каждого</li>
            </ul>

        </div>

        <!--map icons end-->

    <div style="margin-left:430px" class="absolute bottom-0 left-0 w-1 h-6 bg-blue-400"></div>
</div>

<!-- MAP END -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
