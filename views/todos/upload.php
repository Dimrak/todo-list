
<form action="<?php echo url('todo/upload')?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="todoFile">Example file input</label>
    <input type="file" name="fileToUpload" id="todoFile" class="form-control-file">
    <input type="submit" value="Upload Todos" name="submitFile" class="mt-1">
</form>