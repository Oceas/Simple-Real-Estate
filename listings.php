<?php

class Listings
{

	/**
	 * Permalink slug for this post type
	 *
	 * @var string $slug Permalink prefix
	 * @since NEXT
	 */
	private $slug = 'ca_listings';

	/**
	 * Post ID of this post type.
	 *
	 * @var int $post_id Id of Post.
	 * @since NEXT
	 */
	private $post_id;

	/**
	 * Construct
	 *
	 * @since  0.1.0
	 */
	public function __construct()
	{
		$this->hooks();
	}

	/**
	 * Register Hooks
	 *
	 * @since  NEXT
	 */
	private function hooks(): void
	{
		add_action('init', [$this, 'register_post']);
		add_action('cmb2_admin_init', [$this, 'register_post_meta']);
	}


	/**
	 * Post Labels
	 *
	 * @since  NEXT
	 * @return array
	 */
	private function post_labels(): array
	{
		return [
			'name'                  => _x('Listings', 'Post type general name', 'Listing'),
			'singular_name'         => _x('Listing', 'Post type singular name', 'Listing'),
			'menu_name'             => _x('Listings', 'Admin Menu text', 'Listing'),
			'name_admin_bar'        => _x('Listing', 'Add New on Toolbar', 'Listing'),
			'add_new'               => __('Add New', 'Listing'),
			'add_new_item'          => __('Add New Listing', 'Listing'),
			'new_item'              => __('New Listing', 'Listing'),
			'edit_item'             => __('Edit Listing', 'Listing'),
			'view_item'             => __('View Listing', 'Listing'),
			'all_items'             => __('All Listings', 'Listing'),
			'search_items'          => __('Search Listings', 'Listing'),
			'parent_item_colon'     => __('Parent Listings:', 'Listing'),
			'not_found'             => __('No Listings found.', 'Listing'),
			'not_found_in_trash'    => __('No Listings found in Trash.', 'Listing'),
			'featured_image'        => _x('Listing Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'Listing'),
			'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'Listing'),
			'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'Listing'),
			'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'Listing'),
			'archives'              => _x('Listing archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'Listing'),
			'insert_into_item'      => _x('Insert into Listing', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'Listing'),
			'uploaded_to_this_item' => _x('Uploaded to this Listing', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'Listing'),
			'filter_items_list'     => _x('Filter Listings list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'Listing'),
			'items_list_navigation' => _x('Listings list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'Listing'),
			'items_list'            => _x('Listings list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'Listing'),
		];
	}

	/**
	 * Post Arguments
	 *
	 * @since  NEXT
	 * @return array
	 */
	private function post_arguments(): array
	{
		return [
			'labels'             => $this->post_labels(),
			'description'        => 'Listing custom post type.',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'Listing'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'supports'           => array('title', 'editor', 'author', 'thumbnail'),
			'taxonomies'         => array('category', 'post_tag'),
			'show_in_rest'       => true,
		];
	}

	/**
	 * Register Post Type
	 *
	 * @since  NEXT
	 */
	public function register_post(): void
	{
		register_post_type($this->slug, $this->post_arguments());
	}

	/**
	 * Register Sermon Details Meta Fields
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function register_post_meta(): void
	{
		$listing_details = new_cmb2_box(array(
			'id'            => 'ca_listing_details', // Custom ID of the box.
			'title'         => esc_html__('Listing Details', 'simple-real-estate'), // Title visible to the use.
			'object_types'  => array($this->slug),
		));

		$listing_details->add_field(array(
			'name'       => esc_html__('Street', 'simple-real-estate'),
			'desc'       => esc_html__('What is the street and unit number?', 'simple-real-estate'),
			'id'         => 'ca_street',
			'type'       => 'text',
		));

		$listing_details->add_field(array(
			'name'       => esc_html__('City', 'simple-real-estate'),
			'desc'       => esc_html__('What is the City?', 'simple-real-estate'),
			'id'         => 'ca_city',
			'type'       => 'text',
		));

		$listing_details->add_field(array(
			'name'       => esc_html__('Region', 'simple-real-estate'),
			'desc'       => esc_html__('What is the region?', 'simple-real-estate'),
			'id'         => 'ca_region',
			'type'       => 'text',
		));

		$listing_details->add_field(array(
			'name'       => esc_html__('Postal Code', 'simple-real-estate'),
			'desc'       => esc_html__('What is the postal code?', 'simple-real-estate'),
			'id'         => 'ca_postal_code',
			'type'       => 'text',
		));

		$listing_details->add_field(array(
			'name'       => esc_html__('Listing Price', 'simple-real-estate'),
			'desc'       => esc_html__('What is the asking price?', 'simple-real-estate'),
			'id'         => 'ca_listing_price',
			'type'       => 'text_money',
		));

		$listing_details->add_field(array(
			'name'           => 'Listing Agent',
			'desc'           => 'Who is the listing agent?',
			'id'             => 'ca_listing_agent',
			'taxonomy'       => 'ca_agents', //Enter Taxonomy Slug
			'type'           => 'taxonomy_select',
			'remove_default' => 'true', // Removes the default metabox provided by WP core.
		));

		$listing_details->add_field(array(
			'name' => 'Listing Photos',
			'desc' => 'The more the merrier!',
			'id'   => 'ca_listing_photos',
			'type' => 'file_list',
			'text' => array(
				'add_upload_files_text' => 'Listing Photos', // default: "Add or Upload Files"
				'remove_image_text' => 'Listing Photo', // default: "Remove Image"
				'file_text' => 'Listing Photos', // default: "File:"
				'file_download_text' => 'Listing Photo', // default: "Download"
				'remove_text' => 'Listing Photo', // default: "Remove"
			),
		));

		$group_field_id = $listing_details->add_field(array(
			'id'          => 'ca_listing_detail_group',
			'type'        => 'group',
			'description' => __('Generates reusable form entries', 'simple-real-estate'),
			'options'     => array(
				'group_title'       => __('Property Details'),
				'add_button'        => __('Add Additional Detail', 'simple-real-estate'),
				'remove_button'     => __('Remove Detail', 'simple-real-estate'),
				'sortable'          => true,
			),
		));

		$listing_details->add_group_field($group_field_id, array(
			'name' => __('Detail Title', 'simple-real-estate'),
			'id'   => 'ca_detail_title',
			'type' => 'text',
		));

		$listing_details->add_group_field($group_field_id, array(
			'name' => __('Detail Information', 'simple-real-estate'),
			'id'   => 'ca_detail_information',
			'type' => 'text',
		));
	}
}

new Listings();
