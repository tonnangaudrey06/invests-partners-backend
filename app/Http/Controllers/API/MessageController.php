<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function show($sender, $receiver)
    {
        $seen = Message::makeSeen($sender, $receiver);
        $messages = Message::fetchMessage($sender, $receiver);
        return response()->json($messages, 200);
    }

    public function inbox($conversation)
    {
        $messages = Message::getLastestMessageQuery($conversation);
        return $this->sendResponse($messages, 'Member delete');
    }

    public function showContact($sender)
    {
        $contacts = Message::getContacts($sender);
        return $this->sendResponse($contacts, 'Contacts');
    }

    public function send($sender, $receiver, Request $request)
    {
        $error = (object)[
            'status' => 0,
            'message' => null
        ];

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
        
        return $this->sendResponse($message, 'New message');
    }

    public function seen($sender, $receiver)
    {
        $seen = Message::makeSeen($sender, $receiver);
        return response()->json([
            'status' => $seen,
        ], 200);
    }

    public function notification($sender, Request $request)
    {
        $data = $request->input('limit');
        $seen = Message::where('recepteur', $sender)->latest()->limit($data)->get();
        return response()->json([
            'status' => $seen,
        ], 200);
    }

    public function download($fileName)
    {
        $path = storage_path() . '/app/public/uploads/message/' . $fileName;
        if (file_exists($path)) {
            return response()->download($path, $fileName);
        } else {
            return response("Sorry, File does not exist in our server or may have been deleted!", 404);
        }
    }

    public function deleteChat($conversation)
    {
        $delete = Message::deleteConversation($conversation);

        return response()->json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }

    public function deleteMessage($id)
    {
        $delete = Message::deleteMessage($id);
        return response()->json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }
}
