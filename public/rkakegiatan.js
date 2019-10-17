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
    $(document).on('click','#data-rencana-target-fisik-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'data-rencana-target-fisik-tab',
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
    $(document).on('click','#data-rencana-anggaran-kas-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'data-rencana-anggaran-kas-tab',
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
    $(document).on('click','#data-realisasi-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'data-realisasi-tab',
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
    $(document).on('click','#data-statistik-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'data-statistik-tab',
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
    $(document).on('click','#data-foto-tab',function(ev) {
        $.ajax({
            type:'post',
            url: url_current_page +'/changetab',
            dataType: 'json',
            data: {
                "_token": token,
                "tab": 'data-foto-tab',
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
    $("#data-uraian").on("click",".btnDeleteUraian", function(){
        swal.fire ({
            title:'Hapus Data',
            text:'Apakah ingin menghapus data Uraian ini ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'YA, Hapus!',
            cancelButtonText: 'TIDAK!',
        }).then((result)=>{
            if (result.value)
            {
                let url_ = $(this).attr("data-url");
                let id = $(this).attr("data-id");
                $.ajax({            
                    type:'post',
                    url:url_+'/'+id,
                    dataType: 'json',
                    data: {
                        "_method": 'DELETE',
                        "_token": token,
                        "pid": 'datauraian',
                        "id": id,
                    },
                    success:function(result){ 
                        if (result.success==1){
                            $('#data-uraian').html(result.datatable);  
                        }else{
                            console.log("Gagal menghapus data Uraian dengan id "+id);
                        }                    
                    },
                    error:function(xhr, status, error){
                        console.log('ERROR');
                        console.log(parseMessageAjaxEror(xhr, status, error));                           
                    },
                });
            }
        }); 
    });   
    $("#data-rencana-target-fisik").on("click",".btnDeleteRencanaFisik", function(){
        swal.fire ({
            title:'Hapus Data',
            text:'Apakah ingin menghapus data Rencana Target Fisik dan Anggaran Kas ini ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'YA, Hapus!',
            cancelButtonText: 'TIDAK!',
        }).then((result)=>{
            if (result.value)
            {
                let url_ = $(this).attr("data-url");
                let id = $(this).attr("data-id");
                $.ajax({            
                    type:'post',
                    url:url_+'/'+id,
                    dataType: 'json',
                    data: {
                        "_method": 'DELETE',
                        "_token": token,
                        "pid": 'datarencanafisik',
                        "id": id,
                    },
                    success:function(result){ 
                        if (result.success==1){
                            $('#data-rencana-target-fisik').html(result.datatable);  
                        }else{
                            console.log("Gagal menghapus data Uraian dengan id "+id);
                        }                    
                    },
                    error:function(xhr, status, error){
                        console.log('ERROR');
                        console.log(parseMessageAjaxEror(xhr, status, error));                           
                    },
                });
            }
        }); 
    }); 
    $("#data-rencana-anggaran-kas").on("click",".btnDeleteRencanaAnggaranKas", function(){
        swal.fire ({
            title:'Hapus Data',
            text:'Apakah ingin menghapus data Rencana Target Fisik dan Anggaran Kas ini ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'YA, Hapus!',
            cancelButtonText: 'TIDAK!',
        }).then((result)=>{
            if (result.value)
            {
                let url_ = $(this).attr("data-url");
                let id = $(this).attr("data-id");
                $.ajax({            
                    type:'post',
                    url:url_+'/'+id,
                    dataType: 'json',
                    data: {
                        "_method": 'DELETE',
                        "_token": token,
                        "pid": 'datarencanaanggarankas',
                        "id": id,
                    },
                    success:function(result){ 
                        if (result.success==1){
                            $('#data-rencana-anggaran-kas-tab').html(result.datatable);  
                        }else{
                            console.log("Gagal menghapus data Uraian dengan id "+id);
                        }                    
                    },
                    error:function(xhr, status, error){
                        console.log('ERROR');
                        console.log(parseMessageAjaxEror(xhr, status, error));                           
                    },
                });
            }
        }); 
    }); 
    $("#datatablerealisasi").on("click",".btnDeleteRealisasi", function(){
        swal.fire ({
            title:'Hapus Data',
            text:'Apakah ingin menghapus data Realisasi ini ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'YA, Hapus!',
            cancelButtonText: 'TIDAK!',
        }).then((result)=>{
            if (result.value)
            {
                let url_ = $(this).attr("data-url");
                let id = $(this).attr("data-id");
                $.ajax({            
                    type:'post',
                    url:url_+'/'+id,
                    dataType: 'json',
                    data: {
                        "_method": 'DELETE',
                        "_token": token,
                        "pid": 'datarealisasi',
                        "id": id,
                    },
                    success:function(result){ 
                        if (result.success==1){
                            $('#datatablerealisasi').html(result.datatable);  
                        }else{
                            console.log("Gagal menghapus data Uraian dengan id "+id);
                        }                    
                    },
                    error:function(xhr, status, error){
                        console.log('ERROR');
                        console.log(parseMessageAjaxEror(xhr, status, error));                           
                    },
                });
            }
        }); 
    });    
});