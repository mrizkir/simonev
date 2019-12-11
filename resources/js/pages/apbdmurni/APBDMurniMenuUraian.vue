<template>    
    <li class="nav-item" v-if="apbdmurninotselectedmenu">
        <router-link to="/apbdmurni" class="nav-link" @click.native="changeMenuItem" id="linkAPBDMurni">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>
                APBD MURNI
            </p>
        </router-link>						
    </li>    
    <li class="nav-item has-treeview menu-open" id="liAPBDMurni" v-else>
        <a href="#" class="nav-link active" id="linkAPBDMurni">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>
                APBD MURNI
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" id="ulAPBDMurni">
            <li class="nav-item">
                <router-link to="/apbdmurni/uraian" class="nav-link" @click.native="changeMenuItem">
                    <i class="fas fa-circle nav-icon text-warning"></i>
                    <p>URAIAN</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/apbdmurni/uraian/rencanatarget" class="nav-link" @click.native="changeMenuItem">
                    <i class="fas fa-circle nav-icon text-warning"></i>
                    <p>RENCANA TARGET</p>
                </router-link>
            </li>
        </ul>
    </li>
</template>
<script>
export default {
    mounted()
    {
        this.changeMenuItem();
    },
    methods:
    {
        changeMenuItem()
        {
            var name = this.$router.currentRoute.name;
            switch(name)
            {
                case 'apbdmurniuraian' :
                case 'apbdmurniuraianrencanatarget' :
                    this.apbdmurninotselectedmenu=false;
                break;
                default :
                    this.apbdmurninotselectedmenu=true;
            }
        }
    },
    data: function() 
	{
		return {
            apbdmurninotselectedmenu:true,            
        }
    },
}
</script>