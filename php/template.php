<?php

function emitHtmlHead( $title ) {
?>
  <title><?= $title ?></title>
  <link href="css/default.css" rel="stylesheet" type="text/css" />
<?php
}

function emitHeader( $title ) {
    global $baseUrl;
?>
  <div class="h1">
   <h1><a href="<?= $baseUrl ?>/"><?= $title ?></a></h1>
  </div>
  <div class="tabs">
   <ul>
    <li><a href="<?= $baseUrl ?>/">Front</a></li>
    <li><a href="<?= $baseUrl ?>/logs.php">Logs</a></li>
    <li><a href="<?= $baseUrl ?>/graphic-logs.php">Graphic logs</a></li>
   </ul>
  </div>
<?php
}

function emitFooter() {
?>
  <div class="footnote">
   <p>Licensed under <a href="LICENSE">GPLv3</a>.
      More info: <a href="https://github.com/jernst/rasptimer">https://github.com/jernst/rasptimer</a>.</p>
  </div>
<?php
}
