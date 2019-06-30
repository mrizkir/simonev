<?php
Route::group (['prefix'=>'v0'],function() {

});
Route::group (['prefix'=>'v1','middleware'=>['auth:api']],function() {     
    
});