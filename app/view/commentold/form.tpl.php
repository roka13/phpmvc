<div class='comment-form'>
    <form method=post>
		<input type=hidden name="page" value="<?=$this->request->getCurrentUrl()?>">
		   <input type=hidden name="redirect" value="<?=$this->url->create('')?>">
        <fieldset>
			<legend>Kommentera denna sida</legend>
				<p><textarea name='content'><?=$content?></textarea></p>
				<p><label>Namn:<input type='text' name='name' value='<?=$name?>'/></label>
			<label>Hemsida:<input type='url' name='web' value='<?=$web?>'/></label>
			<label>Email:<input type='email' name='mail' value='<?=$mail?>'/></label></p>
		    
			<p class=buttons>
            <input type='submit' name='doCreate' value='Posta kommentar' onClick="this.form.action = '<?=$this->url->create('comments/add')?>'"/>
            <input type='reset' value='Rensa inmatningsfälten'/>
            <input type='submit' name='doRemoveAll' value='Ta bort samtliga' onClick="this.form.action = '<?=$this->url->create('comment/remove-all')?>'"/>
			</p>
	
        </fieldset>
    </form>
</div>