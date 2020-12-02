<template>
    <div>
        <v-system-bar app dark :class="this.$store.getters['uifront/getTheme']('V-SYSTEM-BAR-CSS-CLASS')">        
            <v-spacer></v-spacer>            
            <strong>
                Tahun Anggaran: {{formlogin.tahun_anggaran}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
            </strong>
		</v-system-bar>
        <v-main class="mx-4 mb-4">
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="4">
                        <v-card class="elevation-12">
                            <v-toolbar color="primary" dark flat>
                                <v-toolbar-title>LOGIN</v-toolbar-title>							
                            </v-toolbar>                            
                            <v-form ref="frmlogin" @keyup.native.enter="doLogin" lazy-validation>
                                <v-card-text>
                                    <v-alert
                                        outlined
                                        dense
                                        type="error"
                                        :value="form_error"
                                        icon="mdi-close-octagon-outline">
                                        Username atau Password tidak dikenal
                                    </v-alert>                          
                                    <v-text-field 
                                        v-model="formlogin.username"
                                        label="Username" 
                                        :rules="rule_username"
                                        outlined 
                                        dense />   
                                    <v-text-field 
                                        v-model="formlogin.password"
                                        label="Password" 
                                        type="password"         
                                        :rules="rule_password"                
                                        outlined 
                                        dense />  
                                    <v-select
                                        v-model="formlogin.tahun_anggaran"
                                        :items="daftar_ta"                
                                        label="TAHUN ANGGARAN"
                                        :rules="rule_tahun_anggaran"   
                                        dense
                                        outlined/>   
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer/>                                 
                                    <v-btn 
                                        color="grey" 
                                        dark 
                                        to="/">
                                            KEMBALI
                                    </v-btn>	
                                    <v-btn 
                                        color="primary" 
                                        @click="doLogin" 
                                        :loading="btnLoading"
                                        :disabled="btnLoading">
                                            LOGIN
                                    </v-btn>	
                                </v-card-actions>
                            </v-form>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>      
        <v-footer app padless fixed dark>
			<v-card class="flex" flat tile>
				<v-divider></v-divider>
				<v-card-text class="py-2 white--text text-center">
					<strong>{{NamaAPP}} (2019-2020)</strong> dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. 
					<v-btn dark icon href="https://github.com/mrizkir/simonev-vuetify">
						<v-icon>mdi-github</v-icon>
					</v-btn>					
				</v-card-text>
			</v-card>			
		</v-footer>
    </div>    
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    name: 'Login',
    created()
	{
        this.$store.dispatch('uifront/init',this.$ajax);           
        
        this.daftar_ta=this.$store.getters['uifront/getDaftarTA'];  
        this.formlogin.tahun_anggaran=this.$store.getters['uifront/getTahunAnggaran'];  

		if (this.$store.getters['auth/Authenticated'])
		{
			this.$router.push('/dashboard/'+this.$store.getters['auth/AccessToken']);
		}
    },
    data: () => ({     
        btnLoading:false,
        //form
        form_error:false,
        daftar_ta:[],
        formlogin: {
            username:'',
            password:'',
            tahun_anggaran:'',
        },
        rule_username:[
            value => !!value||"Username mohon untuk diisi !!!"
        ], 
        rule_password:[
            value => !!value||"Password mohon untuk diisi !!!"
        ], 
        rule_tahun_anggaran:[
            value => !!value||"Tahun Anggaran mohon untuk dipilih !!!"
        ], 
        
    }),
    methods: {
        doLogin: async function ()
        {
            if (this.$refs.frmlogin.validate())
            {
                this.btnLoading=true;                
                await this.$ajax.post('/auth/login',{                    
                    username:this.formlogin.username,
                    password:this.formlogin.password,
                    tahun_anggaran:this.formlogin.tahun_anggaran,
                }).then(({data})=>{  
                    this.$ajax.get('/auth/me',{
                        headers:{
                            'Authorization': data.token_type+' '+data.access_token,
                        }
                    })
                    .then(response => {    
                        var data_user = {
                            token: data,
                            user:response.data
                        }
                        this.$store.dispatch('auth/afterLoginSuccess',data_user);                          
                    });
                    this.btnLoading=false;
                    this.form_error=false;
                    this.$router.push('/dashboard/'+data.access_token);
                }).catch(() => {                    
                    this.form_error=true;
                    this.btnLoading=false;
                });                                
            }
        }
    },
    computed :{
        ...mapGetters('uifront',{
            NamaAPP: 'getNamaAPP',
            NamaAPPAlias: 'getNamaAPPAlias',            
        }),        
    }
}
</script>