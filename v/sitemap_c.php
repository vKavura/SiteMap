<?php

?>
<?foreach ($refers as $refer):?> 
<url>
  <loc><?=$refer['r']?></loc>
  <lastmod><?=$time?></lastmod>
  <priority><?=number_format($refer['p'], 2)?></priority>
</url>
<?endforeach?>