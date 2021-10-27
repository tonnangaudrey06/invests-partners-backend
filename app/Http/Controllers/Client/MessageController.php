<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Archive;
use App\Models\Projet;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

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

    public function index2($id, $receive = null, $conversation = null)
    {
        $contacts = Message::getContacts($id);
        $sender = User::find($id);
        $receiver = null;
        $projet = null;
        $messages = [];

        if (!empty($receive)) {
            $receiver = User::find($receive);
        }

        if (!empty($conversation)) {
            $messages = Message::getLastestMessageQuery($conversation);

            if (!empty($messages) && !empty($messages[0]->projet)) {
                $projet = Projet::find($messages[0]->projet);
            }
        }

        return view('pages.chat.view')
            ->with('sender', $sender)
            ->with('receiver', $receiver)
            ->with('projet', $projet)
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

    public function newConversation($sender, $receiver, Request $request)
    {
        $projet = $request->has('projet') ? $request->projet : null;
        $conversationExist = Message::where('projet', $projet)
            ->where(function ($query) use ($receiver) {
                $query->where('recepteur', $receiver)
                    ->orWhere('envoyeur', $receiver);
            })
            ->where(function ($query) use ($sender) {
                $query->where('envoyeur', $sender)
                    ->orWhere('recepteur', $sender);
            })->first();

        $conversation = Str::uuid();

        if (!empty($conversationExist)) {
            $conversation = $conversationExist->conversation;
        }

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
                        $file->storeAs('uploads/message/' . $conversation, $attachment_title, ['disk' => 'public']);
                        $data = [];
                        $data['message'] = $message->id;
                        $data['nom'] = $attachment_title;
                        $data['source'] = 'MESSAGE';
                        $data['type'] = in_array($file->getClientOriginalExtension(), $allowed_images) ? 'IMAGE' : 'FICHIER';
                        $data['url'] = url('storage/uploads/message/' . $conversation) . '/' . $attachment_title;
                        Archive::create($data);
                    } else {
                        return $this->sendError("Certaines extensions de fichiers ne sont pas autorisées !", [], 500);
                    }
                } else {
                    return $this->sendError("La taille de certains fichiers dépasse 150Mo !", [], 500);
                }
            }
        }

        Toastr::success('Votre message a été envoyé', 'Succès');

        return redirect(route('chat.conversation', ['id' => $sender, 'conversation' => $conversation]));
    }
}
