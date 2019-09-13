{**
 * plugins/generic/badges/templates/articleFooter.tpl
 *
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 *}
<div class="badges">
        {if $doi}
        
        <span class="__dimensions_badge_embed__" data-doi="{$doi}"></span><script async src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>

        {/if}
        
</div>

