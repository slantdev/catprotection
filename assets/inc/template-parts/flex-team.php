<?php if( have_rows('team_member') ): ?>

    <section class="team grid-container">
        <div class="grid-x grid-margin-x medium-up-2 large-up-3">
            <!-- TEAM ITEM -->

            <?php while( have_rows('team_member') ): the_row(); 

                // vars
                $name = get_sub_field('team_member_name');
                $position = get_sub_field('team_member_position');
                $bio = get_sub_field('team_member_bio');
                $image = get_sub_field('team_member_image');
            ?>

                    <article class="cell team__item">
                        <!-- TEAM MEMBER -->
                        
                             <section class="team-member grid-x">
                                <div class="cell shrink"><figure class="team-member__img"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></figure></div>
                                <div class="cell auto">
                                    <h2 class="team-member__heading"><?php echo $name; ?></h2>
                                    <p class="team-member__position"><?php echo $position; ?></p>
                                    
                                    <div class="team-member__desc">
                                        <?php echo $bio; ?>
                                    </div>
                                    <a class="team-member__read-more"><span class="readmore-txt">Read more</span></a>
                                </div>
                            </section>
                        
                        <!-- TEAM MEMBER END -->
                    </article>

            <?php endwhile; ?>

        </div>
    </section>

<?php endif; ?>

