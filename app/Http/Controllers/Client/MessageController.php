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
            Message::makeSeen(auth()->user()->id, $conversation);
            $messages = Message::getLastestMessageQuery($conversation);

            if (!empty($messages)) {
                $projet = Projet::find($messages[0]->projet);
            }
        }

        return view('pages.chat.home')
            ->with('sender', auth()->user())
            ->with('receiver', $receiver)
            ->with('projet', $projet)
            ->with('conversation', $conversation)
            ->with('messages', $messages)
            ->with('contacts', $contacts);
    }

    public function send($sender, $conversation, $receiver, Request $request)
    {
        $data = [
            'recepteur' => $receiver,
            'envoyeur' => $sender,
            'conversation' => $conversation,
            'projet' => $request->has('projet') ? $request->projet : null,
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
                        return back();
                    }
                } else {
                    return back();
                }
            }
        }

        return back();
    }
}
