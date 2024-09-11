<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DataSend;
use App\Models\Greetinglog;
use App\Models\Tag;
use App\Models\Receiver;
use App\Notifications\telegramNotification;
use Illuminate\Support\Facades\DB;

use Exception;


class dataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->fetchIds();
        $this->birthdayGreetings();
        $img = DB::table('messageText')->where('id', 2)->first()->messageText;
        $type = DB::table('messageText')->where('id', 3)->first()->messageText;
        $persons = DataSend::all();
        $receivers = Receiver::whereRaw("deleted = 0")->get();
        $blockedReceivers = Receiver::whereRaw("deleted = 1")->get();
        $message = DB::table('messageText')->where('id', 1)->first()->messageText;
        $birthDaymessage = DB::table('birthdaytimes')->where('id', 1)->first()->message;
        $curhour = DB::table('birthdaytimes')->where('id', 1)->first()->hours;
        $curmin = DB::table('birthdaytimes')->where('id', 1)->first()->minutes;
        $curmeridian = DB::table('birthdaytimes')->where('id', 1)->first()->meridian;
        $tags = Tag::whereRaw("id > 4")->get();
        return view("welcome", compact('persons', 'receivers', 'message', 'img', 'blockedReceivers', 'type', 'birthDaymessage', 'curhour', 'curmin', 'curmeridian', 'tags'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new DataSend();
        $data->fullname = $request->fullname;
        $data->birthday = strval($request->bdate);
        $data->save();
        return redirect()->route('home');
    }
    public function addReceiver(Request $request)
    {
        $receiver = new Receiver();
        $receiver->name = $request->fullname;
        $receiver->chat_id = $request->chatid;
        $receiver->save();
        return redirect()->route('home');
    }

    public function deletePerson($id)
    {
        $person = DataSend::find($id);
        $person->delete();
        return redirect()->route('home');
    }
    public function deleteReceiver($id)
    {
        $receiver = Receiver::find($id);
        $receiver->deleted = 1;
        $receiver->selected = 0;
        $receiver->save();
        return redirect()->route('home');
    }
    public function unblockReceiver($id)
    {
        $receiver = Receiver::find($id);
        $receiver->deleted = 0;
        $receiver->save();
        return redirect()->route('home');
    }
    public function sendCustomMessage()
    {
        $txt = DB::table('messageText')->where('id', 1)->first()->messageText;
        $type = DB::table('messageText')->where('id', 3)->first();
        $receivers = Receiver::all();
        $count = 0;



        if (DB::table('receivers')->where('selected', 1)->get()->isEmpty()) {
            toastr()->error("We think that you didn't select any receiver yet", 'Oops! Something went wrong!');
        } else {
            if ($type->messageText == "txt" &&   ($txt == null || $txt == " " || $txt == "")) {
                toastr()->error("We think that your message is empty", 'Oops! Something went wrong!');
            } else {

                foreach ($receivers as $receiver) {
                    $txter = $txt;
                    if ($receiver->deleted == 0  &&  $receiver->selected == 1) {

                        $tags = Tag::whereRaw("id > 4")->get();
                        foreach ($tags as $tag) {

                            $txter = str_replace("[" . $tag->name . "]", $tag->value, $txter);
                        }

                        $currentdate =  now()->toDateString();;
                        $txter = str_replace("[RECEIVER]", $receiver->name, $txter);
                        $txter = str_replace("[TODAY]", $currentdate, $txter);
                        $txter = str_replace("[BIRTHDATE]", "", $txter);
                        $txter = str_replace("[BIRTHNAME]", "", $txter);
                        $txter = str_replace("@", "", $txter);
                        $txter = str_replace("_", " ", $txter);

                        $receiver->notify(new telegramNotification($receiver->chat_id, $txter, "", $type->messageText));
                        $count++;
                    }
                }
                toastr()->success("The message has been sent successfully", "Hooleyaa");
            }
        }

        return redirect()->route('home');
    }
    public function editMessage($id)
    {
        DB::table('messageText')->where('id', 1)->update(['messageText' => request('txt')]);
        return json_encode(array('statusCode' => 200));
        //return redirect()->route('home');
    }


    public function selectReceiver($id)
    {
        $receiver = Receiver::find($id);
        $receiver->selected = request('select');
        $receiver->save();
        return json_encode(array('statusCode' => 200, 'selection' => $receiver->selected));
    }


    public function modifyBirthParams()
    {
        DB::table('birthdaytimes')->where('id', 1)->update(['hours' => request('hours'), 'minutes' => request('minutes'), 'meridian' => request('meridian'), 'message' => request('message')]);
        return json_encode(array('statusCode' => 200));
        # code...
    }



    public function birthdayGreetings()
    {
        $persons = DataSend::all();
        $receivers = Receiver::all();
        $currentdate =  now()->toDateString();
        $currentdatetime = now()->toTimeString();

        //-----------------------------------------------------------------------------------
        $message = DB::table('birthdaytimes')->where('id', 1)->first()->message;
        $notifHour = DB::table('birthdaytimes')->where('id', 1)->first()->hours;
        $notifmin = DB::table('birthdaytimes')->where('id', 1)->first()->minutes;
        $notifmerid =  DB::table('birthdaytimes')->where('id', 1)->first()->meridian;
        //-----------------------------------------------------------------------------------
        $currentHour = DB::table('birthdaytimes')->selectRaw('TIME_FORMAT(CURRENT_TIME,"%h") AS h')->first()->h;
        $currentmin = DB::table('birthdaytimes')->selectRaw('TIME_FORMAT(CURRENT_TIME,"%i") AS m')->first()->m;
        $currentmerid = Carbon::parse($currentdatetime)->format("a");

        //-----------------------------------------------------------------------------------------------------
        if ($notifHour == $currentHour &&  intval($notifmin) <= intval($currentmin) && strtolower($notifmerid) ==  strtolower($currentmerid)) {


            foreach ($persons as $person) {
                if (Carbon::parse($person->birthday)->format('M') == Carbon::parse($currentdate)->format('M') && Carbon::parse($person->birthday)->format('d') == Carbon::parse($currentdate)->format('d')) {
                    if (Greetinglog::whereRaw('personId = ' . $person->id . ' and year =' . Carbon::parse($currentdate)->format('Y'))->get()->isEmpty()) {
                        # code...
                        if (DB::table('receivers')->where('selected', 1)->get()->isEmpty()) {
                            // toastr()->error($person->fullname." have a birthday today but no one will know about it 😔",'Oops! Something went wrong!');
                        } else {
                            foreach ($receivers as $receiver) {
                                if ($receiver->selected == 1 && $receiver->deleted == 0) {
                                    $newmessage = $message;
                                    $tags = Tag::whereRaw("id > 4")->get();
                                    foreach ($tags as $tag) {

                                        $newmessage = str_replace("[" . $tag->name . "]", $tag->value, $newmessage);
                                    }

                                    $newmessage = str_replace("[BIRTHNAME]", $person->fullname, $newmessage);
                                    $newmessage = str_replace("[BIRTHDATE]", $person->birthday, $newmessage);
                                    $newmessage = str_replace("[RECEIVER]", $receiver->name, $newmessage);
                                    $newmessage = str_replace("[TODAY]", $currentdate, $newmessage);
                                    $newmessage = str_replace("@", "",  $newmessage);
                                    $newmessage = str_replace("_", " ",  $newmessage);


                                    $receiver->notify(new telegramNotification($receiver->chat_id, $newmessage, "-", "txt"));
                                }
                            }
                            $greeting = new Greetinglog;
                            $greeting->personId = $person->id;
                            $greeting->year = Carbon::parse()->format('Y');
                            $greeting->save();
                        }
                    }
                }
            }
        }


        return redirect()->route('home');
    }







    public function fetchIDs()
    {

        $api_key = "5915262685:AAHJmaij49RZnc1Ncqw4faTo7GlAtPxS_Mw";
        $method = "/getUpdates";
        $url = "https://api.telegram.org/bot" . $api_key . $method;
        $json = json_decode(file_get_contents($url), true);
        $i = 0;
        foreach ($json["result"]  as $result) {
            if (array_key_exists("message", $json["result"][$i])) {
                if ($json["result"][$i]["message"]["chat"]["type"] == "group") {
                    $data = Receiver::firstOrCreate(
                        ['chat_id' => $json["result"][$i]["message"]["chat"]["id"]],
                        ['name' => $json["result"][$i]["message"]["chat"]["title"]]
                    );
                } else {
                    $data = Receiver::firstOrCreate(
                        ['chat_id' => $json["result"][$i]["message"]["chat"]["id"]],
                        ['name' => $json["result"][$i]["message"]["chat"]["username"]]
                    );
                }
            }
            $i++;
        }
    }


    public function fetchIDsAjax()
    {

        $api_key = "5915262685:AAHJmaij49RZnc1Ncqw4faTo7GlAtPxS_Mw";
        $method = "/getUpdates";
        $url = "https://api.telegram.org/bot" . $api_key . $method;
        $json = json_decode(file_get_contents($url), true);
        $i = 0;
        $new = false;
        foreach ($json["result"]  as $result) {
            if (array_key_exists("message", $json["result"][$i])) {
                if ($json["result"][$i]["message"]["chat"]["type"] == "group") {
                    if (Receiver::where('chat_id', "=",  $json["result"][$i]["message"]["chat"]["id"])->get()->isEmpty()) {
                        $new = true;
                        $data = Receiver::firstOrCreate(
                            ['chat_id' => $json["result"][$i]["message"]["chat"]["id"]],
                            ['name' => $json["result"][$i]["message"]["chat"]["title"]]
                        );
                    }
                } else {


                    if (Receiver::where('chat_id', "=", $json["result"][$i]["message"]["chat"]["id"])->get()->isEmpty()) {
                        $new = true;

                        $data = Receiver::firstOrCreate(
                            ['chat_id' => $json["result"][$i]["message"]["chat"]["id"]],
                            ['name' => $json["result"][$i]["message"]["chat"]["username"]]
                        );
                    }
                }
            }
            $i++;
        }


        return json_encode(array('new' => $new));
    }













    public function modifyImage($id)
    {
        try {
            $img = DB::table('messageText')->where('id', $id)->first();

            $txt = request('url');

            DB::update("update messageText set `messageText` = '" . request('url') . "' where id = 2");
            unlink(public_path('images') . "/" . scandir(public_path('images'))[2]);
            //  File::deleteDirectory();
            return json_encode(array('statusCode' => 200));
        } catch (Exception $e) {
            return json_encode(array('errorMessage' => $e->getMessage()));
        }
    }


    public function modifyType($id)
    {
        $type = request('type');
        DB::update("update messageText set `messageText` = '" . request('type') . "' where id = 3");
        return json_encode(array('statusCode' => 200));
    }


    public function sendCustomePhoto()
    {
        $receivers = Receiver::all();
        $count = 0;

        foreach ($receivers as $receiver) {
            if ($receiver->deleted == 0  &&  $receiver->selected == 1) {
                // public_path('images')."/".scandir(public_path('images'))[2])
                $receiver->notify(new telegramNotification($receiver->chat_id, "", "-", ""));
                $count++;
            }
        }
        if ($count == 0) {
            toastr()->error("We think that you didn't select any receiver yet", 'Oops! Something went wrong!');
        }
        return redirect()->route('home');
    }
    public function getTags()
    {
        try {
            $tags = Tag::all();
            return json_encode(array('tags' => $tags));
        } catch (Exception $e) {

            return json_encode(array('message' => $e->getMessage()));
        }
    }


    public function insertTag()
    {
        $data = new Tag();
        $data->name = request("tagname");
        $data->save();
    }

    public function updateTagVal($tagname)
    {

        DB::table('tags')->where('name', $tagname)->update(['value' => request('tagvalue')]);
    }

    public function deleteTag($tagname)
    {

        DB::table('tags')->where('name', $tagname)->delete();
    }


    //--------------------------------------testing method

    public function toTest()
    {
        return view("test");
    }
}
