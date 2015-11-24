<hr>
<h2>Kommentar</h2>
<div class='question-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->di->get('url')->create($pagekey)?>">
        <input type=hidden name="pagekey" value="<?=$pagekey?>">
       
        <legend>Edit your question</legend>
        <p><label>question:<br/><textarea name='content'><?=$question['content']?></textarea></label></p>
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$question['name']?>'/></label></p>
        <p><label>Webadress:<br/><input type='text' name='web' value='<?=$question['web']?>'/></label></p>
        <p><label>Email:<br/><input type='text' name='mail' value='<?=$question['mail']?>'/></label></p
        
        <p class=buttons>
            <input type='submit' class="button"  name='doCreate' value='Update' onClick="this.form.action = '<?=$this->url->create('question/edit/' . $id . '/' .$pagekey)?>'"/>
            <input type='submit' class="button" name='deleteOne' value='Delete this question' onClick="this.form.action = '<?=$this->url->create('question/deleteOne/' . $id . '/' . $pagekey)?>'"/>
            <input type='submit' class="button" name='doRemoveAll' value='Remove all' onClick="this.form.action = '<?=$this->url->create('question/remove-all/' . $pagekey)?>'"/>
        </p>
     
        
    </form>
</div>