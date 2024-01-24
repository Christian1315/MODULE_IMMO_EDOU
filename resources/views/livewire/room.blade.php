<div>

    <div class="d-flex header-bar">
        <button wire:click="showForm" type="button" class="btn btn-sm bg-dark" data-bs-toggle="modal" data-bs-target="#addRoom">
            @if($show_form) Fermer @else Ajouter @endif
        </button> &nbsp; &nbsp;&nbsp;

        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Rechercher une chambre" aria-label="Search">
        </form>
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
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addRoom">
                    <p class="text-center text-center"> {{$generalError}} </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-red"> {{$loyer_error}} </span>
                                <input type="text" wire:model="loyer" name="loyer" placeholder="Le loyer" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$number_error}} </span>
                                <input type="text" wire:model="number" name="number" placeholder="Numéro de la chambre" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$security_error}} </span>
                                <input type="text" wire:model="security" name="security" placeholder="La sécurité ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$rubbish_error}} </span>
                                <input type="text" wire:model="rubbish" name="rubbish" placeholder="Les ordures ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$vidange_error}} </span>
                                <input type="text" wire:model="vidange" name="vidange" placeholder="La vidange ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$cleaning_error}} </span>
                                <input type="text" wire:model="cleaning" name="cleaning" placeholder="Le nettoyage ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$comments_error}} </span>
                                <textarea wire:model="comments" name="comments" class="form-control" placeholder="Laissez un commentaire ici" class="form-control" id=""></textarea>
                            </div><br>
                        </div>
                        <!--  -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <span class="text-red"> {{$house_error}} </span>
                                <select wire:model="house" class="form-select form-control" name="house" aria-label="Default select example">
                                    <option >Maison</option>
                                    @foreach($houses as $house)
                                    <option value="{{$house['id']}}">{{$house['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$nature_error}} </span>
                                <select wire:model="nature" class="form-select form-control" name="nature" aria-label="Default select example">
                                    <option >Nature de la chambre</option>
                                    @foreach($room_natures as $nature)
                                    <option value="{{$nature['id']}}">{{$nature['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$type_error}} </span>
                                <select wire:model="type" class="form-select form-control" name="type" aria-label="Default select example">
                                    <option >Type de la chambre</option>
                                    @foreach($room_types as $type)
                                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>

                            <div class="mb-3">
                                <input wire:model="water_counter" type="checkbox" name="water_counter" class="btn-check" id="btncheck1" autocomplete="off">
                                <label class="btn bg-dark" for="btncheck1">
                                    Compteur eau ... <br>
                                    <span class="text-red"> {{$water_counter_error}} </span>
                                </label>
                            </div><br>
                            <div class="mb-3">
                                <input wire:model="water_discounter" type="checkbox" name="water_discounter" class="btn-check" id="btncheck2" autocomplete="off">
                                <label class="btn bg-dark" for="btncheck2">
                                    Décompteur eau ... <br>
                                    <span class="text-red"> {{$water_discounter_error}} </span>
                                </label>
                            </div><br>
                            <div class="mb-3">
                                <input wire:model="electric_counter" type="checkbox" name="electric_counter" class="btn-check" id="btncheck3" autocomplete="off">
                                <label class="btn bg-dark" for="btncheck3">
                                    Compteur électrique ... <br>
                                    <span class="text-red"> {{$electric_counter_error}} </span>
                                </label>
                            </div><br>
                            <div class="mb-3">
                                <input wire:model="electric_discounter" type="checkbox" name="electric_counter" class="btn-check" id="btncheck4" autocomplete="off">
                                <label class="btn bg-dark" for="btncheck4">
                                    Décompteur électrique ... <br>
                                    <span class="text-red"> {{$electric_discounter_error}} </span>
                                </label>
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="btn-group text-center" role="group">
                                <input wire:model="publish" type="checkbox" name="publish" class="btn-check" id="btncheck1" autocomplete="off">
                                <label class="btn bg-dark" for="btncheck1">Publier</label>

                                <input wire:model="home_banner" type="checkbox" name="home_banner" class="btn-check" id="home_banner" id="btncheck2" autocomplete="off">
                                <label class="btn bg-dark" wire:click="manageBanner" for="btncheck2">
                                    Image en bannière <br>
                                    <span class="text-red"> {{$principal_img_error}} </span>

                                </label>
                            </div>
                        </div><br>

                        @if($home_banner)
                        <div class="col-md-12" id="principal_img">
                            <span>Uploader l'image principale</span><br>
                            <span class="text-red"> {{$principal_img_error}} </span>
                            <input wire:model="principal_img" type="file" name="principal_img" class="form-control">
                        </div>
                        @endif
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
                            <th class="text-center">Chambre</th>
                            <th class="text-center">Maison</th>
                            <th class="text-center">Loyer</th>
                            <th class="text-center">Loyer Total</th>
                            <th class="text-center">Type de Chambre</th>
                            <th class="text-center">Locataires</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    @if($rooms_count>0)
                    <tbody>
                        @foreach($rooms as $room)

                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$room["number"]}}</td>
                            <td class="text-center">{{$room["house"]["name"]}}</td>
                            <td class="text-center">{{$room["loyer"]}}</td>
                            <td class="text-center">{{$room["total_amount"]}}</td>
                            <td class="text-center">{{$room["type"]['name']}}</td>
                            <td class="text-center">
                                <button wire:click="retrieve({{$room['id']}})" type="button" class="btn btn-sm bg-warning" data-bs-target="#roomLocatires">
                                    Voir
                                </button>
                            </td>
                            <td class="text-center">
                                <!-- <button class="btn btn-sm bg-dark">Modifier</button> &nbsp; -->
                                <button wire:click="delete({{$room['id']}})" class="btn btn-sm bg-red">Suprimer</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune chambre n'a été ajoutée!</p>
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

        <!-- LISTE DES LOCATAIRES ASSOCIEES A CETTE MAISON -->
        <div class="col-md-12">
            @if($current_room)
            <h5 class="text-center">Les Locataire de la chambre -- <strong class="text-red"> {{$current_room["number"]}} </strong> </h5>
            <div class="table-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($room_locations)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">N° de chambre</th>
                            <th class="text-center">Loyer</th>
                            <th class="text-center">Montant payé /Mois </th>
                            <th class="text-center">Type</th>
                            <th class="text-center">commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($room_locations as $location)

                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center"><button class="btn btn-sm btn-success"> {{$location["room"]["number"]}}</button> </td>
                            <td class="text-center">{{$location["room"]["loyer"]}}</td>
                            <td class="text-center"> <button class="btn btn-sm btn-success">{{$location["room"]["total_amount"]}} </button> </td>
                            <td class="text-center">{{$location["type"]["name"]}}</td>
                            <td class="text-center">
                                <textarea name="" id="">{{$location["comments"]}}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucun locataire !</p>
                    @endif
                </table>
            </div>
            @endif
        </div>
    </div>

</div>