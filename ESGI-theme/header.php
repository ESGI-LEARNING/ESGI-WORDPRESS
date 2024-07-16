<html lang="fr">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php echo bloginfo('name') ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="style.css">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header id="header" class="header">
	<div id="divSansMenu" class="header-top">
		<a href="/" class="logo">
			<img id="logo" src="<?php echo esgi_get_site_logo()['logo']; ?>" alt="logo"/>
		</a>

		<button id="btnToggle" class="toggle-button">
			<div class="burger-line"></div>
			<div class="burger-line"></div>
		</button>
	</div>

	<div id="divMenu" class="menu">
		<div class="menu-header">

			<a href="/" class="logo-white">
				<img src="<?php echo esgi_get_site_logo()['logo_white']; ?>" alt="logo"/>
			</a>

			<button id="btnToggleMenu" class="close-button">
				<div class="line line-1"></div>
				<div class="line line-2"></div>
			</button>
		</div>

		<div class="flex justify-end">
			<nav>
                <?php
                // Afficher le menu primary-menu dans une balise nav.main-menu
                wp_nav_menu([
                    'theme_location' => 'header',
                    'container' => false,
                    'menu_class' => 'main-menu',
                ]);
                ?>
			</nav>
		</div>
	</div>
</header>

<?php wp_footer(); ?>
</body>

</html>