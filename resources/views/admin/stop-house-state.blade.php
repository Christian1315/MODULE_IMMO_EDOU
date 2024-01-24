<x-templates.base :title="'Arret des états'" :active="'house'">
    <!-- HEADER -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Panel d'arrêt des états de la Maison -- <span class="text-red"> {{$house["name"]}}</span> </h1>
    </div>
    <br>

    <div class="d-flex header-bar justify-content-between">
        <h4> <strong>Superviseur: <span class="text-red">{{$house["supervisor"]["name"]}}</span> </strong></h4>
        &nbsp;&nbsp;

        <form action="/{{$house['id']}}/stopState" method="get">
            @csrf
            <button class="btn btn-md bg-red">Arrêter les états de cette maison</button>
        </form>
    </div>

    <br>

    <p class="">Liste des locations de la maison</p>
    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    @if(count($locations)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Locataire</th>
                            <th class="text-center">Téléphone</th>
                            <th class="text-center">Chambre</th>
                            <th class="text-center">Loyer Mensuel</th>
                            <th class="text-center">Dernier mois payé</th>
                            <th class="text-center">Date d'Intégration</th>
                            <th class="text-center">Factures</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)

                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center"> <button class="btn btn-sm btn-light"> <strong> {{$location["locataire"]["name"]}} {{$location["locataire"]["prenom"]}}</strong> </button> </td>
                            <td class="text-center">{{$location["locataire"]["phone"]}}</td>
                            <td class="text-center">{{$location["room"]["number"]}}</td>
                            <td class="text-center">{{$location["room"]["total_amount"]}}</td>
                            <td class="text-center"> <button class="btn btn-sm btn-success"> {{$location["latest_loyer_date"]}} </button></td>
                            <td class="text-center">{{$location["integration_date"]}}</td>
                            <td class="text-center">
                                <a href="/{{$location['id']}}/factures" type="button" class="btn btn-sm bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#locationFactures">
                                    Voir
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune location!</p>
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
    <br><br>


    <h4 class="text-red">Liste des états de la maison</h4>
    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    @if(count($states)!=0)

                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Le responsable de l'arrêt</th>
                            <th class="text-center">Date d'arrêt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($states as $state)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center"> {{$state["owner"]["name"]}} </td>
                            <td class="text-center"> <span class="btn btn-sm p-1 bg-red">{{$state["stats_stoped_day"]}}</span> </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucun arrêt d'état!</p>
                    @endif
                </table>
            </div>
        </div>
    </div>

</x-templates.base>