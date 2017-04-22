<h1>Add Purchase</h1>
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