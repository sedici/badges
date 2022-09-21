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
<div class="item badges">
        {if $doi}
            
            {if $showDimensions}        
            <div class="sub_item">
                <span class="__dimensions_badge_embed__" data-doi="{$doi|escape}" data-style="small_circle"></span><script async src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>
            </div>
            {/if}
            

            {if $showAltmetric}
            <div class="sub_item">
                <script type='text/javascript' src='https://d1bxh8uas1mnw7.cloudfront.net/assets/embed.js'></script>
                <div data-badge-popover="right" data-badge-type="donut" data-doi="{$doi|escape}" data-hide-no-mentions="{$badgesAltmetricHideWhenEmpty|escape}" class="altmetric-embed"></div>
            </div>
            {/if}

            {if $showPlumx}
            <div class="sub_item">
                <script type="text/javascript" src="//cdn.plu.mx/widget-popup.js"></script>
                <a href="https://plu.mx/plum/a/?doi={$doi|escape}" class="plumx-plum-print-popup"></a>
            </div>   
            {/if}
        {/if}
        
</div>

