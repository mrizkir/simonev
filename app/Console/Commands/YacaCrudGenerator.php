<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use File;
use DB;

class YacaCrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator {name : Class (singular) for example user} {--theme=default} {--create=all} {--icon=icon}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Yaca Create CRUD Operations';

    /**
     * Nama model / controller / view yang akan dibuat 
     *
     * @var string
     */
    protected $name;

    /**
     * theme
     *
     * @var string
     */
    protected $theme;

    /**
     * created view, model, controller, or all of them 
     *
     * @var string
     */
    protected $create;

    /**
     * icon name
     *
     * @var string
     */
    protected $icon;

    /**
     * nama model
     *
     * @var string
     */
    protected $nama_model;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->name = $this->argument('name');
        $this->theme=$this->option('theme');
        $create=$this->option('create');
        $this->icon = $this->option('icon');
        
        $arg=explode('\\',$this->name);
        $this->nama_model = $arg[count($arg)-1];

        switch ($create) 
        {
            case 'model' :
                //call view method
                $this->model();
            break;
            case 'controller' :
                //call view method
                $this->controller();
            break;
            case 'view' :
                //call view method
                $this->view();
            break;
            default :
                //call model method
                $this->model();

                //call controller method
                $this->controller();

                //call view method
                $this->view();
        }        
    }
    public function model () 
    {
        $path=app_path(str_replace($this->nama_model,'','Models\\'.$this->name));        
        $this->makeDirectory($path);
        
        $namespace='App\\'.preg_replace('#\\\\$#','',str_replace($this->nama_model,'','Models\\'.$this->name));

        $modelTemplate = str_replace ([
                                            '{{namespace}}',
                                            '{{modelName}}',
                                            '{{modelNameLower}}'
                                        ],
                                        [
                                            $namespace,
                                            $this->nama_model, 
                                            strtolower($this->nama_model)                       
                                        ],
                                        $this->getStub('Model'));

        $m_file=$path.$this->nama_model.'Model.php';
        file_put_contents ($m_file,$modelTemplate);

        // create permission
        Permission::findOrCreate('browse_'.strtolower($this->nama_model));
        Permission::findOrCreate('read_'.strtolower($this->nama_model));
        Permission::findOrCreate('add_'.strtolower($this->nama_model));
        Permission::findOrCreate('edit_'.strtolower($this->nama_model));
        Permission::findOrCreate('delete_'.strtolower($this->nama_model));

        // call artisan create table
        Artisan::call ('make:migration',['name'=>'create_'.strtolower($this->nama_model).'_table']);

    }
    public function controller () 
    {               
        $path=app_path(str_replace($this->nama_model,'','Controllers\\'.$this->name));    
        $this->makeDirectory($path);
        
        $namespace='App\\'.preg_replace('#\\\\$#','',str_replace($this->nama_model,'','Controllers\\'.$this->name));        
        $controllerTemplate = str_replace ([
                                                '{{namespace}}',
                                                '{{modelnamespace}}',
                                                '{{modelName}}',
                                                '{{modelNameLower}}',
                                                '{{viewName}}'
                                            ],
                                            [
                                                $namespace,
                                                'App\Models\\'.$this->name,
                                                $this->nama_model, 
                                                strtolower($this->nama_model),
                                                "pages.\$theme.".strtolower(str_replace('\\','.',$this->name))
                                            ],
                                            $this->getStub('Controller'));

        $c_file=$path.$this->nama_model.'Controller.php';
        
       file_put_contents ($c_file,$controllerTemplate);
    }

    public function view () 
    {         
        $path=resource_path('views')."\pages\\".$this->theme."\\".strtolower($this->name);        
        $this->makeDirectory($path);
           
        $markup = [
                    '{{controllerName}}', 
                    '{{modelName}}',                                               
                    '{{modelNameUpper}}',
                    '{{modelNameLower}}',
                    '{{viewName}}',
                    '{{primaryKey}}',
                    '{{theme}}',
                    '{{icon}}'
                ];
        $replace_with = [
                            $this->name.'Controller',
                            $this->nama_model,
                            strtoupper($this->nama_model),
                            strtolower($this->nama_model),
                            "pages.".$this->theme.".".strtolower(str_replace('\\','.',$this->name)),
                            strtolower($this->nama_model).'_id',
                            $this->theme,
                            $this->icon                     
                        ];

        //index
        $viewTemplate = str_replace ($markup,$replace_with, $this->getStub('ViewIndex'));
        file_put_contents ($path."\index.blade.php",$viewTemplate);

        //data table
        $viewTemplate = str_replace ($markup,$replace_with, $this->getStub('ViewDataTable'));
        file_put_contents ($path."\datatable.blade.php",$viewTemplate);

        // //create        
        $viewTemplate = str_replace ($markup,$replace_with, $this->getStub('ViewCreate'));
        file_put_contents ($path."\create.blade.php",$viewTemplate);
        
        // //edit
        $viewTemplate = str_replace ($markup,$replace_with, $this->getStub('ViewEdit'));
        file_put_contents ($path."\\edit.blade.php",$viewTemplate);

        // //show
        $viewTemplate = str_replace ($markup,$replace_with, $this->getStub('ViewShow'));
        file_put_contents ($path."\\show.blade.php",$viewTemplate);

        //info
        $viewTemplate = str_replace ($markup,$replace_with, $this->getStub('ViewInfo'));
        file_put_contents ($path."\\info.blade.php",$viewTemplate);

        //error
        $viewTemplate = str_replace ($markup,$replace_with, $this->getStub('ViewError'));
        file_put_contents ($path."\\error.blade.php",$viewTemplate);
    }

    public function getStub ($type) 
    {
        switch ($type)
        {
            case 'ViewIndex':
            case 'ViewDataTable':
            case 'ViewCreate':
            case 'ViewEdit':
            case 'ViewShow':
            case 'ViewInfo':
            case 'ViewError':
                $file_contents=file_get_contents(resource_path("stubs/{$this->theme}/$type.stub"));
            break;
            case 'Model':
            case 'Controller':
                $file_contents=file_get_contents(resource_path("stubs/$type.stub"));;
            break;
            default :
                $file_contents=NULL;
        }
        return $file_contents;
    }

    private function makeDirectory ($path) 
    {
        if (!File::exists($path)) {            
            File::makeDirectory($path,0755,true);
        }
    }
}
