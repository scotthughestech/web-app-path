<img src="<?php echo base_url('images/ajax-loader.gif') ?>" id="loading" style="position:absolute; top:50%; right:50%;" />
<div class="panel panel-default">
    <div class="panel-heading">Our Report</div>
    <div class="panel-body">
        <form data-bind="submit: filterChart" class="form-inline">
            <div class="form-group">
                <label for="from">From</label>
                <input data-bind="value: from" type="text" class="form-control" id="from" placeholder="YYYY-MM-DD">
            </div>
            <div class="form-group">
                <label for="to">To</label>
                <input data-bind="value: to" type="input" class="form-control" id="to" placeholder="YYYY-MM-DD">
            </div>
            <button type="submit" class="btn btn-default">Filter</button>
            <span id="invalid" style="color:red; margin-left:1em; display:none;">Warning: Invalid Data</span>
        </form>  
        <div id="myfirstchart" style="height: 250px;"></div>
    </div>
</div>