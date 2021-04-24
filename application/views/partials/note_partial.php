<?php foreach($notes AS $note): ?>
    <div class="note">
        <header>
            <h3><?=$note['title'];?></h3>
            <form class="delete" action="notes/process_delete" method="POST">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
                <input type="hidden" name="id" value="<?=$note['id'];?>">
                <input type="submit" value="Delete">
            </form>
        </header>
        <form class="edit" action="/notes/process_edit" method="POST">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
            <input type="hidden" name="id" value="<?=$note['id'];?>">
            <textarea name="description" rows=15" placeholder="Enter description here..."><?=$note['description'];?></textarea>
            <input type="submit" value="edit">
        </form>
    </div>
<?php endforeach; ?>