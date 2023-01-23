<?php
global $post;

$entrants = get_posts(array(
    'post_type' => 'video-entrants',
    'numberposts' => -1,
));
?>
<?php if(is_array($entrants)): ?>
<?php
$tags = false;
foreach ($entrants as $entrant) {
    $terms = get_the_terms( $entrant->ID ,'video_tag');
    if(is_array($terms)) {
        foreach ($terms as $term) {
            $tags[$term->slug] = $term->name;
        }
    }
}
$heading = get_sub_field('heading');
?>
<section class="video-entrant cards cards--news cards--home filter-videos">
    <section class="grid-container content">
        <div class="grid-x">
            <div class="cell">
                <h2 class="cards__title"><?php echo $heading; ?></h2>
            </div>
        </div>
        <div class="grid-x">
            <div class="cell filter-button">
                <button class="button filter-videos-button is-active" data-filter="all">All</button>
                <?php if(is_array($tags)) : ?>
                <?php foreach ($tags as $filter=>$tag): ?>
                    <button class="button filter-videos-button " data-filter="<?php echo $filter; ?>"><?php echo $tag; ?></button>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <section class="grid-x grid-margin-x medium-up-3">
            <?php foreach ($entrants as $entrant): ?>
            <?php
                $video_url = get_field('video_url', $entrant->ID);
                $first_name = get_field('first_name', $entrant->ID);
                $surname = get_field('surname', $entrant->ID);
                $email = get_field('email', $entrant->ID);
                $postcode = get_field('postcode', $entrant->ID);
                $name_of_your_cats = get_field('name_of_your_cats', $entrant->ID);
                $join = get_field('join', $entrant->ID);
                $terms = get_the_terms( $entrant->ID ,'video_tag');
                $class = "";
                if(is_array($terms)) {
                    foreach ($terms as $term) {
                        $class .= " ".$term->slug;
                    }
                }
            ?>
            <article class="cell cards__item filter-videos-item <?php echo $class; ?>">
                <div class="card card--news">
                    <?php echo wp_oembed_get($video_url, array(
                        'height' => 192,
                        'width' => 342,
                    ));?>
            </article>
            <?php endforeach; ?>
        </section>
    </section>
</section>
<?php endif; ?>
