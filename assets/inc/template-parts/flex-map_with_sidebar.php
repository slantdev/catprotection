<?php 
  $sidebar = get_sub_field('sidebar');
?>
<section class="map-sidebar">
  <div class="grid-container content">
    <div class="grid-x grid-margin-x">
      <div class="cell large-4">
        <div class="map-sidebar__sidebar">
          <?php echo $sidebar; ?>
        </div>
      </div>
      <div class="cell large-5 large-offset-1">
        <div class="map-sidebar__map">
          <div class="embed-container">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3156.115795752107!2d145.10087151819516!3d-37.71695974497535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad648650bdf0923%3A0xc26fdbb071ef1160!2s200+Elder+St%2C+Greensborough+VIC+3088!5e0!3m2!1sen!2sau!4v1557359850142!5m2!1sen!2sau" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
