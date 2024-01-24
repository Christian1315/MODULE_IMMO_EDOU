<div>

    <div class="d-flex header-bar">
        <button wire:click="showForm" type="button" class="btn btn-sm bg-dark" data-bs-toggle="modal" data-bs-target="#addLocator">
            @if($show_form) Fermer @else Ajouter @endif
        </button> &nbsp; &nbsp;&nbsp;

        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Rechercher un locataire" aria-label="Search">
        </form>
    </div>
    <br>

    <div class="">
        <p class="text-center text-red"> {{$generalError}} </p>
    </div>

    @if($show_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addlocator">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-red"> {{$name_error}} </span>
                                <input type="text" wire:model="name" name="name" placeholder="Nom ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$prenom_error}} </span>
                                <input type="text" wire:model="prenom" name="prenom" placeholder="Prénom ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$email_error}} </span>
                                <input type="text" wire:model="email" name="email" placeholder="Email..." class="form-control">
                            </div><br>
                            <span class="text-red"> {{$sexe_error}} </span>
                            <select wire:model="sexe" class="form-select form-control" name="sexe" aria-label="Default select example">
                                <option >Sexe</option>
                                <option value="Maxculin">Maxculin</option>
                                <option value="Feminin">Feminin</option>
                            </select><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$phone_error}} </span>
                                <input wire:model="phone" type="phone" name="phone" placeholder="Téléphone ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$piece_number_error}} </span>
                                <input wire:model="piece_number" type="text" name="piece_number" placeholder="Numéro de la pièce d'identité ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span>Télécharger le contrat du mandat</span> <br>
                                <span class="text-red"> {{$mandate_contrat_error}} </span>
                                <input wire:model="mandate_contrat" type="file" name="mandate_contrat" class="form-control">
                            </div><br>
                        </div>
                        <!--  -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-red"> {{$adresse_error}} </span>
                                <input wire:model="adresse" type="text" name="adresse" class="form-control" placeholder="Adresse ....">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$card_id_error}} </span>
                                <input wire:model="card_id" type="text" name="card_id" class="form-control" placeholder="ID de la carte ....">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$card_type_error}} </span>
                                <select wire:model="card_type" class="form-select form-control" name="card_type" aria-label="Default select example">
                                    <option >Type de carte</option>
                                    @foreach($card_types as $type)
                                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$country_error}} </span>
                                <select wire:model="country" class="form-select form-control" name="country" aria-label="Default select example">
                                    <option >Pays</option>
                                    @foreach($countries as $countrie)
                                    <option value="{{$countrie['id']}}">{{$countrie['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$departement_error}} </span>
                                <select wire:model="departement" class="form-select form-control" name="departement" aria-label="Default select example">
                                    <option >Département</option>
                                    @foreach($departements as $departement)
                                    <option value="{{$departement['id']}}">{{$departement['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="mb-3">
                                <span class="text-red"> {{$comments_error}} </span>
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

    <br><br><br>

    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Prénom</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Numéro de pièce</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Adresse</th>
                            <th class="text-center">Contrat</th>
                            <th class="text-center">Maisons</th>
                            <th class="text-center">Chambres</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    @if($locators_count>0)
                    <tbody>
                        @foreach($locators as $locator)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$locator["name"]}}</td>
                            <td class="text-center">{{$locator["prenom"]}}</td>
                            <td class="text-center">{{$locator["email"]}}</td>
                            <td class="text-center">{{$locator["piece_number"]}}</td>
                            <td class="text-center">{{$locator["phone"]}}</td>
                            <td class="text-center">{{$locator["adresse"]}}</td>
                            <td class="text-center"><img src="{{$locator['mandate_contrat']}}" class="img-fluid" width="50px" srcset="">
                            </td>
                            <td class="text-center">
                                <button wire:click="showHouses({{$locator['id']}})" type="button" class="btn btn-sm bg-warning">
                                    Voir
                                </button>
                            </td>
                            <td class="text-center">
                                <button wire:click="showRooms({{$locator['id']}})" type="button" class="btn btn-sm bg-warning" data-bs-toggle="modal" data-bs-target="#locataireRooms">
                                    Voir
                                </button>
                            </td>
                            <td class="text-center">
                                <!-- <button class="btn btn-sm bg-dark">Modifier</button> &nbsp; -->
                                <button class="btn btn-sm bg-red" wire:click="delete({{$locator['id']}})">Suprimer</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucun locataire n'a été ajouté!</p>
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

        <!-- LISTE DES MAISONS ASSOCIEES A UN LOCATAIRE -->
        <div class="col-md-12">
            @if($current_locator)
            <h5 class="text-center">Les Maisons dans lesquelles se trouve le locataire -- <strong class="text-red"> {{$current_locator["name"]}} {{$current_locator["prenom"]}} </strong> </h5>
            <div class="table-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($locator_houses)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Longitude</th>
                            <th class="text-center">Latitude </th>
                            <th class="text-center">Propriétaire</th>
                            <th class="text-center">Superviseur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locator_houses as $house)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$house["name"]}}</td>
                            <td class="text-center">{{$house["longitude"]}}</td>
                            <td class="text-center">{{$house["latitude"]}}</td>
                            <td class="text-center"> <button class="btn btn-sm bg-success"> {{$house["proprietor"]["lastname"]}} {{$house["proprietor"]["firstname"]}}</button> </td>
                            <td class="text-center"> <button class="btn btn-sm bg-red"> {{$house["supervisor"]["name"]}}</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune maison !</p>
                    @endif
                </table>
            </div>
            @endif
        </div>

        <!-- LISTE DES CHAMBRES DANS LES QUELLES SE TROUVENT CE LOCATAIRE -->
        <div class="col-md-12">
            @if($current_locator_for_room)
            <h5 class="text-center">Les Chambres dans lesquelles se trouve le locataire -- <strong class="text-red"> {{$current_locator_for_room["name"]}} {{$current_locator_for_room["prenom"]}} </strong> </h5>
            <div class="table-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($locator_rooms)!=0)

                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Loyer</th>
                            <th class="text-center">Total à payer</th>
                            <th class="text-center">Commantaire </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locator_rooms as $room)

                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center"> <button class="btn btn-sm btn-success">{{$room["number"]}} </button> </td>
                            <td class="text-center">{{$room["loyer"]}}</td>
                            <td class="text-center"> <button class="btn btn-sm bg-red">{{$room["total_amount"]}}</button> </td>
                            <td class="text-center">
                                <textarea name="" id="">{{$room["comments"]}}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune chambre !</p>
                    @endif
                </table>
            </div>
            @endif
        </div>
    </div>
</div>