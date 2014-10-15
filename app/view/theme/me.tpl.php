<div>
 <?php   if (isset($main)) : ?> 
 <article>
	<figure class ='left'>
	<img  src='<?=$this->url->asset('img/me.jpg')?>' alt='Bild på mig'/>
	</figure>

        <?=$main?>
</article>
     <?php endif; ?>
	 
    <?php if(isset($byline)) : ?>
           <footer class="byline">
  <figure class=right> 
	<img  src='<?=$this->url->asset('img/hpump.jpg')?>' alt='Värmepumpexempel'/>
  </figure>
            <?=$byline?>
       
        </footer>
    <?php endif; ?>
</div>	
