<div class="button-group">
    <button class="btn btn-info" onclick="editData('{{ Crypt::encrypt($id)}}')">Edit</button>
    <button class="btn btn-danger" onclick="deleteData('{{ Crypt::encrypt($id) }}')">Delete</button>
</div>