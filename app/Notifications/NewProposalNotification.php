<?php

namespace App\Notifications;

use App\Models\Freelancer;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Routing\Route;

class NewProposalNotification extends Notification
{
    use Queueable;
    protected $freelancer ;
    protected $proposal ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal,User $freelancer)
    {
        $this->proposal=$proposal ;
        $this->freelancer= $freelancer ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail','broadcast','vonage'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $body= sprintf('%s has applied for a job %s', $this->freelancer->name ,$this->proposal->project->title) ;

        return (new MailMessage)
                    ->subject('New Proposal')
                    ->from('Wazzufny@info','Wazzufny')
                    ->greeting('hello ' .$notifiable->name)
                    ->line($body)  
                    ->action('View The Proposal', route('project.show',$this->proposal->project_id))
                    ->line('Thank you for using our application!');
    }

    public function toBroadcast($notifiable)
    {
        $body= sprintf('%s has applied for a job %s', $this->freelancer->name ,$this->proposal->project->title) ;
        return [ 
            'title'=> 'New Proposal' ,
            'body'=> $body ,
            'icon'=> 'icon-material-outline-group' ,
            'url'=> route('project.show',$this->proposal->project_id) ,
        ] ;
    }

    
    public function toDatabase($notifiable)
    {
        $body= sprintf('%s has applied for a job %s', $this->freelancer->name ,$this->proposal->project->title) ;
        return [ 
            'title'=> 'New Proposal' ,
            'body'=> $body ,
            'icon'=> 'icon-material-outline-group' ,
            'url'=> route('project.show',$this->proposal->project_id) ,
        ] ;
    }

    public function toVonage(object $notifiable): VonageMessage
    {
        
        $body= sprintf('%s has applied for a job %s', $this->freelancer->name ,$this->proposal->project->title) ;
        return (new VonageMessage)
                    ->content( $body);
    }

   
    


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        
    }
}
