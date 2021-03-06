<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Infinity
 */
$tm_dione_layout        = Kirki::get_option( 'tm-dione', 'archive_layout' );
$tm_dione_list_boxed    = 1;
$tm_dione_page_title    = Kirki::get_option( 'tm-dione', 'archive_title' );
$tm_dione_heading_image = Kirki::get_option( 'tm-dione', 'page_bg_image' );
$page_breadcrumb        = Kirki::get_option( 'tm-dione', 'breadcrumb_enable' );

$style = '';
if ( $tm_dione_heading_image ) {
    $style .= 'background-image: url("' . ( $tm_dione_heading_image ) . '");';
}
$id_style = uniqid( 'page-header-style-' );

get_header();

tm_dione_apply_style( $style, '#' . $id_style );

?>

<?php if ( $tm_dione_page_title != 'none' ): ?>
    <div id="<?php echo esc_attr( $id_style ) ?>" class="page-big-title <?php echo esc_attr( $tm_dione_page_title ) ?>">
        <div class="container">
            <div class="row middle-xs middle-sm">
                <?php
                the_archive_title( '<h3 class="entry-title media-middle col-md-6" itemprop="headline">', '</h3>' );
                ?>
                <div class="breadcrumb media-middle col-md-6">
                    <?php if ( function_exists( 'tm_bread_crumb' ) && $page_breadcrumb == 1 ) { ?>
                        <?php echo tm_bread_crumb( array( 'home_label' => Kirki::get_option( 'tm-dione', 'breadcrumb_home_text' ) ) ); ?>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>

<div class="blog-wrapper container<?php if ( $tm_dione_list_boxed != 1 )
    echo esc_attr( '-fluid' ) ?>">
    <div class="row">

        <div id="blog-grid-masonry" class="col-md-12 list-blog-wrapper">
            <main class="content row blog-grid-masonry">
                <?php if ( have_posts() ) : ?>
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php
                        /* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
                        get_template_part( 'template-parts/content', 'project-taxonomy' );
                        ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>
            </main>
            <?php tm_dione_paging_nav(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
