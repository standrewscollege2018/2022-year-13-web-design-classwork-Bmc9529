<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$('#checkall').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
});
</script>
<input type="checkbox"/>
<input type="checkbox"/>
<input type="checkbox"/>

<!-- select all boxes -->
<input type="checkbox" name="select" id="checkall" />
