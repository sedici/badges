{**
 * plugins/generic/badges/templates/articleFooter.tpl
 *
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 *}
<div class="item badges">
        {if $doi}
        
            <span class="__dimensions_badge_embed__" data-doi="{$doi}"></span><script async src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>

            <script type='text/javascript' src='https://d1bxh8uas1mnw7.cloudfront.net/assets/embed.js'></script>
            <div data-badge-popover="right" data-badge-type="donut" data-doi="{$doi}" data-hide-no-mentions="true" class="altmetric-embed"></div>


            <script type="text/javascript" src="//cdn.plu.mx/widget-popup.js"></script>
            <a href="https://plu.mx/plum/a/?doi={$doi}" class="plumx-plum-print-popup"></a>
        {/if}
        
</div>

