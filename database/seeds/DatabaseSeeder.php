<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            ['priority'=>'urgent',
            
            // 'created_at'=>date("Y-m-d H:i:s"),

            // 'updated_at'=>date("Y-m-d H:i:s") 
            ],           
            ['priority'=>'important',
            
            ],
            ['priority'=>'ignore',
            
            ],
            ['priority'=>'optional',
        
            ]
        ]);    
    }
}
