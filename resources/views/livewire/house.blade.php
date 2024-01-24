<div>

    <div>
        <div class="d-flex header-bar">
            <h2 class="accordion-header">
                <button type="button" wire:click="showForm" class="btn btn-sm bg-dark" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    @if($show_form) Fermer @else Ajouter @endif
                </button>
            </h2>

            <br>
        </div>
    </div>
    <br>
    <div class="">
        <p class="text-center text-red"> {{$generalError}} </p>
    </div>

    <br>
    @if($show_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addHouse">
                    <p class="text-center text-center"> {{$generalError}} </p>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-red"> {{$name_error}} </span>
                                <input type="text" wire:model="name" name="name" placeholder="Nom de la maison" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$latitude_error}} </span>
                                <input type="text" wire:model="latitude" name="latitude" placeholder="Latitude de la maison" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$longitude_error}} </span>
                                <input type="text" wire:model="longitude" name="longitude" placeholder="Longitude de la maison" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$type_error}} </span>
                                <select class="form-select form-control" wire:model="type" name="type" aria-label="Default select example">
                                    <option>Type de maison</option>
                                    @foreach($house_types as $type)
                                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$country_error}} </span>
                                <select class="form-select form-control" wire:model="country" name="country" aria-label="Default select example">
                                    <option>Pays</option>
                                    @foreach($countries as $countrie)
                                    <option value="{{$countrie['id']}}">{{$countrie['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$departement_error}} </span>
                                <select class="form-select form-control" wire:model="departement" name="departement" aria-label="Default select example">
                                    <option>Département</option>
                                    @foreach($departements as $departement)
                                    <option value="{{$departement['id']}}">{{$departement['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                        </div>
                        <!--  -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <select class="form-select form-control" wire:model="city" name="city" aria-label="Default select example">
                                    <span class="text-red"> {{$city_error}} </span>
                                    <option>Ville/Commune</option>
                                    @foreach($cities as $citie)
                                    <option value="{{$citie['id']}}">{{$citie['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$quartier_error}} </span>
                                <select class="form-select form-control" wire:model="quartier" name="quartier" aria-label="Default select example">
                                    <option>Quartier</option>
                                    @foreach($quartiers as $quartier)
                                    <option value="{{$quartier['id']}}">{{$quartier['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$zone_error}} </span>
                                <select class="form-select form-control" wire:model="zone" name="zone" aria-label="Default select example">
                                    <option>Zone</option>
                                    @foreach($zones as $zone)
                                    <option value="{{$zone['id']}}">{{$zone['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$supervisor_error}} </span>
                                <select class="form-select form-control" wire:model="supervisor" name="supervisor" aria-label="Default select example">
                                    <option>Superviseur</option>
                                    @foreach($supervisors as $supervisor)
                                    <option value="{{$supervisor['id']}}">{{$supervisor['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$proprietor_error}} </span>
                                <select class="form-select form-control" wire:model="proprietor" name="proprietor" aria-label="Default select example">
                                    <option>Propriétaire</option>
                                    @foreach($proprietors as $proprietor)
                                    <option value="{{$proprietor['id']}}">{{$proprietor['lastname']}} {{$proprietor['firstname']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$comments_error}} </span>
                                <textarea name="comments" wire:model="comments" class="form-control" placeholder="Laissez un commentaire ici" class="form-control" id=""></textarea>
                            </div><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn bg-red">Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endif

    <br>

    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Latitude</th>
                            <th class="text-center">Longitude</th>
                            <th class="text-center">Type de maison</th>
                            <th class="text-center">Superviseur</th>
                            <th class="text-center">Propriétaire</th>
                            <th class="text-center">Chambres</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    @if($houses_count>0)
                    <tbody>
                        @foreach($houses as $house)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center"> {{$house["name"]}}</td>
                            <td class="text-center">{{$house["latitude"]}}</td>
                            <td class="text-center">{{$house["longitude"]}}</td>
                            <td class="text-center">{{$house["type"]["name"]}}</td>
                            <td class="text-center">{{$house["supervisor"]["name"]}}</td>
                            <td class="text-center">{{$house["proprietor"]["lastname"]}} {{$house["proprietor"]["firstname"]}}</td>
                            <td class="text-center">
                                <button type="button" wire:click="retrieve({{$house['id']}})" class="btn btn-sm bg-warning" data-bs-target="#houseRooms">
                                    Voir
                                </button>
                            </td>
                            <td class="text-center">
                                <!-- <button class="btn btn-sm bg-dark">Modifier</button> &nbsp; -->
                                <button class="btn btn-sm bg-red" wire:click="delete({{$house['id']}})">Supprimer</button> &nbsp;
                                <a href="{{$house['id']}}/stopHouseState" class="btn btn-sm bg-warning text-dark">Arrêter les
                                    états</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune maison n'a été ajoutée!</p>
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

        <!-- LISTE DES MAISONS ASSOCIEES A UN LOCATAIRES -->
        <div class="col-md-12">
            @if($current_house)
            <h5 class="text-center">Les Chambres de la maison -- <strong class="text-red"> {{$current_house["name"]}} </strong> </h5>
            <div class="table-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($house_rooms)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">N° de chambre</th>
                            <th class="text-center">Loyer</th>
                            <th class="text-center">Montant payé /Mois </th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Nature</th>
                            <th class="text-center">commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($house_rooms as $room)

                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center"> <button class="btn btn-sm btn-success"> {{$room["number"]}}</button></td>
                            <td class="text-center">{{$room["loyer"]}}</td>
                            <td class="text-center">{{$room["number"]}}</td>
                            <td class="text-center"> <button class="btn btn-sm btn-success">{{$room["total_amount"]}} </button> </td>
                            <td class="text-center">{{$room["type"]["name"]}}</td>
                            <td class="text-center">
                                <textarea name="" id="">{{$room["comments"]}}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune Chambre!</p>
                    @endif
                </table>
            </div>
            @endif
        </div>
    </div>
</div>