<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Archive;
use App\Models\Projet;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function index($id = null, $conversation = null)
    {
        $contacts = Message::getContacts(auth()->user()->id);
        $receiver = null;
        $projet = null;
        $messages = [];

        if (!empty($id)) {
            $receiver = User::find($id);
        }

        if (!empty($conversation)) {
            Message::makeSeen($conversation);
            $messages = Message::getLastestMessageQuery($conversation);

            if (!empty($messages)) {
                $projet = Projet::find($messages[0]->projet);
            }
        }

        return view('pages.chat.home')
        ->with('sender', auth()->user())
        ->with('receiver', $receiver)
        ->with('projet', $projet)
        ->with('messages', $messages)
        ->with('contacts', $contacts);
    }

    public function send($sender, $receiver, Request $request)
    {
        $error = (object)[
            'status' => 0,
            'message' => null
        ];

        // $data = $request->input();

        // dd($data);

        $conversationExist = Message::where('projet', $request->projet)->where('recepteur', $receiver)->where('envoyeur', $sender)
            ->orWhere('recepteur', $sender)->where('envoyeur', $receiver)->exists();

        $conversation = Str::uuid();

        if ($conversationExist) {
            $conversation = Message::where('recepteur', $receiver)->where('envoyeur', $sender)->orWhere('recepteur', $sender)->where('envoyeur', $receiver)->first()->conversation;
        }

        $data = [
            'recepteur' => $receiver,
            'envoyeur' => $sender,
            'conversation' => $conversation,
            'projet' => $request->projet,
            'message' => html_entity_decode(htmlentities(trim($request->input('body'))))
        ];

        $message = Message::create($data);

        if ($request->hasFile('attachement')) {
            $allowed_images = Archive::getAllowedImages();
            $allowed_files  = Archive::getAllowedFiles();
            $allowed        = array_merge($allowed_images, $allowed_files);

            $files = $request->file('attachement');

            foreach ($files as $file) {
                if ($file->getSize() < 150000000) {
                    if (in_array($file->getClientOriginalExtension(), $allowed)) {
                        $attachment_title = $file->getClientOriginalName();
                        $attachment = Str::uuid() . "." . $file->getClientOriginalExtension();
                        $file->storeAs('uploads/message/', $attachment_title, ['disk' => 'public']);
                        $data = [];
                        $data['message'] = $message->id;
                        $data['nom'] = $attachment_title;
                        $data['source'] = 'MESSAGE';
                        $data['type'] = in_array($file->getClientOriginalExtension(), $allowed_images) ? 'IMAGE' : 'FICHIER';
                        $data['url'] = url('storage/uploads/message') . '/' . $attachment_title;
                        Archive::create($data);
                    } else {
                        $error->status = 1;
                        $error->message = "Some files extension are not allowed!";
                    }
                } else {
                    $error->status = 1;
                    $error->message = "Some files size exceed 150MB!";
                }
            }
        }
        
        return back();
    }
}
