<?php
    if (isset($title)) : ?>   
	<h1><?=$title?></h1>
     <?php endif; ?>





<?php
    if (isset($content)) : ?>   
	<?=$content?>
     <?php endif; ?>
 

    <?php if(isset($byline)) : ?>
	
        <footer class="byline">
  <figure class=right> 
	<img  src='<?=$this->url->asset('img/hpump.jpg')?>' alt='Värmepumpexempel'/>
  </figure>
            <?=$byline?>
        </footer>
    <?php endif; ?>
 
