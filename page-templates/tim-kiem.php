<?php /* Template Name: Tìm kiếm toàn trang - Search All */

get_header(); ?>

<section class="hidden-phone" id="about">

    <div class="container">

        <h1>

            SEARCH

            <span id="about-subheader"></span>

        </h1>



    </div>
<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

if( strlen($query_string) > 0 ) {
	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
	} // foreach
} //if

$search = new WP_Query($search_query);
print_r($search);
?>
</section>

    <?php get_footer(); ?>