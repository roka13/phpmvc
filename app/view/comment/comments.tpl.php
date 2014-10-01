<div class='comments'>
<hr>
<h2>Kommentarer</h2>
<?php if (is_array($comments)) : ?>

	<?php foreach ($comments as $id => $comment) : ?>

		<?php if( $comment['page'] == $this->request->getCurrentUrl()) : ?>
		<div>
			<p>Kommentar # <?=$id?></p>
			<div class="ram">
				<img class='left' src="http://www.gravatar.com/avatar/<?=md5(strtolower(trim($comment['mail'])));?> . jpg?s=50 . alt='Bild' " />
				<div class = 'right'>	
					<form method=post>	
						<input type=hidden name="redirect" value="<?=$comment['page']?>">
						<input type="hidden" name="id" value="<?=$id?>" />
						<input type='submit' name='doEdit' value='Editera' onClick="this.form.action = '<?=$this->url->create("comments/edit/$id")?>'"/><br/>
						<input type='submit' name='doRemove' value='Ta bort' onClick="this.form.action = '<?=$this->url->create("comments/remove/$id")?>'"/>		
					</form>	
				</div>	
				
				<p>Kommentar: <?=$comment['content'];?></p>
				<p><span>Författad av:   <?= $comment['name']; ?></span>
                <?php if( $comment['web'] ): ?>
                    <span> Hemsida: <a href="<?=$comment['web']?>"><?=$comment['web']?></a></span>
				<?php endif; ?>
				<?php if( $comment['mail'] ): ?>	
					 <span> Skriv till:<a href="mailto:<?=strtolower(trim($comment['mail']));?>"><?=strtolower(trim($comment['mail']));?></a></span></p>
				<?php endif; ?>
		
						
				
			</div> 
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
	<br/>
<?php endif; ?>
</div>