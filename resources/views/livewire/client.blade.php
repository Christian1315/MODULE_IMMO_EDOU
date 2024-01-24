<div>
    <!-- TABLEAU DE LISTE -->
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm table-dark">
                    @if(count($clients)!=0)
                    <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Propriétaire ?</th>
                            <th class="text-center">Locataires ?</th>
                            <th class="text-center">Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr class="align-items-center">
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center">{{$client["name"]}}</td>
                            <td class="text-center">{{$client["type"]["name"]}}</td>
                            <td class="text-center">{{$client["phone"]}}</td>
                            @if($client["is_proprietor"])
                            <td class="text-center"> <span class="bg-red px-1">Non</span> </td>
                            @else
                            <td class="text-center"> <span class="bg-success px-1">Oui</span> </td>
                            @endif
                            @if($client["is_locator"])
                            <td class="text-center"> <span class="bg-red px-1">Non</span> </td>
                            @else
                            <td class="text-center"> <span class="bg-success px-1">Oui</span> </td>
                            @endif
                            <td class="text-center">
                                <textarea name="" id="" class="form-control"> {{$client["comments"]}} </textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <p class="text-center txet-red">Aucun client disponible!</p>
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