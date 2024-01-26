<div>

    <div class="d-flex header-bar">
        @if(session()->get("user"))
        @if(session()->get("user")["is_agent_account"] || session()->get("user")["is_chief_account"])
        <button wire:click="showForm" type="button" class="btn btn-sm bg-red">
            @if($show_form) Fermer @else Initier un paiement @endif
        </button>
        @else
        <button disabled type="button" class="btn btn-sm bg-red">
            @if($show_form) Fermer @else Initier un paiement (bloqué) @endif
        </button>
        @endif
        @endif
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
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="Initiate_Sold">
                    <h5 class="">Initier un paiement à un Propriétaire</h5>
                    <div class="row">
                        <div class="col-12">
                            <span class=" text-red"> {{$proprietor_error}} </span>
                            <select wire:model="proprietor" class="form-select mb-3 form-control" name="proprietor" id="floatingSelectGrid">
                                <option selected>Propriétaire</option>
                                @foreach($proprietors as $proprietor)
                                <option value="{{$proprietor['id']}}">{{$proprietor["lastname"]}} {{$proprietor["firstname"]}}</option>
                                @endforeach
                            </select>
                            <div class="mb-3">
                                <span class="text-red"> {{$sold_error}} </span>
                                <input wire:model="sold" type="number" name="sold" placeholder="Montant à initier ..." class="form-control">
                            </div>
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

    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive shadow-lg p-3">
                <table class="table table-striped table-sm shadow-lg">
                    @if($initiations_count>0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Manager</th>
                            <th class="text-center">Propriétaire</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">commentaire</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($initiations as $initiation)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$initiation['manager']['name']}}</td>
                            <td class="text-center">{{$initiation['proprietor']['lastname']}} {{$initiation['proprietor']['firstname']}}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-success">{{$initiation['amount']}}</button>
                            </td>
                            <td class="text-center">
                                <textarea name="" class="form-control" id="">{{$initiation['comments']}}</textarea>
                            </td>
                            <td class="text-center">
                                @if($initiation['status']['id']==2)
                                <button class="btn btn-sm btn-success">{{$initiation['status']['name']}}</button>
                                @else
                                <button class="btn btn-sm bg-red">{{$initiation['status']['name']}}</button>
                                @endif
                            </td>
                            <td class="text-center text-red"> <strong>{{$initiation['created_at']}}</strong> </td>
                            <td class="text-center">
                                @if(session()->get("user"))
                                @if(session()->get("user")["is_admin"] || session()->get("user")["is_master"])
                                <button wire:click="validate_Initiation({{$initiation['id']}})" class="btn btn-sm bg-warning">Valider</button>
                                @else
                                <button disabled class="btn btn-sm bg-warning">Valider</button>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune initiation de paiement</p>
                    @endif
                </table>
            </div>
            <!-- pagination -->
            <div class="justify-center my-2">
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