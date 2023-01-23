<?php
    $anchor = get_field('donate_anchor');
    if (is_array($anchor)) {
        $anchor = reset($anchor);
    }
?>

<?php if ($anchor): ?>
    <?php set_query_var('anchor', $anchor); ?>
    <?php get_template_part('assets/inc/template-parts/flex-anchor'); ?>
<?php endif; ?>

<script>
    // Create IE + others compatible event handler
    var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
    var eventer = window[eventMethod];
    var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
    // Listen to message from child window
    eventer(messageEvent, function(event) {
        if (event.data && event.data.handler == 'onIFrameContentHeightChanged') {
            var newHeight = event.data.value;
            $('iframe[src*=cpsv]').css('height', newHeight + 'px' );
        }
    }, false);
</script>
<div class="donations-form salseforce-membership">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <article class="cell large-10 text-left">
                <div class="donations-form salseforce-membership">
                    <iframe id="ifrm" src="https://cpsv.secure.force.com/MembershipForm" frameBorder="0" style="width:100%"/>
                </div>
            </article>
        </div>
    </div>
</div>
