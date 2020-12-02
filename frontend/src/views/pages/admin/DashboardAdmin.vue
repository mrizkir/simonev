<template>
    <div>
        <v-system-bar app dark :class="this.$store.getters['uifront/getTheme']('V-SYSTEM-BAR-CSS-CLASS')">
            <v-spacer></v-spacer>            
            <strong>
                Tahun Anggaran: {{tahun_anggaran}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
            </strong>
		</v-system-bar>	
        <v-app-bar app>
            <v-toolbar-title class="headline clickable" @click.stop="$router.push('/dashboard/'+$store.getters['auth/AccessToken']).catch(err => {})">
				<span class="hidden-sm-and-down">
                    {{NamaAPPAlias}}
                </span>
			</v-toolbar-title>
            <v-spacer></v-spacer>            
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
            <v-menu 
                :close-on-content-click="true"
                origin="center center"
                transition="scale-transition"
                :offset-y="true"
                bottom 
                left>
                <template v-slot:activator="{on}">
                    <v-avatar size="30">
                        <v-img :src="photoUser" v-on="on" />
                    </v-avatar>                    
                </template>
                <v-list>
                    <v-list-item>
                        <v-list-item-avatar>
                            <v-img :src="photoUser"></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content>					
                            <v-list-item-title class="title">
                                {{ATTRIBUTE_USER('username')}}
                            </v-list-item-title>
                            <v-list-item-subtitle>                                
                                {{ROLE}}
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>                    
                    <v-divider/>
                    <v-list-item to="/system-users/profil">
                        <v-list-item-icon class="mr-2">
							<v-icon>mdi-account</v-icon>
						</v-list-item-icon>
                        <v-list-item-title>Profil</v-list-item-title>
                    </v-list-item>
                    <v-divider/>
                    <v-list-item @click.prevent="logout">
                        <v-list-item-icon class="mr-2">
							<v-icon>mdi-power</v-icon>
						</v-list-item-icon>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>		
        </v-app-bar>
        <v-main class="mx-4 mb-4">			
			<v-container fluid>
                <v-row>
                    <v-col xs="12" sm="4" md="3" v-if="$store.getters['auth/can']('DMASTER-GROUP_BROWSE')">
                        <v-card 
                            min-height="140"
                            class="clickable deep-purple darken-1"
                            color="#385F73" 
                            @click.native="$router.push('/dmaster')"
                            dark>
                            <v-card-title class="headline">
                                DATA MASTER
                            </v-card-title>                        
                            <v-card-text>
                                Pengaturan berbagai parameter sebagai referensi dari modul-modul lain dalam sistem.
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>
                    <v-col xs="12" sm="4" md="3" v-if="$store.getters['auth/can']('RPJMD-GROUP_BROWSE')">
                        <v-card 
                            min-height="140"
                            class="clickable deep-purple darken-1"
                            color="#385F73"                             
                            dark>
                            <v-card-title class="headline">
                                RPJMD
                            </v-card-title>                        
                            <v-card-text>
                                Modul ini digunakan untuk mengelola Rencana Pembangunan Jangka Panjang Daerah (RPJMD)
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                        
                    <v-col xs="12" sm="4" md="3" v-if="$store.getters['auth/can']('BELANJA-GROUP_BROWSE')">
                        <v-card 
                            min-height="140"
                            class="clickable deep-purple darken-1"
                            color="#385F73" 
                            @click.native="$router.push('/belanjamurni')"
                            dark>
                            <v-card-title class="headline">
                                BELANJA MURNI
                            </v-card-title>                        
                            <v-card-text>
                                Modul ini digunakan untuk mengelola Realisasi RKA dari APBD Murni.
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                        
                    <v-col xs="12" sm="4" md="3" v-if="$store.getters['auth/can']('BELANJA-GROUP_BROWSE')">
                        <v-card 
                            min-height="140"
                            class="clickable deep-purple darken-1"
                            color="#385F73" 
                            @click.native="$router.push('/belanjaperubahan')"
                            dark>
                            <v-card-title class="headline">
                                BELANJA PERUBAHAN
                            </v-card-title>                        
                            <v-card-text>
                                Modul ini digunakan untuk mengelola Realisasi RKA dari APBD Perubahan.
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                        
                    <v-col xs="12" sm="4" md="3" v-if="$store.getters['auth/can']('EVALUASI-RENJA-GROUP_BROWSE')">
                        <v-card 
                            min-height="140"
                            class="clickable deep-purple darken-1"
                            color="#385F73" 
                            @click.native="$router.push('/evaluasirenja')"
                            dark>
                            <v-card-title class="headline">
                                EVALUASI RENJA
                            </v-card-title>                        
                            <v-card-text>
                                Modul ini digunakan untuk menampilkan laporan Evaluasi RENJA Murni dan Perubahan.
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>  
                    <v-col xs="12" sm="4" md="3" v-if="$store.getters['auth/can']('EVALUASI-RKPD-GROUP_BROWSE') && (dashboard=='bapelitbang' || dashboard=='superadmin')">
                        <v-card 
                            min-height="140"
                            class="clickable deep-purple darken-1"
                            color="#385F73" 
                            @click.native="$router.push('/evaluasirkpd')"
                            dark>
                            <v-card-title class="headline">
                                EVALUASI RKPD
                            </v-card-title>                        
                            <v-card-text>
                                Modul ini digunakan untuk menampilkan laporan Evaluasi RKPD Murni dan Perubahan.
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly && (dashboard=='bapelitbang' || dashboard=='superadmin')"/>  
                    <v-col xs="12" sm="4" md="3" v-if="$store.getters['auth/can']('SETTING-USERS-GROUP_BROWSE')">
                        <v-card 
                            min-height="140"
                            class="clickable deep-purple darken-1"
                            color="#385F73" 
                            @click.native="$router.push('/setting/users')"
                            dark>
                            <v-card-title class="headline">
                                USER SISTEM
                            </v-card-title>                        
                            <v-card-text>
                                Modul ini digunakan untuk mengelola user sistem.
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-responsive width="100%" v-if="$vuetify.breakpoint.xsOnly"/>                                  
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
    name:'DashboardAdmin',
    created()
    {
        this.dashboard=this.$store.getters['uiadmin/getDefaultDashboard'];

        this.TOKEN = this.$route.params.token; 
        this.initialize();        
    },
    data: () => ({
        breadcrumbs:[],
        TOKEN:null,
        dashboard:null,

        tahun_anggaran:''
    }),
    methods : {
		initialize:async function()
		{	            
            await this.$ajax.get('/auth/me',                
            {
                headers: {
                    Authorization:'Bearer '+this.TOKEN
                }
            }).then(({data})=>{               
                this.dashboard = data.role[0];    
                this.$store.dispatch('uiadmin/changeDashboard',this.dashboard);                                       

                this.$store.dispatch('uiadmin/init',this.$ajax);              
                this.tahun_anggaran = this.$store.getters['uifront/getTahunAnggaran'];            
            
            })
            .catch(() => {
                this.$store.dispatch('auth/logout');	
                this.$store.dispatch('uifront/reinit');	
                this.$store.dispatch('uiadmin/reinit');	
                this.$router.push('/');
            });                            
        },
        logout ()
        {
            this.loginTime=0;
            this.$ajax.post('/auth/logout',
                {},
                {
                    headers:{
                        'Authorization': this.TOKEN,
                    }
                }
            ).then(()=> {     
                this.$store.dispatch('auth/logout');	
                this.$store.dispatch('uifront/reinit');	
                this.$store.dispatch('uiadmin/reinit');	
                this.$router.push('/');
            })
            .catch(() => {
                this.$store.dispatch('auth/logout');	
                this.$store.dispatch('uifront/reinit');	
                this.$store.dispatch('uiadmin/reinit');	
                this.$router.push('/');
            });
        },
	},
    computed :{
        ...mapGetters('uifront',{
            NamaAPP: 'getNamaAPP',
            NamaAPPAlias: 'getNamaAPPAlias',            
        }),
        ...mapGetters('auth',{
            AUTHENTICATED:'Authenticated',  
            ACCESS_TOKEN:'AccessToken',                            
            ROLE:'Role',
            CAN_ACCESS:'can',         
            ATTRIBUTE_USER:'AttributeUser',               
        }),
        photoUser()
		{
			let img=this.ATTRIBUTE_USER('foto');
			var photo;
			if (img == '')
			{
				photo = this.$api.url+'/storage/images/users/no_photo.png';	
			}
			else
			{
				photo = this.$api.url+'/'+img;	
			}
			return photo;
        },
    }    
}
</script>