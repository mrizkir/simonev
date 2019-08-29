<div class="panel panel-flat border-top-lg border-top-info border-bottom-info">
    <div class="panel-heading">       
        <div class="panel-title">
            <h6 class="panel-title">DAFTAR OPD</h6>
        </div>        
    </div>
    @if (count($dataopd) > 0)
    <div class="table-responsive"> 
        <table id="data" class="table table-striped table-hover">
            <thead>
                <tr class="bg-teal-700">
                    <th width="50">                      
                        ID                                     
                    </th>                     
                    <th width="70">                        
                        TA                          
                    </th>
                    <th>
                        NAMA OPD / SKPD                        
                    </th>
                    <th>NAMA UNIT KERJA</th>
                    <th width="100">LOCKED</th>
                    <th width="100">AKSI</th>
                </tr>
            </thead>
            <tbody>                    
            @foreach ($dataopd as $key=>$item)
                <tr>                   
                    <td>{{$item->useropd}}</td>
                    <td>{{$item->ta}}</td>  
                    <td>{{$item->OrgNm}}</td> 
                    <td>{{empty($item->SOrgNm)?'N.A':$item->SOrgNm}}</td> 
                    <td>
                        <div class="checkbox">
                            {{Form::checkbox("chklocked[]", $item->useropd,$item->locked,['class'=>'switch'])}}  
                        </div>
                    </td>
                    <td>
                        <ul class="icons-list">
                            <li class="text-danger-600">
                                <a class="btnDeleteOPD" href="javascript:;" title="Hapus Data User OPD" data-id="{{$item->useropd}}" data-url="{{route('usersopd.index')}}">
                                    <i class='icon-trash'></i>
                                </a> 
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr class="text-center info">
                    <td colspan="7">
                        <span class="label label-warning label-rounded" style="text-transform: none">
                            <strong>OrgID:</strong>
                            {{$item->OrgID}}
                        </span>
                        <span class="label label-warning label-rounded" style="text-transform: none">
                            <strong>SOrgID:</strong>
                            {{empty($item->SOrgID)?'N.A':$item->SOrgID}}
                        </span>
                    </td>                    
                </tr>
            @endforeach                    
            </tbody>
        </table>               
    </div>
    @else
    <div class="panel-body">
        <div class="alert alert-info alert-styled-left alert-bordered">
            <span class="text-semibold">Info!</span>
            Belum ada data yang bisa ditampilkan.
        </div>
    </div>   
    @endif            
</div>
