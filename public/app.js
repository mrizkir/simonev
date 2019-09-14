let format_uang_options = {
    formatOnPageLoad: true,
    allowDecimalPadding: false,
    decimalCharacter: ",",
    digitGroupSeparator: ".",
    unformatOnSubmit: true,
    showWarnings:false,
    modifyValueOnWheel:false
}

let format_angkat_options = {
    allowDecimalPadding: false,
    formatOnPageLoad: true,
    minimumValue:0,
    maximumValue:9999,
    numericPos:true,
    decimalPlaces : 0,
    digitGroupSeparator : '',
    showWarnings:false,
    unformatOnSubmit: true,
    modifyValueOnWheel:false
}

function checkExistsID(id) {
    var status = false;
    if ($(id).length) status = true;
    return status;
}
//checking data type is json
function isJSON (data) 
{
    try 
    {
        JSON.parse(data);        
    }catch(e) 
    {
        return false;
    }
    return true;
}
//parsing ajax error
function parseMessageAjaxEror (xhr, status, error) 
{    
    if (isJSON(xhr)) {
        var jsonResponseText = $.parseJSON(xhr.responseText);
        var jsonResponseStatus = '';
        var message = '';

        $.each(jsonResponseText, function(name, val) 
        {
            switch(name) 
            {
                case 'message' :
                    message = 'message:' + val + ',';
                break;
                case 'exception' :
                    message = message + 'exception:' + val;
                break;
            }            
        });
        return message;
    }
}
/**
* data table function 
*/
//paginate table data
function paginateTableData (selector,href)
{
    var a =  href.attr('href').split('?page=');        
    var page = a[1];
    var page_url = a[0]+'/paginate/'+page;
    if (typeof page !== 'undefined')
    {
        $.ajax({
            type:'get',
            url: page_url,
            dataType: 'json',
            success:function(result)
            {          
                $(selector).html(result.datatable); 
                if ($(selector + ' *').hasClass('select')) {
                    //styling select
                    $('.select').select2({
                        allowClear:true
                    });
                };
                if ($(selector + ' *').hasClass('switch')) {
                    $(".switch").bootstrapSwitch();
                } 
            },
            error:function(xhr, status, error)
            {
                console.log('ERROR');
                console.log(parseMessageAjaxEror(xhr, status, error));                           
            },
        });
    }
}
 //change number record of page function
 function changeNumberRecordOfPage (selector)
 {
     $.ajax({
         type:'post',
         url: url_current_page +'/changenumberrecordperpage',
         dataType: 'json',
         data: {                
             "_token": token,
             "numberRecordPerPage": $('#numberRecordPerPage').val(),
         },
         success:function(result)
         {          
            $(selector).html(result.datatable);    
            if ($(selector + ' *').hasClass('select')) {
                //styling select
                $('.select').select2({
                    allowClear:true
                });
            }        
            if ($(selector + ' *').hasClass('switch')) {
                $(".switch").bootstrapSwitch();                
            }                       
         },
         error:function(xhr, status, error)
         {
             console.log('ERROR');
             console.log(parseMessageAjaxEror(xhr, status, error));                           
         },
     });
 }
 //sorting table data
 function sortingTableData (selector,a)
 {
     var column_name=a.attr('id');        
     var orderby=a.data('order');
     $.ajax({
        type:'post',
        url: url_current_page +'/orderby',
        dataType: 'json',
        data: {                
            "_token": token,                
            "column_name":column_name,
            "orderby": orderby,
        },
        success:function(result)
        {          
            $(selector).html(result.datatable);  
            if ($(selector + ' *').hasClass('select')) {
                //styling select                    
                $('.select').select2({
                    allowClear:true
                });
            }           
            if ($(selector + ' *').hasClass('switch')) {
                $(".switch").bootstrapSwitch();                
            } 
        },
        error:function(xhr, status, error)
        {
            console.log('ERROR');
            console.log(parseMessageAjaxEror(xhr, status, error));                           
        },
     });
 }    

document.addEventListener('DOMContentLoaded', function() {
    /**
     *  customization dore menu
     */
    $('div.dropdown-menu li').filter(function() {
        return this.className == 'active';
    }).parents('.dropdown').addClass('active');
    
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
        Pace.restart();
    });   
    
    /**
     *  customization jquery-validation
     */
    if ($.validator) //check jquery-validation has loaded
    {   
        $.validator.setDefaults({
            ignore: [],
            errorElement: "div",            
            errorPlacement: function (error, element) {
                if (element.attr("class").indexOf("custom-control") != -1) {
                error.insertAfter(element.parent());
                } else {
                error.insertAfter(element);
                }
            }
        });
        
        //method value not equal
        $.validator.addMethod('valueNotEquals',function(value,element,arg){
            return arg !== value;
        }, "Value must not equal arg.");
        //method check if greater than or equal
        $.validator.addMethod('greaterthanorequal',function(value,element,arg){            
            return parseInt(value) >= parseInt(arg); 
        },'value must greater than or equal.');
        //method check if less than or equal
        $.validator.addMethod('lessthanorequal',function(value,element,arg){            
            return parseInt(value) <= parseInt(arg);  
        },'value must less than or equal.');
    }
    /**
    * form operations
    */ 
    if ($('#frmsearch').is("#frmsearch")) 
    {
        $('#frmsearch').submit (function(e) {
            e.preventDefault();
            var actionurl = e.currentTarget.action;     
            
            $.ajax({
                type:'post',
                url:actionurl,
                dataType: 'json',
                data: $("#frmsearch").serialize(),
                success:function(result){ 
                    $('#divdatatable').html(result.datatable);     
                    if ($('#divdatatable *').hasClass('select')) {
                        //styling select
                        $('.select').select2({
                            allowClear:true
                        });
                    }                  
                    if ($('#divdatatable *').hasClass('switch')) {
                        $(".switch").bootstrapSwitch();                
                    } 
                },
                error:function(xhr, status, error){
                    console.log('ERROR');
                    console.log(parseMessageAjaxEror(xhr, status, error));                           
                },
            });
        });
        $('#btnReset').click(function(ev) 
        {
            $('#frmsearch').trigger('reset');
            $('#txtKriteria').focus();
            $.ajax({
                type:'post',
                url: $('#frmsearch').attr('action'),
                dataType: 'json',
                data: {                
                    "_token": token,
                    "action": 'reset',
                },
                success:function(result){ 
                    $('#divdatatable').html(result.datatable);    
                    $('#txtKriteria').val('');     
                    if ($('#divdatatable *').hasClass('select')) {
                        //styling select
                        $('.select').select2({
                            allowClear:true
                        });
                    }              
                    if ($('#divdatatable *').hasClass('switch')) {
                        $(".switch").bootstrapSwitch();                
                    } 
                },
                error:function(xhr, status, error){
                    console.log('ERROR');
                    console.log(parseMessageAjaxEror(xhr, status, error));                           
                },
            });
        });
    }  
    /**
    * data table operations
    */

    //change number record of page
    $(document).on('change','#numberRecordPerPage', function (ev)
    {
        ev.preventDefault();    
        changeNumberRecordOfPage('#divdatatable');
    });
    //sorting table data
    $(document).on('click','.column-sort', function (ev)
    {
        ev.preventDefault();          
        sortingTableData ('#divdatatable',$(this));
    });
    //paginate table data
    $(document).on('click','#paginations a', function (ev)
    {
        ev.preventDefault();
        paginateTableData('#divdatatable',$(this));
    });

});