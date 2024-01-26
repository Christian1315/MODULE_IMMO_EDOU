<div>

    <div class="col-md-12">
        @if($show_solds)
        @if($current_account)
        <h5 class="">Détails des créditation du compte -- <strong class="text-red"> {{$current_account["name"]}} </strong> </h5>

        <div class="table-responsive shadow-lg p-3">
            <table class="table table-striped table-sm">
                @if(count($account_solds)!=0)
                <thead>
                    <tr>
                        <th class="text-center">N°</th>
                        <th class="text-center">Manager</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Montant</th>
                        <th class="text-center">Visibilité</th>
                        <th class="text-center">Crédité le</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($account_solds as $sold)
                    <tr class="align-items-center">
                        <td class="text-center">{{$loop->index + 1}}</td>
                        <td class="text-center">{{$sold['manager']['name']}}</td>
                        <td class="text-center">
                            <textarea name="" class="form-control" id="">{{$sold['description']}}</textarea>
                        </td>
                        <td class="text-center text-red"><strong>{{$sold['sold']}}</strong> </td>
                        <td class="text-center">
                            @if(!$sold['visible'])
                            <button class="btn btn-sm bg-red">Ancien</button>
                            @else
                            <button class="btn btn-sm btn-success">Actuel</button>
                            @endif
                        </td>
                        <td class="text-center text-red">{{$sold['created_at']}}</td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <p class="text-center text-red">Aucun solde !</p>
                @endif
            </table>
        </div>
        @endif
        @endif
    </div>
    <br><br><br>
    <div class="">
        <p class="text-center text-red"> {{$generalError}} </p>
    </div>
    @if($show_form)
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="addSold">
                    <h5 class="">Créditation du compte -- <span class="text-red">
                            << {{$current_account["name"]}}>>
                        </span> </h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <span class="text-red"> {{$sold_error}} </span>
                                <input wire:model="sold" type="number" name="sold" placeholder="Le montant à crédier ..." class="form-control">
                            </div>
                            <span class="text-red"> {{$comments_error}} </span>
                            <textarea wire:model="comments" name="comments" id="" class="form-control" placeholder="Un commentaire ...."></textarea>
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
            <div class="table-responsive p-3 roundered shadow-lg">
                <table class="table table-striped table-sm ">
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Plafond Maximum</th>
                            <th class="text-center">Solds Crédités</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    @if($accounts_count>0)
                    <tbody>
                        @foreach($accounts as $account)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$account["name"]}}</td>
                            <td class="text-center">
                                <textarea name="" class="form-control" id=""> {{$account["description"]}} </textarea>
                            </td>
                            <td class="text-center">{{$account["phone"]}} </td>
                            <td class="text-center">{{$account["email"]}}</td>
                            <td class="text-center text">
                                <button class="btn btn-sm bg-red text-white shadow">{{$account["plafond_max"]}}</button>
                            </td>

                            <td class="text-center">
                                <button wire:click="showSolds({{$account['id']}})" class="btn btn-sm bg-success">Voir </button>
                            </td>
                            <td class="text-center">
                                @if(session()->get("user"))
                                @if(session()->get("user")["is_master"] || session()->get("user")["is_admin"] || session()->get("user")["is_chief_account"] || session()->get("user")["is_agent_account"])
                                <button wire:click="showForm({{$account['id']}})" class="btn btn-sm bg-red">Créditer</button>
                                @else
                                <button disabled class="btn btn-sm bg-red">Créditer (bloqué)</button>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucun compte disponible!</p>
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