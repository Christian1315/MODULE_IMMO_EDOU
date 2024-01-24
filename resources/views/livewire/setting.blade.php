<div>
    <div class="d-flex header-bar">
        <button wire:click="ShowAddForm" type="button" class="btn btn-sm bg-dark" data-bs-toggle="modal" data-bs-target="#addUser">
            @if($showAddForm) Fermer @else Ajouter un utilisateur @endif
        </button> &nbsp; &nbsp;&nbsp;

        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Rechercher un utilisateur" aria-label="Search">
        </form>
    </div>

    <div class="text-center">
        <p class="text-center text-red"> {{$generalError}} </p>
    </div>

    <br><br>
    @if($showAddForm)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addUser">
                    <h4>Ajout d'un utilisateur</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-red"> {{$name_error}} </span>
                                <input wire:model="name" type="text" name="name" placeholder="Nom/Prénom ...." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$username_error}} </span>
                                <input wire:model="username" type="text" name="username" placeholder="Identifiant(username)" class="form-control">
                            </div><br>
                        </div>
                        <!--  -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="text-red"> {{$phone_error}} </span>
                                <input wire:model="phone" type="phone" name="phone" placeholder="Téléphone ..." class="form-control">
                            </div><br>
                            <div class="mb-3">
                                <span class="text-red"> {{$email_error}} </span>
                                <input wire:model="email" type="text" placeholder="Votre Adresse mail ..." name="email" class="form-control">
                            </div><br>
                        </div>
                    </div>
                    <div class="modal-footer justify-center">
                        <button type="submit" class="btn bg-dark">Enregistrer</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endif

    <br><br>
    @if($showRoleForm)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form wire:submit="AffectRole" class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addUser">
                    <h4>Affectation de rôle au user -- <span class="text-red">
                            << {{$currentActiveUser["name"]}}>>
                        </span> </h4>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-red"> {{$role_error}} </span>
                            <select required wire:model="role" name="role" class="form-select mb-3 form-control">
                                <option>Choisir un rôle</option>
                                @foreach($allRoles as $role)
                                <option value="{{$role['id']}}">{{$role['label']}} -- (<span class="text-red">{{$role['description']}}</span>) </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-center">
                        <button type="submit" class="btn bg-red">Affecter</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    @endif

    <br><br>
    @if($showUserRoles)
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5 class="text-center">Rôles de l'utilisateur -- <span class="text-red">
                        << {{$this->currentActiveUser["name"]}}>>
                    </span> </h5>
                <br>
                <div class="table-responsive animate__animated animate__bounce">
                    <table class="table table-striped table-sm table-dark">
                        @if(count($currentUserRoles)>0)
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center">Label</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($currentUserRoles as $role)
                            <tr class="align-items-center">
                                <td class="text-center">{{$loop->index + 1}}</td>
                                <td class="text-center">{{$role["label"]}}</td>
                                <td class="text-center">
                                    <textarea name="" id="">{{$role["description"]}}</textarea>
                                </td>
                                <td class="text-center">
                                    <button wire:click="remove({{$role['id']}})" class="btn btn-sm bg-warning">- Retirer </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <p class="text-center text-red">Ce utilisateur ne dispose d'aucun rôle!</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <br><br>
    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    @if(count($users)>0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom/Prénom</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Date de création</th>
                            <th class="text-center">Rôles</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        @if($user["is_archive"])
                        <tr disabled class="align-items-center shadow my-2" style="background-color:#F6F6F6;border: solid 2px #000">
                            <th class="text-center">{{$loop->index + 1}}</th>
                            <th class="text-center">{{$user["name"]}}</th>
                            <th class="text-center">{{$user["email"]}}</th>
                            <th class="text-center">{{$user["phone"]}}</th>
                            <th class="text-center text-red">{{$user["created_at"]}}</th>
                            <td class="text-center ">
                                <button disabled class="btn btn-sm bg-warning" data-bs-toggle="modal" data-bs-target="#seeRoles">
                                    <i class="bi bi-eye-fill"></i> &nbsp;
                                    Voir
                                </button>
                            </td>
                            <td class="text-center">
                                <button disabled class="btn btn-sm bg-red">Archivé</button> &nbsp;
                                <button disabled class="btn btn-sm bg-light">Affecter rôle</button> &nbsp;
                                <button disabled class="btn btn-sm bg-dark">Duppliquer</button> &nbsp;
                                &nbsp;
                            </td>
                        </tr>
                        @else
                        <tr class="align-items-center">
                            <th class="text-center">{{$loop->index +1}}</th>
                            <th class="text-center">{{$user["name"]}}</th>
                            <th class="text-center">{{$user["email"]}}</th>
                            <th class="text-center">{{$user["phone"]}}</th>
                            <th class="text-center text-red">{{$user["created_at"]}}</th>
                            <td class="text-center ">
                                <button wire:click="seeRoles({{$user['id']}})" class="btn btn-sm bg-warning">
                                    <i class="bi bi-eye-fill"></i> &nbsp;
                                    Voir
                                </button>
                            </td>
                            <td class="text-center">
                                <button wire:click="Archiver({{$user['id']}})" class="btn btn-sm bg-success">Archiver</button> &nbsp;
                                <button wire:click="ShowAffectRoleForm({{$user['id']}})" class="btn btn-sm bg-light">Affecter rôle</button> &nbsp;
                                &nbsp;
                                <button wire:click="Dupliquer({{$user['id']}})" class="btn btn-sm bg-dark">Duppliquer</button> &nbsp;
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucun utilisateur n'a été ajouté</p>
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

</div>