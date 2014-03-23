/**
 * Created by Anna on 23.03.14.
 */
$(document).ready(function(){
    $('#mainForm').submit(function(e){
        if($('#directoryPath').val() == '')
        {
            $('#directoryPath').css({'border' : '1px solid #ff0000'});
            e.preventDefault();
        }
    });
});