<?php get_header();

$tax_slug = get_query_var( 'taxonomy' );

$term_slug = get_query_var( 'term' ); 

$term = get_term_by( 'slug', $term_slug, $tax_slug ); 

//lay metadata avisors
$termMeta = get_option( 'taxonomy_' . $term->term_id ); 

if($termMeta[avisors] == 1)
{
    get_template_part('content','people-avisors'); 

}else get_template_part('content','people'); ?> 

<?php get_footer();?>