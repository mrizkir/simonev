<script>
import {Line} from 'vue-chartjs';

export default {
    name:'ChartTargetRealisasi',
    extends: Line,

    props:{
        datagrafik:{
            type:Array,            
        },     
    },   
    mounted() 
    {
        this.chartdata.datasets[0].data=this.datagrafik[0];
        this.chartdata.datasets[1].data=this.datagrafik[1];
        this.renderChart(this.chartdata, this.options);
    },
    data:() => ({
        chartdata:{
            labels: ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER'],
            datasets:[
                {     
                    label: 'TARGET',         
                    fill:false,
                    data: [],   
                    borderColor: '#A71C6F',                                                       
                    borderWidth: 1,                    
                },
                {
                    label: 'REALISASI',                             
                    data:[],
                    fill:false,
                    borderColor: '#FF9800',
                    borderWidth: 1, 
                }
            ],            
        },    
        options:{
            responsive:true,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'BULAN'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'TARGET & REALISASI'
                    }
                }]
            },                                 
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            maintainAspectRatio: false,
        }  
    })
}
</script>