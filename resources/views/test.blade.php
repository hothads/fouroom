<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- NEWS -->
<!-- MODAL FOR NATIONAL EDUCATION PROJECT -->
<?foreach($arResult["ITEMS"] as $key => $arItem):?>
<modal :width="1129" :height="624" name="hello-world<?=$key?>">

    <div class="flex">

        <div style="width: 802px" class="text-lg bg-gray-100 pl-12 pr-6 py-6">
            <?=$arItem["DETAIL_TEXT"]?>
        </div>

        <div class="bg-gray-200">
            <img width="327" class="rounded" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="">
        </div>

    </div>

</modal>
<?endforeach;?>
<!-- MODAL FOR NATIONAL EDUCATION PROJECT END -->

<!-- NATIONAL EDUCATION PROJECT -->

<div class="xline">

    <div style="height: 5px; width: 47px" class="bg-blue-400"></div> <!--blue line-->

    <div class="relative">

        <div class="absolute right-0 pr-40 pt-12">
            <img src="<?=SITE_TEMPLATE_PATH?>/images/semicircle.svg" width="23" height="41" alt="<?=$arItem["NAME"]?>">
        </div>

        <h2 class="my-12">Национальный проект &laquo;Образование&raquo;</h2>

        <tabs>
            <tab name="Федеральные проекты" :selected="true">
                <div class="flex">

                    <div class="mt-16">
                    <?foreach($arResult["ITEMS"] as $key => $arItem):?>
                    <!--modal link-->
                        <?if ($key <= 4):?>
                        <div class="left_card cursor-pointer" @click.prevent="$modal.show('hello-world<?=$key?>')">
                            <!--modal link end-->

                            <div class="left_card_title ">
                                <?=$arItem["NAME"]?>
                            </div>

                            <div class="left_card_icons bg-yellow-600">
                                <span><?=$arItem["PREVIEW_TEXT"]?></span>
                                <div class="icon bg-yellow-500">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/coub.svg" width="36" height="29"
                                         alt="Успех каждого ребенка">
                                </div>
                            </div>
                        </div>
                        <?else:?>
                        <div class="right_card cursor-pointer" @click.prevent="$modal.show('hello-world<?=$key?>')">
                            <!--modal link end-->
                            <div class="left_card_icons bg-yellow-600">
                                <span><?=$arItem["PREVIEW_TEXT"]?></span>
                                <div class="icon bg-yellow-500">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/coub.svg" width="36" height="29"
                                         alt="Успех каждого ребенка">
                                </div>
                            </div>
                            <div class="right_card_title ">
                                <?=$arItem["NAME"]?>
                            </div>
                        </div>
                        <?endif?>

                        <?if ($key == 4):?>
                    </div>
                    <div class="mt-16">
                        <img class="mt-6" src="<?=SITE_TEMPLATE_PATH?>/images/icons/stat.svg" width="415" height="400" alt="">
                    </div>
                    <div class="mt-16">
                        <?endif?>
                        <?endforeach;?>

                    </div>
                </div>
            </tab>

            <tab name="Источники финансирования">

                <div class="flex">

                    <div class="mt-16">

                        <div style="width: 384px" class="left_card">

                            <div class="left_card_title ">
                                Федеральный бюджет
                            </div>

                            <div style="width: 175px; background: #3C91C1" class="left_card_icons">

                                <span style="width: 122px">723,3 млрд &#8381;</span>

                                <div style="width: 33%; background: #4EA7D9;" class="icon">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/hand.svg" width="28" height="28"
                                         alt="Федеральный бюджет">
                                </div>

                            </div>
                        </div>

                        <!--bottom items-->

                        <div class="flex items-center mb-8" style="margin-top: 146px">
                            <div class="mr-6">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/hand.svg" width="28" height="28"
                                     alt="Сроки реализации проекта">
                            </div>
                            <div>
                                <div class="text-gray-600 mb-2">Сроки реализации проекта</div>
                                <div style="font-size: 24px; font-weight: bold" class="text-gray-800">01.01.2019 -
                                    31.12.2024
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="mr-6">
                                <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/hand.svg" width="28" height="28" alt="Бюджет проекта">
                            </div>
                            <div>
                                <div class="text-gray-600 mb-2">Бюджет проекта</div>
                                <div style="font-size: 24px; font-weight: bold" class="text-gray-800">784 млрд
                                    &#8381;
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-16" style="margin-left: -30px;">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/icons/budget.svg" height="400" width="415" style="margin-top: 25px;" alt="">
                    </div>

                    <div class="mt-16"> <!-- right cards -->

                        <!--first-->
                        <div style="width: 384px; margin-left: -30px" class="right_card">

                            <div style="width: 175px; background: #70B54B" class="left_card_icons"
                                 style="background: #0062A7">

                                <div style="width: 33%; background: #5F9940;" class="icon">
                                    <svg width="28" height="28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.778 16.3c.22-.357.44-.714.687-1.057h-1.63c.088.06.172.122.25.192.135.125.253.269.363.416.11.148.205.31.275.475h.044c.004-.003.004-.014.011-.025zM4.208 3.268H24.82v9.047c.36-.107.716-.2 1.086-.236V.545A.545.545 0 0025.363 0H3.668a.545.545 0 00-.543.545V15.79c0 .302.242.545.543.545h1.975a.077.077 0 01.014-.022c.35-.39.823-.652 1.296-.862.165-.074.323-.137.485-.203h-3.23V3.267zm0-2.178H24.82v1.09H4.208V1.09z"
                                              fill="#fff"/>
                                        <path d="M15.553 6.741a2.707 2.707 0 00-2.955.59 2.726 2.726 0 00-.587 2.969 2.707 2.707 0 002.503 1.68 2.726 2.726 0 001.039-5.238zm.466 3.142a1.627 1.627 0 01-3.13-.626c0-.66.396-1.256 1.005-1.51a1.633 1.633 0 011.773.354c.466.467.605 1.171.352 1.782z"
                                              fill="#fff"/>
                                        <path d="M23.194 6.535a1.632 1.632 0 01-1.626-1.632.545.545 0 00-.543-.545H8.006a.543.543 0 00-.543.545 1.637 1.637 0 01-1.626 1.632.543.543 0 00-.543.545v4.354c0 .303.242.546.543.546a1.637 1.637 0 011.626 1.631c0 .303.242.546.543.546h13.019a.545.545 0 00.543-.546c0-.898.727-1.628 1.626-1.631.3 0 .543-.244.543-.546V7.08a.543.543 0 00-.543-.545zm-.543 4.41a2.72 2.72 0 00-2.114 2.121H8.494a2.724 2.724 0 00-2.117-2.122V7.57a2.728 2.728 0 002.117-2.125h12.043A2.724 2.724 0 0022.65 7.57v3.374zM12.8 18.95a.549.549 0 000-.774.544.544 0 00-.771 0 .548.548 0 000 .773.544.544 0 00.77 0z"
                                              fill="#fff"/>
                                        <path d="M6.263 27.78a.54.54 0 00.767.003l2.636-2.608c.447-.45.583-1.116.385-1.695l.565-.549c.305-.294.709-.46 1.134-.46h7.23a4.855 4.855 0 003.414-1.392c.037-.037-.286.346 4.933-5.913a2.192 2.192 0 00-.257-3.076 2.174 2.174 0 00-3.05.243l-3.208 3.312a2.182 2.182 0 00-1.692-.814h-6.063a7.022 7.022 0 00-2.723-.545c-2.617 0-4.904 1.215-6.133 3.488-.518-.1-1.061.06-1.454.453L.16 20.832a.544.544 0 000 .77l6.103 6.177zm4.07-12.4c.834 0 1.638.17 2.394.5.07.03.143.045.216.045h6.174a1.09 1.09 0 010 2.18h-4.438a.543.543 0 00-.543.546c0 .302.242.545.543.545h4.438a2.183 2.183 0 002.158-2.468 860.38 860.38 0 003.56-3.676 1.089 1.089 0 011.534-.13c.459.391.518 1.08.129 1.54l-4.878 5.854a3.786 3.786 0 01-2.636 1.065h-7.23c-.708 0-1.38.272-1.886.766l-.463.45-4.261-4.277c.998-1.872 2.866-2.94 5.19-2.94zm-6.815 3.625a.538.538 0 01.672-.078c.095.06-.177-.188 4.709 4.708a.55.55 0 01.003.77l-2.246 2.221-5.344-5.404 2.206-2.217z"
                                              fill="#fff"/>
                                    </svg>
                                </div>

                                <span style="width: 122px">45,7 млрд &#8381;</span>
                            </div>

                            <div class="right_card_title">
                                Бюджет субъектов РФ
                            </div>

                        </div>

                        <!--second-->
                        <div style="width: 384px; margin-left: -30px; margin-top: 300px" class="right_card">

                            <div style="width: 175px; background: #E96302" class="left_card_icons"
                                 style="background: #0062A7">

                                <div style="width: 33%; background: #CC5600;" class="icon">
                                    <svg width="28" height="28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.778 16.3c.22-.357.44-.714.687-1.057h-1.63c.088.06.172.122.25.192.135.125.253.269.363.416.11.148.205.31.275.475h.044c.004-.003.004-.014.011-.025zM4.208 3.268H24.82v9.047c.36-.107.716-.2 1.086-.236V.545A.545.545 0 0025.363 0H3.668a.545.545 0 00-.543.545V15.79c0 .302.242.545.543.545h1.975a.077.077 0 01.014-.022c.35-.39.823-.652 1.296-.862.165-.074.323-.137.485-.203h-3.23V3.267zm0-2.178H24.82v1.09H4.208V1.09z"
                                              fill="#fff"/>
                                        <path d="M15.553 6.741a2.707 2.707 0 00-2.955.59 2.726 2.726 0 00-.587 2.969 2.707 2.707 0 002.503 1.68 2.726 2.726 0 001.039-5.238zm.466 3.142a1.627 1.627 0 01-3.13-.626c0-.66.396-1.256 1.005-1.51a1.633 1.633 0 011.773.354c.466.467.605 1.171.352 1.782z"
                                              fill="#fff"/>
                                        <path d="M23.194 6.535a1.632 1.632 0 01-1.626-1.632.545.545 0 00-.543-.545H8.006a.543.543 0 00-.543.545 1.637 1.637 0 01-1.626 1.632.543.543 0 00-.543.545v4.354c0 .303.242.546.543.546a1.637 1.637 0 011.626 1.631c0 .303.242.546.543.546h13.019a.545.545 0 00.543-.546c0-.898.727-1.628 1.626-1.631.3 0 .543-.244.543-.546V7.08a.543.543 0 00-.543-.545zm-.543 4.41a2.72 2.72 0 00-2.114 2.121H8.494a2.724 2.724 0 00-2.117-2.122V7.57a2.728 2.728 0 002.117-2.125h12.043A2.724 2.724 0 0022.65 7.57v3.374zM12.8 18.95a.549.549 0 000-.774.544.544 0 00-.771 0 .548.548 0 000 .773.544.544 0 00.77 0z"
                                              fill="#fff"/>
                                        <path d="M6.263 27.78a.54.54 0 00.767.003l2.636-2.608c.447-.45.583-1.116.385-1.695l.565-.549c.305-.294.709-.46 1.134-.46h7.23a4.855 4.855 0 003.414-1.392c.037-.037-.286.346 4.933-5.913a2.192 2.192 0 00-.257-3.076 2.174 2.174 0 00-3.05.243l-3.208 3.312a2.182 2.182 0 00-1.692-.814h-6.063a7.022 7.022 0 00-2.723-.545c-2.617 0-4.904 1.215-6.133 3.488-.518-.1-1.061.06-1.454.453L.16 20.832a.544.544 0 000 .77l6.103 6.177zm4.07-12.4c.834 0 1.638.17 2.394.5.07.03.143.045.216.045h6.174a1.09 1.09 0 010 2.18h-4.438a.543.543 0 00-.543.546c0 .302.242.545.543.545h4.438a2.183 2.183 0 002.158-2.468 860.38 860.38 0 003.56-3.676 1.089 1.089 0 011.534-.13c.459.391.518 1.08.129 1.54l-4.878 5.854a3.786 3.786 0 01-2.636 1.065h-7.23c-.708 0-1.38.272-1.886.766l-.463.45-4.261-4.277c.998-1.872 2.866-2.94 5.19-2.94zm-6.815 3.625a.538.538 0 01.672-.078c.095.06-.177-.188 4.709 4.708a.55.55 0 01.003.77l-2.246 2.221-5.344-5.404 2.206-2.217z"
                                              fill="#fff"/>
                                    </svg>
                                </div>

                                <span style="width: 122px">45,7 млрд &#8381;</span>
                            </div>

                            <div class="right_card_title">
                                Внебюджетные источники
                            </div>

                        </div>
                    </div>
                </div>
            </tab>
        </tabs>
    </div>
</div>





