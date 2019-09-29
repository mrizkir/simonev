document.addEventListener('DOMContentLoaded', function() {   
    /**
     * Detail RKA Kegiatan
    */
    $(document).on('click','#ringkasan-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'ringkasan-tab',
            },
            success:function(result)
            { 
                console.log(result.success);
            },
            error:function(xhr, status, error)
            {   
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    });
    $(document).on('click','#data-kegiatan-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'data-kegiatan-tab',
            },
            success:function(result)
            { 
                console.log(result.success);
            },
            error:function(xhr, status, error)
            {   
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    });    
    $(document).on('click','#data-uraian-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'data-uraian-tab',
            },
            success:function(result)
            { 
                console.log(result.success);
            },
            error:function(xhr, status, error)
            {   
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    });    
    $(document).on('change','#StrID',function(ev) {
        
    });  
    $(document).on('change','#KlpID',function(ev) {
        alert('test');
    });  
    $(document).on('change','#JnsID',function(ev) {
        alert('test');
    });  
    $(document).on('change','#ObyID',function(ev) {
        alert('test');
    });  
    $(document).on('change','#RObyID',function(ev) {
        alert('test');
    });  
});