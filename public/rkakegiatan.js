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
        ev.preventDefault(); 
        var StrID = $('#StrID').val();
        if (StrID=='none' || StrID=='')
        {
            $('#KlpID').html('<option></option>');
            $('#JnsID').html('<option></option>');
            $('#ObyID').html('<option></option>');
            $('#RObyID').html('<option></option>');
        }
        else
        {
            $.ajax({
                type:'post',
                url: url_current_page +'/changerekening',
                dataType: 'json',
                data: {                
                    "_token": token,
                    "StrID": StrID,
                    "pid": 'transaksi',
                },
                success:function(result)
                { 
                    var daftar_kelompok = result.daftar_kelompok;
                    var listitems='<option></option>';
                    $.each(daftar_kelompok,function(key,value){
                        listitems+='<option value="' + key + '">'+value+'</option>';                    
                    });
                    
                    $('#KlpID').html(listitems);
                    $('#JnsID').html('<option></option>');
                    $('#ObyID').html('<option></option>');
                    $('#RObyID').html('<option></option>');
                },
                error:function(xhr, status, error){
                    console.log('ERROR');
                    console.log(parseMessageAjaxEror(xhr, status, error));                           
                },
            }); 
        }
    });  
    $(document).on('change','#KlpID',function(ev) {
        ev.preventDefault(); 
        var KlpID = $('#KlpID').val();
        if (KlpID=='none' || KlpID=='')
        {
            $('#JnsID').html('<option></option>');
            $('#ObyID').html('<option></option>');
            $('#RObyID').html('<option></option>');
        }
        else
        {
            $.ajax({
                type:'post',
                url: url_current_page +'/changerekening',
                dataType: 'json',
                data: {                
                    "_token": token,
                    "KlpID":KlpID,
                    "pid": 'kelompok',
                },
                success:function(result)
                { 
                    var daftar_jenis = result.daftar_jenis;
                    var listitems='<option></option>';
                    $.each(daftar_jenis,function(key,value){
                        listitems+='<option value="' + key + '">'+value+'</option>';                    
                    });
                    
                    $('#JnsID').html(listitems);
                    $('#ObyID').html('<option></option>');
                    $('#RObyID').html('<option></option>');
                },
                error:function(xhr, status, error){
                    console.log('ERROR');
                    console.log(parseMessageAjaxEror(xhr, status, error));                           
                },
            }); 
        }
    });  
    $(document).on('change','#JnsID',function(ev) {
        ev.preventDefault(); 
        var KlpID = $('#KlpID').val();
        if (KlpID=='none' || KlpID=='')
        {
            $('#ObyID').html('<option></option>');
            $('#RObyID').html('<option></option>');
        }
        else
        {
            $.ajax({
                type:'post',
                url: url_current_page +'/changerekening',
                dataType: 'json',
                data: {                
                    "_token": token,
                    "JnsID": $('#JnsID').val(),
                    "pid": 'jenis',
                },
                success:function(result)
                { 
                    var daftar_rincian = result.daftar_rincian;
                    var listitems='<option></option>';
                    $.each(daftar_rincian,function(key,value){
                        listitems+='<option value="' + key + '">'+value+'</option>';                    
                    });
                    
                    $('#ObyID').html(listitems);
                    $('#RObyID').html('<option></option>');
                },
                error:function(xhr, status, error){
                    console.log('ERROR');
                    console.log(parseMessageAjaxEror(xhr, status, error));                           
                },
            }); 
        }
    });  
    $(document).on('change','#ObyID',function(ev) {
        ev.preventDefault(); 
        $.ajax({
            type:'post',
            url: url_current_page +'/changerekening',
            dataType: 'json',
            data: {                
                "_token": token,
                "ObyID": $('#ObyID').val(),
                "pid": 'rincian',
            },
            success:function(result)
            { 
                var daftar_obyek = result.daftar_obyek;
                var listitems='<option></option>';
                $.each(daftar_obyek,function(key,value){
                    listitems+='<option value="' + key + '">'+value+'</option>';                    
                });
                
                $('#RObyID').html(listitems);
            },
            error:function(xhr, status, error){
                console.log('ERROR');
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        }); 
    });  
    $(document).on('change','#RObyID',function(ev) {
        alert('test');
    });  
});