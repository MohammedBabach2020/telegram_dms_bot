<?php

namespace App\Console\Commands;
use App\Models\Greetinglog;
use Carbon\Carbon;
use App\Models\TAG;
use App\Models\Receiver;
use App\Notifications\telegramNotification;
use App\Models\DataSend;
use NotificationChannels\Telegram\TelegramUpdates;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class SendBirthdayTelegram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendtelegram:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a happy birthday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         
        $persons = DataSend::all();
        $receivers= Receiver::all();
        $currentdate = DB::table('birthdaytimes')->selectRaw('CURRENT_DATE AS c')->first()->c ;
        $currentdatetime = DB::table('birthdaytimes')->selectRaw('CURRENT_TIME AS ct')->first()->ct;
        
        //-----------------------------------------------------------------------------------
        $message= DB::table('birthdaytimes')->where('id', 1)->first()->message;
        $notifHour= DB::table('birthdaytimes')->where('id', 1)->first()->hours ;
        $notifmin= DB::table('birthdaytimes')->where('id', 1)->first()->minutes ;
        $notifmerid =  DB::table('birthdaytimes')->where('id', 1)->first()->meridian ;
        //-----------------------------------------------------------------------------------
        $currentHour= DB::table('birthdaytimes')->selectRaw('TIME_FORMAT(CURRENT_TIME,"%h") AS h')->first()->h ;
        $currentmin=DB::table('birthdaytimes')->selectRaw('TIME_FORMAT(CURRENT_TIME,"%i") AS m')->first()->m ;
        $currentmerid = Carbon::parse($currentdatetime)->format("a");
        
        //-----------------------------------------------------------------------------------------------------
            if ($notifHour==$currentHour &&  intval($notifmin) <= intval($currentmin) && strtolower($notifmerid) ==  strtolower($currentmerid)) {
        
            
          foreach ($persons as $person) {
            if (Carbon::parse($person->birthday)->format('M') == Carbon::parse($currentdate)->format('M') && Carbon::parse($person->birthday)->format('d') ==Carbon::parse($currentdate)->format('d')) {
                if (Greetinglog::whereRaw('personId = '.$person->id.' and year ='.Carbon::parse($currentdate)->format('Y'))->get()->isEmpty()) {
                             # code...
                if (DB::table('receivers')->where('selected', 1)->get()->isEmpty()) {
                    // toastr()->error($person->fullname." have a birthday today but no one will know about it 😔",'Oops! Something went wrong!');
                }
                else{
                    foreach ($receivers as $receiver) {
                        if ($receiver->selected == 1 && $receiver->deleted == 0) {    
                            $newmessage = $message;
                            $tags= Tag::whereRaw("id > 4")->get();
                            foreach ($tags as $tag) {
                           
                                $newmessage= str_replace("[".$tag->name."]",$tag->value,$newmessage) ;
                            }

                            $newmessage = str_replace("[BIRTHNAME]",$person->fullname,$newmessage);   
                            $newmessage = str_replace("[BIRTHDATE]",$person->birthday,$newmessage);   
                            $newmessage = str_replace("[RECEIVER]",$receiver->name,$newmessage);   
                            $newmessage = str_replace("[TODAY]",$currentdate,$newmessage);   
                            $newmessage = str_replace("@","",  $newmessage) ;
                            $newmessage = str_replace("_"," ",  $newmessage) ;
                          

                            $receiver->notify(new telegramNotification($receiver->chat_id, $newmessage,"-","txt"));                         
                        }   
                        }
                        $greeting = new Greetinglog ;
                        $greeting->personId = $person->id;
                        $greeting->year = Carbon::parse()->format('Y');
                        $greeting->save();
                   }
                   }
                   }
                   }
               
            }
       
 
    }
}
