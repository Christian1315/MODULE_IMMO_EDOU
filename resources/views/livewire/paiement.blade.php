<div>

    <h4 class="text-dark">Filtrer par période</h4>
    <div class="d-flex header-bar">
        <span class="text-red"> {{$start_date_error}} </span><br>
        <input wire:model="start_date" class="form-control" type="date" name="start_date">
        <span class="text-red"> {{$end_date_error}} </span><br>
        <input wire:model="end_date" class="form-control" type="date" name="end_date">
        &nbsp;
        <button wire:click="searchByDate" class="btn btn-sm bg-red">Rechercher</button>
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
                <form class="shadow-lg p-3 animate__animated animate__bounce" wire:submit.prevent="TraitePaiement">
                    <h5 class="">Traitement du paiement d'ID <<{{$currentActivepaiement}}>></h5>
                    <div class="row">
                        <div class="col-12">
                            <span class="text-red"> {{$status_error}} </span>
                            <select required wire:model="status" name="status" class="form-select mb-3 form-control">
                                <option selected>Status de paiement</option>
                                @foreach($paiement_status as $status)
                                <option value="{{$status['id']}}">{{$status['name']}}</option>
                                @endforeach
                            </select>
                            <!-- <textarea wire:model="comments" name="comments" id="" class="form-control" placeholder="Un commentaire ...."></textarea> -->
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
            <div class="table-responsive shadow-lg p-3">
                <table class="table table-striped table-sm">
                    @if($paiements_count>0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Responsable</th>
                            <th class="text-center">Reference</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">commentaire</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Facture</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$paiement["owner"]["name"]}}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-success">{{$paiement["reference"]}}</button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm bg-red">{{$paiement["amount"]}}</button>
                            </td>
                            <td class="text-center">
                                <textarea name="" class="form-control" id="">{{$paiement["comments"]}}</textarea>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm shadow-sm bg-light">{{$paiement["type"]["name"]}}</button>
                            </td>
                            <td class="text-center">
                                <img src="{{$paiement['facture']['facture']}}" class="img-fluid" width="50px" alt="" srcset="">
                            </td>
                            <td class="text-center">
                            <td class="text-center">
                                @if($paiement['status']['id']==1)
                                <button class="btn btn-sm btn-warning">{{$paiement['status']['name']}}</button>
                                @elseif($paiement['status']['id']==2)
                                <button class="btn btn-sm bg-red">{{$paiement['status']['name']}}</button>
                                @elseif($paiement['status']['id']==3)
                                <button class="btn btn-sm btn-success">{{$paiement['status']['name']}}</button>
                                @elseif($paiement['status']['id']==4)
                                <button class="btn btn-sm bg-red">{{$paiement['status']['name']}}</button>
                                @endif
                            </td>
                            </td>
                            <td class="text-center text-red"> <strong>{{$paiement['created_at']}}</strong> </td>
                            <td class="text-center">
                                @if(session()->get("user"))
                                @if(session()->get("user")["is_master"] || session()->get("user")["is_admin"])
                                <button wire:click="showForm({{$paiement['id']}})" class="btn btn-sm bg-warning"> @if($show_form) Fermer @else Traiter le paiement @endif</button>
                                @else
                                <button disabled class="btn btn-sm bg-warning">Traiter le paiement(bloqué) </button>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucun paiement</p>
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