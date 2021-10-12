<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'recepteur', 'envoyeur', 'conversation', 'message', 'piece_jointe', 'projet'
    ];

    public static function fetchMessage($sender, $receiver)
    {
        return Message::where('recepteur', $sender)->orWhere('envoyeur', $sender)->latest()->with(['attachements', 'sender', 'receiver'])->get();
        return (new self)->fetchMessagesQuery($sender, $receiver)->orderBy('created_at', 'asc')->get();
    }

    public function fetchMessagesQuery($sender, $receiver)
    {
        return Message::where('recepteur', $receiver)->where('envoyeur', $sender)
            ->orWhere('recepteur', $sender)->where('envoyeur', $receiver);
    }

    public static function makevu($sender, $receiver)
    {
        Message::where('recepteur', $sender)
            ->where('envoyeur', $receiver)
            ->where('vu', 0)
            ->update(['vu' => 1]);
        return 1;
    }

    public function getLastMessageQuery($sender, $receiver)
    {
        return $this->fetchMessagesQuery($sender, $receiver)->latest()->first();
    }

    public static function getLastestMessageQuery($conversation)
    {
        // $conversations = DB::table('messages')
        //     ->select(['conversation', 'projet'])
        //     ->distinct()
        //     ->where('conversation', $conversation)
        //     ->first();
        
        return Message::where('conversation', $conversation)
            ->latest()
            ->with(['attachements', 'sender', 'receiver'] )
            ->get();
    }

    public static function countUnvuMessages($sender, $receiver)
    {
        return Message::where('recepteur', $receiver)->where('envoyeur', $sender)->where('vu', 0)->count();
    }

    public static function getContacts($sender)
    {
        $contacts = [];
        $user = User::find($sender);

        $conversations = DB::table('messages')
            ->select('conversation')
            ->distinct()
            ->where('envoyeur', $sender)
            ->orWhere('recepteur', $sender)->get();

        foreach ($conversations as $key => $item) {
            $contact = Message::where('conversation', $item->conversation)
                ->latest()
                ->first();
            if ($contact->envoyeur != $sender) {
                $contact->recepteur = $contact->envoyeur;
            }
            $contact->envoyeur = (int) $sender;
            $contact->recepteur = User::find($contact->recepteur);

            if (!empty($contact->projet)) {
                $contact->projet = Projet::find($contact->projet);
            }

            array_push($contacts, $contact);
        }

        return $contacts;
    }

    public static function deleteConversation($conversation)
    {
        try {
            $piece_jointes = DB::table('messages')
                ->join('archives', 'archives.id', '=', 'messages.piece_jointe')
                ->select('archives.*')
                ->where('messages.conversation', $conversation)
                ->get();

            foreach ($piece_jointes as $piece_jointe) {
                if (isset($piece_jointe)) {
                    $path = storage_path('app/public/.attachments/' . $piece_jointe->filename);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                }
                Archive::find($piece_jointe->id)->delete();
            }

            Message::where('conversation', $conversation)->delete();
            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public static function deleteMessage($message)
    {
        Message::find($message)->delete();
        return 1;
    }

    public function attachements()
    {
        return $this->hasMany(Archive::class, 'message', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'envoyeur', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'recepteur', 'id');
    }

    public function projet_data()
    {
        return $this->belongsTo(Projet::class, 'projet', 'id');
    }
}
