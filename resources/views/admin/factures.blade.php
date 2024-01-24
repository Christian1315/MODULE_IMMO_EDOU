<x-templates.base :title="'Factures'" :active="'location'">

    <!-- HEADER -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Panel des Factures</h1>
    </div>
    <br>

    <!-- MODAL DU FORMULAIRE DE CHANGEMENT DE STATUS -->
    <div class="modal fade" id="changeStatus" data-bs-toggle="modal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="">Traitement de facture</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select class="form-select form-control" name="house" aria-label="Default select example">
                                        <option selected>Status</option>
                                        <option value="1">One</option>
                                        <option value="1">Two</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-dark" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn bg-red">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    @if(count($factures)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Faturier</th>
                            <th class="text-center">Maison</th>
                            <th class="text-center">Chambre</th>
                            <th class="text-center">Locataire</th>
                            <th class="text-center">Facture</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">Commentaire</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($factures as $facture)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center">{{$facture["owner"]["name"]}}</td>
                            <td class="text-center">{{$facture["location"]["house"]["name"]}}</td>
                            <td class="text-center">{{$facture["location"]["room"]["number"]}} </td>
                            <td class="text-center">{{$facture["location"]["locataire"]["name"]}} {{$facture["location"]["locataire"]["prenom"]}}</td>
                            <td class="text-center"><img src="{{$facture['facture']}}" class="img-fluid" width="50px" srcset="">
                            </td>
                            <td class="text-center">{{$facture['amount']}}</td>
                            <td class="text-center">
                                <textarea name="" class="form-control" id=""> {{$facture['comments']}} </textarea>
                            </td>
                            <td class="text-center">{{$facture['type']['name']}}</td>
                            <td class="text-center"> <button class="bg-success btn btn-sm">{{$facture['status']['name']}}</button> </td>


                            <td class="text-center">
                                <button class="btn btn-sm bg-red" data-bs-toggle="modal" data-bs-target="#changeStatus">Traiter la facture</button> &nbsp;
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center text-red">Aucune facture disponible pour cette location</p>
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
</x-templates.base>