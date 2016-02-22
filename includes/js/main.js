
$(document).ready(function(){
    
    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab
      $(".dataTables_scrollHead > div > table > thead > tr > th input").click()
    });
     
    
 $('#vendor_file_list_filter').remove()

    $('#uploader_main #vendor').on('change',function(){
        
        var vendor = $(this).val();
        
        console.log(vendor)
        
        $('#vender_group').html('');
        
        $.ajax({
            url:'/dashboard/get_vendors?vendor='+vendor, 
            method:'post'
        }).done(function(data){
            
            var json = $.parseJSON(data)
            
            var vendors = '<option value="0"> Select a Account</option>';
            
            $(json).each(function(i, item){
                
               vendors += '<option value="'+item.id+'">'+item.label+'</option>';
                
            });
            
             $(vendors).appendTo('#vender_group');
             $('#vender_group').prop("disabled", false);
        })
        
        
        
    });
    
  
});