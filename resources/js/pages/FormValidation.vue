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
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Pagu Anggaran OPD / SKPD</h3>
                        </div>
						<form @submit.prevent="saveData" class="form-horizontal">
							<div class="card-body">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">PAGU ANGGARAN APBD</label>
									<div class="col-sm-9">
										<input class="form-control" v-model.trim="$v.Jumlah1.$model" :class="{ 'is-invalid': $v.Jumlah1.$error }"/>
										<div class="form-error-message" v-if="!$v.Jumlah1.required">* wajib isi</div>
									</div>
								</div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PAGU ANGGARAN APBDP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="Jumlah2" id="Jumlah2" v-model="Jumlah2" class="form-control" :class="{ 'is-invalid': $v.Jumlah1.$error }">
										<div class="form-error-message" v-if="!$v.Jumlah2.required">* wajib isi</div>
                                    </div>
                                </div>								
								<button class="button" type="submit" :disabled="submitStatus === 'PENDING'">Submit!</button>
								<p class="typo__p" v-if="submitStatus === 'OK'">Thanks for your submission!</p>
								<p class="typo__p" v-if="submitStatus === 'ERROR'">Please fill the form correctly.</p>
								<p class="typo__p" v-if="submitStatus === 'PENDING'">Sending...</p>
							</div>
						</form>
                    </div>
				</div>
			</div>
		</div>
		<button @click="showAlert">Hello world</button>
    </section>    
 </div>
</template>
<script>
import { required} from 'vuelidate/lib/validators';

export default {
	created(){
		// Vue.swal('Hello Vue world!!!');
	},
  	data() {
    	return {
			//form
			Jumlah1: '',
			Jumlah2: '',
			submitStatus: null
    	}
	},
	validations: {
		Jumlah1: {
			required,
		},
		Jumlah2: {
			required,
		},
	},
	methods: {
		showAlert() {
			// Use sweetalert2
			this.$swal({
				title: '<i class="far fa-spin fa-spinner"></i>',
				text: 'lier',
				showCancelButton: false,
				showConfirmButton: false,
				showCloseButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false,
				allowEnterKey: false,
			});
			setTimeout(() => {
					this.$swal.close();
			}, 1000);
			
		},
		saveData() 
		{
			this.$v.$touch();
			if (this.$v.$invalid) {
				this.submitStatus = 'ERROR';
			} else {
				// do your submit logic here
				this.submitStatus = 'PENDING';
				setTimeout(() => {
					this.submitStatus = 'OK'
				}, 500)
			}
		}
	}
}
</script>