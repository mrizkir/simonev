<template>
    <div>
        <v-system-bar app dark :class="this.$store.getters['uifront/getTheme']('V-SYSTEM-BAR-CSS-CLASS')">        
            <v-spacer></v-spacer>            
            <strong><slot name="system-bar"/></strong>
		</v-system-bar>
        <v-app-bar color="blue" dark app>  
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" :class="this.$store.getters['uifront/getTheme']('V-APP-BAR-NAV-ICON-CSS-CLASS')"></v-app-bar-nav-icon>          
            <v-toolbar-title>
                <span class="hidden-sm-and-down">
                    {{NamaAPPAlias}}
                </span>
            </v-toolbar-title>
            <v-spacer />
            <v-toolbar-items class="hidden-sm-and-down">                
                <v-btn to="/login" color="white" text large>
                    LOGIN
                </v-btn>
            </v-toolbar-items>  
            <v-menu class="hidden-md-and-up" v-if="$vuetify.breakpoint.xsOnly">
                <template v-slot:activator="{ on }">
                    <v-btn icon v-on="on">
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>
                <v-list>                    
                    <v-list-item to="/login">
                        <v-list-item-title>LOGIN</v-list-item-title>
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
        <v-navigation-drawer v-model="drawer" width="300" dark :class="this.$store.getters['uifront/getTheme']('V-NAVIGATION-DRAWER-CSS-CLASS')" :temporary="temporaryleftsidebar" app>
			<v-list-item>
				<v-list-item-avatar>
					<v-img :src="photoUser"></v-img>
				</v-list-item-avatar>
				<v-list-item-content>					
					<v-list-item-title class="title">
						GUEST
					</v-list-item-title>
					<v-list-item-subtitle>
						GUEST
					</v-list-item-subtitle>
				</v-list-item-content>
			</v-list-item>
			<v-divider></v-divider>
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
                <v-list-item class="primary" dark>
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-filter</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>								
                        <v-list-item-title>FILTER</v-list-item-title>
                    </v-list-item-content>		
                </v-list-item>
                <slot name="filtersidebar"/>		     
                <v-list-item class="primary" dark>
                    <v-list-item-icon class="mr-2">
                        <v-icon>mdi-filter</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>								
                        <v-list-item-title>OTHER</v-list-item-title>
                    </v-list-item-content>		
                </v-list-item>          
                <v-list-item>
                    <v-list-item-content>                     
                        <v-btn color="danger" @click.stop="resetCache">
                            RESET CACHE
                        </v-btn>
                    </v-list-item-content>
                </v-list-item>	
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
import { mapGetters } from 'vuex';
export default {
    name:'FrontLayout',      
    props:{
        showrightsidebar:{
            type:Boolean,
            default:true
        },
        temporaryleftsidebar:{
            type:Boolean,
            default:true
        },
    },
    data:()=>({        
        drawer:null,
        drawerRight:null,         
    }), 
    methods:{
        resetCache()
        {
            this.$store.dispatch('uifront/reinit');  
            this.$router.go();
        }
    },
    computed :{
        ...mapGetters('uifront',{
            NamaAPP: 'getNamaAPP',
            NamaAPPAlias: 'getNamaAPPAlias',            
        }),        
        photoUser()
		{
			var photo = this.$api.url+'/storage/images/users/no_photo.png';			
			return photo;
		}
    }
}
</script>