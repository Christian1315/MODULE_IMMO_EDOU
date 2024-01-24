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

    <div class="">
        <p class="text-center text-red"> {{$generalError}} </p>
    </div>
    <br>
    @if($show_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addProprio">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-red"> {{$firstname_error}} </span>
                                <input type="text" wire:model="firstname" name="firstname" placeholder="Nom" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$lastname_error}} </span>
                                <input type="text" wire:model="lastname" name="lastname" placeholder="Prénom" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$phone_error}} </span>
                                <input type="phone" wire:model="phone" name="phone" placeholder="Téléphone" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$email_error}} </span>
                                <input type="text" wire:model="email" placeholder="Adresse email" name="email" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$sexe_error}} </span>
                                <select wire:model="sexe" class="form-select form-control" name="sexe" aria-label="Default select example">
                                    <option>Sexe</option>
                                    <option value="Maxculin">Maxculin</option>
                                    <option value="Feminin">Feminin</option>
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$piece_number_error}} </span>
                                <input type="text" wire:model="piece_number" name="piece_number" placeholder="Numéro de pièce d'identité" class="form-control">
                            </div><br>
                        </div>
                        <!--  -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span>Télécharger le mandat du contrat</span>
                                <span class="text-red"> {{$mandate_contrat_error}} </span>
                                <input type="file" wire:model="mandate_contrat" name="mandate_contrat" class="form-control">
                            </div><br>

                            <div class="mb-3">
                                <span class="text-red"> {{$adresse_error}} </span>
                                <input type="text" wire:model="adresse" placeholder="Adresse" name="adresse" class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$country_error}} </span>
                                <select wire:model="country" class="form-select form-control" name="country" aria-label="Default select example">
                                    <option>Pays</option>
                                    @foreach($countries as $countrie)
                                    <option value="{{$countrie['id']}}">{{$countrie['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$city_error}} </span>
                                <select wire:model="city" class="form-select form-control" name="city" aria-label="Default select example">
                                    <option>Ville/Commune</option>
                                    @foreach($cities as $citie)
                                    <option value="{{$citie['id']}}">{{$citie['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$card_type_error}} </span>
                                <select wire:model="card_type" class="form-select form-control" name="card_type" aria-label="Default select example">
                                    <option>Type de carte ID</option>
                                    @foreach($card_types as $type)
                                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                                    @endforeach
                                </select>
                            </div><br>

                            <div class="mb-3">
                                <span class="text-red"> {{$comments_error}} </span>
                                <textarea wire:model="comments" name="comments" class="form-control" placeholder="Laissez un commentaire ici" class="form-control" id=""></textarea>
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
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Prénom</th>
                            <th class="text-center">Téléphone</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">N° Pièce d'identité</th>
                            <th class="text-center">Mandat du contrat</th>
                            <th class="text-center">Adresse</th>
                            <th class="text-center">Maisons</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    @if($proprietors_count>0)
                    <tbody>
                        @foreach($proprietors as $proprietor)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center">{{$proprietor["lastname"]}}</td>
                            <td class="text-center">{{$proprietor["firstname"]}}</td>
                            <td class="text-center">{{$proprietor["phone"]}}</td>
                            <td class="text-center">{{$proprietor["email"]}}</td>
                            <td class="text-center">{{$proprietor["piece_number"]}}</td>
                            <td class="text-center"><img src="{{$proprietor['mandate_contrat']}}" class="img-fluid" width="50px" srcset="">
                            </td>
                            <td class="text-center">{{$proprietor["adresse"]}}</td>
                            <td class="text-center">
                                <button type="button" wire:click="retrieve({{$proprietor['id']}})" class="btn btn-sm bg-warning" data-bs-target="#proprioHouses">
                                    Voir
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm bg-red" wire:click="delete({{$proprietor['id']}})">Supprimer</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucun propriétaires n'est ajouté!</p>
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
            @if($current_proprietor)
            <h5 class="text-center">Les Maisons du propriétaire -- <strong class="text-red"> {{$current_proprietor["lastname"]}} {{$current_proprietor["firstname"]}} </strong> </h5>
            <div class="tabsle-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($this->proprietor_houses)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Latitude</th>
                            <th class="text-center">Longétitude</th>
                            <th class="text-center">commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proprietor_houses as $proprietor_house)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1 }}</td>
                            <td class="text-center"> <button class="btn btn-sm btn-success"> {{$proprietor_house["name"]}}</button> </td>
                            <td class="text-center">{{$proprietor_house["latitude"]}}</td>
                            <td class="text-center">{{$proprietor_house["longitude"]}}</td>
                            <td class="text-center">
                                <textarea name="" class="form-control" rows="1" id="">{{$proprietor_house["comments"]}}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune maison</p>
                    @endif
                </table>
            </div>
            @endif
        </div>
    </div>
</div>