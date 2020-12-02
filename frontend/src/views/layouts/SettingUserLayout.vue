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
                <v-list-item :to="{path:'/setting/users'}" v-if="CAN_ACCESS('SETTING-USERS-GROUP')" link class="yellow" color="green" >
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-home-floor-b</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>BOARD USERS</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>       
                <v-subheader v-if="CAN_ACCESS('PERMISSIONS_BROWSE')">HAK AKSES</v-subheader>         
                <v-list-item link v-if="CAN_ACCESS('PERMISSIONS_BROWSE')" to="/setting/users/permissions">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account-key</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            PERMISSIONS
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link v-if="CAN_ACCESS('ROLES_BROWSE')" to="/setting/users/roles">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account-group</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            ROLES
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-subheader>PENGGUNA</v-subheader>       
                <v-list-item link v-if="CAN_ACCESS('USERS_BROWSE')" to="/setting/users/superadmin">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            USER SUPERADMIN
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link v-if="CAN_ACCESS('USERS BAPELITBANG_BROWSE')" to="/setting/users/bapelitbang">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            USERS BAPELITBANG
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>  
                <v-list-item link v-if="CAN_ACCESS('USERS OPD_BROWSE')" to="/setting/users/opd">
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-account</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            USERS OPD
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
					<v-btn dark icon href="https://github.com/mrizkir/simonev-vuetify">
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
    name:'SettingUserLayout',  
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
}
</script>