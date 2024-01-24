<div>
    <div class="text-center">
        <p class="text-red"> {{$generalError}} </p>
    </div>
    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    @if($locations_count>0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Maison</th>
                            <th class="text-center">Chambre</th>
                            <th class="text-center">Locataire</th>
                            <th class="text-center">Contrat</th>
                            <th class="text-center">Loyer</th>
                            <th class="text-center">Dernier loyer payé</th>
                            <th class="text-center">Mouvement des locataires</th>
                        </tr>
                    </thead>
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
                            <td class="text-center">
                                <button class="btn btn-sm btn-success"> {{$location["latest_loyer_date"]}}</button>
                            </td>
                            <td class="text-center">
                                <button wire:click="showLocatorBeforeStates({{$location['id']}})" class="btn btn-sm bg-dark">Avant arrêt d'état</button> &nbsp;
                                <button wire:click="showLocatorAfterStates({{$location['id']}})" class="btn btn-sm bg-red">Après arrêt d'état</button> &nbsp;
                                &nbsp;
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

        <!-- LOCATAIRES AYANT PAY2 AVANT LA DATE D'ARRET DES ETATS DANS CETTE LOCATION -->
        @if($show_locatorsBefore)
        <div class="col-md-12">
            <h5 class="">Les locataires ayant payés avant l'arrêt des états de la location d'ID -- <span class="text-red">
                    << {{$current_locationId}}>>
                </span> </h5>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    @if(count($location_locatorsBefore)>0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Prénom</th>
                            <th class="text-center">Phone </th>
                            <th class="text-center">Adresse</th>
                            <th class="text-center">commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($location_locatorsBefore as $locator)
                        @if(array_key_exists("locataire",$locator))
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$locator["locataire"]["name"]}}</td>
                            <td class="text-center">{{$locator["locataire"]["prenom"]}}</td>
                            <td class="text-center">{{$locator["locataire"]["phone"]}}</td>
                            <td class="text-center">{{$locator["locataire"]["adresse"]}}</td>
                            <td class="text-center">
                                <textarea name="" id="">{{$locator["locataire"]["comments"]}}</textarea>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-red text-center">Aucun locataires n'a payé avant l'ârrêt de états dans cette location</p>
                    @endif
                </table>
            </div>
        </div>
        @endif
        <br><br><br>
        <!-- LOCATAIRES AYANT PAY2 APRES LA DATE D'ARRET DES ETATS DANS CETTE LOCATION -->
        @if($show_locatorsAfter)
        <div class="col-md-12">
            <h5 class="text-center">Les locataires ayant payés avant l'arrêt des états de la location d'ID -- <span class="text-red">
                    << {{$current_locationId}}>>
                </span> </h5>

            <div class="table-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($location_locatorsAfter)>0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Prénom</th>
                            <th class="text-center">Phone </th>
                            <th class="text-center">Adresse</th>
                            <th class="text-center">commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($location_locatorsAfter as $locator)
                        @if(array_key_exists("locataire",$locator))
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$locator["locataire"]["name"]}}</td>
                            <td class="text-center">{{$locator["locataire"]["prenom"]}}</td>
                            <td class="text-center">{{$locator["locataire"]["phone"]}}</td>
                            <td class="text-center">{{$locator["locataire"]["adresse"]}}</td>
                            <td class="text-center">
                                <textarea name="" id="">{{$locator["locataire"]["comments"]}}</textarea>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-red text-center">Aucun locataires n'a payé avant l'ârrêt de états dans cette location</p>
                    @endif
                </table>
            </div>
        </div>
        @endif

    </div>
</div>