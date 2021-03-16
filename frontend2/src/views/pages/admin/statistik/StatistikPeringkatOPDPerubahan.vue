<template>
    <BelanjaPerubahanLayout :showrightsidebar="false">
        <template v-slot:system-bar>
            Tahun Anggaran: {{$store.getters['uifront/getTahunAnggaran']}} | Bulan Realisasi:{{$store.getters['uifront/getNamaBulan']}}
        </template>
        <ModuleHeader>
            <template v-slot:icon>
                mdi-chart-timeline-variant
            </template>
            <template v-slot:name>
                PERINGKAT OPD PERUBAHAN
            </template>
            <template v-slot:breadcrumbs>
                <v-breadcrumbs :items="breadcrumbs" class="pa-0">
                    <template v-slot:divider>
                        <v-icon>mdi-chevron-right</v-icon>
                    </template>
                </v-breadcrumbs>
            </template>
            <template v-slot:desc>
                <v-alert                                        
                    color="cyan"
                    border="left"                    
                    colored-border
                    type="info"
                    >
                    Berisi peringkat progres realisasi fisik dan keuangan terakhir OPD 
                </v-alert>
            </template>
		</ModuleHeader>
        <v-container fluid>
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-card>
                        <v-card-text>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-database-search"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
            <v-row class="mb-4" no-gutters>
                <v-col cols="12">
                    <v-data-table
                        :headers="headers"
                        :items="datatable"
                        item-key="kode_organisasi" 
                        :search="search"
                        :loading="datatableLoading"
                        loading-text="Loading... Please wait"                        
                        class="elevation-1"
                        :disable-pagination="true"
                        :hide-default-footer="true"
                        dense >
                        <template v-slot:top>
                            <v-toolbar flat color="white">
                                <v-toolbar-title>PERINGKAT OPD</v-toolbar-title>
                                <v-divider
                                    class="mx-4"
                                    inset
                                    vertical
                                ></v-divider>
                                <v-spacer></v-spacer>
                            </v-toolbar>
                        </template> 
                        <template v-slot:item.RealisasiFisik2="{ item }">                            
                            {{ item.RealisasiFisik2|makeLookPrecision }}
                        </template>                                
                        <template v-slot:item.PersenRealisasiKeuangan2="{ item }">                            
                            {{ item.PersenRealisasiKeuangan2|makeLookPrecision }}
                        </template>                                                                 
                        <template v-slot:no-data>                            
                            data peringkat opd tidak tersedia.
                        </template>
                    </v-data-table>
                </v-col>
            </v-row>
		</v-container>		
    </BelanjaPerubahanLayout>
</template>
<script>
import BelanjaPerubahanLayout from '@/views/layouts/BelanjaPerubahanLayout';
import ModuleHeader from '@/components/ModuleHeader';
export default {
    name: 'StatistikPeringkatOPDPerubahan',
    created()
	{
		this.breadcrumbs = [
            {
                text:'HOME',
                disabled:false,
                href:'/dashboard/'+this.$store.getters['auth/AccessToken']
            },
            {
                text:'BELANJA PERUBAHAN',
                disabled:false,
                href:'/belanjaperubahan'
            },
            {
                text:'STATISTIK',
                disabled:false,
                href:'#'
            },
            {
                text:'PERINGKAT OPD',
                disabled:true,
                href:'#'
            }
        ];
        
        this.initialize();  		
    },
    data:()=>({
        search:'',
        datatableLoading:false,
        peringkat:[],
        headers: [                        
            { text: 'NOMOR', value: 'index',width:100},   
            { text: 'KODE', value: 'kode_organisasi',width:100, sortable:false,},   
            { text: 'NAMA OPD', value: 'OrgNm',sortable:false},                   
            { text: 'REALISASI FISIK', align:'end', value: 'RealisasiFisik2'},                   
            { text: 'REALISASI KEUANGAN', align:'end',value: 'PersenRealisasiKeuangan2'},            
        ],
    }),
    methods : {
		initialize:async function() {
            this.datatableLoading = true;
            await this.$ajax.post('/belanjaperubahan/statistik/peringkatopd',
                {
                    tahun:this.$store.getters['uifront/getTahunAnggaran'],                                                            
				},
                {
                    headers:{
                        Authorization: this.$store.getters["auth/Token"]
                    }
                }
				
            ).then(({data})=>{    
                this.peringkat=data.peringkat;
                this.datatableLoading = false;
            });		
        },        
	},
    computed:{
        datatable()
        {
            return this.peringkat.map((items,index)=>({
                ...items,
                index:index+1
            }));
        }
    },
    components: {
        BelanjaPerubahanLayout,		
        ModuleHeader,
	}
};
</script>
