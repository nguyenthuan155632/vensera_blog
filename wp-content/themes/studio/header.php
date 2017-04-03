<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Studio
 */

	/** 
	 * studio_doctype hook
	 *
	 * @hooked studio_doctype -  10
	 * 
	 */
	do_action( 'studio_doctype' );
	?>

<head>
    <meta name="google-site-verification" content="JczKVBtaUXM_gwdkv5Gw65ONvj7VmQN8rO7OhM51RQY" />
<?php	
	/** 
	 * studio_before_wp_head hook
	 *
	 * @hooked studio_head -  10
	 * 
	 */
	do_action( 'studio_before_wp_head' );

	wp_head(); ?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-8297763938357175",
        enable_page_level_ads: true
    });
    </script>
</head>

<body <?php body_class(); ?>>

	<?php 
	/** 
	 * studio_before_header hook
	 *
	 * @hooked studio_page_start -  10
	 * 
	 */
	do_action( 'studio_before_header' );
	

	/** 
	 * studio_header hook
	 *
	 * @hooked studio_header_start -  10
	 * @hooked studio_site_branding_start -  30
	 * @hooked studio_logo -  50
	 * @hooked studio_site_title_description -  60
	 * @hooked studio_site_branding_end -  70
	 * @hooked studio_header_menu -  80
	 * @hooked studio_primary_menu - 110
	 * @hooked studio_header_end -  200
	 * 
	 */
	do_action( 'studio_header' );


	/** 
	 * studio_after_header hook
	 * 
	 */
	do_action( 'studio_after_header' );


	/** 
	 * studio_content hook
	 *
	 * @hooked studio_content_start - 10
	 * 
	 */
	do_action( 'studio_content' );