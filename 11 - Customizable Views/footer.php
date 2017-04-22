    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('js/ie10-viewport-bug-workaround.js'); ?>"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Knockout Library via CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.1/knockout-min.js"></script>
<!-- PHP-driven JavaScript Utility Functions -->
<script>
    function base_url(params) {
        return '<?php echo base_url(); ?>' + params;
    }
    function site_url(params) {
        return '<?php echo site_url(); ?>' + '/' + params;
    }
</script>
<!-- Custom script for this template -->
<?php if (isset($scripts)): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
  </body>
</html>