<?php
    $id = sanitize_text_field( $_POST['id'] );
    $age = sanitize_text_field( $_POST['age'] );
    $gender = sanitize_text_field( $_POST['gender'] );
    $breed = sanitize_text_field( $_POST['breed'] );
    $compatibility = sanitize_text_field( $_POST['compatibility'] );
    $gender_option = get_gender_option();
    $breed_option =  get_breed_option();
    $compatibility_option =  get_compatibility_option();
    $colour = false;
   global $post;
   $posts = search_adopt_cats($id,$age,$gender,$breed, $compatibility , $colour); 
	
?>
<section class="cards" id="cats">
    
    <div class="grid-container">
    <form  method="post" action="<?php echo esc_url( '#cats' ); ?>">
        <!-- FILTER -->
        <div class="grid-x filter">
            <div class="cell medium-2 filter__item">
                <input type="text"  name="id" class="filter__input" placeholder="ID Number" />
            </div>
            <div class="cell medium-2 filter__item">
                <select name="age" id="" class="filter__select">
                    <option value="" disabled selected>AGE</option>
                    <option <?php if($age == 'kitten'){ echo 'selected'; } ?> value="kitten">Kitten (up to 6 mo)</option>
                    <option <?php if($age == 'junior'){ echo 'selected'; } ?> value="junior">Junior (6 mo to 2 yr)</option>
                    <option <?php if($age == 'prime'){ echo 'selected'; } ?> value="prime">Prime (3-6 yr)</option>
                    <option <?php if($age == 'mature'){ echo 'selected'; } ?> value="mature">Mature (7-10 yr)</option>
                    <option <?php if($age == 'senior'){ echo 'selected'; } ?> value="senior">Senior (10 years+)</option>
                </select>
            </div>
            <div class="cell medium-2 filter__item">
                <select name="gender" id="" class="filter__select">
                    <option value="" disabled selected>Gender</option>
                    <?php foreach($gender_option as $key=>$value): ?>
                        <option <?php if($key == $gender){ echo 'selected'; } ?>  value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="cell medium-2 filter__item">
                <select name="breed" id="" class="filter__select">
                    <option value="" disabled selected>Breed</option>
                    <?php foreach($breed_option as $key=>$value): ?>
                        <option <?php if($key == $breed){ echo 'selected'; } ?>  value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="cell medium-2 filter__item">
                <select name="compatibility" id="" class="filter__select">
                    <option value="" disabled selected>Compatibility</option>
                    <?php foreach($compatibility_option as $key=>$value): ?>
                        <option <?php if($key == $compatibility){ echo 'selected'; } ?>  value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="cell medium-2 filter__item">
                <button class="button filter__button">Search</button>
            </div>
            
        </div>
        <!-- FILTER END -->
        </form>
        
        <?php if($posts) : ?>
        <section class="grid-x grid-margin-x medium-up-2 large-up-4">
            <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
                    <?php get_template_part( 'assets/inc/template-parts/tp-adopt-cat-card' ); ?>
            <?php endforeach; wp_reset_postdata(); ?>
        </section>
        <?php else : ?>    
        <section class="grid-x grid-margin-x cards__not-found">
            <div class="cell text-center"><p>Cat's not found.</p></div>
        </section>
        <?php endif; ?>    
        
</div>
</section>