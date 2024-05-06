{**
 * plugins/generic/badges/templates/articleFooter.tpl
 *
 * Copyright 2019
 * Portal de Revistas de la Universidad Nacional de La Plata
 *  https://revistas.unlp.edu.ar
 *  https://sedici.unlp.edu.ar
 *
 * @author gonetil
 *}

{if $doi}
    <link rel="stylesheet" type="text/css" href="/plugins/generic/badges/styles/badges.css">
    <div class="item badges" style="display: none">
        <h2 class="label">{translate key="plugins.generic.badges.manager.settings.showBlockTitle"}</h2>

        {if $showDimensions}
        <div class="sub_item">
            <span class="__dimensions_badge_embed__" data-doi="{$doi|escape}" data-hide-zero-citations="{$badgesDimensionsHideWhenEmpty|escape}" data-style="small_circle"></span><script async src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>
        </div>
        {/if}

        {if $showAltmetric}
        <div class="sub_item">
            <script type='text/javascript' src='https://d1bxh8uas1mnw7.cloudfront.net/assets/embed.js'></script>
            <div data-badge-popover="right" data-badge-type="{$badgesAltmetricStyle|escape}" data-doi="{$doi|escape}" data-hide-no-mentions="{$badgesAltmetricHideWhenEmpty|escape}" class="altmetric-embed"></div>
        </div>
        {/if}

        {if $showPlumx}
        <div class="sub_item">
            <script type="text/javascript" src="//cdn.plu.mx/widget-popup.js"></script>
            <a href="https://plu.mx/plum/a/?doi={$doi|escape}" class="plumx-plum-print-popup" data-hide-when-empty="{$badgesPlumxHideWhenEmpty|escape}"></a>
        </div>
        {/if}
    </div>

    <script>
        window.addEventListener("load", function() {ldelim}
            let dimensionsBadge = document.getElementsByClassName('__dimensions_badge_embed__')[0];
            let altmetricBadge = document.getElementsByClassName('altmetric-embed')[0];
            let plumxBadge = document.getElementsByClassName('plumx-plum-print-popup')[0];

            if(dimensionsBadge.hasChildNodes() || altmetricBadge.hasChildNodes() || plumxBadge.hasChildNodes()) {ldelim}
                let badgesDiv = document.getElementsByClassName('badges')[0];
                badgesDiv.style.display = 'block';
            {rdelim}
        {rdelim});
    </script>
{/if}
