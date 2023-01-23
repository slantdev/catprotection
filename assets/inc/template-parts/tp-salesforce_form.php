<?php
    $anchor = get_field('donate_anchor');
    if(is_array($anchor)) {
        $anchor = reset($anchor);
    }
    $form_id = (!$form_id) ? get_sub_field('salesforce_form_id') : $form_id;
?>

<?php if($anchor): ?>
    <?php set_query_var('anchor', $anchor); ?>
    <?php get_template_part('assets/inc/template-parts/flex-anchor'); ?>
<?php endif; ?>

<?php if($form_id) : ?>
<style>
.npspPlusDonateDropIn{
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
}
</style>
<div class="donations-form salseforce">
    <div id="salesforce_form-<?php echo $form_id; ?>" class="salesforce-form"></div>
</div>
<?php
    /* $form_url = "https://dev-cpsv.cs75.force.com"; // development */
    $form_url = "https://cpsv.secure.force.com"; // production
?>
<script src="https://js.stripe.com/v3/"></script>
<script src="<?php echo $form_url; ?>/resource/npsp_plus__DonateDropIn/dropin.js"></script>
<script>
    npspPlusDropIn.create({
    donateFormURL: '<?php echo $form_url; ?>/npsp_plus__DonateDropIn?form=<?php echo $form_id; ?>',
        containerSelector: '#salesforce_form-<?php echo $form_id; ?>', // CSS selector of the HTML element the drop-in iFrame will be appended (body tag by default).
      iFrameOptions: {
        id: 'npspPlusDonateDropIn', // HTML id of the DropIn iFrame element
        className: 'npspPlusDonateDropIn' // HTML class name of the DropIn iFrame element.
      }
    })
</script>
<?php endif; ?>
