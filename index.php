<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="bower_components/jquery/jquery.min.js"></script>
  <script src="bower_components/foundation/js/foundation/foundation.js"></script>
  <script src="bower_components/foundation/js/foundation/foundation.accordion.js"></script>

  <link rel="stylesheet" type="text/css" href="bower_components/foundation/css/foundation.css">
  <link rel="stylesheet" type="text/css" href="assets/css/media_list.css">

</head>
<body>
<?php
  include("directory_list.php");

  $files = dirToArray('assets/Music');

  echo '<ul class="accordion" data-accordion>';
  foreach ($files as $artist => $value) {
    if(is_array($value)){
      echo '<li class="accordion-navigation">
               <a href="#artist-'.preg_replace('/[^A-Za-z0-9\-]/', '_', $artist).'">'.$artist.'</a>
               <div id="artist-'.preg_replace('/[^A-Za-z0-9\-]/', '_', $artist).'" class="content">';
                
                foreach ($value as $albumKey => $songs) {
                  if(is_array($songs)){
                     echo '<ul class="accordion" data-accordion>
                            <li class="accordion-navigation">
                              <a href="#album-'.preg_replace('/[^A-Za-z0-9\-]/', '_', $albumKey).'">'.$albumKey.'</a>
                              <div id="album-'.preg_replace('/[^A-Za-z0-9\-]/', '_', $albumKey).'" class="content">
                                <a href="player.html?d='.$artist.DIRECTORY_SEPARATOR.$albumKey.'" class="button">Play Album</a>
                                <ul>';
                                if(count($songs) > 0){
                                  foreach ($songs as $songKey => $song) {
                                    $songpath = pathinfo($song);
                                    echo '<li class="song">'.$songpath['filename'].'</li>';
                                  }
                                }else{
                                  echo '<li class="no-songs">Songs not in mp3 or mp4 format</li>';
                                }
                              echo '</ul>
                              </div>
                            </li>
                          </ul>';
                  }
                }
          echo '</div>
              </li>';
    }
  }
  echo '</ul>';
?>
</body>
  <script>
    $(document).foundation({
      accordion: {
        // specify the class used for accordion panels
        content_class: 'content',
        // specify the class used for active (or open) accordion panels
        active_class: 'active',
        // allow multiple accordion panels to be active at the same time
        multi_expand: true,
        // allow accordion panels to be closed by clicking on their headers
        // setting to false only closes accordion panels when another is opened
        toggleable: true
      }
    });
  </script>
</html>