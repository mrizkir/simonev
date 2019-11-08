<template>
 <div class="content-wrapper">
	<section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        PAGU ANGGARAN OPD / SKPD
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/">HOME</router-link></li>
                        <li class="breadcrumb-item">MASTER</li>
                        <li class="breadcrumb-item active">PAGU ANGGARAN OPD / SKPD</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>  
	<!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <Select2 v-model="myValue" :options="myOptions" :settings="{
                        theme:'bootstrap',
                        allowClear:true,
                        placeholder :'Pilih '
                    }" @change="myChangeEvent($event)" @select="mySelectEvent($event)" />
				    <h4>Value: {{ myValue }}</h4>
				</div>
			</div>
		</div>
    </section>    
 </div>
</template>
<script>
import Select2 from 'v-select2-component';
export default {
	// declare Select2Component
	components: {Select2},
	mounted(){
	},
    data() {
        return {
            myValue: 'op1',
            myOptions: ['op1', 'op2', 'op3'] // or [{id: key, text: value}, {id: key, text: value}]
        }
    },
    methods: {
        myChangeEvent(val){
            console.log(val);
        },
        mySelectEvent({id, text}){
            console.log({id, text})
        }
    }
}
</script>