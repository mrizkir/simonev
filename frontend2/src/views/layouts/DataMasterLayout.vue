<template>
    <div>
        <v-system-bar app dark :class="this.$store.getters['uifront/getTheme']('V-SYSTEM-BAR-CSS-CLASS')">        
            <v-spacer></v-spacer>            
            <strong><slot name="system-bar"/></strong>
		</v-system-bar>
        <v-app-bar color="blue" dark app>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" class="grey--text" :class="this.$store.getters['uifront/getTheme']('V-APP-BAR-NAV-ICON-CSS-CLASS')"></v-app-bar-nav-icon>
            <v-toolbar-title class="headline clickable" @click.stop="$router.push('/dashboard/'+$store.getters['auth/AccessToken']).catch(err => {})">
				<span class="hidden-sm-and-down">
                    {{NamaAPPAlias}}
                </span>
			</v-toolbar-title>
            <v-spacer></v-spacer>                        
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
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
			<v-app-bar-nav-icon @click.stop="drawerRight = !drawerRight">
                <v-icon>mdi-menu-open</v-icon>
			</v-app-bar-nav-icon>            
        </v-app-bar>    
        <v-navigation-drawer v-model="drawer" width="300" dark :class="this.$store.getters['uifront/getTheme']('V-NAVIGATION-DRAWER-CSS-CLASS')" app>
			<v-list-item>
				<v-list-item-avatar>
					<v-img :src="photoUser" @click.stop="toProfile"></v-img>
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
			<v-divider></v-divider>
            <v-list expand>
                <v-list-item :to="{path:'/dmaster'}" v-if="CAN_ACCESS('DMASTER-GROUP')" link class="yellow" color="green" >
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-home-floor-b</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>BOARD DATA MASTER</v-list-item-title>
                    </v-list-item-content>
                </v-list-item> 
                <v-subheader>KODEFIKASI</v-subheader>
                <v-list-item link v-if="CAN_ACCESS('URUSAN_BROWSE')" to="/dmaster/kodefikasi/urusan">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-group</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            URUSAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>   
                <v-list-item link v-if="CAN_ACCESS('BIDANG-URUSAN_BROWSE')" to="/dmaster/kodefikasi/bidangurusan">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-group</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            BIDANG URUSAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>   
                <v-subheader>KEGIATAN</v-subheader>                
                <v-list-item link v-if="CAN_ACCESS('JENIS PELAKSANAAN_BROWSE')" to="/dmaster/jenispelaksanaan">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-road</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            JENIS PELAKSANAAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>   
                <v-list-item link v-if="CAN_ACCESS('JENIS PEMBANGUNAN_BROWSE')" to="/dmaster/jenispembangunan">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-shovel</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            JENIS PEMBANGUNAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>      
                <v-subheader>REKENING</v-subheader>         
                <v-list-item link to="/dmaster/rekening/transaksi" v-if="CAN_ACCESS('OPD_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-decimal</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            TRANSAKSI
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link to="/dmaster/rekening/kelompok" v-if="CAN_ACCESS('OPD_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-decimal</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            KELOMPOK
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link to="/dmaster/rekening/jenis" v-if="CAN_ACCESS('OPD_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-decimal</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            JENIS
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link to="/dmaster/rekening/rincian" v-if="CAN_ACCESS('OPD_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-decimal</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            RINCIAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link to="/dmaster/rekening/objek" v-if="CAN_ACCESS('OPD_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-decimal</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            OBJEK
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-subheader>ORGANISASI</v-subheader>
                <v-list-item link to="/dmaster/opd" v-if="CAN_ACCESS('OPD_BROWSE')">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-office-building</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            OPD
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link v-if="CAN_ACCESS('UNIT KERJA_BROWSE')" to="/dmaster/unitkerja">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-domain</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            UNIT KERJA
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>                   
                <v-subheader>PEGAWAI</v-subheader>
                <v-list-item link v-if="CAN_ACCESS('ASN_BROWSE')" to="/dmaster/asn">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account-circle-outline</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            ASN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link v-if="CAN_ACCESS('PEJABAT_BROWSE')" to="/dmaster/pejabat">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account-circle</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            PEJABAT
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-subheader>LAIN-LAIN</v-subheader>
                <v-list-item link v-if="CAN_ACCESS('SUMBER DANA_BROWSE')" to="/dmaster/sumberdana">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-cash-100</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            SUMBER DANA
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link v-if="CAN_ACCESS('TA_BROWSE')" to="/dmaster/ta">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-calendar-month</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            TAHUN ANGGARAN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-navigation-drawer v-model="drawerRight" width="300" app fixed right temporary v-if="showrightsidebar">
            <v-list dense>
                <v-list-item>		
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-menu-open</v-icon>
                    </v-list-item-icon>			
                    <v-list-item-content>									
                        <v-list-item-title class="title">
                            OPTIONS
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item class="teal lighten-5 mb-5">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-filter</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>								
                        <v-list-item-title>FILTER</v-list-item-title>
                    </v-list-item-content>		
                </v-list-item>
                <slot name="filtersidebar"/>		                	
            </v-list>
		</v-navigation-drawer>
        <v-main class="mx-4 mb-4">			
			<slot />
		</v-main>
        <v-footer app padless fixed dark>
			<v-card class="flex" flat tile>
				<v-divider></v-divider>
				<v-card-text class="py-2 white--text text-center">
					<strong>{{NamaAPP}} (2019-2020)</strong> dikembangkan oleh TIM IT BAPELITBANG KAB. Bintan. 
					<v-btn dark icon href="https://github.com/mrizkir/simonev">
						<v-icon>mdi-github</v-icon>
					</v-btn>					
				</v-card-text>
			</v-card>			
		</v-footer>
    </div>    
</template>
<script>
import {mapGetters} from 'vuex';
export default {
    name: 'DataMasterLayout',  
    props:{
        showrightsidebar:{
            type:Boolean,
            default:true
        }
    },      
    data:()=>({
        loginTime:0,
        drawer:null,
        drawerRight:null,   
    }),       
    methods: {        
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
    computed:{
        ...mapGetters('auth',{
            AUTHENTICATED:'Authenticated',  
            ACCESS_TOKEN:'AccessToken',          
            TOKEN:'Token',          
            ROLE:'Role',
            CAN_ACCESS:'can',         
            ATTRIBUTE_USER:'AttributeUser',               
        }),
        ...mapGetters('uifront',{
            NamaAPP: 'getNamaAPP',
            NamaAPPAlias: 'getNamaAPPAlias',            
        }),        
        photoUser() {
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
    },
    watch: {
        loginTime:{
            handler(value)
            {
                
                if (value >= 0)
                {
                    setTimeout(() => { 
                        this.loginTime=this.AUTHENTICATED==true?this.loginTime+1:-1;                                                                     
					}, 1000);
                }
                else
                {
                    this.$store.dispatch('auth/logout');
                    this.$router.replace('/login');
                }
            },
            immediate:true
        },        
    }
};
</script>