<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Pool,Branch, Branch_User, Designation, Designation_User, User};
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\LazyCollection;

class UserController extends Controller
{
    public function index(Request $req)
    {
        // dd('vfr');
        $path = $req->file('file')->store('upload', ['disk' => 'upload']);
        $user = (new FastExcel())->import($path);

        LazyCollection::make(function() use (&$user) 
        {
            $data = $user;
            foreach ($data as $line) 
            {
                yield $line;
            }
        })
            ->chunk(500)
            ->each(function ($line) 
            {
                foreach ($line as $line) 
                {
                    $pool = new Pool();
                   $designation=new Designation();
                    $poolID = $pool->updateOrCreate([

                        'pool_name' => $line['Pool'],
                    
                    ]);

                    // branch 

                    $branchID = Branch::updateOrcreate(

                        [
                            'branch_code'=> $line['Branch Code'],
                        ],
                        [
                          'branch_name'=> $line['Branch Detail'],
                          'pool_id'=>$poolID->id,
                        ]
                    );


                    // ********** Salesman ***********

                    
                    $salesmanID = $designation->updateOrcreate([
                            'designation_name'=>'Van Salesman',
                        ],
                    );

                    $vansales = User::updateOrCreate([
                        'code' => $line['Van Salesman Code'],
                        'name' => $line['Van Salesman Name'],
                        'mobile' => $line['Van Salesman Mobile'],
                        'password' => $line['Van Salesman Password'],
                        'designation_id' => $salesmanID->id,
                      ]);

                      $branchuser = Branch_User::updateOrCreate([

                        'user_id' => $vansales->id,
                        'branch_id' =>  $branchID->id,
                        
                       ]);


                       

                    // ********* Supervisor ***********



                    $supervisorID = $designation->updateOrcreate([
                        'designation_name'=>'Supervisor',
                    ],
                    );

                    $Supervisor = User::updateOrCreate([
                        'code' => $line['Supervisor Code'],
                        'name' => $line['Supervisor Name'],
                        'mobile' => $line['Supervisor Mobile'],
                        'password' => $line['Supervisor Password'],
                        'designation_id' => $supervisorID->id,
                      ]);

                      $branchuser = Branch_User::updateOrCreate([

                        'user_id' => $Supervisor->id,
                        'branch_id' =>  $branchID->id,
                        
                       ]);

                       $des_user = Designation_User::updateOrCreate([

                        'user_id' => $vansales->id,
                        'manager_id' =>  $Supervisor->id,
                        
                       ]);



                    // ********** channel manager **********

                    $channelmanagerID = $designation->updateOrcreate([
                        'designation_name'=>'Channel Manager',
                    ],
                    );

                    $channelmanager = User::updateOrCreate([
                        'code' => $line['Channel Manager Code'],
                        'name' => $line['Channel Manager Name'],
                        'mobile' => $line['Channel Manager Mobile'],
                        'password' => $line['Channel Manager Password'],
                        'designation_id' => $channelmanagerID->id,
                      ]);

                      $branchuser = Branch_User::updateOrCreate([

                        'user_id' =>  $channelmanager->id,
                        'branch_id' =>  $branchID->id,
                        
                       ]);

                       $des_user = Designation_User::updateOrCreate([

                        'user_id' =>  $Supervisor->id,
                        'manager_id' =>  $channelmanager->id,
                       ]);


                    // *********** RSM ************

                    $RSMID = $designation->updateOrcreate([
                       'designation_name'=>'RSM',
                    ],
                    );

                 $RSM = User::updateOrCreate([
                    'code' => $line['RSM Code'],
                    'name' => $line['RSM Name'],
                    'mobile' => $line['RSM Mobile'],
                    'password' => $line['RSM Password'],
                    'designation_id' => $RSMID->id,
                  ]);

                  $branchuser = Branch_User::updateOrCreate([

                    'user_id' =>  $RSM->id,
                    'branch_id' =>  $branchID->id,
                  
                   ]);

                   $des_user = Designation_User::updateOrCreate([

                    'user_id' => $channelmanager->id,
                    'manager_id' => $RSM->id,
                   ]);



                // ******** CDM *********


                 $CDMID = $designation->updateOrcreate([
                     'designation_name'=>'CDM',
                 ],
                 );

               $CDM = User::updateOrCreate([
                'code' => $line['CDM Code'],
                'name' => $line['CDM Name'],
                'mobile' => $line['CDM Mobile'],
                'password' => $line['CDM Password'],
                'designation_id' => $CDMID->id,
                
                 ]);

                 $branchuser = Branch_User::updateOrCreate([

                    'user_id' => $CDM->id,
                    'branch_id' =>  $branchID->id,
                    
                   ]);

                   $des_user = Designation_User::updateOrCreate([

                    'user_id' =>  $RSM->id,
                    'manager_id' =>  $CDM->id,
                   ]);














                    


            }

        });
    }
}