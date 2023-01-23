<div class="share-email-modal" id="share-email-model" style="display: none;">
  <h2 class="share-email-modal__heading">Share with a friend</h2>
  <?php 
    if(function_exists('gravity_form')) {
      gravity_form(13, false, false, false, '', true); 
    }
  ?>
</div>