<?php

namespace App\Notifications;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramFile;

use App\Models\DataSend;
use App\Models\Receiver;
use DB;
class telegramNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public string $chatid  ;
    public  $content ;
    public string $imgpath ;
    public string $type ;


    public function __construct(string $chatid,$content,string $imgpath,string $type)
    {
        $this->chatid = $chatid;
        $this->content = $content;
        $this->imgpath = $imgpath;
        $this->type = $type;
    }



    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
    
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        return $output_file; 
    }

    public function toTelegram($notifiable)
    {
if ($this->content == null ) {
    $this->content ="";
}


        if ($this->type == "txt") {
            return  TelegramMessage::create()
            ->to($this->chatid)
            ->content($this->content)  ;
        }
        else if($this->type == "pic") {
            $img = DB::table('messageText')->where('id', 2)->first()->messageText;
            $imgt =$this->base64_to_jpeg($img,"pic.jpeg");
            return  TelegramFile::create()
            ->to($this->chatid)
            ->content($this->content)  
            ->file($imgt, 'photo');
        }
      

   
     
    }

}
