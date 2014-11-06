<div class='comment-form'> 
    <form method=post> 
		<input type=hidden name="redirect" value="<?=$_SERVER['HTTP_REFERER']?>">
        <input type="hidden" name="id" value="<?=$id?>" />
		<input type="hidden" name="page" value="<?=$page?>" />
        <fieldset> 
			<p><label>Namn:<input type='text' name='name' value='<?=$name?>'/></label> 
			<label>Hemsida:<input type='url' name='web' value='<?=$web?>'/></label> 
			<label>Email:<input type='email' name='mail' value='<?=$mail?>'/></label></p> 
			<p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p> 
			<p class=buttons> 
            <input type='submit' name='doSave' value='Spara' onClick="this.form.action = '<?=$this->url->create('comments/save') .'/' . $id?>'" /> 
			<input type='submit' name='doCancel' value='Cancel' onClick="this.form.action = '<?=$_SERVER['HTTP_REFERER']?>'"/> 
			</p> 
        </fieldset> 
    </form> 
</div> 