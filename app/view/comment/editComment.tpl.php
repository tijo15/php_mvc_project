<hr>
<h2>Kommentar</h2>
<div class='comment-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->di->get('url')->create($pagekey)?>">
        <input type=hidden name="pagekey" value="<?=$pagekey?>">
       
        <legend>Edit your comment</legend>
        <p><label>Comment:<br/><textarea name='content'><?=$comment['content']?></textarea></label></p>
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$comment['name']?>'/></label></p>
        <p><label>Webadress:<br/><input type='text' name='web' value='<?=$comment['web']?>'/></label></p>
        <p><label>Email:<br/><input type='text' name='mail' value='<?=$comment['mail']?>'/></label></p
        
        <p class=buttons>
            <input type='submit' class="button"  name='doCreate' value='Update' onClick="this.form.action = '<?=$this->url->create('comment/edit/' . $id . '/' .$pagekey)?>'"/>
            <input type='submit' class="button" name='deleteOne' value='Delete this comment' onClick="this.form.action = '<?=$this->url->create('comment/deleteOne/' . $id . '/' . $pagekey)?>'"/>
            <input type='submit' class="button" name='doRemoveAll' value='Remove all' onClick="this.form.action = '<?=$this->url->create('comment/remove-all/' . $pagekey)?>'"/>
        </p>
     
        
    </form>
</div>