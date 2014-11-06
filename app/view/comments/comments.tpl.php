<div>
<hr>
<h2>Kommentarer</h2>

  <?php foreach ($comments as $comment) : ?> 
		<?php	$properties = $comment->getProperties();?>
			<?php if( $properties['page'] == $this->request->getCurrentUrl()) : ?>
				<?php	$id =$properties['id'];
				$url1=$this->url->create('comments/edit/' .$id);
				$url2=$this->url->create('comments/remove/' .$id);
				$mail=strtolower(trim($properties['mail']));
				$home=null;
				?>
				<div>
					<p>Kommentar # <?=$properties['id']?></p>
					<div class='ram'>
					<img class='left' src="http://www.gravatar.com/avatar/<?=md5(strtolower(trim($properties['mail'])));?>.jpg?s=60"  alt='Bild' />
							<div class = 'right'>	
								<form method=post>	
								<input type=hidden name="redirect" value="<?=$properties['page'];?>"/>
								<input type="hidden" name="id" value=" '<?=$properties['id'];?>'" />
								<input type='submit' name='doEdit' value='Editera' onClick="this.form.action= '<?=$url1?>'"/><br/>
								<input type='submit' name='doRemove' value='Ta bort' onClick="this.form.action='<?=$url2?>'"/>		
								</form>	
							</div>	
				
						<p>Kommentar: <?=$properties['content'];?></p>
						<p><span>Författad av:  <?=$properties['name'];?></span>

		
						<?php if( $properties['web'] ): ?>
							<span> Hemsida: <a href="<?=$properties['web']?>"><?=$properties['web']?></a></span>
						<?php endif; ?>
						<?php if($properties['mail'] ): ?>	
							<span> Skriv till: <a href="mailto:<?=$mail;?>"><?=$mail;?></a></span></p>
						<?php endif; ?>
					</div> 
				</div>
			<?php endif; ?>	
	<?php endforeach; ?>		
	<br/>
</div>