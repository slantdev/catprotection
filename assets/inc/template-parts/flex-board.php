<?php if( have_rows('board_member') ): ?>

    <section class="board grid-container">
        <div class="grid-x">
            
            <?php while( have_rows('board_member') ): the_row(); 

                // vars
                $name = get_sub_field('board_member_name');
                $position = get_sub_field('board_member_position');
                $bio = get_sub_field('board_member_bio');
            ?>

                    <article class="cell large-10 board__item">
                        <!-- BOARD MEMBER -->
                        
                            <section class="board-member grid-x">
                                <div class="cell auto">
                                <?php if( $name ): ?>
                                    <h2 class="board-member__heading"><?php echo $name; ?></h2>
                                <?php endif; ?>
                                <?php if( $position ): ?>
                                    <p class="board-member__position"><?php echo $position; ?></p>
                                <?php endif; ?>
                                <?php if( $bio ): ?>
                                    <div class="board-member__desc">
                                        <?php echo $bio; ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </section>
                        
                        <!-- BOARD MEMBER END -->
                    </article>

            <?php endwhile; ?>

        </div>
    </section>

<?php endif; ?>

