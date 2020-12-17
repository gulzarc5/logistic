<?php

use App\Docate;
use App\City;
use App\Content;
use App\DocateDetails;
use App\DocateHistory;
use App\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class DocateEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Truncating State Table');
        // State::truncate();
        $payment_type_array = ['c','cod','cash']; 
        $mode = ['Air','Train','Road']; 
        $branch_ids = [3,10]; 
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) { 
            $docate = new Docate();    
            $docate->payment_option =$payment_type_array[rand(0,2)];
            if ($docate->payment_option == 'cod' || $docate->payment_option == 'cash' ) {
                $docate->collecting_amount = rand(1000,9999);
            }

            $cn_no = 'CN'.rand(1111,9999);
            $docate->send_mode = $mode[rand(0,2)];
            $docate->docate_id=$cn_no;
            $docate->no_of_box = rand(1,4);        
            $docate->actual_weight = rand(5,100);
            $docate->chargeable_weight = rand(5,100);
            $docate->invoice_value = rand(5,100);
            $docate->invoice_no = rand(5,100);
            $docate->branch_id = $branch_ids[rand(0,1)];
            $docate->pickup_date =Carbon::today()->toDateString();
            $docate->pickup_time = Carbon::today()->toTimeString();
            if($docate->save()){
                //Sender Details Insert
                $city_id = 1;
                $city_data = City::find($city_id);

                $docate_details = new DocateDetails();
                $docate_details->docate_id=$docate->id;
                $docate_details->name = $faker->name;
                $docate_details->state = isset($city_data->state->id) ? $city_data->state->id : null;
                $docate_details->city = $city_id;
                $docate_details->pin = rand(111111,999999);
                $docate_details->address = $faker->address();
                $docate_details->save();
                if($docate_details->save()){
                    $docate->sender_id = $docate_details->id;                
                    $docate->save();
                }

                // Receiver Details Insert
                $city_id = 2;
                $city_data = City::find($city_id);

                $docate_details = new DocateDetails();
                $docate_details->docate_id=$docate->id;
                $docate_details->state = isset($city_data->state->id) ? $city_data->state->id : null;
                $docate_details->city = $city_id;
                $docate_details->name = $faker->name;
                $docate_details->pin = rand(111111,999999);
                $docate_details->address = $faker->address();
                $docate_details->save();
                if($docate_details->save()){
                    $docate->receiver_id = $docate_details->id;
                    $docate->save();
                }

                // Docate History Insert
                $docate_history = new DocateHistory();
                $docate_history->docate_id = $docate->docate_id;
                $docate_history->data_id = $docate->id;
                $docate_history->type=1;
                $docate_history->comments = "Docate Booked";
                $docate_history->save();

                for ($j=0; $j < $docate->no_of_box; $j++) { 
                    $contents= new Content();
                    $contents->docate_id = $docate->id;
                    $contents->content = $faker->paragraph($nbSentences = 5, $variableNbSentences = true);
                    $contents->length = rand(50,200);
                    $contents->breadth = rand(50,200);
                    $contents->height = rand(50,200);
                    $contents->total = rand(50,200);
                    $contents->save();
                }                
            }
            $this->command->line($i." Docate Booked");
        }
        $this->command->line('Seeding Successfull');
        
    }
}
