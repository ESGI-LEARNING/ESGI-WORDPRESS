<?php

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    $args = array(
        'default-color' => '000000',
    );

    add_theme_support('custom-background', $args);
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/burger.js', array('jquery'), '1.0', true);
});

function img_uri()
{
    return get_theme_file_uri('/assets/images/');
}

function esgi_query_vars($vars)
{
    $vars[] = 'custom_param';
    return $vars;
}

add_filter('query_vars', 'esgi_query_vars');

add_action('customize_register', 'esgi_social_network_customize_register');
function esgi_social_network_customize_register($wp_customize)
{
    $wp_customize->add_section('esgi_social_network_facebook', array(
        'title' => __('Facebook', 'esgi'),
        'priority' => 100,
    ));

    $wp_customize->add_setting('esgi_social_network_facebook_url', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('esgi_social_network_facebook_url', array(
        'type' => 'text',
        'label' => __('URL de la page Facebook', 'esgi'),
        'description' => __('Saisissez l\'URL de la page Facebook à afficher dans le thème.', 'esgi'),
        'section' => 'esgi_social_network_facebook',
    ));

    $wp_customize->add_section('esgi_social_network_linkedin', array(
        'title' => __('Linkedin', 'esgi'),
        'priority' => 100,
    ));

    $wp_customize->add_setting('esgi_social_network_linkedin_url', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('esgi_social_network_linkedin_url', array(
        'type' => 'text',
        'label' => __('URL de la page Linkedin', 'esgi'),
        'description' => __('Saisissez l\'URL de la page Linkedin à afficher dans le thème.', 'esgi'),
        'section' => 'esgi_social_network_linkedin',
    ));
}

function esgi_get_social_networks()
{
    $social_networks = array();

    $social_networks['facebook'] = array(
        'url' => get_theme_mod('esgi_social_network_facebook_url'),
        'icon' => 'fab fa-facebook',
    );

    $social_networks['linkedin'] = array(
        'url' => get_theme_mod('esgi_social_network_linkedin_url'),
        'icon' => 'fab fa-linkedin',
    );

    return $social_networks;
}

function get_post_by_category($category, $page)
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $page,
        'category_name' => $category,
    );

    $query = new WP_Query($args);
    $result = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $current_post = array(
                'title' => get_the_title(),
                'content' => get_the_excerpt(),
                'permalink' => get_the_permalink(),
            );
            array_push($result, $current_post);
        }
    } else {
        return 'Aucun article ne corespond à votre recherche.';
    }
    wp_reset_postdata();
    return $result;
}

function get_current_uri(): string
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https://";
    else
        $url = "http://";

    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];

    return $url;
}

