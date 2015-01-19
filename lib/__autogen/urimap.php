<?php

$PHOTON__urimap = (new HashMap())
    ->put((new Route('index.php')), 'IndexController')
    ->put('404', 'Http404Controller')
;