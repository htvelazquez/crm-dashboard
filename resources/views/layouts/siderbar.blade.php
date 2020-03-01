<aside class="main-sidebar">
    <?php
    //var_dump($authorizedURI);
    ?>
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            @if (in_array('/', $authorizedURI))
            <li><a href="/"><i class="glyphicon glyphicon-home"></i> <span>Home</span></a></li>
            @endif

            @if (in_array('/contacts', $authorizedURI))
                <li><a href="/contacs"><i class="glyphicon glyphicon-briefcase"></i> <span>Directorio</span></a></li>
            @endif

            @if (in_array('/profile', $authorizedURI))
                <li><a href="/profile"><i class="glyphicon glyphicon-user"></i> <span>Mi Perfil</span></a></li>
            @endif
        </ul>
    </section>
</aside>
