<template>
    <select :name="name" class="form-control">
        <slot></slot>
    </select>
</template>
<style src="select2/dist/css/select2.min.css"></style>
<style src="select2-bootstrap-theme/dist/select2-bootstrap.min.css"></style>
<script>
import Select2 from 'select2';
export default {
    props: [
        'options',
        'value',
        'name'
    ],    
    mounted ()
    {
        var vm = this;
        //init select
        $(this.$el).select2({
                        theme:'bootstrap',
                        data: this.options,
                        allowClear:true,
                        placeholder :'MOHON DIPILIH'
                    })
                    .val(this.value)
                    .trigger('change')
                    // emit event on change
                    .on('change', function(){
                        vm.$emit('input',this.value); 
                        if (this.value!=''&&this.value!='none'&&this.value!=null)
                        {
                            $(this).removeClass('is-invalid');
                        }                                               
                    });
        
    },
    watch: 
    {
        value: function (value)
        {
            //update value
            $(this.$el).val(value)
                        .trigger('change');
        },
        options: function (options)
        {
            $(this.$el).select2({
                theme:'bootstrap',
                data: options,
                allowClear:true,
                placeholder :'MOHON DIPILIH'
            });
        }
    },
    destroyed: function ()
    {
        $(this.$el).off().select2('destroy');
    }
}
</script>