function enqueue_custom_scripts()
{
    wp_enqueue_script('pagination-ajax', get_template_directory_uri() . '/assets/js/pagination-ajax.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


add_action('customize_register', 'esgi_services_customize_register');

function esgi_services_customize_register($wp_customize)
{
    function add_section_and_settings($wp_customize, $section_id, $section_title, $section_description)
    {
        $wp_customize->add_section($section_id, array(
            'title' => __($section_title, 'esgi'),
            'description' => __($section_description, 'esgi'),
            'priority' => 160,
        ));

        $wp_customize->add_setting($section_id . '_phone', array(
            'default' => '+33 1 53 31 25 23',
            'description' => __('Saisisser le numéro de téléphone', 'esgi'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_setting($section_id . '_email', array(
            'default' => 'info@company.com',
            'description' => __('Saissiser l\'email', 'esgi'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control($section_id . '_phone', array(
            'label' => __('Téléphone', 'esgi'),
            'section' => $section_id,
            'type' => 'text',
        ));

        $wp_customize->add_control($section_id . '_email', array(
            'label' => __('Email', 'esgi'),
            'section' => $section_id,
            'type' => 'text',
        ));
    }

    add_section_and_settings($wp_customize, 'esgi_services_location_desk', 'Location de bureau', 'Personnaliser la localisation du bureau');

    $wp_customize->add_setting('esgi_services_location_desk_street', array(
        'default' => 'Rue de la paix',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_setting('esgi_services_location_desk_region', array(
        'default' => 'Paris',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('esgi_services_location_desk_street', array(
        'label' => __('Rue', 'esgi'),
        'section' => 'esgi_services_location_desk',
        'type' => 'text',
    ));

    $wp_customize->add_control('esgi_services_location_desk_region', array(
        'label' => __('Région', 'esgi'),
        'section' => 'esgi_services_location_desk',
        'type' => 'text',
    ));

    add_section_and_settings($wp_customize, 'esgi_services_manager', 'Manager', 'Personnaliser les infos du manager');

    add_section_and_settings($wp_customize, 'esgi_services_ceo', 'CEO', 'Personnaliser les infos du CEO');
}


function esgi_get_services()
{
    $result = array();
    $result['location_desk'] = array(
        'street' => get_theme_mod('esgi_services_location_desk_street'),
        'region' => get_theme_mod('esgi_services_location_desk_region'),
    );
    $result['manager'] = array(
        'phone' => get_theme_mod('esgi_services_manager_phone'),
        'email' => get_theme_mod('esgi_services_manager_email'),
    );
    $result['ceo'] = array(
        'phone' => get_theme_mod('esgi_services_ceo_phone'),
        'email' => get_theme_mod('esgi_services_ceo_email'),
    );
    return $result;
}

add_action('customize_register', 'esgi_team_members_customize_register');

function esgi_team_members_customize_register($wp_customize)
{
    $wp_customize->add_section('esgi_team_members', array(
        'title' => __('Membres de l\'équipe', 'esgi'),
        'description' => __('Personnaliser les membres de l\'équipe', 'esgi'),
        'priority' => 160,
    ));

    function add_member_settings($wp_customize, $member_id)
    {
        $wp_customize->add_setting('esgi_team_members_work_' . $member_id, array(
            'default' => 'Web developer',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_setting('esgi_team_members_phone_' . $member_id, array(
            'default' => '+33 1 53 31 25 23',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_setting('esgi_team_members_email_' . $member_id, array(
            'default' => 'work@company.com',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $default_image = get_template_directory_uri() . '/assets/images/png/' . ($member_id + 4) . '.png';
        $wp_customize->add_setting('esgi_team_members_image_' . $member_id, array(
            'default' => $default_image,
            'sanitize_callback' => 'esc_url_raw',
        ));
    }

    function add_member_controls($wp_customize, $member_id)
    {
        $wp_customize->add_control('esgi_team_members_work_' . $member_id, array(
            'label' => __('Poste', 'esgi'),
            'section' => 'esgi_team_members',
            'type' => 'text',
        ));
        $wp_customize->add_control('esgi_team_members_phone_' . $member_id, array(
            'label' => __('Téléphone', 'esgi'),
            'section' => 'esgi_team_members',
            'type' => 'text',
        ));
        $wp_customize->add_control('esgi_team_members_email_' . $member_id, array(
            'label' => __('Email', 'esgi'),
            'section' => 'esgi_team_members',
            'type' => 'text',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_team_members_image_' . $member_id, array(
            'label' => __('Image', 'esgi'),
            'section' => 'esgi_team_members',
            'settings' => 'esgi_team_members_image_' . $member_id,
        )));
    }

    for ($i = 1; $i <= 4; $i++) {
        add_member_settings($wp_customize, $i);
        add_member_controls($wp_customize, $i);
    }
}

function esgi_get_team_members()
{
    $team_members = array();
    $upload_dir = wp_get_upload_dir();

    for ($i = 1; $i <= 4; $i++) {
        $team_members[$i - 1]['work'] = get_theme_mod('esgi_team_members_work_' . $i, 'work');
        $team_members[$i - 1]['phone'] = get_theme_mod('esgi_team_members_phone_' . $i, '+33 6 12 34 56 78');
        $team_members[$i - 1]['email'] = get_theme_mod('esgi_team_members_email_' . $i, 'work@company.com');
        $team_members[$i - 1]['image'] = get_theme_mod('esgi_team_members_image_' . $i, $upload_dir['baseurl'] . '/assets/images/png/5.png');
    }

    return $team_members;
}

add_action('customize_register', 'esgi_customize_register_site_logo');
function esgi_customize_register_site_logo($wp_customize)
{
    $wp_customize->add_section('esgi_site_logo', array(
        'title' => __('Logo du site', 'esgi'),
        'description' => __('Personnaliser le logo du site', 'esgi'),
        'priority' => 1,
    ));
    $wp_customize->add_setting('esgi_site_logo', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/logo.svg',
        'description' => __('Logo du site', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_setting('esgi_site_logo_white', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/logo-white.svg',
        'description' => __('Logo du site blanc', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_site_logo', array(
        'label' => __('Logo', 'esgi'),
        'section' => 'esgi_site_logo',
        'settings' => 'esgi_site_logo',
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_site_logo_white', array(
        'label' => __('Logo blanc', 'esgi'),
        'section' => 'esgi_site_logo',
        'settings' => 'esgi_site_logo_white',
    )));
}

function esgi_get_site_logo()
{

    $site_logo = array();
    if (get_theme_mod('esgi_site_logo')) {
        $site_logo['logo'] = get_theme_mod('esgi_site_logo');
    } else {
        $site_logo['logo'] = get_template_directory_uri() . '/assets/images/svg/logo.svg';
    }
    if (get_theme_mod('esgi_site_logo_white')) {
        $site_logo['logo_white'] = get_theme_mod('esgi_site_logo_white');
    } else {
        $site_logo['logo_white'] = get_template_directory_uri() . '/assets/images/svg/logo-white.svg';
    }
    if (get_theme_mod('esgi_site_logo_comment_reply')) {
        $site_logo['comment_reply'] = get_theme_mod('esgi_site_logo_comment_reply');
    } else {
        $site_logo['comment_reply'] = get_template_directory_uri() . '/assets/images/png/reply_comment.png';
    }
    return $site_logo;
}

add_action('customize_register', 'esgi_customize_register_partners');
function esgi_customize_register_partners($wp_customize)
{
    $wp_customize->add_section('esgi_partners', array(
        'title' => __('Partenaires', 'esgi'),
        'description' => __('Personnaliser les partenaires', 'esgi'),
        'priority' => 1,
    ));
    $wp_customize->add_setting('esgi_partners_logo_1', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/partner-1.png',
        'description' => __('Logo du partenaire 1', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_setting('esgi_partners_logo_2', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/partner-2.png',
        'description' => __('Logo du partenaire 2', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_setting('esgi_partners_logo_3', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/partner-3.png',
        'description' => __('Logo du partenaire 3', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_setting('esgi_partners_logo_4', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/partner-4.png',
        'description' => __('Logo du partenaire 4', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_setting('esgi_partners_logo_5', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/partner-5.png',
        'description' => __('Logo du partenaire 5', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_setting('esgi_partners_logo_6', array(
        'default' => get_template_directory_uri() . '/assets/images/svg/partner-6.png',
        'description' => __('Logo du partenaire 6', 'esgi'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_partners_logo_1', array(
        'label' => __('Logo du partenaire 1', 'esgi'),
        'section' => 'esgi_partners',
        'settings' => 'esgi_partners_logo_1',
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_partners_logo_2', array(
        'label' => __('Logo du partenaire 2', 'esgi'),
        'section' => 'esgi_partners',
        'settings' => 'esgi_partners_logo_2',
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_partners_logo_3', array(
        'label' => __('Logo du partenaire 3', 'esgi'),
        'section' => 'esgi_partners',
        'settings' => 'esgi_partners_logo_3',
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_partners_logo_4', array(
        'label' => __('Logo du partenaire 4', 'esgi'),
        'section' => 'esgi_partners',
        'settings' => 'esgi_partners_logo_4',
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_partners_logo_5', array(
        'label' => __('Logo du partenaire 5', 'esgi'),
        'section' => 'esgi_partners',
        'settings' => 'esgi_partners_logo_5',
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'esgi_partners_logo_6', array(
        'label' => __('Logo du partenaire 6', 'esgi'),
        'section' => 'esgi_partners',
        'settings' => 'esgi_partners_logo_6',
    )));
}

function esgi_get_partners()
{
    $partners = array();
    for ($i = 1; $i <= 6; $i++) {
        $partners['logo_' . $i] = get_theme_mod('esgi_partners_logo_' . $i);
    }
    return $partners;
}

function get_theme_path($path)
{
    return getcwd() . '/wp-content/themes/project_wordpress_ESGI/' . $path;
}

add_action('wp_ajax_foobar', 'esgi_search_posts');
function esgi_search_posts($search_query)
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        's' => $search_query,
    );

    $query = new WP_Query($args);
    $result = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $categories = get_the_category();
            $categories_name = [];
            foreach ($categories as $category) {
                array_push($categories_name, $category->name);
            }
            $current_post = array(
                'title' => get_the_title(),
                'content' => get_the_excerpt(),
                'permalink' => get_the_permalink(),
                'date' => get_the_date(),
                'category' => $categories_name,
            );
            array_push($result, $current_post);
        }
    } else {
        return 'Aucun article ne corespond à votre recherche.';
    }
    wp_reset_postdata();
    return $result;
}

function delete_argument_uri($url)
{
    $parsed_url = parse_url($url);
    $base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'];

    if (isset($parsed_url['path'])) {
        $base_url .= $parsed_url['path'];
    }

    if (is_single()) {
        return home_url('/blog/');
    }

    if (isset($parsed_url['query'])) {
        parse_str($parsed_url['query'], $query_params);
        unset($query_params['category']);
        unset($query_params['tags']);

        if (!empty($query_params)) {
            $base_url .= '?' . http_build_query($query_params);
        }
    }

    return $base_url;
}
