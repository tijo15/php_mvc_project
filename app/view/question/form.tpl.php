<div class='question-form'>
    <form method=post > 
        <input type=hidden name="redirect" value="<?=$pagekey == 'questions' ? $this->url->create('question') : $this->url->create('hem')?>">
        <input type=hidden name="pagekey" value="<?=$pagekey?>">
        <hr>
        <p><label><br/><textarea name='content' placeholder="Question:"><?=$content?></textarea></label></p>
        <p><input type='text' name='name' placeholder="Name:" value='<?=$name?>'/></p>
        <p>
       <input type='text' name='web' placeholder="Website:" value='<?=$web?>'/>
        <input type='text' name='mail' placeholder="Email:" value='<?=$mail?>'/></p>
        <p class=buttons>
            <input type='submit' class="button"  name='doCreate' value='Question'  onClick="this.form.action = '<?=$this->url->create('question/add')?>'"/>
            <input type='reset' class="button"  value='Reset'/>
            <input type='submit' class="button"  name='doRemoveAll' value='Remove all' onClick="this.form.action = '<?=$this->url->create('question/remove-all/' . $pagekey)?>'"/>
        </p>
        <output></output>
        
    </form>
</div>
