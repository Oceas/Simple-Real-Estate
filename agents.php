<?php //phpcs:ignore Wordpress.Files.Filename
/**
 * Custom Post Type for Agents
 *
 */

/**
 * Custom post type for Agents
 *
 */
class Agents
{

	/**
	 * Permalink slug for this post type
	 *
	 * @var string $slug Permalink prefix
	 * @since NEXT
	 */
	private $slug = 'ca_agents';

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
		add_action('init', [$this, 'register_taxonomy']);
	}

	/**
	 * Register Taxonomy
	 *
	 * @since  NEXT
	 */
	public function register_taxonomy(): void
	{

		$args = array(
			'label'        => __('Agents', 'simple-real-estate'),
			'show_in_rest' => true,
		);

		register_taxonomy($this->slug, 'ca_listings', $args);
	}
}
