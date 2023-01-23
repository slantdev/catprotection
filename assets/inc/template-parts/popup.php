<?php $page_options = get_field('page_options'); ?>

<?php if(!$page_options || $page_options['display_signup']): ?>
<!-- POPUP -->
<section class="join" id="popup">
    <span class="join__close">Close</span>
    <div class="grid-container">
        <section class="grid-x">
            <article class="cell small-12">
                <h2 class="join__heading">Stay in touch</h2>
                <fieldset>
                    <?php 
                        if(function_exists('gravity_form')) {
                            gravity_form( 10, false, false, false, '', true ); 
                        }
                    ?>
                </fieldset>
            </article>
        </section>
    </div>
</section>
<!-- POPUP END -->
<?php endif; ?>