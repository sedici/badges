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
            
            {if $showDimensions}        
            <div class="sub_item"  style="text-align:center">
                <span class="__dimensions_badge_embed__" data-doi="{$doi}" data-style="small_circle" style="text-align:center"></span><script async src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>
            </div>
            {/if}
            

            {if $showAltmetric}
            <div class="sub_item">
                <script type='text/javascript' src='https://d1bxh8uas1mnw7.cloudfront.net/assets/embed.js'></script>
                <div data-badge-popover="right" data-badge-type="donut" data-doi="{$doi}" data-hide-no-mentions="false" class="altmetric-embed"></div>
            </div>
            {/if}

            {if $showPlumx}
            <div class="sub_item">
                <script type="text/javascript" src="//cdn.plu.mx/widget-popup.js"></script>
                <a href="https://plu.mx/plum/a/?doi={$doi}" class="plumx-plum-print-popup"></a>
            </div>   
            {/if}
        {/if}
        
</div>

