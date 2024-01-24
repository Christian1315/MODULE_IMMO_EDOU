<div>

    <div class="d-flex header-bar">
        <button wire:click="showForm" type="button" class="btn btn-sm bg-dark" data-bs-toggle="modal" data-bs-target="#addLocation">
            @if($show_form) Fermer @else Ajouter @endif
        </button> &nbsp; &nbsp;&nbsp;

        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Rechercher une location" aria-label="Search">
        </form> &nbsp;&nbsp;
        <button wire:click="generateCaution" class="btn btn-sm bg-red">Gérer les cautions </button> &nbsp;
    </div>
    <br>
    <br><br>

    <div class="">
        <p class="text-center text-red"> {{$generalError}} </p>
    </div>

    @if($show_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addLocation">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$house_error}} </span>
                                <select wire:model="house" class="form-select form-control" name="house" aria-label="Default select example">
                                    <option>Maison</option>
                                    @foreach($houses as $house)
                                    <option value="{{$house['id']}}">{{$house['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="mb-3">
                                <span class="text-center text-red"> {{$room_error}} </span>
                                <select wire:model="room" class="form-select form-control" name="room" aria-label="Default select example">
                                    <option >Chambre</option>
                                    @foreach($rooms as $room)
                                    <option value="{{$room['id']}}">{{$room['number']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="mb-3">
                                <span class="text-center text-red"> {{$locataire_error}} </span>
                                <select wire:model="locataire" class="form-select form-control" name="locataire" aria-label="Default select example">
                                    <option>Locataire</option>
                                    @foreach($locators as $locator)
                                    <option value="{{$locator['id']}}">{{$locator['name']}} {{$locator['prenom']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$type_error}} </span>

                                <select wire:model="type" class="form-select form-control" name="type" aria-label="Default select example">
                                    <option >Type de location</option>
                                    @foreach($location_types as $type)
                                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="mb-3">
                                <span>Uploader le bordereau du caution</span><br>
                                <span class="text-center text-red"> {{$caution_bordereau_error}} </span>
                                <input wire:model="caution_bordereau" type="file" name="caution_bordereau" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$caution_electric_error}} </span>
                                <input wire:model="caution_electric" type="text" name="caution_electric" class="form-control" placeholder="Caution d'électricité...">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$water_counter_error}} </span>
                                <input wire:model="water_counter" type="text" name="water_counter" placeholder="Compteur eau..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$prestation_error}} </span>
                                <input wire:model="prestation" type="number" name="prestation" placeholder="La prestation..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$numero_contrat_error}} </span>
                                <input wire:model="numero_contrat" type="text" name="numero_contrat" placeholder="Numéro du contrat..." class="form-control">
                            </div><br>
                        </div>
                        <!--  -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span>Uploader l'image du contrat</span><br>
                                <span class="text-center text-red"> {{$img_contrat_error}} </span>
                                <input wire:model="img_contrat" type="file" name="img_contrat" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$caution_water_error}} </span>
                                <input wire:model="caution_water" type="text" name="caution_water" class="form-control" placeholder="Caution eau ....">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$electric_counter_error}} </span>
                                <input wire:model="electric_counter" type="text" name="electric_counter" class="form-control" placeholder="Compteur électricité ....">
                            </div><br>
                            <div class="mb-3">
                                <span>Date d'échéance</span><br>
                                <span class="text-center text-red"> {{$echeance_date_error}} </span>
                                <input wire:model="echeance_date" type="date" name="echeance_date" class="form-control" placeholder="Date d'écheance ....">
                            </div><br>
                            <div class="mb-3">
                                <span>Date du dernier loyer payé</span><br>
                                <span class="text-center text-red"> {{$latest_loyer_date_error}} </span>
                                <input wire:model="latest_loyer_date" type="date" name="latest_loyer_date" class="form-control" placeholder="Dernier loyer payé ....">
                            </div><br>
                            <div class="mb-3">
                                <span>Uploader l'image de la prestation</span><br>
                                <span class="text-center text-red"> {{$img_prestation_error}} </span>
                                <input wire:model="img_prestation" type="file" name="img_prestation" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$caution_number_error}} </span>
                                <input wire:model="caution_number" type="number" name="caution_number" class="form-control" placeholder="Nombre de caution loyer ....">
                            </div><br>
                            <div class="mb-3">
                                <span>Date d'intégration</span><br>
                                <span class="text-center text-red"> {{$integration_date_error}} </span>
                                <input wire:model="integration_date" type="date" name="integration_date" class="form-control" placeholder="Date d'intégration ....">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-center text-red"> {{$comments_error}} </span>
                                <textarea wire:model="comments" name="comments" class="form-control" placeholder="Laissez un commentaire ici" class="form-control" id=""></textarea>
                            </div><br>
                        </div>
                    </div>
                    <div class="text-right mt-2">
                        <button class="btn btn-sm bg-red">Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endif

    @if($showCautions)
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert bg-dark text-white">
                    Cautions générées avec succès! Cliquez sur le lien ci-dessous pour la télécharger: <br>
                    <a class="text-red" href="{{$cautions_link}}" target="_blank" rel="noopener noreferrer">Télécharger</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($show_demenage_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form wire:submit.prevent="Demenage" class="shadow-lg p-3 animate__animated animate__bounce">
                    <h5 class="">Démenager le locataire</h5>
                    <span class="text-red"> {{$move_comments_error}} </span>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <textarea wire:model="move_comments" name="move_comments" class="form-control" placeholder="Donner une raison justifiant ce déménagement"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-dark">Valider</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endif

    @if($show_encaisse_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form wire:submit.prevent="Encaisse" class="shadow-lg p-3 animate__animated animate__bounce">
                    <h5 class="">Encaisser le loyer d'une location</h5>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <span class="text-red"> {{$encaisse_paiement_type_error}} </span>
                                <select name="encaisse_paiement_type" wire:model="encaisse_paiement_type" class="form-select form-control" name="house" aria-label="Default select example">
                                    <option>Type de paiement</option>
                                    @foreach($paiements_types as $type)
                                    <option value="{{$type['id']}}">{{$type["name"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <span class="text-red"> {{$encaisse_mount_error}} </span>
                                <br>
                                <span>Date ou mois pour lequel vous voulez encaisser pour cette location</span>
                                <input wire:model="encaisse_mount" type="date" name="mounth" class="form-control" id="">
                            </div>
                            <span>Uploader la facture ici</span> <br>
                            <span class="text-red"> {{$encaisse_facture_error}} </span>
                            <input wire:model="encaisse_facture" type="file" name="encaisse_facture" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-dark">Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endif

    @if($show_traitFacture_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form wire:submit.prevent="FactureTraitement" class="shadow-lg p-3 animate__animated animate__bounce">
                    <h5 class="">Traitement de la facture << {{$activeFactureId}}>> d'une location</h5>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <span class="text-red"> {{$trait_facture_status_error}} </span>
                                <select name="trait_facture_status" wire:model="trait_facture_status" class="form-select form-control" name="house" aria-label="Default select example">
                                    <option >Status de facture</option>
                                    @foreach($factures_status as $status)
                                    <option value="{{$status['id']}}">{{$status["name"]}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-dark">Valider</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endif


    <br><br><br>
    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Maison</th>
                            <th class="text-center">Chambre</th>
                            <th class="text-center">Locataire</th>
                            <th class="text-center">Contrat</th>
                            <th class="text-center">Loyer</th>
                            <th class="text-center">Dernier loyer payé</th>
                            <th class="text-center">Commentaire</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    @if($locations_count>0)
                    <tbody>
                        @foreach($locations as $location)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center">{{$location["house"]["name"]}}</td>
                            <td class="text-center">{{$location["room"]["number"]}}</td>
                            <td class="text-center">{{$location["locataire"]["name"]}} {{$location["locataire"]["prenom"]}}</td>
                            <td class="text-center"><img src="{{$location['img_contrat']}}" class="img-fluid" width="50px" srcset="">
                            </td>
                            <td class="text-center">{{$location["loyer"]}}</td>
                            <td class="text-center">{{$location["latest_loyer_date"]}}</td>
                            <td class="text-center">
                                <textarea name="" class="form-control" id="">{{$location["comments"]}}</textarea>
                            </td>
                            <td class="text-center">
                                <button wire:click="showDemenageForm({{$location['id']}})" class="btn btn-sm bg-red">
                                    @if($show_demenage_form) Fermer @else Démenager @endif
                                </button> &nbsp;
                                <button wire:click="showEncaisseForm({{$location['id']}})" class="btn btn-sm bg-dark" data-bs-toggle="modal" data-bs-target="#encaisserLocation">
                                    @if($show_encaisse_form) Fermer @else Encaisser @endif
                                </button> &nbsp;
                                <button wire:click="showFactures({{$location['id']}})" class="btn btn-sm bg-warning text-dark">Gérer les
                                    factures</button>
                                &nbsp;
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune location n'a été ajoutée!</p>
                    @endif
                </table>
            </div>
            <!-- pagination -->
            <div class="justify-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- LISTE DES FACTURES ASSOCIEES A CETTE LOCATION -->
        <div class="col-md-12">
            @if($current_location)
            <h5 class="text-center">Les factures associées à cette location </strong> </h5>
            <div class="table-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($location_factures)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Faturier</th>
                            <th class="text-center">Maison</th>
                            <th class="text-center">Chambre</th>
                            <th class="text-center">Locataire</th>
                            <th class="text-center">Facture</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">Commentaire</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($location_factures as $facture)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center">{{$facture["owner"]["name"]}}</td>
                            <td class="text-center">{{$facture["location"]["house"]["name"]}}</td>
                            <td class="text-center">{{$facture["location"]["room"]["number"]}} </td>
                            <td class="text-center">{{$facture["location"]["locataire"]["name"]}} {{$facture["location"]["locataire"]["prenom"]}}</td>
                            <td class="text-center"><img src="{{$facture['facture']}}" class="img-fluid" width="50px" srcset="">
                            </td>
                            <td class="text-center">{{$facture['amount']}}</td>
                            <td class="text-center">
                                <textarea name="" class="form-control" id=""> {{$facture['comments']}} </textarea>
                            </td>
                            <td class="text-center">{{$facture['type']['name']}}</td>

                            @if($facture['status']["id"]==1)
                            <td class="text-center"> <button class="bg-warning btn btn-sm">{{$facture['status']['name']}}</button> </td>
                            @elseif($facture['status']["id"]==2)
                            <td class="text-center"> <button class="bg-success btn btn-sm">{{$facture['status']['name']}}</button> </td>
                            @else
                            <td class="text-center"> <button class="bg-red btn btn-sm">{{$facture['status']['name']}}</button> </td>
                            @endif
                            <td class="text-center">
                                <button wire:click="showFacturesTraitementForm({{$facture['id']}})" class="btn btn-sm bg-red">Traiter la facture</button> &nbsp;
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune facture disponible pour cette location</p>
                    @endif
                </table>
            </div>
            @endif
        </div>
    </div>
</div>