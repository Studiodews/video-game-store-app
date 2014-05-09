<h1>main page</h1>

<?php

echo $video_game . "<br />";
echo $card;

foreach ($platforms as $platform):
?>
<div><?php echo $platform['Platform']['id']?>"<?php echo $platform['Platform']['name']?></div>



<?php endforeach; ?>