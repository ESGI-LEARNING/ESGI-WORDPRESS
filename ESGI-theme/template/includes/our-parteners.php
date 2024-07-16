<div class="partners-wrapper">
    <?php foreach (esgi_get_partners() as $partner) {
        if ($partner) {
            echo '<img src="' . $partner . '" class="partner-logo">';
        }
    } ?>
</div>