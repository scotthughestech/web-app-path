<img src="<?php echo base_url('images/ajax-loader.gif') ?>" id="loading" style="position:absolute; top:50%; right:50%;" />
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Purchase</h4>
      </div>
      <div class="modal-body">
        <form data-bind="submit: savePurchase">
    <div class="form-group">
        <label for="date">Date</label>
        <input data-bind="textInput: date" type="input" class="form-control" id="date" />
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input data-bind="textInput: price" type="input" class="form-control" id="price" />
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input data-bind="textInput: description" type="input" class="form-control" id="description" />
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select data-bind="value: category_id" class="form-control">
            <?php if (isset($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->id; ?>">
                    <?php echo $category->name; ?>
                </option>
            <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<h1>Browse Purchases</h1>
<table id="purchases" class="table"></table>
<script>
    function getName(id) {
        switch (id) {
            <?php foreach($categories as $category): ?>
            case '<?php echo $category->id; ?>':
            return '<?php echo $category->name; ?>';
            break;
            <?php endforeach; ?>
            default:
            return null;            
        }
    }
</script>