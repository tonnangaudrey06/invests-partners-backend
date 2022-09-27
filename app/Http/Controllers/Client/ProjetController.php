<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\AdminCloture;
use App\Mail\AdminClotureI;
use App\Mail\AdminInfoSupp;
use App\Mail\AdminPublication;
use App\Models\Projet;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;
use App\Mail\CIValidation;
use App\Mail\AdminValidation;
use App\Mail\CIInfoSupp;
use App\Mail\CIModification;
use App\Mail\RejetMail;
use App\Models\Archive;
use App\Models\DocumentFiscaux;
use App\Models\Investissement;
use App\Models\Secteur;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProjetController extends Controller
{
    public function index()
    {
        $secteurs = Secteur::with(['conseiller_data'])->get();

        // if (auth()->user()->role == 1 || auth()->user()->role == 5) {
        //     $secteurs = Secteur::with(['conseiller_data'])->get();
        // } else {
        //     $secteurs = Secteur::with(['conseiller_data'])
        //         ->where('user', auth()->user()->id)
        //         ->get();
        // }

        foreach ($secteurs as $key => $secteur) {
            $secteurs[$key]->projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
                ->withCount('likes')
                ->where('secteur', $secteur->id)
                ->where('type', 'AUTRE')
                ->where(
                    function ($query) {
                        return $query
                            ->where('etat', '!=', 'CLOTURE')
                            ->where('etat', '!=', 'REJETE');
                    }
                )
                ->latest()
                ->get();
        }

        return view('pages.projet.home', compact('secteurs'))->with('type', 'AUTRE');
    }

    public function index_ip()
    {
        $secteurs = Secteur::with(['conseiller_data'])->get();

        // if (auth()->user()->role == 1 || auth()->user()->role == 5) {
        //     $secteurs = Secteur::with(['conseiller_data'])->get();
        // } else {
        //     $secteurs = Secteur::with(['conseiller_data'])
        //         ->where('user', auth()->user()->id)
        //         ->get();
        // }

        foreach ($secteurs as $key => $secteur) {
            $secteurs[$key]->projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
                ->withCount('likes')
                ->where('secteur', $secteur->id)
                ->where('type', 'IP')
                ->where(
                    function ($query) {
                        return $query
                            ->where('etat', '!=', 'CLOTURE')
                            ->orWhere('etat', '!=', 'REJETE');
                    }
                )
                ->latest()
                ->get();
        }

        return view('pages.projet.home', compact('secteurs'))->with('type', 'IP');
    }

    public function index_secteur($secteur)
    {
        $projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
            ->withCount('likes')
            ->where('secteur', $secteur)
            ->where(
                function ($query) {
                    return $query
                        ->where('etat', '!=', 'CLOTURE')
                        ->orWhere('etat', '!=', 'REJETE');
                }
            )
            ->get();

        // if (auth()->user()->role == 1 || auth()->user()->role == 5) {
        //     $projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
        //         ->where('secteur', $secteur)
        //         ->where(
        //             function ($query) {
        //                 return $query
        //                     ->where('etat', '!=', 'CLOTURE')
        //                     ->orWhere('etat', '!=', 'REJETE');
        //             }
        //         )
        //         ->get();
        // } else {
        //     $projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
        //         ->where('secteur', $secteur)
        //         ->whereIn('secteur', function ($query) {
        //             $query->select('id')
        //                 ->from(with(new Secteur())->getTable())
        //                 ->where('user', auth()->user()->id);
        //         })
        //         ->where(
        //             function ($query) {
        //                 return $query
        //                     ->where('etat', '!=', 'CLOTURE')
        //                     ->orWhere('etat', '!=', 'REJETE');
        //             }
        //         )
        //         ->latest()
        //         ->get();
        // }

        $secteur = Secteur::where('id', $secteur)->first()->libelle;

        return view('pages.projet.home-secteur', compact('projets'))->with('secteur', $secteur);
    }

    public function index_ville($ville)
    {
        $secteurs = Secteur::with(['projets', 'conseiller_data'])->get();

        // if (auth()->user()->role == 1 || auth()->user()->role == 5) {
        //     $secteurs = Secteur::with(['projets', 'conseiller_data'])->get();
        // } else {
        //     $secteurs = Secteur::with(['projets', 'conseiller_data'])->where('user', auth()->user()->id)->get();
        // }

        foreach ($secteurs as $key => $secteur) {
            $secteurs[$key]->projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
                ->withCount('likes')
                ->where('secteur', $secteur->id)
                ->where('ville_activite', $ville)
                ->where(
                    function ($query) {
                        return $query
                            ->where('etat', '!=', 'CLOTURE')
                            ->orWhere('etat', '!=', 'REJETE');
                    }
                )
                ->latest()
                ->get();
        }

        return view('pages.projet.home-place', compact('secteurs'))->with('ville', $ville);
    }

    public function index_etat($etat)
    {
        $secteurs = Secteur::with(['projets', 'conseiller_data'])->get();

        // if (auth()->user()->role == 1 || auth()->user()->role == 5) {
        //     $secteurs = Secteur::with(['projets', 'conseiller_data'])->get();
        // } else {
        //     $secteurs = Secteur::with(['projets', 'conseiller_data'])->where('user', auth()->user()->id)->get();
        // }

        foreach ($secteurs as $key => $secteur) {
            $secteurs[$key]->projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
                ->withCount('likes')
                ->where('secteur', $secteur->id)
                ->where('etat', $etat)
                ->latest()
                ->get();
        }

        return view('pages.projet.home-etat', compact('secteurs'))->with('etat', $etat);
    }

    public function archives()
    {
        $secteurs = Secteur::with(['conseiller_data'])->get();

        // if (auth()->user()->role == 1 || auth()->user()->role == 5) {
        //     $secteurs = Secteur::with(['conseiller_data'])->get();
        // } else {
        //     $secteurs = Secteur::with(['conseiller_data'])
        //         ->where('user', auth()->user()->id)
        //         ->get();
        // }

        foreach ($secteurs as $key => $secteur) {
            $secteurs[$key]->projets = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])
                ->withCount('likes')
                ->where('secteur', $secteur->id)
                ->where(
                    function ($query) {
                        return $query
                            ->where('etat', 'CLOTURE')
                            ->orWhere('etat', 'REJETE');
                    }
                )
                ->latest()
                ->get();
        }

        return view('pages.projet.home', compact('secteurs'))->with('type', 'ARCHIVE');
    }

    public function add()
    {
        $secteurs = Secteur::all();
        return view('pages.projet.add', compact('secteurs'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'intitule' => 'bail|required|:projets',
                'pays_activite' => 'bail|required|string|:projets',
                'ville_activite' => 'bail|required|string|:projets',
                'description' => 'bail|required|:projets',
                'financement' => 'bail|required|string|:projets',
                'secteur' => 'bail|required|:projets',
                'logo' => 'mimes:jpg,jpeg,png',
                'taux_rentabilite' => 'required|:projets',
                'duree' => 'required|:projets',
                'delai_recup' => 'required|:projets',
                'ca_previsionnel' => 'required|:projets',
            ],
            [
                'taux_rentabilite.required' => 'Champ obligatoire!',
                'duree.required' => 'Champ obligatoire!',
                'delai_recup.required' => 'Champ obligatoire!',
                'ca_previsionnel.required' => 'Champ obligatoire!',
                'intitule.required' => 'Champ obligatoire!',
                'pays_activite.required' => 'Champ obligatoire!',
                'ville_activite.required' => 'Champ obligatoire!',
                'description.required' => 'Champ obligatoire!',
                'financement.required' => 'Champ obligatoire!',
                'secteur.required' => 'Champ obligatoire!',
            ]
        );

        $logo = $request->file('logo');

        $data = array();
        $data['intitule'] = $request->intitule;
        $data['pays_activite'] = $request->pays_activite;
        $data['ville_activite'] = $request->ville_activite;
        $data['description'] = $request->description;
        $data['secteur'] = $request->secteur;
        $data['financement'] = $request->financement;
        $data['taux_rentabilite'] = $request->taux_rentabilite;
        $data['duree'] = $request->duree;
        $data['delai_recup'] = $request->delai_recup;
        $data['ca_previsionnel'] = $request->ca_previsionnel;
        $data['avancement'] = $request->avancement;

        $data['user'] = auth()->user()->id;
        $data['type'] = 'IP';
        $data['etat'] = 'PUBLIE';

        $medias = $request->has('medias') ? $request->file('medias') : [];

        $data['folder'] = hexdec(uniqid());

        if (!empty($logo)) {
            $filename = 'logo.' . $logo->getClientOriginalExtension();
            $data['logo'] = url('storage/uploads/projets/' . $data['folder']) . '/' . $filename;
            $logo->storeAs('uploads/projets/' . $data['folder'] . '/', $filename, ['disk' => 'public']);
        }

        $projet = Projet::create($data);

        foreach ($medias as $media) {
            $extension = $media->getClientOriginalExtension();

            $data = [
                'projet' => $projet->id,
                'nom' => $media->getClientOriginalName(),
                'source' => 'CONSEILLER'
            ];

            if (in_array($extension, Archive::getAllowedFiles())) {
                $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/documents') . '/' . $data['nom'];
                $data['type'] = 'FICHIER';
                $media->storeAs('uploads/projets/' . $projet->folder . '/documents/', $data['nom'], ['disk' => 'public']);
            } else if (in_array($extension, Archive::getAllowedImages())) {
                $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/images') . '/' . $data['nom'];
                $data['type'] = 'IMAGE';
                $media->storeAs('uploads/projets/' . $projet->folder . '/images/', $data['nom'], ['disk' => 'public']);
            } else {
                $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/videos') . '/' . $data['nom'];
                $data['type'] = 'VIDEO';
                $media->storeAs('uploads/projets/' . $projet->folder . '/videos/', $data['nom'], ['disk' => 'public']);
            }

            Archive::create($data);
        }

        if (!empty($photo)) {
            $filename = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
            $membre['photo'] = url('storage/uploads/membres/') . '/' . $filename;
            $photo->storeAs('uploads/membres/', $filename, ['disk' => 'public']);
        }

        Toastr::success('Projet ajouté avec succès!', 'Succès');

        return redirect()->route('projet.home_ip');
    }

    public function edit($id)
    {
        $secteurs = Secteur::all();
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->find($id);
        return view('pages.projet.edit', compact('projet', 'secteurs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'taux_rentabilite' => 'required|:projets|max:255',
                'duree' => 'required|:projets|max:255',
                'delai_recup' => 'required|:projets|max:255',
                'ca_previsionnel' => 'required|:projets|max:255',
                'description' => 'required|:projets',
                'intitule' => 'required|:projets',
                'secteur' => 'required|:projets'
            ],

            [
                'taux_rentabilite.required' => 'Champ obligatoire!',
                'duree.required' => 'Champ obligatoire!',
                'delai_recup.required' => 'Champ obligatoire!',
                'ca_previsionnel.required' => 'Champ obligatoire!',
                'description.required' => 'Champ obligatoire!',
                'intitule.required' => 'Champ obligatoire!',
                'secteur.required' => 'Champ obligatoire!',
            ]
        );

        $projet = Projet::with(['user_data', 'secteur_data'])->find($id);

        $projet->taux_rentabilite = $request->taux_rentabilite;
        $projet->duree = $request->duree;
        $projet->rsi = $request->delai_recup;
        $projet->ca_previsionnel = $request->ca_previsionnel;
        $projet->description = $request->description;
        $projet->financement = $request->financement;
        $projet->intitule = $request->intitule;
        $projet->secteur = $request->secteur;

        if ($projet->type == "AUTRE") {
            $projet->etat = 'COMPLET';
        }

        if (auth()->user()->role == 2) {
            $data_report = [
                'user' => User::where('id', auth()->user()->id)->first(),
                'element' => $projet,
                'action' => 'CI_MODIFIE',
                'type' => 'PROJET',
                'date' => Carbon::now()
            ];

            $this->Report($data_report);
        }

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $path = parse_url($projet->logo);
            File::delete(public_path($path['path']));
            $filename = 'logo.' . $logo->getClientOriginalExtension();
            $projet->logo = url('storage/uploads/' . $projet->user_data->folder . '/projets/' . $projet->folder) . '/' . $filename;
            $logo->storeAs('uploads/' . $projet->user_data->folder . '/projets/' . $projet->folder . '/', $filename, ['disk' => 'public']);
        }

        $projet->save();

        if ($request->hasFile('fichier')) {

            $files = $request->file('fichier');

            foreach ($files as $media) {
                $extension = $media->getClientOriginalExtension();

                $data = [
                    'projet' => $projet->id,
                    'nom' => $media->getClientOriginalName(),
                    'source' => 'CONSEILLER'
                ];

                if (in_array($extension, Archive::getAllowedFiles())) {
                    $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/documents') . '/' . $data['nom'];
                    $data['type'] = 'FICHIER';
                    $media->storeAs('uploads/projets/' . $projet->folder . '/documents/', $data['nom'], ['disk' => 'public']);
                } else if (in_array($extension, Archive::getAllowedImages())) {
                    $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/images') . '/' . $data['nom'];
                    $data['type'] = 'IMAGE';
                    $media->storeAs('uploads/projets/' . $projet->folder . '/images/', $data['nom'], ['disk' => 'public']);
                } else {
                    $data['url'] = url('storage/uploads/projets/' . $projet->folder . '/videos') . '/' . $data['nom'];
                    $data['type'] = 'VIDEO';
                    $media->storeAs('uploads/projets/' . $projet->folder . '/videos/', $data['nom'], ['disk' => 'public']);
                }
                Archive::create($data);
            }
        }

        $admin = User::where('role', 1)->first();

        Mail::to($admin->email)
            ->queue(new CIModification($projet->toArray()));

        Toastr::success('Projet modifié avec succès!', 'Succès');

        return redirect()->route('projet.details', $projet->id);
    }

    public function delete($id)
    {
        $projet = Projet::with(['user_data'])->find($id);
        File::deleteDirectory(storage_path('app/public/uploads/') . $projet->user_data->folder . '/' . 'projets/' . $projet->folder);
        $projet->delete();
        Toastr::success('Projet supprimé avec succès!', 'Success');
        return redirect()->route('projet.home');
    }

    public function showp($id)
    {
        $projet = Projet::with(['user_data', 'membres', 'medias', 'secteur_data'])->withCount('likes')->find($id);
        $docs = DocumentFiscaux::with(['user_data'])->where('user', $projet->user_data->id)->get();
        $total_invest = DB::table('investissements')->where('projet', $id)->sum('montant');
        $nber_invest = DB::table('investissements')->where('projet', $id)->count();
        $privileges = DB::table('privileges')->where('user', auth()->user()->id)->get();
        return view('pages.projet.details', compact('projet', 'docs', 'total_invest', 'nber_invest', 'privileges'));
    }

    public function typemessage($id)
    {
        $projet = Projet::with(['user_data','secteur_data'])->find($id);
        return view('pages.projet.askinfo', compact('projet'));
    }

    public function publish($id)
    {
        $projet = Projet::with(['user_data', 'secteur_data'])->find($id);

        $projet->update([
            'etat' => 'PUBLIE',
        ]);

        Mail::to($projet->user_data->email)->queue(new AdminPublication($projet->toArray()));

        $user = User::find($projet->user_data->id);

        if (!empty($user->device_token)) {
            $user->sendFcmNotification("Votre projet '$projet->intitule' est à present publié sur notre plateforme");
        }

        Toastr::success('Projet publié avec succès!', 'Succès');

        return back();
    }

    public function cloture($id)
    {
        $projet = Projet::with(['user_data', 'secteur_data'])->find($id);

        $investisseurs = Investissement::select('*')
            ->groupBy('projet')
            ->groupBy('user')
            ->where('projet', $id)
            ->with(['projet_data', 'user_data'])
            ->get();

        $projet->update([
            'etat' => 'CLOTURE',
        ]);

        Mail::to($projet->user_data->email)->queue(new AdminCloture($projet->toArray()));

        $user = User::find($projet->user_data->id);

        if (!empty($user->device_token)) {
            $user->sendFcmNotification("Nous avons le plaisir de vous annoncer que les investissements sont officiellement clos pour votre projet
            '$projet->intitule'.", "Clôture de votre projet");
        }

        foreach ($investisseurs as $investisseur) {
            Mail::to($investisseur->user_data->email)
                ->queue(new AdminClotureI($projet->toArray(), $investisseur->toArray()["user_data"]));
        }

        Toastr::success('Projet cloturé avec succès!', 'Succès');

        return back();
    }

    public function AdminValidate($id)
    {
        $projet = Projet::with(['user_data'])->find($id);

        Mail::to($projet->user_data->email)
            ->queue(new AdminValidation($projet->toArray()));

        $user = User::find($projet->user_data->id);

        if (!empty($user->device_token)) {
            $user->sendFcmNotification("Félicitations ! Votre projet '$projet->intitule' a retenu l'attention  de
            l'équipe d'invest & partners. Afin de travailler à la recherche d'investisseurs grâce à votre visibilité sur la
            plateforme, veuillez procéder au paiement des travaux.", "Validation de votre projet");
        }

        Toastr::success('Mail envoyé avec succès!', 'Projet epprouvé');

        $projet->update([
            'etat' => 'ATTENTE_PAIEMENT',
        ]);

        return back();
    }

    public function AdminInfoSupp(Request $request, $id)
    {
        $projet = Projet::with(['user_data', 'secteur_data'])->find($id);
        $conseiller = User::where('id', $projet->secteur_data->user)->first();

        $data = array();
        $data['objet'] = $request->objet;
        $data['message'] = $request->message;

        Mail::to($conseiller->email)
            ->queue(new AdminInfoSupp($projet->toArray(), $data));

        Toastr::success('Mail envoyé avec succès!', 'Succès');

        $projet->update([
            'etat' => 'ATTENTE_INFO_SUPPL',
        ]);

        return redirect()->route('projet.details', $projet->id);
    }

    public function CIInfoSupp(Request $request, $id)
    {
        $projet = Projet::with(['user_data', 'secteur_data'])->find($id);

        $data = array();
        $data['objet'] = $request->objet;
        $data['message'] = $request->message;

        Mail::to($projet->user_data->email)
            ->queue(new CIInfoSupp($projet->toArray(), $data));

        $data_report = [
            'user' => User::where('id', auth()->user()->id)->first(),
            'element' => $projet,
            'action' => 'CI_DEMANDE_INFO_SUP',
            'type' => 'PROJET',
            'date' => Carbon::now()
        ];

        $this->Report($data_report);

        Toastr::success('Mail envoyé avec succès!', 'Succès');

        $projet->update([
            'etat' => 'ATTENTE_INFO_SUPPL',
        ]);

        return redirect()->route('projet.details', $projet->id);
    }

    public function CIValidate($id)
    {

        $projet = Projet::with(['user_data', 'secteur_data'])->find($id);
        $admin = User::where('role', 1)->first();

        $data_report = [
            'user' => User::where('id', auth()->user()->id)->first(),
            'element' => $projet,
            'action' => 'CI_VALIDE',
            'type' => 'PROJET',
            'date' => Carbon::now()
        ];

        $this->Report($data_report);

        Mail::to($admin->email)
            ->queue(new CIValidation($projet->toArray()));

        Toastr::success('Mail envoyé avec succès!', 'Projet approuvé');

        $projet->update([
            'etat' => 'ATTENTE_VALIDATION_ADMIN',
        ]);

        return back();
    }

    public function Rejeter($id)
    {
        $projet = Projet::with(['user_data', 'secteur_data'])->find($id);
        $admin = User::where('role', 1)->first();

        if (auth()->user()->role == 2) {
            $data_report = [
                'user' => User::where('id', auth()->user()->id)->first(),
                'element' => $projet,
                'action' => 'CI_REJETE',
                'type' => 'PROJET',
                'date' => Carbon::now()
            ];

            $this->Report($data_report);
        }

        Mail::to($projet->user_data->email)
            ->queue(new RejetMail($projet->toArray(), $admin->toArray()));

        Toastr::success('Mail envoyé avec succès!', 'Projet refusé');

        $projet->update([
            'etat' => 'REJETE',
        ]);

        return back();
    }

    public function Report($data)
    {
        User::writeReport(auth()->user()->folder, $data);
    }
}
